<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Closure;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;
use Modules\Blog\Actions\ParentChilds\GetTreeOptions;
use Modules\Blog\Database\Factories\CategoryFactory;
use Modules\Media\Models\Media;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

/**
 * Modules\Blog\Models\Category.
 *
 * @property int                                $id
 * @property string                             $title
 * @property string                             $slug
 * @property Carbon|null                        $created_at
 * @property Carbon|null                        $updated_at
 * @property string|null                        $updated_by
 * @property string|null                        $created_by
 * @property Collection<int, Article>           $articles
 * @property int|null                           $articles_count
 * @property MediaCollection<int, Media>        $media
 * @property int|null                           $media_count
 * @property array<string, mixed>|null          $description
 * @property Carbon|null                        $deleted_at
 * @property string|null                        $deleted_by
 * @property string|null                        $parent_id
 * @property AdjacencyCollection<int, Category> $children
 * @property int|null                           $children_count
 * @property Category|null                      $parent
 * @property int|null                           $post_counter
 * @property mixed                              $translations
 * @property AdjacencyCollection<int, Category> $ancestors
 * @property int|null                           $ancestors_count
 * @property AdjacencyCollection<int, Category> $ancestorsAndSelf
 * @property int|null                           $ancestors_and_self_count
 * @property AdjacencyCollection<int, Category> $bloodline
 * @property int|null                           $bloodline_count
 * @property AdjacencyCollection<int, Category> $childrenAndSelf
 * @property int|null                           $children_and_self_count
 * @property AdjacencyCollection<int, Category> $descendants
 * @property int|null                           $descendants_count
 * @property AdjacencyCollection<int, Category> $descendantsAndSelf
 * @property int|null                           $descendants_and_self_count
 * @property AdjacencyCollection<int, Category> $parentAndSelf
 * @property int|null                           $parent_and_self_count
 * @property Category|null                      $rootAncestor
 * @property AdjacencyCollection<int, Category> $siblings
 * @property int|null                           $siblings_count
 * @property AdjacencyCollection<int, Category> $siblingsAndSelf
 * @property int|null                           $siblings_and_self_count
 * @property string|null                        $icon
 * @property Banner|null                        $banner
 * @property Collection<int, Article>           $categoryArticles
 * @property int|null                           $category_articles_count
 * @property int                                $is_active
 * @property int                                $sort_order
 * @property ProfileContract|null               $creator
 * @property ProfileContract|null               $updater
 * @property ProfileContract|null               $deleter
 * @property string|null                        $name
 * @property int                                $depth
 * @property string                             $path
 *
 * @method static CategoryFactory                  factory($count = null, $state = [])
 * @method static Builder|Category                 newModelQuery()
 * @method static Builder|Category                 newQuery()
 * @method static Builder|Category                 onlyTrashed()
 * @method static Builder|Category                 query()
 * @method static Builder|Category                 whereCreatedAt($value)
 * @method static Builder|Category                 whereCreatedBy($value)
 * @method static Builder|Category                 whereId($value)
 * @method static Builder|Category                 whereSlug($value)
 * @method static Builder|Category                 whereTitle($value)
 * @method static Builder|Category                 whereUpdatedAt($value)
 * @method static Builder|Category                 whereUpdatedBy($value)
 * @method static Builder|Category                 withTrashed()
 * @method static Builder|Category                 withoutTrashed()
 * @method static AdjacencyCollection<int, static> all($columns = ['*'])
 * @method static Builder|Category                 breadthFirst()
 * @method static Builder|Category                 depthFirst()
 * @method static Builder|Category                 doesntHaveChildren()
 * @method static AdjacencyCollection<int, static> get($columns = ['*'])
 * @method static Builder|Category                 getExpressionGrammar()
 * @method static Builder|Category                 hasChildren()
 * @method static Builder|Category                 hasParent()
 * @method static Builder|Category                 isLeaf()
 * @method static Builder|Category                 isRoot()
 * @method static Builder|Category                 tree($maxDepth = null)
 * @method static Builder|Category                 treeOf((Model|callable) $constraint, $maxDepth = null)
 * @method static Builder|Category                 whereDeletedAt($value)
 * @method static Builder|Category                 whereDeletedBy($value)
 * @method static Builder|Category                 whereDepth($operator, $value = null)
 * @method static Builder|Category                 whereDescription($value)
 * @method static Builder|Category                 whereLocale(string $column, string $locale)
 * @method static Builder|Category                 whereLocales(string $column, array<string, mixed> $locales)
 * @method static Builder|Category                 whereParentId($value)
 * @method static Builder|Category                 withGlobalScopes(array<string, mixed> $scopes)
 * @method static Builder|Category                 withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @method static Builder|Category                 whereIcon($value)
 * @method static Builder|Category                 whereName($value)
 * @method static Builder|Category                 whereIsActive($value)
 * @method static Builder|Category                 whereSortOrder($value)
 * @method static Category|null                    first()
 * @method static Collection<int, Category>        get()
 * @method static Category                         create(array<string, mixed> $attributes = [])
 * @method static Category                         firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static Builder<static>|Category         where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder<static>|Category         whereNotNull((string|Expression) $columns)
 * @method static int                              count(string $columns = '*')
 *
 * @mixin Model
 * @mixin \Eloquent
 */
class Category extends BaseModel
{
    use HasRecursiveRelationships;
    use HasTranslations;

    /** @var array<int, string> */
    public array $translatable = [
        'title',
        'description',
    ];

    /**
     * Attributi assegnabili in massa (mass assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'name',
        'picture',
        'description',
        'parent_id',
        'in_leaderboard',
        'icon',
    ];

    /**
     * @return array<int|string, string>
     */
    public static function getTreeCategoryOptions(): array
    {
        $instance = new self();

        return app(GetTreeOptions::class)->execute($instance);
    }

    /**
     * Get the path key to the item for the frontend only.
     */
    public function getFrontRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsToMany<Article, $this, Pivot, 'pivot'>
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * @return HasMany<Article, $this>
     */
    public function categoryArticles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    /**
     * @return HasOne<Banner, $this>
     */
    public function banner(): HasOne
    {
        return $this->hasOne(Banner::class);
    }

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'title' => 'string',
            'slug' => 'string',
            'name' => 'string',
            'picture' => 'string',
            'description' => 'string',
            'parent_id' => 'string',
            'in_leaderboard' => 'boolean',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'icon' => 'string',
        ];
    }
}
