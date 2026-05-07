<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

use Illuminate\Support\Collection;
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetBloodline
{
    use QueueableAction;

    public function execute(?int $category_id): Collection
    {
        if (null === $category_id) {
            return collect([]);
        }
        Assert::notNull($category = Category::find($category_id), '['.__LINE__.']['.__FILE__.']');

        // return $category->bloodline()->get()->reverse();
        return $category->ancestorsAndSelf()->get()->reverse();
    }
}
