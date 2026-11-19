<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
=======
use Illuminate\Support\Collection;
>>>>>>> laraxot/dev
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetBloodline
{
    use QueueableAction;

    /**
<<<<<<< HEAD
     * @return EloquentCollection<int, Category>
     */
    public function execute(?int $categoryId): EloquentCollection
    {
        if (null === $categoryId) {
            return new EloquentCollection();
        }
        Assert::notNull($category = Category::find($categoryId), '['.__LINE__.']['.__FILE__.']');

        return $category->ancestorsAndSelf()->get()->reverse()->values();
=======
     * @return Collection<int, \Modules\Blog\Models\Category>
     */
    public function execute(?int $category_id): Collection
    {
        if (null === $category_id) {
            return collect([]);
        }
        Assert::notNull($category = Category::find($category_id), '['.__LINE__.']['.__FILE__.']');

        // return $category->bloodline()->get()->reverse();
        return $category->ancestorsAndSelf()->get()->reverse();
>>>>>>> laraxot/dev
    }
}
