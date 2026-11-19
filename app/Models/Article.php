<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

<<<<<<< HEAD
use Carbon\Carbon;
=======
use ArrayAccess;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Database\Query\Expression;
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
<<<<<<< HEAD
use Illuminate\Support\Str;
use Modules\Blog\Actions\Article\FilterArticleContentBlocksExceptAction;
use Modules\Blog\Actions\Article\FilterArticleContentBlocksOnlyAction;
use Modules\Blog\Actions\Article\FormatArticleHumanReadTimeAction;
use Modules\Blog\Actions\Article\FormatArticlePublishedDateAction;
use Modules\Blog\Actions\Article\FormatArticleTimeLeftForHumansAction;
use Modules\Blog\Actions\Article\ResolveArticleMainImageFromAttributesAction;
use Modules\Blog\Actions\Article\ResolveArticleMainImageUrlAction;
use Modules\Blog\Actions\Article\ResolveArticleThumbnailAction;
use Modules\Blog\Actions\Article\ResolveArticleTranslationAction;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Blog\Models\Concerns\ArticleFeedable;
use Modules\Blog\Models\Concerns\ArticleQueryScopes;
use Modules\Comment\Models\Comment;
use Modules\Comment\Models\CommentNotificationSubscription;
use Modules\Comment\Models\Concerns\HasComments;
use Modules\Comment\Models\Contracts\Commentable;
use Modules\Comment\Models\Contracts\SupportsCommentNotifications;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
=======
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Blog\Database\Factories\ArticleFactory;
use Modules\Comment\Models\CommentNotificationSubscription;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
use Modules\Media\Models\Media;
use Modules\Rating\Models\Contracts\HasRatingContract;
>>>>>>> laraxot/dev
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\Rating\Models\Traits\HasRating;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Parental\HasChildren;
use Spatie\Feed\Feedable;
<<<<<<< HEAD
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

use function Safe\json_decode;
=======
use Spatie\Feed\FeedItem;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\ModelStatus\Status;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Spatie\Translatable\HasTranslations;
use Webmozart\Assert\Assert;
>>>>>>> laraxot/dev

