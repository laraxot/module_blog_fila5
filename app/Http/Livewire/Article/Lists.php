<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Xot\Actions\GetViewAction;

class Lists extends Component
{
    public const ITEMS_PER_PAGE = 10;

    // All categories
    /**
     * @var Collection<Category>
     */
    public Collection $categories;

    // Variables keeping track of the current post query
    public int $postCount = 0;

    /**
     * @var \Illuminate\Support\Collection<int,\Illuminate\Support\Collection>
     */
    public \Illuminate\Support\Collection $postChunks;

    public int $queryCount = 0;

    public int $currentChunk = 0;

    // Currently selected category
    public ?Category $category = null;

    // Currently selected order
    public string $order = 'date_desc';

    public string $tpl;

    /**
     * @var array
     */
    protected $queryString = [
        'category' => ['except' => ''],
        'order' => ['except' => 'date_desc'],
    ];

    public function mount(): void
    {
        $this->categories = Category::all();
        $this->tpl = 'v1';

        $this->refreshArticles();
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'activeCategory' => $this->category,
        ];

        return view((string) $view, $view_params);
    }

    public function updatedCategory(): void
    {
        $this->refreshArticles();
    }

    public function updatedOrder(): void
    {
        $this->refreshArticles();
    }

    public function loadMore(): void
    {
        $this->currentChunk++;
    }

    // private function getActiveCategory(): ?Category
    // {
    // return $this->categories->first(fn ($i) => $i->slug === $this->category);
    //    return $this->category;
    // }

    /**
     * Summary of getArticleQuery.
     */
    private function getArticleQuery(): EloquentBuilder
    {
        $query = Article::published();
        if (($activeCategory = $this->category) instanceof Category) {
            $query = $query->whereCategoryId($activeCategory->id);
        }

        if ($this->order === 'date_asc') {
            return $query->orderBy('published_at', 'asc');
        }

        return $query->orderBy('published_at', 'desc');
    }

    private function refreshArticles(): void
    {
        // This will force the update of the `post-chunk` child components
        $this->queryCount++;
        $this->currentChunk = 0;

        $postIds = $this->getArticleQuery()->pluck('id');
        $this->postCount = $postIds->count(); /** @phpstan-ignore method.nonObject */
        $this->postChunks = $postIds->chunk(self::ITEMS_PER_PAGE);
    }
}
