<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Carbon\Carbon;
<<<<<<< HEAD
use Carbon\CarbonInterface;
=======
>>>>>>> laraxot/dev
use Illuminate\Support\Str;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;

use function Safe\json_decode;

use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportArticlesFromByJsonTextAction
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(string $jsonText): void
    {
        /** @var array<mixed> $json */
        $json = json_decode($jsonText, true);
        Assert::isArray($json, '['.__LINE__.']['.__FILE__.']');

        foreach ($json as $item) {
            Assert::isArray($item, 'Each element must be an array');
            $this->importArticle($item);
        }
    }

    /**
     * @param array<mixed> $item
     */
    private function importArticle(array $item): void
    {
        $parentCategoryId = $this->importCategories($item);
        $article = $this->upsertArticle($item, $parentCategoryId);
        $this->importRatings($article, $item);
    }

    /**
     * @param array<mixed> $item
     */
    private function importCategories(array $item): ?int
    {
        $parentCategoryId = null;
        /** @var array<mixed> $categories */
        $categories = $item['category'] ?? [];
        Assert::isArray($categories, 'Category must be an array');

        foreach ($categories as $categoryItem) {
            Assert::isArray($categoryItem, 'Category item must be an array');
            $parentCategoryId = $this->upsertCategory($categoryItem, $parentCategoryId);
        }

        return $parentCategoryId;
    }

    /**
     * @param array<mixed> $categoryItem
     */
    private function upsertCategory(array $categoryItem, ?int $parentCategoryId): int
    {
        $categoryData = [
            'title' => $categoryItem['title'] ?? '',
            'slug' => $categoryItem['slug'] ?? '',
            'parent_id' => $parentCategoryId,
        ];
        $categoryWhere = ['slug' => $categoryData['slug']];
        /** @var Category $category */
        $category = Category::firstOrCreate($categoryWhere, $categoryData);

        return (int) $category->id;
    }

    /**
     * @param array<mixed> $item
     */
    private function upsertArticle(array $item, ?int $parentCategoryId): Article
    {
        $articleWhere = [
            'slug' => $item['slug'],
        ];

        $articleData = [
            'uuid' => Str::uuid(),
            'title' => $item['title'],
            'slug' => $item['slug'],
            'status' => $item['status'],
            'status_display' => 'open' === $item['status_display'],
            'bet_end_date' => $this->parseOptionalDate($item['bet_end_date'] ?? ''),
            'event_start_date' => $this->parseOptionalDate($item['event_start_date'] ?? ''),
            'event_end_date' => $this->parseOptionalDate($item['event_end_date'] ?? ''),
            'is_wagerable' => $item['is_wagerable'],
            'brier_score' => $item['brier_score'],
            'brier_score_play_money' => $item['brier_score_play_money'],
            'brier_score_real_money' => $item['brier_score_real_money'],
            'wagers_count' => $item['wagers_count'],
            'wagers_count_canonical' => $item['wagers_count_canonical'],
            'wagers_count_total' => $item['wagers_count_total'],
            'wagers' => $item['wagers'],
            'volume_play_money' => $item['volume_play_money'],
            'volume_real_money' => $item['volume_real_money'],
            'is_following' => $item['volume_real_money'],
            'category_id' => $parentCategoryId,
            'published_at' => Carbon::today()->toDateString(),
        ];

        /** @var Article $article */
        $article = Article::firstOrCreate($articleWhere, $articleData);

        return $article;
    }

    /**
     * @param array<mixed> $item
     */
    private function importRatings(Article $article, array $item): void
    {
        /** @var array<int, array<string, mixed>> $outcomes */
        $outcomes = $item['outcomes'];
        foreach ($outcomes as $rating) {
            if (! is_array($rating)) {
                continue;
            }

            $this->upsertRating($article, $rating);
        }
    }

    /**
     * @param array<string, mixed> $rating
     */
    private function upsertRating(Article $article, array $rating): void
    {
        $ratingTitle = is_string($rating['title'] ?? null) ? $rating['title'] : '';
        $ratingWhere = ['title' => $ratingTitle];
        $ratingData = [
            'title' => $ratingTitle,
            'is_disabled' => (bool) ($rating['disabled'] ?? false),
        ];

        $ratingModel = $article->ratings()->firstOrCreate($ratingWhere, $ratingData);
        if (! isset($rating['thumbnail_2x']) || ! is_string($rating['thumbnail_2x'])) {
            return;
        }

        if (! method_exists($ratingModel, 'addMediaFromUrl')) {
            return;
        }

        $fileAdder = $ratingModel->addMediaFromUrl($rating['thumbnail_2x']);
        Assert::isInstanceOf($fileAdder, FileAdder::class);
        $fileAdder->toMediaCollection('rating');
    }

    private function parseOptionalDate(mixed $value): CarbonInterface|string
    {
        if (! \is_string($value) || mb_strlen($value) <= 3) {
            return \is_string($value) ? $value : '';
        }

        return Carbon::parse($value);
    }