/**
 * Modules\Blog\Models\Article.
 *
<<<<<<< HEAD
 * @property Profile|null $author
 * @property Collection<int, Category> $categories
 * @property int|null $categories_count
 * @property Collection<int, Comment> $comments
 * @property int|null $comments_count
 * @property string $human_read_time
 * @property MediaCollection<int, Media> $media
 * @property int|null $media_count
 * @property Collection<int, Tag> $tags
 * @property Collection<int, Status> $statuses
 * @property int|null $statuses_count
 * @property int|null $tags_count
 * @property UserContract|null $user
 * @property string $body
 * @property Carbon $published_at
 * @property Carbon $updated_at
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $main_image_upload
 * @property string $main_image_url
 * @property array<string, mixed>|string $content_blocks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article article(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article author(string $profile_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article currentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article differentFromCurrentArticle(string $current_article)
 * @method static ArticleFactory factory($count = null, $state = [])
=======
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
 * @property array<int|string, mixed>|string                $content_blocks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article article(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article currentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article differentFromCurrentArticle(string $current_article)
 * @method static ArticleFactory                                factory($count = null, $state = [])
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTags((\ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTagsOfAnyType(array<int|string, Tag>|string $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTags((\ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTagsOfAnyType(array<int|string, Tag>|string $tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTags((\ArrayAccess<int|string, Tag>|Tag|array<int|string, Tag>|string) $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTrashed()
 *
 * @property string $id
 * @property string $uuid
 * @property string|null $content
 * @property string|null $picture
 * @property int|null $category_id
 * @property int|null $author_id
 * @property string|null $status
 * @property int $show_on_homepage
 * @property int|null $read_time
 * @property string|null $excerpt
 * @property string $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property string|null $deleted_by
 * @property array<string, mixed>|null $footer_blocks
 * @property array<string, mixed>|null $sidebar_blocks
 * @property int $is_featured
 * @property Carbon|null $closed_at
 * @property Category|null $category
 * @property string $main_image
 * @property Collection<int, Rating> $ratings
 * @property int|null $ratings_count
 * @property mixed $translations
 * @property string|null $rewarded_at
=======
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTags(ArrayAccess<int|string, mixed>|Tag|array<int|string, mixed>|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTags(ArrayAccess<int|string, mixed>|Tag|array<int|string, mixed>|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTags(ArrayAccess<int|string, mixed>|Tag|array<int|string, mixed>|string $tags, ?string $type = null)
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
 * @property array<int|string, mixed>|null                      $footer_blocks
 * @property array<int|string, mixed>|null                      $sidebar_blocks
 * @property int                             $is_featured
 * @property string|null                     $closed_at
 * @property Category|null                   $category
 * @property string                          $main_image
 * @property Collection<int, Rating>         $ratings
 * @property int|null                        $ratings_count
 * @property mixed                           $translations
 * @property string|null                     $rewarded_at
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocales(string $column, array<string, mixed> $locales)
=======
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocales(string $column, array<int, string> $locales)
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
 * @property int $status_display
 * @property string|null $bet_end_date
 * @property string|null $event_start_date
 * @property string|null $event_end_date
 * @property string|null $type Parental STI alias: post|event (Post, Event)
 * @property int $is_wagerable
 * @property int|null $wagers_count
 * @property int|null $wagers_count_canonical
 * @property int|null $wagers_count_total
 * @property int|null $wagers
 * @property string|null $brier_score
 * @property string|null $brier_score_play_money
 * @property string|null $brier_score_real_money
 * @property float|null $volume_play_money
 * @property float|null $volume_real_money
 * @property int $is_following
=======
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
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocales(string $column, array<string, mixed> $locales, ?mixed $value)
=======
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereJsonContainsLocales(string $column, array<int, string> $locales, ?mixed $value)
>>>>>>> laraxot/dev
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereRewardedAt($value)
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
 * @mixin Model
 *
<<<<<<< HEAD
 * @property string|null $type
 * @property string|null $extra
 * @property string|null $resolved_at
 * @property string|null $liquidity
 * @property float|null $stocks_count
 * @property float|null $stocks_value
 * @property string $sum_credit_yes
 * @property string $sum_credit_no
 * @property int $count_credit_yes
 * @property int $count_credit_no
 * @property Collection<int, CommentNotificationSubscription> $notificationSubscriptions
 * @property int|null $notification_subscriptions_count
 *
 * @method static EloquentBuilder<static>|Article whereCountCreditNo($value)
 * @method static EloquentBuilder<static>|Article whereCountCreditYes($value)
 * @method static EloquentBuilder<static>|Article whereExtra($value)
 * @method static EloquentBuilder<static>|Article whereLiquidity($value)
 * @method static EloquentBuilder<static>|Article whereResolvedAt($value)
 * @method static EloquentBuilder<static>|Article whereStocksCount($value)
 * @method static EloquentBuilder<static>|Article whereStocksValue($value)
 * @method static EloquentBuilder<static>|Article whereSumCreditNo($value)
 * @method static EloquentBuilder<static>|Article whereSumCreditYes($value)
 * @method static EloquentBuilder<static>|Article whereType($value)
 * @method static EloquentBuilder<static>|Article withAnyTagsOfType(array<string, mixed>|string $type)
 * @method static Article|null first()
 * @method static Collection<int, Article> get()
 * @method static Article create(array<string, mixed> $attributes = [])
 * @method static Article firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article where((string|\Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereNotNull((string|\Illuminate\Contracts\Database\Query\Expression) $columns)
 * @method static int count(string $columns = '*')
 *
 * @property ProfileContract|null $deleter
 *
 * @method static EloquentBuilder<static>|Article childrenWith(array<string, mixed> $relations)
 * @method static EloquentBuilder<static>|Article childrenWithCount(array<string, mixed> $relations)
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Commentable, Feedable, HasTranslationsContract, SupportsCommentNotifications
{
    use ArticleFeedable;
    use ArticleQueryScopes;
    use HasChildren;
    use HasComments;
=======
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
 * @method static EloquentBuilder<static>|Article                       withAnyTagsOfType(array<int, string>|string $type)
 * @method static Article|null                                          first()
 * @method static Collection<int, Article>                              get()
 * @method static Article                                               create(array<string, mixed> $attributes = [])
 * @method static Article                                               firstOrCreate(array<string, mixed> $attributes = [], array<string, mixed> $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereNotNull((string|Expression) $columns)
 * @method static int                                                   count(string $columns = '*')
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $deleter
 *
 * @method static EloquentBuilder<static>|Article childrenWith(array<int|string, mixed> $relations)
 * @method static EloquentBuilder<static>|Article childrenWithCount(array<int|string, mixed> $relations)
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasRatingContract, HasTranslationsContract
{
    use HasChildren;
>>>>>>> laraxot/dev
    use HasRating;
    use HasTags;
    use HasTranslations;

<<<<<<< HEAD
    /**
     * Parental STI: la colonna `type` distingue i contenuti (`post` = Novita', `event` = Eventi).
     *
     * @var array<string, class-string<Article>>
     */
    protected $childTypes = [
        'post' => Post::class,
        'event' => Event::class,
    ];

