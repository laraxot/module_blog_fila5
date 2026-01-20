<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Xot\Models\XotBaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Base Model for Blog module.
 *
 * Extends XotBaseModel and adds:
 * - Spatie Media Library support (HasMedia, InteractsWithMedia)
 * - Soft Deletes support
 *
 * @see \Modules\Xot\Models\XotBaseModel
 */
abstract class BaseModel extends XotBaseModel implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'blog';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            // Module-specific casts only
            // Common casts (id, uuid, timestamps) are inherited from XotBaseModel
        ]);
    }
}
