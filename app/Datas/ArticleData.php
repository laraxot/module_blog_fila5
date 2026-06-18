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
     * @param array<int|string, mixed>|null          $contentBlocks
     * @param array<int|string, mixed>|null          $sidebarBlocks
     * @param array<int|string, mixed>|null          $footerBlocks
     * @param EloquentCollection<int, Category>|null $categories
     * @param array<int|string, mixed>|null          $ratings
     * @param Collection<int, string>|null           $tags
     */
    public function __construct(
        public string $id,
        public string $uuid,
        array|string $title,
        public string $slug,
        public ?int $categoryId,
        public ?string $status,
        public bool $showOnHomepage,
        public ?string $publishedAt,
        public ?array $contentBlocks,
        public ?array $sidebarBlocks,
        public ?array $footerBlocks,
        public ?EloquentCollection $categories,
        public ?string $url,
        public ?array $ratings,
        public ?string $closedAt,
        public ?string $closedAtDate,
        public ?string $timeLeftForHumans,
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

        $this->closedAtDate = Carbon::parse($this->closedAt)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first(), '['.__LINE__.']['.__FILE__.']');
        $this->ratings = $article->getArrayRatingsWithImage();
        $this->timeLeftForHumans = $article->getTimeLeftForHumans();
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
        return app(GetBloodline::class)->execute($this->categoryId);
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
