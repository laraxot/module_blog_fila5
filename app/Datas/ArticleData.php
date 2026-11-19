<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
<<<<<<< HEAD
use Spatie\LaravelData\Data;

/**
 * @phpstan-consistent-constructor
 */
=======
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

>>>>>>> laraxot/dev
class ArticleData extends Data implements \Stringable
{
    public string $title;

<<<<<<< HEAD
    public string $id;

    public string $uuid;

    public string $slug;

    public ?int $categoryId;

    public ?string $status;

    public bool $showOnHomepage;

    public ?string $publishedAt;

    /** @var array<int|string, mixed>|null */
    public ?array $contentBlocks;

    /** @var array<int|string, mixed>|null */
    public ?array $sidebarBlocks;

    /** @var array<int|string, mixed>|null */
    public ?array $footerBlocks;

    public ?string $url;

    public ?string $closedAt;

    public ArticleDataHydrated $hydrated;

    /**
     * @param array<int|string, mixed>|string $title
     */
    public function __construct(
        ArticleDataCore $core,
        array|string $title,
        ArticleDataBlocks $blocks,
    ) {
        $this->id = $core->id;
        $this->uuid = $core->uuid;
        $this->slug = $core->slug;
        $this->categoryId = $core->categoryId;
        $this->status = $core->status;
        $this->showOnHomepage = $core->showOnHomepage;
        $this->publishedAt = $core->publishedAt;
        $this->url = $core->url;
        $this->closedAt = $core->closedAt;
        $this->contentBlocks = $blocks->contentBlocks;
        $this->sidebarBlocks = $blocks->sidebarBlocks;
        $this->footerBlocks = $blocks->footerBlocks;

        $this->title = self::resolveTitle($title);
        $this->hydrated = $this->buildHydratedData();
    }

    /**
     * @param array<string, mixed> $payload
     */
    public static function fromPayload(array $payload): static
    {
        return new static(
            core: ArticleDataPayloadMapper::coreFromPayload($payload),
            title: ArticleDataPayloadMapper::titleFromPayload($payload),
            blocks: ArticleDataPayloadMapper::blocksFromPayload($payload),
        );
    }

    public static function from(mixed ...$payloads): static
    {
        if (1 === count($payloads) && is_array($payloads[0])) {
            /** @var array<string, mixed> $singlePayload */
            $singlePayload = $payloads[0];

            return static::fromPayload($singlePayload);
        }

        return parent::from(...$payloads);
    }

=======
    /**
     * @param array<string, string>|string $title
     * @param array<int|string, mixed>|null $content_blocks
     * @param array<int|string, mixed>|null $sidebar_blocks
     * @param array<int|string, mixed>|null $footer_blocks
     * @param Collection<int, Category>|null $categories
     * @param array<int|string, array<string, mixed>>|null $ratings
     * @param Collection<int, mixed>|null $tags
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
        public ?Collection $categories,
        public ?string $url,
        public ?array $ratings,
        public ?string $closed_at,
        public ?string $closed_at_date,
        // public ?int $betting_users,
        public ?string $time_left_for_humans,
        // public ?float $volume_credit,
        public ?Collection $tags,
        // public string $class,
        // public string $articleId;
        // public string $ratingId;
        // public int $credit;
    ) {
        $resolved = $title;
        if (is_array($title)) {
            $lang = app()->getLocale();
            $resolved = $title[$lang] ?? last($title);
        }
        $this->title = is_string($resolved)
            ? $resolved
            : (is_scalar($resolved) ? (string) $resolved : '');
        // $this->url = $this->getUrl();
        $this->categories = $this->getCategories();

        $this->closed_at_date = Carbon::parse($this->closed_at)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first(), '['.__LINE__.']['.__FILE__.']');
        // $this->betting_users = $article->getBettingUsers();
        $ratings = $article->getArrayRatingsWithImage();
        $this->ratings = is_array($ratings) ? array_values($ratings) : null;
        $this->time_left_for_humans = $article->getTimeLeftForHumans();
        // $this->volume_credit = $article->getVolumeCredit();
        $this->tags = $article->tags->map(fn ($tag) => $tag->name ?? '');
    }

    // public function getClosedAt(): string
    // {
    //     return $carbonDate = Carbon::parse($this->closed_at)->format('Y-m-d');
    // }

    // public function getTimeLeftForHumans(): string
    // {
    //     dddx('a');
    //     return $this->getArticle()->getTimeLeftForHumans();
    // }
>>>>>>> laraxot/dev
    public function __toString(): string
    {
        return '['.__LINE__.']['.__FILE__.']';
    }

<<<<<<< HEAD
=======
    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return app(GetBloodline::class)->execute($this->category_id);

        // Assert::notNull($category = Category::find($this->category_id),'['.__LINE__.']['.__FILE__.']');

        // return $category->bloodline()->get()->reverse();
    }

    // public function getArticle(): Article
    // {
    //     Assert::notNull($article = Article::where('uuid', $this->uuid)->first(),'['.__LINE__.']['.__FILE__.']');

    //     return $article;
    // }

    // public function getRatings(): array
    // {
    //     return $this->getArticle()->getArrayRatingsWithImage();
    // }

    // public function getBettingUsers(): int
    // {
    //     return $this->getArticle()->getBettingUsers();
    // }

>>>>>>> laraxot/dev
    public function url(string $type): string
    {
        $lang = app()->getLocale();
        if ('show' === $type) {
            return '/'.$lang.'/article/'.$this->slug;
        }

<<<<<<< HEAD
        return '#';
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this->hydrated, $name)) {
            return $this->hydrated->{$name};
        }

        throw new \RuntimeException(sprintf('Undefined property [%s] on ArticleData.', $name));
    }

    public function __isset(string $name): bool
    {
        return property_exists($this->hydrated, $name);
    }

    private function buildHydratedData(): ArticleDataHydrated
    {
        $categories = app(GetBloodline::class)->execute($this->categoryId);
        $closedAtDate = null !== $this->closedAt ? Carbon::parse($this->closedAt)->format('Y-m-d') : null;

        $article = ArticleDataHydrator::findByUuid($this->uuid);

        return new ArticleDataHydrated(
            categories: $categories,
            ratings: $article->getArrayRatingsWithImage(),
            closedAtDate: $closedAtDate,
            timeLeftForHumans: $article->getTimeLeftForHumans(),
            tags: new Collection($article->tags->map(
                static function (mixed $tag): string {
                    if (! is_object($tag)) {
                        return '';
                    }

                    $name = $tag->name ?? null;

                    return is_string($name) ? $name : (is_scalar($name) ? (string) $name : '');
                },
            )->all()),
        );
    }

    /**
     * @param array<int|string, mixed>|string $title
     */
    private static function resolveTitle(array|string $title): string
    {
        $resolved = $title;
        if (is_array($title)) {
            $lang = app()->getLocale();
            $resolved = $title[$lang] ?? last($title);
        }

        return is_string($resolved)
            ? $resolved
            : (is_scalar($resolved) ? (string) $resolved : '');
    }
=======
        // if ('edit' == $type) { // NON ESISTE EDIT NEL FRONTEND !!!
        //    return '/'.$lang.'/article/'.$this->slug.'/edit';
        // }

        return '#';
    }
>>>>>>> laraxot/dev
}
