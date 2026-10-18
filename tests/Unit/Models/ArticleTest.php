<?php

declare(strict_types=1);

/**
 * Article Model Test Suite.
 *
 * Tests Blog\Models\Article functionality:
 * - Table configuration and relationships
 * - Article CRUD operations
 * - Category associations (many-to-many)
 * - Tag relationships
 * - Article publishing state
 * - Content translation support
 */

namespace Tests\Unit\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Blog\Models\Article;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Il modello Article vive sulla connessione `blog`: RefreshDatabase annulla solo la connessione predefinita,
     * senza questa riga le righe create da un test restano visibili ai successivi.
     *
     * @var list<string>
     */
    protected $connectionsToTransact = ['blog'];

    protected Article $article;

    protected function setUp(): void
    {
        parent::setUp();
        $this->article = new Article();
    }

    /**
     * @param array<string, mixed> $attributes
     */
    private function createArticle(array $attributes = []): Article
    {
        return ArticleFactory::new()->createOne($attributes);
    }

    private function freshArticle(Article $article): Article
    {
        $fresh = $article->fresh();
        $this->assertInstanceOf(Article::class, $fresh);

        return $fresh;
    }

    private function assertArticleIsPublished(Article $article): void
    {
        $this->assertTrue(
            Article::published()->whereKey($article->getKey())->exists()
        );
    }

    private function assertArticleIsDraft(Article $article): void
    {
        $this->assertFalse(
            Article::published()->whereKey($article->getKey())->exists()
        );
    }

    /** Article has correct table name */
    #[Test]
    public function itHasCorrectTableName(): void
    {
        $this->assertEquals('articles', $this->article->getTable());
    }

    /** Article has correct primary key */
    #[Test]
    public function itHasCorrectPrimaryKey(): void
    {
        $this->assertEquals('id', $this->article->getKeyName());
    }

    /** Article can be created with valid data */
    #[Test]
    public function itCanCreateArticleWithValidData(): void
    {
        $data = [
            'title' => 'Test Article',
            'slug' => 'test-article',
            'description' => 'Test description',
            'content_blocks' => [],
            'sidebar_blocks' => [],
            'footer_blocks' => [],
            'published_at' => Carbon::now(),
        ];

        $article = Article::create($data);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals('Test Article', $article->title);
        $this->assertEquals('test-article', $article->slug);
        $this->assertArticleIsPublished($article);
    }

    /** Article can be updated */
    #[Test]
    public function itCanUpdateArticle(): void
    {
        $article = $this->createArticle([
            'title' => 'Original Title',
            'slug' => 'original-title',
            'content' => 'Original content',
        ]);

        $blocks = [['type' => 'paragraph', 'data' => ['text' => 'Updated content']]];
        $article->update([
            'title' => 'Updated Title',
            'content_blocks' => $blocks,
        ]);

        $fresh = $this->freshArticle($article);
        $this->assertEquals('Updated Title', $fresh->title);
        $this->assertEquals($blocks, $fresh->content_blocks);
    }

    /** Article can be published */
    #[Test]
    public function itCanBePublished(): void
    {
        $article = $this->createArticle([
            'title' => 'Unpublished Article',
            'slug' => 'unpublished',
            'published_at' => null,
        ]);

        $article->update(['published_at' => Carbon::now()]);

        $this->assertArticleIsPublished($this->freshArticle($article));
    }

    /** Article can be unpublished */
    #[Test]
    public function itCanBeUnpublished(): void
    {
        $article = $this->createArticle([
            'title' => 'Published Article',
            'slug' => 'published',
            'published_at' => Carbon::now(),
        ]);

        $article->update(['published_at' => null]);

        $this->assertArticleIsDraft($this->freshArticle($article));
    }

    /** Article can be found by slug */
    #[Test]
    public function itCanBeFoundBySlug(): void
    {
        $created = $this->createArticle([
            'title' => 'Slug Test',
            'slug' => 'slug-test-unique',
            'content' => 'Test content',
        ]);

        $found = Article::where('slug', 'slug-test-unique')->first();

        $this->assertInstanceOf(Article::class, $found);
        $this->assertSame($created->id, $found->id);
        $this->assertEquals('Slug Test', $found->title);
    }

    /** Article can be found by title */
    #[Test]
    public function itCanBeFoundByTitle(): void
    {
        $created = $this->createArticle([
            'title' => 'Unique Title',
            'slug' => 'unique-title',
            'content' => 'Content',
        ]);

        $found = Article::where('title->'.app()->getLocale(), 'Unique Title')->first();

        $this->assertInstanceOf(Article::class, $found);
        $this->assertSame($created->id, $found->id);
        $this->assertEquals('unique-title', $found->slug);
    }

    /** Can query only published articles */
    #[Test]
    public function itCanQueryPublishedArticles(): void
    {
        $this->createArticle(['title' => 'Published 1', 'slug' => 'pub-1', 'published_at' => Carbon::now()]);
        $this->createArticle(['title' => 'Draft 1', 'slug' => 'draft-1', 'published_at' => null]);
        $this->createArticle(['title' => 'Published 2', 'slug' => 'pub-2', 'published_at' => Carbon::now()]);

        $published = Article::published()->get();

        $this->assertCount(2, $published);
    }

    /** Can query only draft articles */
    #[Test]
    public function itCanQueryDraftArticles(): void
    {
        $this->createArticle(['title' => 'Published', 'slug' => 'published', 'published_at' => Carbon::now()]);
        $this->createArticle(['title' => 'Draft 1', 'slug' => 'draft-1', 'published_at' => null]);
        $this->createArticle(['title' => 'Draft 2', 'slug' => 'draft-2', 'published_at' => null]);

        $drafts = Article::query()->whereNull('published_at')->get();

        $this->assertCount(2, $drafts);
    }

    /** Article uses timestamps */
    #[Test]
    public function itUsesTimestamps(): void
    {
        $this->assertTrue($this->article->usesTimestamps());
    }

    /** Article has created_at and updated_at */
    #[Test]
    public function itHasTimestamps(): void
    {
        $article = $this->createArticle([
            'title' => 'Timestamp Test',
            'slug' => 'timestamp-test',
        ]);

        $this->assertNotNull($article->created_at);
        $this->assertNotNull($article->updated_at);
    }

    /** Article can be deleted */
    #[Test]
    public function itCanBeDeleted(): void
    {
        $article = $this->createArticle([
            'title' => 'To Delete',
            'slug' => 'to-delete',
        ]);

        $article->delete();

        $this->assertSoftDeleted($article);
    }

    /** Article can be created with factory */
    #[Test]
    public function itCanBeCreatedWithFactory(): void
    {
        $article = $this->createArticle();

        $this->assertInstanceOf(Article::class, $article);
        $this->assertNotEmpty($article->title);
        $this->assertNotEmpty($article->slug);
    }

    /** Article can be queried and ordered by creation date */
    #[Test]
    public function itCanBeOrderedByCreatedDate(): void
    {
        $this->createArticle(['title' => 'First', 'slug' => 'first', 'created_at' => now()->subDays(2)]);
        $this->createArticle(['title' => 'Second', 'slug' => 'second', 'created_at' => now()]);
        $this->createArticle(['title' => 'Third', 'slug' => 'third', 'created_at' => now()->subDay()]);

        /** @var Collection<int, Article> $ordered */
        $ordered = Article::orderBy('created_at', 'asc')->get();

        $first = $ordered->get(0);
        $second = $ordered->get(1);
        $third = $ordered->get(2);

        $this->assertInstanceOf(Article::class, $first);
        $this->assertInstanceOf(Article::class, $second);
        $this->assertInstanceOf(Article::class, $third);
        $this->assertEquals('First', $first->title);
        $this->assertEquals('Third', $second->title);
        $this->assertEquals('Second', $third->title);
    }

    /** Article can be counted */
    #[Test]
    public function itCanBeCounted(): void
    {
        ArticleFactory::new()->count(5)->create();

        $count = Article::count();

        $this->assertGreaterThanOrEqual(5, $count);
    }

    /** Article query can be limited */
    #[Test]
    public function itCanBeLimited(): void
    {
        ArticleFactory::new()->count(10)->create();

        $limited = Article::limit(3)->get();

        $this->assertCount(3, $limited);
    }

    /** Article can be paginated */
    #[Test]
    public function itCanBePaginated(): void
    {
        ArticleFactory::new()->count(25)->create();

        $paginated = Article::paginate(10);

        $this->assertEquals(25, $paginated->total());
        $this->assertLessThanOrEqual(10, $paginated->perPage());
    }
}
