<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Blog\Models\Concerns\ArticleFeedable;
use Modules\Blog\Models\Concerns\ArticleQueryScopes;
use Modules\Blog\Support\ArticleDelegates;
use Modules\Comment\Models\Comment;
use Modules\Comment\Models\CommentNotificationSubscription;
use Modules\Comment\Models\Concerns\HasComments;
use Modules\Comment\Models\Contracts\SupportsCommentNotifications;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Models\Traits\HasRating;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Parental\HasChildren;
use Spatie\Feed\Feedable;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * Blog article aggregate — scopes in {@see ArticleQueryScopes}, presentation in {@see ArticleDelegates}.
 *
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $body
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string|null $main_image_upload
 * @property string|null $main_image_url
 * @property Category|null $category
 * @property UserContract|null $user
 * @property array<int, array<string, mixed>>|null $content_blocks
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasTranslationsContract, SupportsCommentNotifications
{
    use ArticleFeedable;
    use ArticleQueryScopes;
    use HasChildren;
    use HasComments;
    use HasRating;
    use HasTags;
    use HasTranslations;

    /** @var array<int, string> */
    public array $translatable = [
        'title',
        // 'description',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];

    /**
     * Attributi assegnabili in massa (mass assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'slug',
        // 'description',
        'body',
        'images',
        'viewCount',

        'content_blocks',
        'footer_blocks',
        'sidebar_blocks',
        'is_featured',
        'main_image_upload',
        'main_image_url',
        'published_at',
        'closed_at',
        'category_id',
        'type',
        'status',
        'status_display',
        'bet_end_date',
        'event_start_date',
        'event_end_date',
        'is_wagerable',
        'brier_score',
        'brier_score_play_money',
        'brier_score_real_money',
        'wagers_count',
        'wagers_count_canonical',
        'wagers_count_total',
        'wagers',
        'volume_play_money',
        'volume_real_money',
        'is_following',
        'rewarded_at',
    ];

    /**
     * Ottiene la traduzione di un attributo in una specifica lingua.
     *
     * @param string $key               Il nome dell'attributo da tradurre
     * @param string $locale            Il codice della lingua richiesta
     * @param bool   $useFallbackLocale Se utilizzare o meno la lingua di fallback
     *
     * @return array<int|string, mixed>|string|int|null Il valore tradotto dell'attributo
     *
     * @SuppressWarnings("PHPMD.BooleanArgumentFlag")
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): array|string|int|null
    {
        return ArticleDelegates::translation($this, $key, $locale, $useFallbackLocale);
    }

    /**
     * Restituisce tutti i feed item.
     *
     * @return Collection<int, Article>
     */
    public static function getAllFeedItems(): Collection
    {
        /** @var Collection<int, Article> $result */
        $result = static::latest()->take(150)->get();

        return $result;
    }

    /**
     * Wrapper statico per latest() richiesto da PHPStan.
     *
     * @return EloquentBuilder<Article>
     */
    public static function latest(?string $column = null): EloquentBuilder
    {
        $column = $column ?? self::CREATED_AT;

        /** @var EloquentBuilder<Article> $query */
        $query = static::query()->latest($column);

        return $query;
    }

    /**
     * @return array<string, mixed>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /** @return BelongsTo<Model&UserContract, $this> */
    public function user(): BelongsTo
    {
        $userClassModel = XotData::make()->getUserClass();

        return $this->belongsTo($userClassModel);
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ----- Feed ------
    public function shortBody(int $words = 30): string
    {
        return Str::words(strip_tags((string) $this->body), $words);
    }

    public function getFormattedDate(): string
    {
        return ArticleDelegates::formattedDate($this);
    }

    public function getThumbnail(): ?string
    {
        return ArticleDelegates::thumbnail($this);
    }

    /**
     * @return Attribute<string, never>
     */
    public function humanReadTime(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                unset($value);

                return ArticleDelegates::humanReadTime($attributes);
            },
        );
    }

    /**
     * The author that belong to the article.
     *
     * @return BelongsTo<Profile, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'user_id'); // ->withTrashed();
    }

    public function getTitle(): string
    {
        if ($this->title) {
            return $this->title;
        }

        return 'Get Title of article id '.$this->id;
    }

    public function getMainImage(): string
    {
        return ArticleDelegates::mainImageUrl($this);
    }

    public function getUuidAttribute(?string $value): string
    {
        if (null !== $value && '' !== $value) {
            return $value;
        }
        // dddx($value);
        $value = (string) Str::uuid();
        $this->uuid = $value;
        $this->save();

        // return $value;

        return '##';
    }

    public function getTimeLeftForHumans(): ?string
    {
        return ArticleDelegates::timeLeftForHumans($this);
    }

    /**
     * Get the path key to the item for the frontend only.
     */
    public function getFrontRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param array<int, string> $nameBlocks
     *
     * @return array<int, array<string, mixed>>
     */
    public function getOnlyContentBlocks(array $nameBlocks): array
    {
        return ArticleDelegates::onlyContentBlocks($this, $nameBlocks);
    }

    /**
     * @param array<int, string> $nameBlocks
     *
     * @return array<int, array<string, mixed>>
     */
    public function getExceptContentBlocks(array $nameBlocks): array
    {
        return ArticleDelegates::exceptContentBlocks($this, $nameBlocks);
    }

    /**
     * This string will be used in notifications on what a new comment was made.
     */
    public function commentableName(): string
    {
        return 'Predizione';
    }

    /**
     * This URL will be used in notifications to let the user know
     * where the comment itself can be read.
     */
    public function commentUrl(): string
    {
        return '#';
    }

    /**
     * Converti l'attributo 'closed_at' in un oggetto Carbon.
     */
    public function getClosedAtAttribute(string $value): Carbon
    {
        return Carbon::parse($value);
    }

    /**
     * Attributi assegnabili in massa (mass assignment).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'main_image_upload' => 'string',
            'main_image_url' => 'string',
        ];
    }

    /**
     * @return Attribute<string, never>
     */
    protected function mainImage(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                unset($value);

                return ArticleDelegates::mainImage($attributes);
            },
        );
    }
}
