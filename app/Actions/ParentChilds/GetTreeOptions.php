<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\ParentChilds;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetTreeOptions
{
    use QueueableAction;

    /**
     * @param Model $model - Model that uses HasRecursiveRelationships
     *
     * @return array<int|string, string>
     */
    public function execute(Model $model): array
    {
        // Use tree() method for models with HasRecursiveRelationships
        if (method_exists($model, 'tree')) {
            $tree = $model->tree();
            Assert::object($tree, 'tree() must return an object');

            if (method_exists($tree, 'get')) {
                $collection = $tree->get();
                Assert::object($collection, 'get() must return an object');

                if (method_exists($collection, 'toTree')) {
                    /** @var Collection $models */
                    $models = $collection->toTree();
                } else {
                    // Fallback if toTree doesn't exist
                    $models = $collection;
                }
            } else {
                // Fallback if get doesn't exist
                $models = $tree;
            }
        } else {
            // Fallback for models without tree functionality
            $models = $model::all();
        }

        Assert::isIterable($models, 'Models must be iterable');

        $results = [];
        foreach ($models as $mod) {
            Assert::object($mod, 'Model item must be an object');

            if (property_exists($mod, 'id') && property_exists($mod, 'title')) {
                $id = $mod->id;
                $title = $mod->title;

                Assert::scalar($id, 'ID must be scalar');
                Assert::string($title, 'Title must be string');

                /* @phpstan-ignore-next-line offsetAccess.invalidOffset */
                $results[$id] = $title;

                // Handle children if they exist
                if (property_exists($mod, 'children') && is_iterable($mod->children)) {
                    foreach ($mod->children as $child) {
                        Assert::object($child, 'Child must be an object');

                        if (property_exists($child, 'id') && property_exists($child, 'title')) {
                            $childId = $child->id;
                            $childTitle = $child->title;

                            Assert::scalar($childId, 'Child ID must be scalar');
                            Assert::string($childTitle, 'Child title must be string');

                            /* @phpstan-ignore-next-line offsetAccess.invalidOffset */
                            $results[$childId] = '--------->'.$childTitle;

                            if (property_exists($child, 'children') && is_iterable($child->children)) {
                                foreach ($child->children as $cld) {
                                    Assert::object($cld, 'Grandchild must be an object');

                                    if (property_exists($cld, 'id') && property_exists($cld, 'title')) {
                                        $cldId = $cld->id;
                                        $cldTitle = $cld->title;

                                        Assert::scalar($cldId, 'Grandchild ID must be scalar');
                                        Assert::string($cldTitle, 'Grandchild title must be string');

                                        /* @phpstan-ignore-next-line offsetAccess.invalidOffset */
                                        $results[$cldId] = '----------------->'.$cldTitle;

                                        if (property_exists($cld, 'children') && is_iterable($cld->children)) {
                                            foreach ($cld->children as $c) {
                                                Assert::object($c, 'Great-grandchild must be an object');

                                                if (property_exists($c, 'id') && property_exists($c, 'title')) {
                                                    $cId = $c->id;
                                                    $cTitle = $c->title;

                                                    Assert::scalar($cId, 'Great-grandchild ID must be scalar');
                                                    Assert::string($cTitle, 'Great-grandchild title must be string');

                                                    /* @phpstan-ignore-next-line offsetAccess.invalidOffset */
                                                    $results[$cId] = '------------------------->'.$cTitle;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $results;
    }
}
