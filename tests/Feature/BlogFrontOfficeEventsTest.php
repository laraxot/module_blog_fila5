<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Blog\Database\Seeders\DemoContentSeeder;
use Modules\Blog\Models\Article;
use Modules\Blog\View\Composers\ThemeComposer;
use Modules\Cms\Actions\ResolvePageAction;
use Tests\TestCase;

/**
 * Behaviour: FO /it/events — content_type=event only, featured read-only, detail SEO.
 * Related: DemoContentSeederTest.php, BlogFrontOfficeNovitaTest.php.
 * User: «completa http://192.168.1.40:8000/it/events utilizzando bmad + second brain + filament blueprint».
 */
class BlogFrontOfficeEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @var list<string> */
    protected $connectionsToTransact = ['blog', 'comment'];

    public function testPaginatedAndFeaturedEventsAreContentTypeEventOnly(): void
    {
        app(DemoContentSeeder::class)->run();

        $composer = app(ThemeComposer::class);
        $events = $composer->paginatedEvents(20);
        $featured = $composer->featuredEvents(10);

        $this->assertGreaterThanOrEqual(5, $events->count());
        foreach ($events as $event) {
            $this->assertSame('event', $event->getAttribute('content_type'));
        }

        $this->assertNotEmpty($featured);
        foreach ($featured as $event) {
            $this->assertSame('event', $event->getAttribute('content_type'));
            $this->assertTrue(
                (bool) $event->getAttribute('is_featured') || (bool) $event->getAttribute('show_on_homepage'),
            );
        }
    }

    public function testFindPublishedEventBySlugIgnoresPosts(): void
    {
        app(DemoContentSeeder::class)->run();

        $post = Article::query()->where('content_type', 'post')->firstOrFail();
        $composer = app(ThemeComposer::class);

        $this->assertNull($composer->findPublishedEventBySlug((string) $post->getAttribute('slug')));

        $event = Article::query()->where('content_type', 'event')->firstOrFail();
        $found = $composer->findPublishedEventBySlug((string) $event->getAttribute('slug'));
        $this->assertInstanceOf(Article::class, $found);
        $this->assertSame('event', $found->getAttribute('content_type'));
    }

    public function testResolvePageActionEventsBranchReturnsOnlyEvents(): void
    {
        app(DemoContentSeeder::class)->run();

        $action = app(ResolvePageAction::class);
        $event = Article::query()->where('content_type', 'event')->firstOrFail();
        $post = Article::query()->where('content_type', 'post')->firstOrFail();

        $resolvedEvent = $action->execute('events', (string) $event->getAttribute('slug'));
        $this->assertSame('model', $resolvedEvent->renderMode);
        $this->assertInstanceOf(Article::class, $resolvedEvent->item);
        $this->assertSame('event', $resolvedEvent->item->getAttribute('content_type'));

        $resolvedPost = $action->execute('events', (string) $post->getAttribute('slug'));
        $this->assertNull($resolvedPost->item);
    }

    public function testEventsIndexHttpShowsFeaturedAndExplore(): void
    {
        app(DemoContentSeeder::class)->run();

        $response = $this->get('/it/events');
        $response->assertOk();
        $response->assertSee('Eventi', false);
        $response->assertSee('Eventi in evidenza', false);
        $response->assertSee('Tutti gli eventi', false);
    }

    public function testEventsDetailHttpUsesArticleTitle(): void
    {
        app(DemoContentSeeder::class)->run();

        $slug = 'passeggiata-quartiere-senza-ostacoli';
        $response = $this->get('/it/events/'.$slug);
        $response->assertOk();
        $response->assertSee('Passeggiata', false);
        $response->assertSee('Torna agli eventi', false);
        $response->assertSee('Asset Design Comuni', false);
    }
}
