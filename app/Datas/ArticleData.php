<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

/**
 * @phpstan-consistent-constructor
 */
class ArticleData extends Data implements \Stringable
{
    public string $title;

    /**
     * @param array<string, string>|string           $title
     * @param array<int|string, mixed>|null          $content_blocks
     * @param array<int|string, mixed>|null          $sidebar_blocks
     * @param array<int|string, mixed>|null          $footer_blocks
     * @param EloquentCollection<int, Category>|null $categories
     * @param array<int|string, mixed>|null          $ratings
     * @param Collection<int, string>|null            $tags
     */
    public function __construct(
        public string $id,
        public string $uuid,
        array|string $title,
        public string $slug,
        public ?int $category_id,
        public ?string $status,
        public bool $show_on_homepage,
        public ?string $published_at,
        public ?array $content_blocks,
        public ?array $sidebar_blocks,
        public ?array $footer_blocks,
        public ?EloquentCollection $categories,
        public ?string $url,
        public ?array $ratings,
        public ?string $closed_at,
        public ?string $closed_at_date,
        public ?string $time_left_for_humans,
        public ?Collection $tags,
    ) {
        $resolved = $title;
        if (is_array($title)) {
            $lang = app()->getLocale();
            $resolved = $title[$lang] ?? last($title);
        }
        $this->title = is_string($resolved)
            ? $resolved
            : (is_scalar($resolved) ? (string) $resolved : '');
        $this->categories = $this->getCategories();

        $this->closed_at_date = Carbon::parse($this->closed_at)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first(), '['.__LINE__.']['.__FILE__.']');
        $this->ratings = $article->getArrayRatingsWithImage();
        $this->time_left_for_humans = $article->getTimeLeftForHumans();
        $this->tags = $article->tags->map(static fn ($tag): string => is_string($tag->name ?? null) ? $tag->name : (string) ($tag->name ?? ''));
    }

    public function __toString(): string
    {
        return '['.__LINE__.']['.__FILE__.']';
    }

    /**
     * @return EloquentCollection<int, Category>
     */
    public function getCategories(): EloquentCollection
    {
        return app(GetBloodline::class)->execute($this->category_id);
    }

    public function url(string $type): string
    {
        $lang = app()->getLocale();
        if ('show' === $type) {
            return '/'.$lang.'/article/'.$this->slug;
        }

        return '#';
    }
}
