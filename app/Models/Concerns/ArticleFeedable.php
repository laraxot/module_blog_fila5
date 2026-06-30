<?php

declare(strict_types=1);

namespace Modules\Blog\Models\Concerns;

use Modules\Blog\Support\ArticleDelegates;
use Spatie\Feed\FeedItem;

trait ArticleFeedable
{
    public function toFeedItem(): FeedItem
    {
        return ArticleDelegates::toFeedItem($this);
    }
}
