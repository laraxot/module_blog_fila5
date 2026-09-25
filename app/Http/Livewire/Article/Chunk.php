<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

class Chunk extends Component
{
<<<<<<< HEAD
    /** @var array<int, int|string> */
=======
    /** @var array<int, string> */
    /** @var array<int, mixed> */
    /** @var array<int, mixed> */
>>>>>>> laraxot/dev
    public array $postIds;

    public string $tpl = 'v1';

    public function render(): Renderable
    {
        $articles = Article::whereIn('id', $this->postIds)->get()->keyBy('id');

<<<<<<< HEAD
        $orderedPosts = collect($this->postIds)->map(static fn (int|string $id): ?Article => $articles->get($id));
=======
        $orderedPosts = collect($this->postIds)->map(static fn ($id) => (is_array($articles) ? $articles[$id] : null));
>>>>>>> laraxot/dev

        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $viewParams = [
            'articles' => $orderedPosts,
        ];

        return view((string) $view, $viewParams);
    }

    public function url(): string
    {
        return '#';
    }
}