=======
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
        'description',
        'excerpt',
=======
        // 'description',
>>>>>>> laraxot/dev
        'body',
        'images',
        'viewCount',

        'content_blocks',
        'footer_blocks',
        'sidebar_blocks',
        'is_featured',
<<<<<<< HEAD
        'show_on_homepage',
=======
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     * @param  string  $key  Il nome dell'attributo da tradurre
     * @param  string  $locale  Il codice della lingua richiesta
     * @param  bool  $useFallbackLocale  Se utilizzare o meno la lingua di fallback
     * @return array<int|string, mixed>|string|int|null Il valore tradotto dell'attributo
     *
     * @SuppressWarnings("PHPMD.BooleanArgumentFlag")
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): array|string|int|null
    {
        return app(ResolveArticleTranslationAction::class)->execute($this, $key, $locale, $useFallbackLocale);
=======
     * @param string $key               Il nome dell'attributo da tradurre
     * @param string $locale            Il codice della lingua richiesta
     * @param bool   $useFallbackLocale Se utilizzare o meno la lingua di fallback
     *
     * @return array<array-key, mixed>|string|int|null Il valore tradotto dell'attributo
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true): array|string|int|null
    {
        if (! $this->isTranslatableAttribute($key)) {
            $value = $this->getAttribute($key);

            if (null === $value) {
                return null;
            }

            return is_scalar($value) ? (string) $value : null;
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

        if (is_string($value)) {
            return $value;
        }
        if (is_int($value)) {
            return $value;
        }
        if (is_array($value)) {
            /** @var array<string, mixed> $typed */
            $typed = $value;

            return $typed;
        }

        return null;
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     * @return EloquentBuilder<Article>
=======
     * @return EloquentBuilder<static>
>>>>>>> laraxot/dev
     */
    public static function latest(?string $column = null): EloquentBuilder
    {
        $column = $column ?? self::CREATED_AT;

<<<<<<< HEAD
        /** @var EloquentBuilder<Article> $query */
=======
        /** @var EloquentBuilder<static> $query */
>>>>>>> laraxot/dev
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

<<<<<<< HEAD
    /** @return BelongsTo<Model&UserContract, $this> */
    public function user(): BelongsTo
    {
        $userClass = XotData::make()->getUserClass();

        return $this->belongsTo($userClass);
    }

    /** @return BelongsTo<Category, $this> */
=======
    /**
     * @return BelongsTo<Model&UserContract, $this>
     */
    public function user(): BelongsTo
    {
        $user_class = XotData::make()->getUserClass();

        return $this->belongsTo($user_class);
    }

    /**
     * @return BelongsTo<Category, $this>
     */
>>>>>>> laraxot/dev
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ----- Feed ------
<<<<<<< HEAD
=======
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

>>>>>>> laraxot/dev
    public function shortBody(int $words = 30): string
    {
        return Str::words(strip_tags((string) $this->body), $words);
    }

    public function getFormattedDate(): string
    {
<<<<<<< HEAD
        return app(FormatArticlePublishedDateAction::class)->execute($this);
=======
        Assert::notNull($this->published_at, '['.__LINE__.']['.__FILE__.']');

        return $this->published_at->format('F jS Y');
>>>>>>> laraxot/dev
    }

    public function getThumbnail(): ?string
    {
<<<<<<< HEAD
        return app(ResolveArticleThumbnailAction::class)->execute($this);
    }

    /**
     * @return Attribute<string, never>
     */
    public function humanReadTime(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                unset($value);

                return app(FormatArticleHumanReadTimeAction::class)->execute($attributes);
            },
=======
        if (null !== $this->getMedia()->first()) {
            return $this->getMedia()->first()->getUrl();
        }

        return '#';
        // if (str_starts_with((string) $this->thumbnail, 'http')) {
        //     return $this->thumbnail;
        // }

        // return '/storage/'.$this->thumbnail;
    }

    /**
     * @return Attribute<string, string>
     */
    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: static function ($value, array $attributes): string {
                /** @var array<string, mixed> $attributes */
                $body = $attributes['body'] ?? '';
                $bodyStr = is_string($body) ? $body : (is_scalar($body) ? (string) $body : '');
                $words = Str::wordCount(strip_tags($bodyStr));
                $minutes = ceil($words / 200);

                return $minutes.' '.str('min')->plural((int) $minutes).', '
                    .$words.' '.str('word')->plural($words);
            }
>>>>>>> laraxot/dev
        );
    }

    /**
<<<<<<< HEAD
=======
     * Scope a query to only include articles different from current article.
     *
     * @param EloquentBuilder<static> $query
     * @return EloquentBuilder<static>
     */
    public function scopeDifferentFromCurrentArticle(EloquentBuilder $query, string $current_article): EloquentBuilder
    {
        return $query->where('id', '!=', $current_article);
    }

    /**
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
        $translated = $this->getAttribute('title');
        if (is_string($translated) && $translated !== '') {
            return $translated;
        }

        $raw = $this->getRawOriginal('title');
        if (! is_string($raw) || trim($raw) === '') {
            return '';
        }

        $decoded = json_decode($raw, true);
        if (! is_array($decoded)) {
            return $raw;
        }

        $fallback = config('app.fallback_locale');
        $fallbackLocale = is_string($fallback) ? $fallback : 'it';
        $candidate = $decoded[app()->getLocale()] ?? $decoded[$fallbackLocale] ?? null;
        if (is_string($candidate) && $candidate !== '') {
            return $candidate;
        }

        foreach ($decoded as $value) {
            if (is_string($value) && $value !== '') {
                return $value;
            }
        }

        return '';
=======
        if ($this->title) {
            return $this->title;
        }

        return 'Get Title of article id '.$this->id;
>>>>>>> laraxot/dev
    }

    public function getMainImage(): string
    {
<<<<<<< HEAD
        return app(ResolveArticleMainImageUrlAction::class)->execute($this);
=======
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
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
        if ($value !== null && $value !== '') {
=======
        if (null !== $value && '' !== $value) {
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
        return app(FormatArticleTimeLeftForHumansAction::class)->execute($this);
=======
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
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
     * @param  array<int, string>  $nameBlocks
     * @return array<int, array<string, mixed>>
     */
    public function getOnlyContentBlocks(array $nameBlocks): array
    {
        return app(FilterArticleContentBlocksOnlyAction::class)->execute($this, $nameBlocks);
    }

    /**
     * @param  array<int, string>  $nameBlocks
     * @return array<int, array<string, mixed>>
     */
    public function getExceptContentBlocks(array $nameBlocks): array
    {
        return app(FilterArticleContentBlocksExceptAction::class)->execute($this, $nameBlocks);
=======
     * @param array<int, string> $name_blocks
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
        })->values()
            ->map(static fn (array $value): array => $value)
            ->all();
    }

    /**
     * @param array<int, string> $name_blocks
     * @return array<int, array<string, mixed>>
     */
    public function getExceptContentBlocks(array $name_blocks): array
    {
        /** @var array<int, array<string, mixed>> */
        $contentBlocks = is_array($this->content_blocks) ? $this->content_blocks : [];

        return collect($contentBlocks)
            ->filter(function (array $value) use ($name_blocks): bool {
                foreach ($name_blocks as $block) {
                    if (($value['type'] ?? null) === $block) {
                        return false;
                    }
                }

                return true;
            })
            ->values()
            ->map(static fn (array $value): array => $value)
            ->all();
    }

    /**
     * Scope a query to only include articles.
     *
     * @param EloquentBuilder<static> $query
     * @return EloquentBuilder<static>
     */
    public function scopeArticle(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->where('author_id', $id);
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param EloquentBuilder<static> $query
     * @return EloquentBuilder<static>
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
     * @param EloquentBuilder<static> $query
     * @return EloquentBuilder<static>
     */
    public function scopeShowHomepage(EloquentBuilder $query): EloquentBuilder
    {
        return $query->where('show_on_homepage', 1);
    }

    /**
     * Scope a query to only include posted articles until today.
     *
     * @param EloquentBuilder<static> $query
     * @return EloquentBuilder<static>
     */
    public function scopePublishedUntilToday(EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        return $query->whereDate('published_at', '<=', Carbon::today()->toDateString());
    }

    /**
     * Scope a query to only include articles with a specified category.
     *
     * @param EloquentBuilder<static> $query
     * @param string $id The id of the category
     * @return EloquentBuilder<static>
     */
    public function scopeCategory(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->where('category_id', $id);
    }

    /**
     * Scope a query to only include articles that belongs to an author.
     *
     * @param EloquentBuilder<static> $query
     * @param string $profile_id The id of the author
     * @return EloquentBuilder<static>
     */
    public function scopeAuthor(EloquentBuilder $query, string $profile_id): EloquentBuilder
    {
        return $query->where('user_id', $profile_id);
    }

    /**
     * Scope a query to only include articles with a specified tag.
     *
     * @param EloquentBuilder<static> $query
     * @param string $id The id of the tag
     * @return EloquentBuilder<static>
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
     * @param EloquentBuilder<static> $query
     * @param string $searching The searching words
     * @return EloquentBuilder<static>
     */
    public function scopeSearch(EloquentBuilder $query, string $searching): EloquentBuilder
    {
        return $query->where('title', 'LIKE', "%{$searching}%")
            ->orWhere('content', 'LIKE', "%{$searching}%")
            ->orWhere('excerpt', 'LIKE', "%{$searching}%");
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
    public function getClosedAtAttribute(mixed $value): ?Carbon
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            return Carbon::parse($value);
        }

        if ($value instanceof Carbon) {
            return $value;
        }

        return null;
=======
    public function getClosedAtAttribute(string $value): Carbon
    {
        return Carbon::parse($value);
>>>>>>> laraxot/dev
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
<<<<<<< HEAD
            'event_start_date' => 'datetime',
            'event_end_date' => 'datetime',
=======
>>>>>>> laraxot/dev
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

<<<<<<< HEAD
    /**
     * @return Attribute<string, never>
     */
    protected function mainImage(): Attribute
    {
        return Attribute::make(
            get: static function (mixed $value, array $attributes): string {
                unset($value);

                return app(ResolveArticleMainImageFromAttributesAction::class)->execute($attributes);
            },
=======
    /*
     * Get the comments of the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment>

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
*/

    /**
     * Get the article's main image.
     *
     * @return Attribute<string, string>
     */
    protected function mainImage(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                /** @var array<string, mixed> $attributes */
                $imageUpload = $attributes['main_image_upload'] ?? null;
                $imageUrl = $attributes['main_image_url'] ?? null;
                $result = $imageUpload ?? $imageUrl ?? '#';

                if (is_string($result)) {
                    return $result;
                }

                return is_scalar($result) ? (string) $result : '#';
            }
>>>>>>> laraxot/dev
        );
    }
}
