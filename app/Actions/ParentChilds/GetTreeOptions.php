<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\ParentChilds;

use Illuminate\Database\Eloquent\Collection;
<<<<<<< HEAD
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Menu;
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> laraxot/dev
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetTreeOptions
{
    use QueueableAction;

    private static function optionArrayKey(bool|float|int|string $scalar): int|string
    {
        return match (true) {
            is_int($scalar) => $scalar,
            is_string($scalar) => $scalar,
            is_float($scalar) => (string) $scalar,
            default => $scalar ? 1 : 0,
        };
    }

    /**
<<<<<<< HEAD
     * @return array<int|string, string>
     */
    public function execute(Category|Menu $model): array
    {
        return $this->buildOptionsFromModels($this->resolveTreeModels($model));
    }

    /**
     * @return array<int, Category|Menu>
     */
    private function resolveTreeModels(Category|Menu $model): array
    {
        $collection = $model->tree()->get();
        Assert::isInstanceOf($collection, Collection::class, 'tree()->get() must return a collection');

        if (! method_exists($collection, 'toTree')) {
            return array_values($collection->all());
        }

        /** @var Collection<int, Category|Menu> $models */
        $models = $collection->toTree();

        return array_values($models->all());
    }

    /**
     * @param array<int, Category|Menu> $models
     *
     * @return array<int|string, string>
     */
    private function buildOptionsFromModels(array $models): array
    {
        $results = [];
        foreach ($models as $mod) {
            $this->appendModelOptions($results, $mod, '');
=======
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
                    /** @var \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model> $models */
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

                $results[self::optionArrayKey($id)] = $title;

                // Handle children if they exist
                if (property_exists($mod, 'children') && is_iterable($mod->children)) {
                    foreach ($mod->children as $child) {
                        Assert::object($child, 'Child must be an object');

                        if (property_exists($child, 'id') && property_exists($child, 'title')) {
                            $childId = $child->id;
                            $childTitle = $child->title;

                            Assert::scalar($childId, 'Child ID must be scalar');
                            Assert::string($childTitle, 'Child title must be string');

                            $results[self::optionArrayKey($childId)] = '--------->'.$childTitle;

                            if (property_exists($child, 'children') && is_iterable($child->children)) {
                                foreach ($child->children as $cld) {
                                    Assert::object($cld, 'Grandchild must be an object');

                                    if (property_exists($cld, 'id') && property_exists($cld, 'title')) {
                                        $cldId = $cld->id;
                                        $cldTitle = $cld->title;

                                        Assert::scalar($cldId, 'Grandchild ID must be scalar');
                                        Assert::string($cldTitle, 'Grandchild title must be string');

                                        $results[self::optionArrayKey($cldId)] = '----------------->'.$cldTitle;

                                        if (property_exists($cld, 'children') && is_iterable($cld->children)) {
                                            foreach ($cld->children as $c) {
                                                Assert::object($c, 'Great-grandchild must be an object');

                                                if (property_exists($c, 'id') && property_exists($c, 'title')) {
                                                    $cId = $c->id;
                                                    $cTitle = $c->title;

                                                    Assert::scalar($cId, 'Great-grandchild ID must be scalar');
                                                    Assert::string($cTitle, 'Great-grandchild title must be string');

                                                    $results[self::optionArrayKey($cId)] = '------------------------->'.$cTitle;
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
>>>>>>> laraxot/dev
        }

        return $results;
    }
<<<<<<< HEAD

    /**
     * @param array<int|string, string> $results
     */
    private function appendModelOptions(array &$results, Category|Menu $mod, string $prefix): void
    {
        $id = $mod->getAttribute('id');
        $title = $mod->getAttribute('title');
        Assert::scalar($id, 'ID must be scalar');
        Assert::string($title, 'Title must be string');

        $results[self::optionArrayKey($id)] = $prefix.$title;

        $children = $mod->getAttribute('children');
        if (! is_iterable($children)) {
            return;
        }

        foreach ($children as $child) {
            if (! $child instanceof Category && ! $child instanceof Menu) {
                continue;
            }

            $this->appendModelOptions($results, $child, $prefix.'--------->');
        }
    }
=======
>>>>>>> laraxot/dev
}
