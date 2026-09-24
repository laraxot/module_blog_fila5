<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Blog\Models;

<<<<<<< .merge_file_DVP7u6
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> laraxot/dev
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> .merge_file_EvvrvF
use Modules\Blog\Models\Concerns\HasPathByParentId;
use Spatie\EloquentSortable\SortableTrait;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

/**
 * @property string|null $parent_id
 * @property string      $name
 */
abstract class BaseTreeModel extends BaseModel
{
    use HasPathByParentId;
    use HasRecursiveRelationships;
    use SortableTrait;

    public function getDepthName(): string
    {
        return 'cte_depth';
    }

    public function getPathName(): string
    {
        return 'cte_path';
    }

<<<<<<< .merge_file_DVP7u6
<<<<<<< HEAD
=======
    public function makeChildOf(Model $parent): self // $parent is unused
    {// if ($node->isSelfOrDescendantOf($this)) {
        //    throw new MoveNotPossibleException('Cannot make unit descendant of itself');
=======
    public function makeChildOf(Model $parent): self // $parent is unused
    {// if ($node->isSelfOrDescendantOf($this)) {
        //    throw new MoveNotPossibleException('Cannot make unit descendant of itself');
<<<<<<< HEAD
>>>>>>> .merge_file_EvvrvF
                        // }

                        // Save the previous parent to be used when finishing.

                        $this->save();
<<<<<<< .merge_file_DVP7u6
=======
=======
                            // }

                            // Save the previous parent to be used when finishing.

                            $this->save();
>>>>>>> laraxot/dev
>>>>>>> .merge_file_EvvrvF

        return $this;
    }

<<<<<<< .merge_file_DVP7u6
>>>>>>> laraxot/dev
=======
>>>>>>> .merge_file_EvvrvF
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'name' => 'string',
            'parent_id' => 'string',
            'path' => 'string',
            'breads' => 'string',
            'root_name' => 'string',
            'is_leaf' => 'boolean',
            'ordering' => 'integer',
            'deleted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
