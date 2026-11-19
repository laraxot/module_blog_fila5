<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Collection;
=======
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\Rating;
use Webmozart\Assert\Assert;

class ShowArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'blog:article-show {articleId}';

    /**
     * The console command description.
     */
    protected $description = 'Visualizza articolo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
<<<<<<< HEAD
        $article = $this->resolveArticle();
        $ratings = $this->loadRatings($article);

        $this->info($this->resolveTitle($article));
        $this->table(
            ['id', 'title', 'is_winner', 'count', 'sum', 'avg', 'tot'],
            $this->buildRatingRows($article, $ratings),
        );
    }

    private function resolveArticle(): Article
    {
=======
>>>>>>> laraxot/dev
        $articleIdRaw = $this->argument('articleId');
        $articleId = is_scalar($articleIdRaw) ? (string) $articleIdRaw : '[ID non valido]';
        Assert::notNull($article = Article::firstWhere(['id' => $articleId]), '['.__LINE__.']['.__FILE__.']');

<<<<<<< HEAD
        return $article;
    }

    /**
     * @return Collection<int, Rating>
     */
    private function loadRatings(Article $article): Collection
    {
        return $article->ratings()
            ->where('user_id', null)
            ->get();
    }

    private function resolveTitle(Article $article): string
    {
        if (! is_scalar($article->title)) {
            return '[Titolo non valido]';
        }

        return (string) $article->title;
    }

    /**
     * @param Collection<int, Rating> $ratings
     *
     * @return list<array<int|float|bool|string|null>>
     */
    private function buildRatingRows(Article $article, Collection $ratings): array
    {
=======
        $ratings = $article->ratings()
            ->where('user_id', null)
            ->get();

        $title = is_scalar($article->title) ? (string) $article->title : '[Titolo non valido]';
        $this->info($title);
        $header = ['id', 'title', 'is_winner', 'count', 'sum', 'avg', 'tot'];
>>>>>>> laraxot/dev
        $rows = [];
        foreach ($ratings as $rating) {
            if (! $rating instanceof Rating) {
                continue;
            }

<<<<<<< HEAD
            $rows[] = $this->buildRatingRow($article, $ratings, $rating);
        }

        return $rows;
    }

    /**
     * @param Collection<int, Rating> $ratings
     *
     * @return array<int|float|bool|string|null>
     */
    private function buildRatingRow(
        Article $article,
        Collection $ratings,
        Rating $rating,
    ): array {
        $ratingId = $rating->getAttribute('id');
        $ratingTitle = $rating->getAttribute('title') ?? 'N/A';
        $pivotData = $rating->getRelation('pivot');
        $isWinner = $pivotData instanceof Pivot
            ? (bool) ($pivotData->getAttribute('is_winner') ?? false)
            : false;

        $tmpArticle = $this->loadRatingAggregates($article, $ratings, $ratingId);
        [$sum, $tot, $count, $avg] = $this->extractRatingAggregates($tmpArticle);

        return [
            $this->normalizeRatingId($ratingId),
            $this->normalizeRatingTitle($ratingTitle),
            $isWinner,
            $count,
            $sum,
            $avg,
            $tot,
        ];
    }

    /**
     * @return array{0: int, 1: int, 2: int, 3: float}
     */
    private function extractRatingAggregates(Article $article): array
    {
        $valueSum = $article->getAttribute('value_sum');
        $valueTot = $article->getAttribute('value_tot');
        $valueCount = $article->getAttribute('value_count');

        $sum = is_numeric($valueSum) ? (int) $valueSum : 0;
        $tot = is_numeric($valueTot) ? (int) $valueTot : 0;
        $count = is_numeric($valueCount) ? (int) $valueCount : 0;
        $avg = $tot > 0 ? round($sum * 100 / $tot, 2) : 0.0;

        return [$sum, $tot, $count, $avg];
    }

    private function normalizeRatingId(mixed $ratingId): int|string|null
    {
        return is_int($ratingId) || is_string($ratingId) ? $ratingId : null;
    }

    private function normalizeRatingTitle(mixed $ratingTitle): string
    {
        if (is_string($ratingTitle)) {
            return $ratingTitle;
        }

        return is_scalar($ratingTitle) ? (string) $ratingTitle : 'N/A';
    }

    /**
     * @param Collection<int, Rating> $ratings
     */
    private function loadRatingAggregates(
        Article $article,
        Collection $ratings,
        mixed $ratingId,
    ): Article {
        return $article->loadSum(['ratings as value_sum' => static function (Builder $query) use ($ratingId): void {
            Assert::isInstanceOf($query, Builder::class);
            $query
                ->where('ratings.id', $ratingId)
                ->where('rating_morph.user_id', '!=', null);
        },
        ], 'rating_morph.value')
            ->loadSum(['ratings as value_tot' => static function (Builder $query) use ($ratings): void {
                Assert::isInstanceOf($query, Builder::class);
                $query
                    ->whereIn('ratings.id', $ratings->modelKeys())
                    ->where('rating_morph.user_id', '!=', null);
            },
            ], 'rating_morph.value')
            ->loadCount(['ratings as value_count' => static function (Builder $query) use ($ratingId): void {
=======
            $ratingId = $rating->getAttribute('id');
            $ratingTitle = $rating->getAttribute('title') ?? 'N/A';
            $pivotData = $rating->getRelation('pivot');
            $isWinner = $pivotData instanceof Pivot
                ? ($pivotData->getAttribute('is_winner') ?? false)
                : false;

            $tmpArticle = $article->loadSum(['ratings as value_sum' => static function ($query) use ($ratingId): void {
>>>>>>> laraxot/dev
                Assert::isInstanceOf($query, Builder::class);
                $query
                    ->where('ratings.id', $ratingId)
                    ->where('rating_morph.user_id', '!=', null);
            },
<<<<<<< HEAD
            ], 'rating_morph.value');
=======
            ], 'rating_morph.value')
                ->loadSum(['ratings as value_tot' => static function ($query) use ($ratings): void {
                    Assert::isInstanceOf($query, Builder::class);
                    $query
                        ->whereIn('ratings.id', $ratings->modelKeys())
                        ->where('rating_morph.user_id', '!=', null);
                },
                ], 'rating_morph.value')
                ->loadCount(['ratings as value_count' => static function ($query) use ($ratingId): void {
                    Assert::isInstanceOf($query, Builder::class);
                    $query
                        ->where('ratings.id', $ratingId)
                        ->where('rating_morph.user_id', '!=', null);
                },
                ], 'rating_morph.value');

            // Use getAttribute to safely access dynamic properties
            $valueSum = $tmpArticle->getAttribute('value_sum');
            $valueTot = $tmpArticle->getAttribute('value_tot');
            $valueCount = $tmpArticle->getAttribute('value_count');

            $sum = is_numeric($valueSum) ? (int) $valueSum : 0;
            $tot = is_numeric($valueTot) ? (int) $valueTot : 0;
            $count = is_numeric($valueCount) ? (int) $valueCount : 0;
            $avg = $tot > 0 ? round($sum * 100 / $tot, 2) : 0;

            $data = [$ratingId, $ratingTitle, $isWinner, $count, $sum, $avg, $tot];
            $rows[] = $data;
        }
        $this->table($header, $rows);
>>>>>>> laraxot/dev
    }
}
