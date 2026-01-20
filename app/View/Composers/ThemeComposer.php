<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Blog\Datas\ArticleData;
use Modules\Blog\Models\Article;
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
     * @return Collection<int, Category>
     */
    public function categories()
    {
        return Category::tree()->get()->toTree();
    }

    /**
     * Show recent categories with their latest .
     *
     * @return Collection<int, Category>
     */
    public function getCategoriesArticles()
    {
        return $this->categories();
    }

    public function getArticles(): EloquentCollection
    {
        return Article::all()
            ->sortBy(['created_at', 'desc']);
    }

    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $fun = 'get'.Str::studly($type).'Articles';

        $result = $this->{$fun}($number);

        return $result instanceof Collection ? $result : collect();
    }

    public function getFeaturedArticles(int $number = 6): Collection
    {
        $rows = Article::published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();
        if (0 === $rows->count()/* @phpstan-ignore method.nonObject */) {
            $rows = Article::get();
            Article::whereRaw('1=1')->update(['show_on_homepage' => true]);
        }

        return $rows;
    }

    public function getLatestArticles(int $number = 6): Collection
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesByCategory(string $category_id, int $number = 6): array
    {
        $rows = Article::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($rows);
    }

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

    public function getNavCategories(): Collection
    {
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
    }

    public function getFooterCategories(): Collection
    {
        return Category::has('articles', '>', 0)
            ->take(8)
            ->get();
    }

    // --- da fare con parental
    public function getFooterAuthors(): Collection
    {
        // $footerAuthors = Profile::profileIsAuthor()
        // ->take(8)
        $footerAuthors = Profile::inRandomOrder()
            ->limit(8)
            ->get();

        return $footerAuthors;
    }

    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function getFooterTags(): Collection
    {
        return Tag::take(15)->get();
    }

    /**
     * @return Collection<(int|string), mixed>
     */
    public function getMoreArticles(Model $model)
    {
        return collect([]);
    }

    /**
     * @return LengthAwarePaginator<Article>
     */
    public function getPaginatedArticles(int $num = 15)
    {
        return Article::paginate($num);
    }

    public function showArticleSidebarContent(string $slug): Renderable
    {
        Assert::isInstanceOf($article = Article::firstOrCreate(['slug' => $slug], ['sidebar_blocks' => []]), Article::class, '['.__LINE__.']['.__FILE__.']');
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);

        $article = new Blocks(blocks: $article->sidebar_blocks, model: $article);

        return $article->render();
    }

    

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
    }

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
        $results = $this->getLatestArticles($number); // ->toArray();

        return $this->getArticleDataArray($results);
    }

    public function paginatedArticlesLatest(int $limit = 6): Paginator
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesComingSoon(int $limit = 6): Paginator
    {
        return Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByNumberOfBets(int $limit = 6): Paginator
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByVolumes(int $limit = 6): Paginator
    {
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
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesComingSoon(int $number = 6): array
    {
        $results = Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesOrderByNumberOfBets(int $number = 6): array
    {
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticlesOrderByVolumes(int $number = 6): array
    {
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    /**
     * @return list<ArticleData>
     */
    public function getAllArticles(): array
    {
        $results = Article::orderBy('created_at', 'desc')->get();

        return $this->getArticleDataArray($results);
    }

    /**
     * @return list<ArticleData>
     */
    public function getArticleDataArray(Collection $rows): array
    {
        $tmp = [];
        foreach ($rows->toArray() as $content) {
            /** @var array $content */
            if (isset($content['title']) && is_array($content['title'])) {
                $lang = app()->getLocale();
                $content['title'] = $content['title'][$lang] ?? last($content['title']);
            }
            /* @var array $content */
            $tmp[] = ArticleData::from($content);
        }

        // dddx($tmp);
        return $tmp;
    }

    public function getArticleModel(string $slug): ?Article
    {
        return Article::where('slug', $slug)->first();
    }

    public function getCategoryModel(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function getHotTopics(): array
    {
        $result = Category::with([
            'categoryArticles' => function ($query) {
                if (is_object($query) && method_exists($query, 'withCount')) {
                    $query->withCount('ratings');
                }

                return $query;
            },
            // 'banner'
        ])
            ->get()
            ->map(fn ($category): array => [
                'image' => $category->getFirstMediaUrl('category'), // ?? 'https://placehold.co/300x200',
                'slug' => $category->slug,
                'title' => $category->title,
                'ratings_sum' => $category->categoryArticles->sum('ratings_count'),
            ])
            ->sortByDesc('ratings_sum')
            ->take(3)
            ->values()
            ->toArray();

        /** @var list<array<string, mixed>> $typedResult */
        $typedResult = array_values($result);
        return $typedResult;
    }
}
