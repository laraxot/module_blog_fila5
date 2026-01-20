<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Spatie\LaravelData\Data;
use Stringable;
use Webmozart\Assert\Assert;

class ArticleData extends Data implements Stringable
{
    public string $title = '';

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
        if (is_array($title)) {
            $lang = app()->getLocale();
            $title = $title[$lang] ?? last($title);
        }
        if (is_string($title)) {
            $this->title = $title;
        }
        // $this->url = $this->getUrl();
        $this->categories = $this->getCategories();

        $this->closed_at_date = Carbon::parse($this->closed_at)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first(), '['.__LINE__.']['.__FILE__.']');
        // $this->betting_users = $article->getBettingUsers();
        $this->ratings = $article->getArrayRatingsWithImage();
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
    public function __toString(): string
    {
        return '['.__LINE__.']['.__FILE__.']';
    }

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

    public function url(string $type): string
    {
        $lang = app()->getLocale();
        if ($type === 'show') {
            return '/'.$lang.'/article/'.$this->slug;
        }

        // if ('edit' == $type) { // NON ESISTE EDIT NEL FRONTEND !!!
        //    return '/'.$lang.'/article/'.$this->slug.'/edit';
        // }

        return '#';
    }
}
