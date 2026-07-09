<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;

class GetBloodline
{
    use QueueableAction;

    /**
     * @return AdjacencyCollection<int, Category>
     */
    public function execute(?int $categoryId): AdjacencyCollection
    {
        if ($categoryId === null) {
            return new AdjacencyCollection;
        }

        $category = Category::query()->find($categoryId);
        if ($category === null) {
            return new AdjacencyCollection;
        }

        $relation = $category->ancestorsAndSelf();

        /** @var AdjacencyCollection<int, Category> $result */
        $result = $relation->get();

        return $result->reverse()->values();
    }
}
