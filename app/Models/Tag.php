<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Closure;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Tags\Tag as BaseTag;

/**
 * Modules\Blog\Models\Tag.
 *
<<<<<<< HEAD
 * @property int $id
 * @property array<string, mixed> $name
 * @property array<string, mixed> $slug
 * @property string|null $type
 * @property int|null $order_column
=======
 * @property int         $id
 * @property array<string, string> $name
 * @property array<string, string> $slug
 * @property string|null $type
 * @property int|null    $order_column
>>>>>>> laraxot/dev
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_by
 *
<<<<<<< HEAD
 * @method static EloquentBuilder|Tag containing(string $name, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static EloquentBuilder|Tag ordered(string $direction = 'asc')
=======
 * @method static EloquentBuilder|Tag                       containing(string $name, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static EloquentBuilder|Tag                       ordered(string $direction = 'asc')
>>>>>>> laraxot/dev
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
<<<<<<< HEAD
 * @method static EloquentBuilder|Tag whereLocale(string $column, string $locale)
 * @method static EloquentBuilder|Tag whereLocales(string $column, array<string, mixed> $locales)
=======
 * @method static EloquentBuilder|Tag                       whereLocale(string $column, string $locale)
 * @method static EloquentBuilder|Tag                       whereLocales(string $column, array<int, string> $locales)
>>>>>>> laraxot/dev
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedBy($value)
<<<<<<< HEAD
 * @method static EloquentBuilder|Tag withType(?string $type = null)
 *
 * @property mixed $translations
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereDeletedBy($value)
 * @method static EloquentBuilder|Tag whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static EloquentBuilder|Tag whereJsonContainsLocales(string $column, array<string, mixed> $locales, ?mixed $value)
 * @method static Tag|null first()
 * @method static Collection<int, Tag> get()
 * @method static Tag create(array<string, mixed> $attributes = [])
 * @method static Tag firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static Tag findOrCreate(array<string, string>|string $name, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereNotNull((string|Expression) $columns)
 * @method static int count(string $columns = '*')
=======
 * @method static EloquentBuilder|Tag                       withType(?string $type = null)
 *
 * @property mixed       $translations
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tag         whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag         whereDeletedBy($value)
 * @method static EloquentBuilder|Tag                               whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static EloquentBuilder|Tag                               whereJsonContainsLocales(string $column, array<int, string> $locales, ?mixed $value)
 * @method static Tag|null                                          first()
 * @method static Collection<int, Tag>                              get()
 * @method static Tag                                               create(array<string, mixed> $attributes = [])
 * @method static Tag                                               firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereNotNull((string|Expression) $columns)
 * @method static int                                               count(string $columns = '*')
>>>>>>> laraxot/dev
 *
 * @mixin \Eloquent
 */
class Tag extends BaseTag
{
    protected $connection = 'blog';
}
