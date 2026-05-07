<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
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
        $articleIdRaw = $this->argument('articleId');
        $articleId = is_scalar($articleIdRaw) ? (string) $articleIdRaw : '[ID non valido]';
        Assert::notNull($article = Article::firstWhere(['id' => $articleId]), '['.__LINE__.']['.__FILE__.']');

        $ratings = $article->ratings()
            ->where('user_id', null)
            ->get();

        $title = is_scalar($article->title) ? (string) $article->title : '[Titolo non valido]';
        $this->info($title);
        $header = ['id', 'title', 'is_winner', 'count', 'sum', 'avg', 'tot'];
        $rows = [];
        foreach ($ratings as $rating) {
            if (! $rating instanceof Rating) {
                continue;
            }

            $ratingId = $rating->getAttribute('id');
            $ratingTitle = $rating->getAttribute('title') ?? 'N/A';
            $pivotData = $rating->getRelation('pivot');
            $isWinner = $pivotData instanceof Pivot
                ? ($pivotData->getAttribute('is_winner') ?? false)
                : false;

            $tmpArticle = $article->loadSum(['ratings as value_sum' => static function ($query) use ($ratingId): void {
                Assert::isInstanceOf($query, Builder::class);
                $query
                    ->where('ratings.id', $ratingId)
                    ->where('rating_morph.user_id', '!=', null);
            },
            ], 'rating_morph.value')
                ->loadSum(['ratings as value_tot' => static function ($query) use ($ratings): void {
                    Assert::isInstanceOf($query, Builder::class);
                    $query
                        ->whereIn('ratings.id', $ratings->modelKeys())
                        ->where('rating_morph.user_id', '!=', null);
                },
<<<<<<< Updated upstream
                ], 'rating_morph.value')
            /*
            ->loadAvg(['ratings as value_avg' => static function ($query) use ($rating) {
                $query
                    ->where('ratings.id', $rating->id)
                    ->where('rating_morph.user_id', '!=', null);
            }], 'rating_morph.value')
            */
                ->loadCount(['ratings as value_count' => static function ($query) use ($rating): void {
=======
            ], 'rating_morph.value')
                ->loadCount(['ratings as value_count' => static function ($query) use ($ratingId): void {
>>>>>>> Stashed changes
                    Assert::isInstanceOf($query, Builder::class);
                    $query
                        ->where('ratings.id', $ratingId)
                        ->where('rating_morph.user_id', '!=', null);
                },
<<<<<<< Updated upstream
                ], 'rating_morph.value');
=======
            ], 'rating_morph.value');
>>>>>>> Stashed changes

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
    }
}
