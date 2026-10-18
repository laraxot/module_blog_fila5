<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers\Support;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\Blog\Models\Article;

final class ThemeArticleQueries
{
    /**
     * @return EloquentCollection<int, Article>
     */
    public function allSorted(): EloquentCollection
    {
        return $this->contentQuery()->get()->sortBy(['created_at', 'desc']);
    }

    /**
     * @return Collection<int, Article>
     */
    public function featured(int $number): Collection
    {
        $rows = $this->contentQuery()->published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();

        if (0 !== $rows->count()) {
            return $rows;
        }

        $rows = $this->contentQuery()->get();
        $this->contentQuery()->update(['show_on_homepage' => true]);

        return $rows;
    }

    /**
     * @return Collection<int, Article>
     */
    public function latest(int $number): Collection
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * @return Collection<int, Article>
     */
    public function byCategory(string $categoryId, int $number): Collection
    {
        return $this->contentQuery()->where('category_id', $categoryId)
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginateByCategory(string $categoryId, int $limit): Paginator
    {
        return $this->contentQuery()->where('category_id', $categoryId)
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedLatest(int $limit): Paginator
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * Public editorial posts; events have their own Design Comuni listing.
     * Optional Design Comuni lista filters: keyword search + category slug.
     *
     * @return Paginator<int, Article>
     */
    public function paginatedPosts(int $limit, ?string $search = null, ?string $categorySlug = null): Paginator
    {
        $query = $this->contentQuery()
            ->where('content_type', 'post')
            ->with(['category'])
            ->published()
            ->publishedUntilToday();

        if (is_string($categorySlug) && '' !== $categorySlug) {
            $query->whereHas('category', static function (EloquentBuilder $categoryQuery) use ($categorySlug): void {
                $categoryQuery->where('slug', $categorySlug);
            });
        }

        if (is_string($search) && '' !== $search) {
            $like = '%'.$search.'%';
            $query->where(static function (EloquentBuilder $searchQuery) use ($like): void {
                $searchQuery
                    ->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhere('excerpt', 'like', $like);
            });
        }

        return $query
            ->orderByDesc('published_at')
            ->simplePaginate($limit)
            ->withQueryString();
    }

    public function findPublishedPostBySlug(string $slug): ?Article
    {
        /** @var Article|null $post */
        $post = $this->contentQuery()
            ->where('content_type', 'post')
            ->where('slug', $slug)
            ->published()
            ->publishedUntilToday()
            ->with(['category'])
            ->first();

        return $post;
    }

    /**
     * Post in evidenza per lista Novità (Design Comuni) — sola lettura, no side-effect.
     * Callers: ThemeArticleSupport::featuredPosts → ThemeComposer::featuredBlogPosts → blocks/blog/index.
     * Differisce da featured(): non aggiorna show_on_homepage.
     *
     * @return Collection<int, Article>
     */
    public function featuredPosts(int $number): Collection
    {
        return $this->contentQuery()
            ->where('content_type', 'post')
            ->where(static function (EloquentBuilder $query): void {
                $query->where('is_featured', true)
                    ->orWhere('show_on_homepage', true);
            })
            ->with(['category'])
            ->published()
            ->publishedUntilToday()
            ->orderByDesc('published_at')
            ->take($number)
            ->get();
    }

    /**
     * Public events listing (Design Comuni «Eventi» / Vivere il comune).
     *
     * @return Paginator<int, Article>
     */
    public function paginatedEvents(int $limit): Paginator
    {
        return $this->contentQuery()
            ->where('content_type', 'event')
            ->with(['category'])
            ->published()
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
    }

    public function findPublishedEventBySlug(string $slug): ?Article
    {
        /** @var Article|null $event */
        $event = $this->contentQuery()
            ->where('content_type', 'event')
            ->where('slug', $slug)
            ->published()
            ->with(['category'])
            ->first();

        return $event;
    }

    /**
     * Eventi in evidenza per lista Eventi (Design Comuni) — sola lettura, no side-effect.
     * Callers: ThemeArticleSupport::featuredEvents → ThemeComposer::featuredEvents → blocks/events/index.
     *
     * @return Collection<int, Article>
     */
    public function featuredEvents(int $number): Collection
    {
        return $this->contentQuery()
            ->where('content_type', 'event')
            ->where(static function (EloquentBuilder $query): void {
                $query->where('is_featured', true)
                    ->orWhere('show_on_homepage', true);
            })
            ->with(['category'])
            ->published()
            ->orderBy('event_start_date')
            ->take($number)
            ->get();
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedComingSoon(int $limit): Paginator
    {
        return $this->contentQuery()->where('content_type', 'event')->published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedByWagers(int $limit): Paginator
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedByVolume(int $limit): Paginator
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * @return Collection<int, Article>
     */
    public function comingSoon(int $number): Collection
    {
        return $this->contentQuery()->where('content_type', 'event')->published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->take($number)
            ->get();
    }

    /**
     * @return Collection<int, Article>
     */
    public function orderedByWagers(int $number): Collection
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * @return Collection<int, Article>
     */
    public function orderedByVolume(int $number): Collection
    {
        return $this->contentQuery()->published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * @return Collection<int, Article>
     */
    public function allByCreatedAt(): Collection
    {
        return $this->contentQuery()->orderBy('created_at', 'desc')->get();
    }

    /** @return EloquentBuilder<Article> */
    private function contentQuery(): EloquentBuilder
    {
        // SSoT: content_type=post|event (mai Parental `type`; article legacy escluso)
        return Article::query()->whereIn('content_type', ['post', 'event']);
    }
}
