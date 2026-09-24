<?php

declare(strict_types=1);

namespace Modules\Blog\Models\Concerns;

<<<<<<< HEAD
use Modules\Blog\Actions\Article\ConvertArticleToFeedItemAction;
=======
use Modules\Blog\Support\ArticleDelegates;
>>>>>>> laraxot/dev
use Spatie\Feed\FeedItem;

trait ArticleFeedable
{
    public function toFeedItem(): FeedItem
    {
<<<<<<< HEAD
        return app(ConvertArticleToFeedItemAction::class)->execute($this);
=======
        return ArticleDelegates::toFeedItem($this);
>>>>>>> laraxot/dev
    }
}
