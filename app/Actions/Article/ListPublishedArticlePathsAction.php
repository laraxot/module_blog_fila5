<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Modules\Blog\View\Composers\Queries\ThemeArticleQueries;
use Modules\Seo\Contracts\SitemapLastModifiedContract;
use Modules\Seo\Contracts\SitemapPathsContract;
use Spatie\QueueableAction\QueueableAction;

/**
 * Percorsi di dettaglio di post ed eventi pubblicati, per la sitemap di Seo (DCP-273).
 *
 * /{lang}/blog/{slug} e /{lang}/events/{slug} li serve la pagina Folio del tema `[container0]/[slug0]/index.blade.php` tramite
 * `Cms\ResolvePageAction`, che chiede a `ThemeArticleQueries` gli stessi contenuti: qui si riusa quella query, non se ne scrive una nuova.
 */
final class ListPublishedArticlePathsAction implements SitemapLastModifiedContract, SitemapPathsContract
{
    use QueueableAction;

    /**
     * @return list<string>
     */
    public function execute(): array
    {
        $queries = app(ThemeArticleQueries::class);

        return [
            ...$this->paths('blog', $queries->publishedPostSlugs()),
            ...$this->paths('events', $queries->publishedEventSlugs()),
        ];
    }

    /**
     * @param  Collection<int, mixed>  $slugs
     * @return list<string>
     */
    private function paths(string $section, Collection $slugs): array
    {
        $paths = [];
        foreach ($slugs as $slug) {
            if (is_string($slug) && $slug !== '') {
                $paths[] = $section.'/'.rawurlencode($slug);
            }
        }

        return $paths;
    }

    /**
     * Ultima modifica di post ed eventi pubblicati, con gli stessi percorsi di execute() (#736).
     *
     * @see Modules/Seo/docs/adr/search-engine-presence.md
     *
     * @return array<string, DateTimeInterface>
     */
    public function lastModified(): array
    {
        $queries = app(ThemeArticleQueries::class);

        return [
            ...$this->dates('blog', $queries->publishedPostLastModified()),
            ...$this->dates('events', $queries->publishedEventLastModified()),
        ];
    }

    /**
     * @param  Collection<string, mixed>  $dates  slug => updated_at
     * @return array<string, DateTimeInterface>
     */
    private function dates(string $section, Collection $dates): array
    {
        $result = [];
        foreach ($dates as $slug => $updatedAt) {
            if (is_string($slug) && $slug !== '' && $updatedAt instanceof DateTimeInterface) {
                $result[$section.'/'.rawurlencode($slug)] = $updatedAt;
            }
        }

        return $result;
    }
}
