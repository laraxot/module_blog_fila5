<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use ArrayAccess;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Comment\Models\CommentNotificationSubscription;
use Modules\Comment\Models\Concerns\HasComments;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
use Modules\Media\Models\Media;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Models\Traits\HasRating;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Parental\HasChildren;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\ModelStatus\Status;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Spatie\Translatable\HasTranslations;
use Webmozart\Assert\Assert;

/**
 * Modules\Blog\Models\Article.
 *
 * @property Profile|null                $author
 * @property Collection<int, Category>   $categories
 * @property int|null                    $categories_count
 * @property Collection<int, Comment>    $comments
 * @property int|null                    $comments_count
 * @property string                      $human_read_time
 * @property MediaCollection<int, Media> $media
 * @property int|null                    $media_count
 * @property Collection<int, Tag>        $tags
 * @property Collection<int, Status>     $statuses
 * @property int|null                    $statuses_count
 * @property int|null                    $tags_count
 * @property UserContract|null           $user
 * @property string                      $body
 * @property Carbon                      $published_at
 * @property Carbon                      $updated_at
 * @property string                      $slug
 * @property string                      $title
 * @property string                      $description
 * @property string                      $main_image_upload
 * @property string                      $main_image_url
 * @property array<string, mixed>|string $content_blocks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article article(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article author(string $profile_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article category(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article currentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article differentFromCurrentArticle(string $current_article)
 * @method static ArticleFactory                                factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article published()
 * @method static \Illuminate\Database\Eloquent\Builder|Article publishedUntilToday()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article search(string $searching)
 * @method static \Illuminate\Database\Eloquent\Builder|Article showHomepage()
 * @method static \Illuminate\Database\Eloquent\Builder|Article tag(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTags((ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTagsOfAnyType(array<int|string, Tag>|string $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTags((ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTagsOfAnyType(array<int|string, Tag>|string $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTags((ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTrashed()
 *
 * @property string                          $id
 * @property string                          $uuid
 * @property string|null                     $content
 * @property string|null                     $picture
 * @property int|null                        $category_id
 * @property int|null                        $author_id
 * @property string|null                     $status
 * @property int                             $show_on_homepage
 * @property int|null                        $read_time
 * @property string|null                     $excerpt
 * @property string                          $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property string|null                     $deleted_by
 * @property array<string, mixed>|null       $footer_blocks
 * @property array<string, mixed>|null       $sidebar_blocks
 * @property int                             $is_featured
 * @property string|null                     $closed_at
 * @property Category|null                   $category
 * @property string                          $main_image
 * @property Collection<int, Rating>         $ratings
 * @property int|null                        $ratings_count
 * @property mixed                           $translations
 * @property string|null                     $rewarded_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContentBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFooterBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocales(string $column, array<string, mixed> $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMainImageUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMainImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShowOnHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUuid($value)
 *
 * @property int         $status_display
 * @property string|null $bet_end_date
 * @property string|null $event_start_date
 * @property string|null $event_end_date
 * @property int         $is_wagerable
 * @property int|null    $wagers_count
 * @property int|null    $wagers_count_canonical
 * @property int|null    $wagers_count_total
 * @property int|null    $wagers
 * @property string|null $brier_score
 * @property string|null $brier_score_play_money
 * @property string|null $brier_score_real_money
 * @property float|null  $volume_play_money
 * @property float|null  $volume_real_money
 * @property int         $is_following
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBetEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBrierScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBrierScorePlayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBrierScoreRealMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereEventEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereEventStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsFollowing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsWagerable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSidebarBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereStatusDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVolumePlayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereVolumeRealMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereWagers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereWagersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereWagersCountCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereWagersCountTotal($value)
 *
 * @property RatingMorph $pivot
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocales(string $column, array<string, mixed> $locales, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereRewardedAt($value)
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
 * @mixin Model
 *
 * @property string|null                                      $type
 * @property string|null                                      $extra
 * @property string|null                                      $resolved_at
 * @property string|null                                      $liquidity
 * @property float|null                                       $stocks_count
 * @property float|null                                       $stocks_value
 * @property string                                           $sum_credit_yes
 * @property string                                           $sum_credit_no
 * @property int                                              $count_credit_yes
 * @property int                                              $count_credit_no
 * @property Collection<int, CommentNotificationSubscription> $notificationSubscriptions
 * @property int|null                                         $notification_subscriptions_count
 *
 * @method static EloquentBuilder<static>|Article                       whereCountCreditNo($value)
 * @method static EloquentBuilder<static>|Article                       whereCountCreditYes($value)
 * @method static EloquentBuilder<static>|Article                       whereExtra($value)
 * @method static EloquentBuilder<static>|Article                       whereLiquidity($value)
 * @method static EloquentBuilder<static>|Article                       whereResolvedAt($value)
 * @method static EloquentBuilder<static>|Article                       whereStocksCount($value)
 * @method static EloquentBuilder<static>|Article                       whereStocksValue($value)
 * @method static EloquentBuilder<static>|Article                       whereSumCreditNo($value)
 * @method static EloquentBuilder<static>|Article                       whereSumCreditYes($value)
 * @method static EloquentBuilder<static>|Article                       whereType($value)
 * @method static EloquentBuilder<static>|Article                       withAnyTagsOfType(array<string, mixed>|string $type)
 * @method static Article|null                                          first()
 * @method static Collection<int, Article>                              get()
 * @method static Article                                               create(array<string, mixed> $attributes = [])
 * @method static Article                                               firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereNotNull((string|Expression) $columns)
 * @method static int                                                   count(string $columns = '*')
 *
 * @property \Modules\Fixcity\Models\Profile|null $deleter
 *
 * @method static EloquentBuilder<static>|Article childrenWith(array<string, mixed> $relations)
 * @method static EloquentBuilder<static>|Article childrenWithCount(array<string, mixed> $relations)
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasTranslationsContract
{
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
        // 'is_closed', => closet_at

        /*
        'title',
        'slug',
        'thumbnail',
        'body',
        'user_id',
        'active',
        'published_at',
        'meta_title',
        'meta_description',

         'author_id',
        'title',
        'slug',
        'content',
        'picture',
        'category_id',
        'status',
        'publish_date',
        'show_on_homepage',
        'author_name',
        'read_time',
        'excerpt',
        */
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
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): array|string|int|null
    {
        if (! $this->isTranslatableAttribute($key)) {
            $value = $this->getAttribute($key);

            return null !== $value ? SafeStringCastAction::cast($value) : null;
        }

        $translations = $this->getTranslations($key);

        $translation = $translations[$locale] ?? '';

        if ('' !== $translation || ! $useFallbackLocale) {
            $value = $translation;
        } else {
            $fallbackLocale = config('app.fallback_locale');
            $fallbackKey = is_string($fallbackLocale) ? $fallbackLocale : 'en';
            $value = $translations[$fallbackKey] ?? '';
        }

        return match (true) {
            is_string($value) => $value,
            is_array($value) => $value,
            is_int($value) => $value,
            default => null,
        };
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
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class);
    }

    /** @return BelongsTo<Category, $this> */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ----- Feed ------
    public function toFeedItem(): FeedItem
    {
        Assert::notNull($this->user, '['.__LINE__.']['.__FILE__.']');

        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            // ->link($this->path()) //Call to an undefined method Modules\Blog\Models\Article::path()
            ->authorName($this->user->name ?? 'Unknown');
    }

    public function shortBody(int $words = 30): string
    {
        return Str::words(strip_tags((string) $this->body), $words);
    }

    public function getFormattedDate(): string
    {
        Assert::notNull($this->published_at, '['.__LINE__.']['.__FILE__.']');

        return $this->published_at->format('F jS Y');
    }

    public function getThumbnail(): ?string
    {
        if (null !== $this->getMedia()->first()) {
            return $this->getMedia()->first()->getUrl();
        }

        return '#';
        // if (str_starts_with((string) $this->thumbnail, 'http')) {
        //     return $this->thumbnail;
        // }

        // return '/storage/'.$this->thumbnail;
    }

    /** @return Attribute<string, never> */
    public function humanReadTime(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                $words = Str::wordCount(strip_tags(SafeStringCastAction::cast($attributes['body'] ?? '')));
                $minutes = ceil($words / 200);

                return $minutes.' '.str('min')->plural((int) $minutes).', '
                    .$words.' '.str('word')->plural($words);
            },
        );
    }

    /**
     * Scope a query to only include articles different from current article.
     *
     * @param EloquentBuilder<Article> $query
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeDifferentFromCurrentArticle(EloquentBuilder $query, string $current_article): EloquentBuilder
    {
        return $query->where('id', '!=', $current_article);
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
        if ($this->media) {
            // https://spatie.be/docs/laravel-medialibrary/v11/basic-usage/retrieving-media
            return $this->getFirstMediaUrl('main_image_upload');
        }

        if ($this->main_image_upload) {
            return Storage::url($this->main_image_upload);
        }

        if (null !== $this->main_image_url) {
            return $this->main_image_url;
        }

        return '#';
    }

    /*
     * NO !!
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: static function ($value): string {
                return date_format(new DateTime($value), 'd/m/Y');
            }
        );
    }
    */

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

    // public function getTimeLeft(): string
    // {
    //     $time = $this->closed_at;

    //     $days = Carbon::now()->diffInDays($time);
    //     $hours = Carbon::now()->copy()->addDays($days)->diffInHours($time);
    //     $minutes = Carbon::now()->copy()->addDays($days)->addHours($hours)->diffInMinutes($time);
    //     return $days.'d'.$hours.'m'.$minutes.'s';
    // }

    public function getTimeLeftForHumans(): ?string
    {
        $endDate = $this->closed_at;
        $startDate = Carbon::now();

        if ($startDate > $endDate) {
            return (string) (__('blog::article.single_expired') ?? '');
        }

        // Calcola la differenza tra le due date
        $diff = $startDate->diff($endDate);

        // Ottieni il tempo rimasto in giorni, ore, minuti e secondi
        $month = $diff->m;

        if ($month > 0) {
            return $endDate->format('Y-m-d');
        }

        $days = $diff->d;
        $hours = $diff->h;
        $minutes = $diff->i;

        if (0 === $month && 0 === $days && 0 === $hours && 0 === $minutes) {
            return (string) (__('blog::article.single_expired') ?? '');
        }

        if ($days > 0) {
            return (string) (__('blog::article.time_left_days', ['days' => $days]) ?? '');
        }

        return (string) (__('blog::article.time_left', ['hours' => $hours, 'minutes' => $minutes]) ?? '');
    }

    // /**
    //  * Get the path to the picture
    //  *
    //  * @return string
    //  */
    // public function path()
    // {
    //     return "/storage/{$this->picture}";
    // }
    // /**
    //  * Get the route key for the article.
    //  *
    //  * @return string
    //  */
    // public function getRouteKeyName()
    // {
    //     if (inAdmin()) {
    //         return $this->getKeyName();
    //     }
    //     return 'slug';
    // }
    /**
     * Get the path key to the item for the frontend only.
     */
    public function getFrontRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @param array<int, string> $name_blocks
     *
     * @return array<int, array<string, mixed>>
     */
    public function getOnlyContentBlocks(array $name_blocks): array
    {
        /** @var array<int, array<string, mixed>> */
        $contentBlocks = is_array($this->content_blocks) ? $this->content_blocks : [];

        return collect($contentBlocks)->filter(function (array $value) use ($name_blocks): bool {
            foreach ($name_blocks as $block) {
                if (($value['type'] ?? null) === $block) {
                    return true;
                }
            }

            return false;
        })->values()->all();
    }

    /**
     * @param array<int, string> $name_blocks
     *
     * @return array<int, array<string, mixed>>
     */
    public function getExceptContentBlocks(array $name_blocks): array
    {
        /** @var array<int, array<string, mixed>> */
        $contentBlocks = is_array($this->content_blocks) ? $this->content_blocks : [];

        return collect($contentBlocks)->filter(function (array $value) use ($name_blocks): bool {
            $shouldExclude = false;
            foreach ($name_blocks as $block) {
                if (($value['type'] ?? null) === $block) {
                    $shouldExclude = true;
                    break;
                }
            }

            return ! $shouldExclude;
        })->values()->all();
    }

    /**
     * Scope a query to only include articles.
     *
     * @param EloquentBuilder<Article> $query
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeArticle(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->where('author_id', $id);
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param EloquentBuilder<Article> $query
     *
     * @return EloquentBuilder<Article>
     */
    public function scopePublished(EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        // return $query->where('status', 'published');
        // return $query->currentStatus('published');
        return $query
            ->whereNotNull('published_at');
    }

    /**
     * Scope a query to only include show on homepage articles.
     *
     * @param EloquentBuilder<Article> $query
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeShowHomepage(EloquentBuilder $query): EloquentBuilder
    {
        return $query->where('show_on_homepage', 1);
    }

    /**
     * Scope a query to only include posted articles until today.
     *
     * @param EloquentBuilder<Article> $query
     *
     * @return EloquentBuilder<Article>
     */
    public function scopePublishedUntilToday(EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        return $query->whereDate('published_at', '<=', Carbon::today()->toDateString());
    }

    /**
     * Scope a query to only include articles with a specified category.
     *
     * @param EloquentBuilder<Article> $query
     * @param string                   $id    The id of the category
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeCategory(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->where('category_id', $id);
    }

    /**
     * Scope a query to only include articles that belongs to an author.
     *
     * @param EloquentBuilder<Article> $query
     * @param string                   $profile_id The id of the author
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeAuthor(EloquentBuilder $query, string $profile_id): EloquentBuilder
    {
        return $query->where('author_id', $profile_id);
    }

    /**
     * Scope a query to only include articles with a specified tag.
     *
     * @param EloquentBuilder<Article> $query
     * @param string                   $id    The id of the tag
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeTag(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->whereHas('tags', static function ($q) use ($id): void {
            $q->where('id', $id);
        });
    }

    /**
     * Scope a query to only include articles which contains searching words.
     *
     * @param EloquentBuilder<Article> $query
     * @param string                   $searching The searching words
     *
     * @return EloquentBuilder<Article>
     */
    public function scopeSearch(EloquentBuilder $query, string $searching): EloquentBuilder
    {
        return $query->where('title', 'LIKE', "%{$searching}%")
            ->orWhere('content', 'LIKE', "%{$searching}%")
            ->orWhere('excerpt', 'LIKE', "%{$searching}%");
    }

    /**
     * This string will be used in notifications on what a new comment
     * was made.
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

    // /**
    //  * Get the tags of the article
    //  *
    //  * @return \Illuminate\Database\Eloquent\Collection
    //  */
    // public function tags()
    // {
    //    return $this->belongsToMany(Tag::class);
    // }

    /** @return Attribute<string, never> */
    protected function mainImage(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                $imageUpload = $attributes['main_image_upload'] ?? null;
                $imageUrl = $attributes['main_image_url'] ?? null;
                $result = $imageUpload ?? $imageUrl ?? '#';

                return SafeStringCastAction::cast($result);
            },
        );
    }
}
