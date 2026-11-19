<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

<<<<<<< HEAD
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Renderable;
=======
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Blog\Datas\ArticleData;
use Modules\Blog\Models\Article;
<<<<<<< HEAD
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Tag;
use Modules\Blog\View\Composers\Composition\ThemeComposerBag;
use Modules\UI\Datas\SliderData;

class ThemeComposer
{
    public function __construct(
        private readonly ThemeComposerBag $bag = new ThemeComposerBag,
    ) {}

    /**
=======
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Tag;
use Modules\UI\Datas\SliderData;
use Modules\UI\View\Components\Render\Blocks;
use Webmozart\Assert\Assert;

class ThemeComposer
{
    /**
     * Show recent categories with their latest .
     *
>>>>>>> laraxot/dev
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
<<<<<<< HEAD
        return $this->bag->categories()->categories();
    }

    /**
=======
        return Category::tree()->get()->toTree();
    }

    /**
     * Show recent categories with their latest .
     *
>>>>>>> laraxot/dev
     * @return Collection<int, Category>
     */
    public function getCategoriesArticles(): Collection
    {
        return $this->categories();
    }

    /**
     * @return EloquentCollection<int, Article>
     */
    public function getArticles(): EloquentCollection
    {
<<<<<<< HEAD
        return $this->bag->articles()->allSorted();
    }

    /**
     * @return Collection<int, mixed>
     */
    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $method = 'get'.Str::studly($type).'Articles';
        $result = $this->{$method}($number);
=======
        return Article::all()
            ->sortBy(['created_at', 'desc']);
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $fun = 'get'.Str::studly($type).'Articles';

        $result = $this->{$fun}($number);
>>>>>>> laraxot/dev