=======
    public function execute(string $json_text): void
    {
        /** @var array<string, mixed> $json */
        $json = json_decode($json_text, true);
        Assert::isArray($json, '['.__LINE__.']['.__FILE__.']');

        /** @var array<string, mixed> $j */
        foreach ($json as $j) {
            Assert::isArray($j, 'Each element must be an array');

            $bet_end_date = $j['bet_end_date'] ?? '';
            if (\is_string($bet_end_date) && mb_strlen($bet_end_date) > 3) {
                $bet_end_date = Carbon::parse($bet_end_date);
            }
            $event_start_date = $j['event_start_date'] ?? '';
            if (\is_string($event_start_date) && mb_strlen($event_start_date) > 3) {
                $event_start_date = Carbon::parse($event_start_date);
            }
            $event_end_date = $j['event_end_date'] ?? '';
            if (\is_string($event_end_date) && mb_strlen($event_end_date) > 3) {
                $event_end_date = Carbon::parse($event_end_date);
            }

            $parent_category_id = null;
            /** @var array<int, array<string, mixed>> $categories */
            $categories = $j['category'] ?? [];
            Assert::isArray($categories, 'Category must be an array');

            /** @var array<string, mixed> $cat */
            foreach ($categories as $cat) {
                // dddx($category);
                Assert::isArray($cat, 'Category item must be an array');
                $cd = $cat;
                $category_data = [
                    'title' => $cd['title'] ?? '',
                    'slug' => $cd['slug'] ?? '',
                    'parent_id' => $parent_category_id,
                ];
                $category_where = ['slug' => $category_data['slug']];
                /** @var Category $category */
                $category = Category::firstOrCreate($category_where, $category_data);
                $parent_category_id = $category->id;
                // dddx($parent_category_id);
            }

            $article_where = [
                'slug' => $j['slug'],
            ];

            $article_data = [
                'uuid' => Str::uuid(),
                'title' => $j['title'],
                'slug' => $j['slug'],
                'status' => $j['status'],
                'status_display' => 'open' === $j['status_display'],
                'bet_end_date' => $bet_end_date,
                'event_start_date' => $event_start_date,
                'event_end_date' => $event_end_date,
                'is_wagerable' => $j['is_wagerable'],
                'brier_score' => $j['brier_score'],
                'brier_score_play_money' => $j['brier_score_play_money'],
                'brier_score_real_money' => $j['brier_score_real_money'],
                'wagers_count' => $j['wagers_count'],
                'wagers_count_canonical' => $j['wagers_count_canonical'],
                'wagers_count_total' => $j['wagers_count_total'],
                'wagers' => $j['wagers'],
                'volume_play_money' => $j['volume_play_money'],
                'volume_real_money' => $j['volume_real_money'],
                'is_following' => $j['volume_real_money'],
                'category_id' => $parent_category_id,
                'published_at' => Carbon::today()->toDateString(),
            ];

            // dddx($article_data);

            $article = Article::firstOrCreate($article_where, $article_data);

            /** @var array<int, mixed> $outcomes */
            $outcomes = $j['outcomes'];
            /** @var array<string, mixed> $rating */
            foreach ($outcomes as $rating) {
                $rating_where = [
                    'title' => $rating['title'] ?? '',
                ];
                $rating_data = [
                    'title' => $rating['title'] ?? '',
                    'is_disabled' => $rating['disabled'] ?? false,
                ];

                $ratingModel = $article->ratings()->firstOrCreate($rating_where, $rating_data);
                if (isset($rating['thumbnail_2x']) && is_string($rating['thumbnail_2x'])) {
                    if (! method_exists($ratingModel, 'addMediaFromUrl')) {
                        continue;
                    }

                    $fileAdder = $ratingModel->addMediaFromUrl($rating['thumbnail_2x']);
                    Assert::isInstanceOf($fileAdder, FileAdder::class);

                    $fileAdder->toMediaCollection('rating');
                }
            }

            // dddx($j['outcomes']);
        }
    }
>>>>>>> laraxot/dev
}
