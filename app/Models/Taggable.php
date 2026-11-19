<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Closure;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Modules\Xot\Contracts\ProfileContract;

/**
 * Modules\Blog\Models\Taggable.
 *
<<<<<<< HEAD
 * @property int $id
 * @property int $tag_id
 * @property string $taggable_type
 * @property int $taggable_id
=======
 * @property int         $id
 * @property int         $tag_id
 * @property string      $taggable_type
 * @property int         $taggable_id
>>>>>>> laraxot/dev
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
<<<<<<< HEAD
 * @property array<string, mixed> $custom_properties
=======
 * @property array<array-key, mixed> $custom_properties
>>>>>>> laraxot/dev
 *
 * @method static Builder|Taggable newModelQuery()
 * @method static Builder|Taggable newQuery()
 * @method static Builder|Taggable onlyTrashed()
 * @method static Builder|Taggable query()
 * @method static Builder|Taggable whereCreatedAt($value)
 * @method static Builder|Taggable whereCreatedBy($value)
 * @method static Builder|Taggable whereId($value)
 * @method static Builder|Taggable whereTagId($value)
 * @method static Builder|Taggable whereTaggableId($value)
 * @method static Builder|Taggable whereTaggableType($value)
 * @method static Builder|Taggable whereUpdatedAt($value)
 * @method static Builder|Taggable whereUpdatedBy($value)
 * @method static Builder|Taggable withTrashed()
 * @method static Builder|Taggable withoutTrashed()
 *
 * @property Carbon|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static Builder|Taggable whereDeletedAt($value)
 * @method static Builder|Taggable whereDeletedBy($value)
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
<<<<<<< HEAD
 * @method static Taggable|null first()
 * @method static Collection<int, Taggable> get()
 * @method static Taggable create(array<string, mixed> $attributes = [])
 * @method static Taggable firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static Builder<static>|Taggable where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder<static>|Taggable whereNotNull((string|Expression) $columns)
 * @method static int count(string $columns = '*')
=======
 * @method static Taggable|null             first()
 * @method static Collection<int, Taggable> get()
 * @method static Taggable                  create(array<string, mixed> $attributes = [])
 * @method static Taggable                  firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static Builder<static>|Taggable  where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder<static>|Taggable  whereNotNull((string|Expression) $columns)
 * @method static int                       count(string $columns = '*')
>>>>>>> laraxot/dev
 *
 * @mixin \Eloquent
 */
class Taggable extends BaseMorphPivot
{
    /**
     * Undocumented variable.
     */
    protected $table = 'taggables';  // spatie vuol cosi'

    protected $connection = 'blog';

    /** @var list<string> */
    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type',
        'custom_properties',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'custom_properties' => [],
    ];

    /**
<<<<<<< HEAD
     * @param  array<string, mixed>  $customProperties
=======
     * @param array<string, mixed> $customProperties
     * @return $this
>>>>>>> laraxot/dev
     */
    public function withCustomProperties(array $customProperties): self
    {
        // $this->customProperties = $customProperties;
        $this->custom_properties = $customProperties;

        return $this;
    }

    public function hasCustomProperty(string $propertyName): bool
    {
        return Arr::has($this->custom_properties, $propertyName);
    }

    /**
     * Get the value of custom property with the given name.
     */
    public function getCustomProperty(string $propertyName, mixed $default = null): mixed
    {
        return Arr::get($this->custom_properties, $propertyName, $default);
    }

    /**
<<<<<<< HEAD
     * @param  array<string, mixed>|int|string|float|null  $value
     * @return $this
     */
    public function setCustomProperty(string $name, int|string|float|array|null $value): static
=======
     * @param int|string|float|array<string, mixed>|null $value
     * @return $this
     */
    public function setCustomProperty(string $name, int|string|float|array|null $value): self
>>>>>>> laraxot/dev
    {
        $customProperties = $this->custom_properties;

        Arr::set($customProperties, $name, $value);

<<<<<<< HEAD
        $this->custom_properties = self::normalizeCustomProperties($customProperties);
=======
        $this->custom_properties = $this->typedCustomProperties($customProperties);
>>>>>>> laraxot/dev

        return $this;
    }

    public function forgetCustomProperty(string $name): self
    {
        $customProperties = $this->custom_properties;

        Arr::forget($customProperties, $name);

<<<<<<< HEAD
        $this->custom_properties = self::normalizeCustomProperties($customProperties);
=======
        $this->custom_properties = $this->typedCustomProperties($customProperties);
>>>>>>> laraxot/dev

        return $this;
    }

<<<<<<< HEAD
    /**
     * @param  array<mixed, mixed>  $properties
     * @return array<string, mixed>
     */
    private static function normalizeCustomProperties(array $properties): array
    {
        $normalized = [];
        foreach ($properties as $key => $value) {
            if (is_string($key)) {
                $normalized[$key] = $value;
            }
        }

        return $normalized;
=======

    /**
     * @param array<int|string, mixed> $properties
     * @return array<string, mixed>
     */
    private function typedCustomProperties(array $properties): array
    {
        $typed = [];
        foreach ($properties as $key => $value) {
            if (is_string($key)) {
                $typed[$key] = $value;
            }
        }

        return $typed;
>>>>>>> laraxot/dev
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'custom_properties' => 'array',
        ];
    }
}
