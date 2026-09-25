<?php

declare(strict_types=1);

namespace Modules\Blog\Models\Concerns;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Actions\Article\ConvertArticleToFeedItemAction;
=======
use Modules\Blog\Support\ArticleDelegates;
>>>>>>> laraxot/dev
=======
use Modules\Blog\Actions\Article\ConvertArticleToFeedItemAction;
>>>>>>> b591d4e (Lint)
use Spatie\Feed\FeedItem;

trait ArticleFeedable
{
    public function toFeedItem(): FeedItem
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return app(ConvertArticleToFeedItemAction::class)->execute($this);
=======
        return ArticleDelegates::toFeedItem($this);
>>>>>>> laraxot/dev
=======
        return app(ConvertArticleToFeedItemAction::class)->execute($this);
>>>>>>> b591d4e (Lint)
    }
}