        return $result instanceof Collection ? $result : collect();
    }

    /**
     * @return Collection<int, Article>
     */
    public function getFeaturedArticles(int $number = 6): Collection
    {
<<<<<<< HEAD
        return $this->bag->articles()->featured($number);
=======
        $rows = Article::published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();
        if (0 === $rows->count()) {
            $rows = Article::get();
            Article::whereRaw('1=1')->update(['show_on_homepage' => true]);
        }

        return $rows;
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<int, Article>
     */
    public function getLatestArticles(int $number = 6): Collection
    {
<<<<<<< HEAD
        return $this->bag->articles()->latest($number);
=======
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();
>>>>>>> laraxot/dev
    }

    /**
     * @return list<ArticleData>
     */
<<<<<<< HEAD
    public function getArticlesByCategory(string $categoryId, int $number = 6): array
    {
        return $this->bag->articles()->byCategory($categoryId, $number);
=======
    public function getArticlesByCategory(string $category_id, int $number = 6): array
    {
        $rows = Article::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($rows);
>>>>>>> laraxot/dev
    }

    /**
     * @return Paginator<int, Article>
     */
<<<<<<< HEAD
    public function paginateArticlesByCategory(string $categoryId, int $limit = 6): Paginator
    {
        return $this->bag->articles()->paginateByCategory($categoryId, $limit);
    }

=======
    public function paginateArticlesByCategory(string $category_id, int $limit = 6): Paginator
    {
        return Article::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    /*
    public function getAuthors(): Collection
    {
        $rows = Profile::ProfileIsAuthor()
            ->take(4)
            ->get();

        return $rows;
    }
    */

>>>>>>> laraxot/dev
    /**
     * @return Collection<int, Category>
     */
    public function getNavCategories(): Collection
    {
<<<<<<< HEAD
        return $this->bag->categories()->navCategories();
=======
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<int, Category>
     */
    public function getFooterCategories(): Collection
    {
<<<<<<< HEAD
        return $this->bag->categories()->navCategories();
    }

=======
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
    }

    // --- da fare con parental
>>>>>>> laraxot/dev
    /**
     * @return Collection<int, Profile>
     */
    public function getFooterAuthors(): Collection
    {
<<<<<<< HEAD
        return $this->bag->catalog()->footerAuthors();
=======
        // $footerAuthors = Profile::profileIsAuthor()
        // ->take(8)
        return Profile::inRandomOrder()
            ->limit(8)
            ->get();
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
<<<<<<< HEAD
        return $this->bag->catalog()->tags();
=======
        return Tag::all();
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getFooterTags(): Collection
    {
<<<<<<< HEAD
        return $this->bag->catalog()->footerTags();
=======
        return Tag::take(15)->get();
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<(int|string), mixed>
     */
    public function getMoreArticles(Model $model): Collection
    {
<<<<<<< HEAD
        return $this->bag->articles()->moreArticles($model);
=======
        return collect([]);
>>>>>>> laraxot/dev
    }

    /**
     * @return LengthAwarePaginator<int, Article>
     */
    public function getPaginatedArticles(int $num = 15): LengthAwarePaginator
    {
<<<<<<< HEAD
        return $this->bag->articles()->paginatedArticles($num);
=======
        return Article::paginate($num);
>>>>>>> laraxot/dev
    }

    public function showArticleSidebarContent(string $slug): Renderable
    {
<<<<<<< HEAD
        return $this->bag->sidebar()->showArticleSidebarContent($slug);
    }

    /**
     * @return Paginator<int, Article>|array<int|string, mixed>
=======
        Assert::isInstanceOf($article = Article::firstOrCreate(['slug' => $slug], ['sidebar_blocks' => []]), Article::class, '['.__LINE__.']['.__FILE__.']');
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);

        $sidebarBlocks = $article->sidebar_blocks ?? [];
        $blockComponent = new Blocks(
            view: 'ui::components.render.blocks.v1',
            blocks: is_array($sidebarBlocks) ? $sidebarBlocks : [],
            model: $article,
        );

        return $blockComponent->render();
    }

    /**
     * @return array<int|string, mixed>|Paginator<int, Article>
>>>>>>> laraxot/dev
     */
    public function getMethodData(string $method, int $number = 6): Paginator|array
    {
        $result = $this->{$method}($number);
        if ($result instanceof Paginator) {
            return $result;
        }

        return is_array($result) ? $result : [];
    }

    /**
     * @return list<SliderData>
     */
    public function getBanner(): array
    {
<<<<<<< HEAD
        return $this->bag->banners()->all();
    }

    public function getSingleBanner(object $banner): SliderData
    {
        return $this->bag->banners()->single($banner);
=======
        $results = Banner::all()->sortBy('pos');
        $tmp = [];
        foreach ($results as $content) {
            $slider_data = $content->toArray();
            $slider_data['link'] = $content->getUrlCategoryPage();
            $tmp[] = SliderData::from($slider_data);
        }

        return $tmp;
    }

    public function getSingleBanner(Banner $banner): SliderData
    {
        return SliderData::from($banner->toArray());
>>>>>>> laraxot/dev
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesFeatured(int $number = 6): Collection
    {
        dddx('wip con article data');

        return $this->getFeaturedArticles($number);
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesLatest(int $number = 6): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->articlesLatest($number);
=======
        $results = $this->getLatestArticles($number); // ->toArray();

        return $this->getArticleDataArray($results);
>>>>>>> laraxot/dev
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedArticlesLatest(int $limit = 6): Paginator
    {
<<<<<<< HEAD
        return $this->bag->articles()->paginatedLatest($limit);
    }

    /**
     * @param  list<int|string>  $excludeIds
     * @return LengthAwarePaginatorContract<int, Article>
     */
    public function paginatedBlogPosts(int $limit = 9, ?string $search = null, ?string $categorySlug = null, array $excludeIds = []): LengthAwarePaginatorContract
    {
        return $this->bag->articles()->paginatedPosts($limit, $search, $categorySlug, $excludeIds);
    }

    /** @return Paginator<int, Article> */
    public function paginatedPublicEvents(int $limit = 9): Paginator
    {
        return $this->bag->articles()->paginatedComingSoon($limit);
    }

    /**
     * @return Collection<int, Article>
     */
    public function featuredBlogPosts(int $number = 3): Collection
    {
        return $this->bag->articles()->featuredPosts($number);
    }

    public function findPublishedPostBySlug(string $slug): ?Article
    {
        return $this->bag->articles()->findPublishedPostBySlug($slug);
    }

    /**
     * @param  list<int|string>  $excludeIds
     * @return LengthAwarePaginatorContract<int, Article>
     */
    public function paginatedEvents(int $limit = 9, array $excludeIds = []): LengthAwarePaginatorContract
    {
        return $this->bag->articles()->paginatedEvents($limit, $excludeIds);
    }

    public function findPublishedEventBySlug(string $slug): ?Article
    {
        return $this->bag->articles()->findPublishedEventBySlug($slug);
    }

    /**
     * @return Collection<int, Article>
     */
    public function featuredEvents(int $number = 6): Collection
    {
        return $this->bag->articles()->featuredEvents($number);
=======
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
>>>>>>> laraxot/dev
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedArticlesComingSoon(int $limit = 6): Paginator
    {
<<<<<<< HEAD
        return $this->bag->articles()->paginatedComingSoon($limit);
=======
        return Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
>>>>>>> laraxot/dev
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedArticlesOrderByNumberOfBets(int $limit = 6): Paginator
    {
<<<<<<< HEAD
        return $this->bag->articles()->paginatedByWagers($limit);
=======
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->simplePaginate($limit);
>>>>>>> laraxot/dev
    }

    /**
     * @return Paginator<int, Article>
     */
    public function paginatedArticlesOrderByVolumes(int $limit = 6): Paginator
    {
<<<<<<< HEAD
        return $this->bag->articles()->paginatedByVolume($limit);
    }

    public function mapArticle(object $article): object
    {
        return $this->bag->articles()->mapArticle($article);
=======
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->simplePaginate($limit);
    }

    /**
     * --.
     */
    public function mapArticle(Article|ArticleData $article): ArticleData
    {
        if ($article instanceof ArticleData) {
            return $article;
        }

        $article = $article->toArray();

        if (is_array($article['title'])) {
            $lang = app()->getLocale();
            $article['title'] = $article['title'][$lang] ?? last($article['title']);
        }

        return ArticleData::from($article);
>>>>>>> laraxot/dev
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesComingSoon(int $number = 6): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->comingSoon($number);
=======
        $results = Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
>>>>>>> laraxot/dev
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesOrderByNumberOfBets(int $number = 6): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->orderedByWagers($number);
=======
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
>>>>>>> laraxot/dev
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesOrderByVolumes(int $number = 6): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->orderedByVolume($number);
=======
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
>>>>>>> laraxot/dev
    }

    /**
     * @return list<ArticleData>
     */
    public function getAllArticles(): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->allData();
    }

    /**
     * @param  Collection<int, Article>  $rows
=======
        $results = Article::orderBy('created_at', 'desc')->get();

        return $this->getArticleDataArray($results);
    }

    /**
     * @param EloquentCollection<int, Article>|Collection<int, Article> $rows
>>>>>>> laraxot/dev
     * @return list<ArticleData>
     */
    public function getArticleDataArray(Collection $rows): array
    {
<<<<<<< HEAD
        return $this->bag->articles()->dataArray($rows);
=======
        $tmp = [];
        foreach ($rows->toArray() as $content) {
            /** @var array<string, mixed> $content */
            if (isset($content['title']) && is_array($content['title'])) {
                $lang = app()->getLocale();
                $content['title'] = $content['title'][$lang] ?? last($content['title']);
            }
            /* @var array<string, mixed> $content */
            $tmp[] = ArticleData::from($content);
        }

        // dddx($tmp);
        return $tmp;
>>>>>>> laraxot/dev
    }

    public function getArticleModel(string $slug): ?Article
    {
<<<<<<< HEAD
        return $this->bag->articles()->model($slug);
    }

    public function getCategoryModel(string $slug): ?Model
    {
        return $this->bag->categories()->model($slug);
=======
        return Article::where('slug', $slug)->first();
    }

    public function getCategoryModel(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
>>>>>>> laraxot/dev
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getHotTopics(): array
    {
<<<<<<< HEAD
        return $this->bag->categories()->hotTopics();
=======
        /** @var array<int, array<string, mixed>> $categories */
        $categories = Category::query()
            ->with(['categoryArticles' => static fn ($query) => $query->withCount('ratings')])
            ->get()
            ->map(fn (Category $category): array => [
                'image' => $category->getFirstMediaUrl('category'),
                'slug' => $category->slug,
                'title' => $category->title,
                'ratings_sum' => (int) (is_numeric($sum = $category->categoryArticles->sum('ratings_count')) ? $sum : 0),
            ])
            ->sortByDesc('ratings_sum')
            ->take(3)
            ->values()
            ->all();

        /* @var array<int, array<string, mixed>> $categories */
        return $categories;
>>>>>>> laraxot/dev
    }
}
