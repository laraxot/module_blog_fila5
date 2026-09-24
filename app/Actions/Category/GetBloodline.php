<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

<<<<<<< HEAD
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;
=======
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;
>>>>>>> laraxot/dev

class GetBloodline
{
    use QueueableAction;

    /**
<<<<<<< HEAD
     * @return AdjacencyCollection<int, Category>
     */
    public function execute(?int $categoryId): AdjacencyCollection
    {
        if (null === $categoryId) {
            return new AdjacencyCollection();
        }

        $category = Category::query()->find($categoryId);
        if (null === $category) {
            return new AdjacencyCollection();
        }

        $relation = $category->ancestorsAndSelf();

        /** @var AdjacencyCollection<int, Category> $result */
        $result = $relation->get();

        return $result->reverse()->values();
=======
     * @return EloquentCollection<int, Category>
     */
    public function execute(?int $categoryId): EloquentCollection
    {
        if (null === $categoryId) {
            return new EloquentCollection();
        }
        Assert::notNull($category = Category::find($categoryId), '['.__LINE__.']['.__FILE__.']');

        return $category->ancestorsAndSelf()->get()->reverse()->values();
>>>>>>> laraxot/dev
    }
}
