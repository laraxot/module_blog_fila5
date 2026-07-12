<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Blog\Models;

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
