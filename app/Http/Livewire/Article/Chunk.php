<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

class Chunk extends Component
{
    /** @var array<int, string> */
<<<<<<< HEAD
    /** @var array<int, mixed> */
    /** @var array<int, mixed> */
=======
>>>>>>> laraxot/dev
    public array $postIds;

    public string $tpl = 'v1';

    public function render(): Renderable
    {
        $articles = Article::whereIn('id', $this->postIds)->get()->keyBy('id');

<<<<<<< HEAD
        $orderedPosts = collect($this->postIds)->map(static fn ($id) => (is_array($articles) ? $articles[$id] : null));
=======
        $orderedPosts = collect($this->postIds)->map(fn (string $id): ?Article => $articles->get($id));
>>>>>>> laraxot/dev

        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_OpLBY8
=======
=======
>>>>>>> laraxot/dev
        $viewParams = [
            'articles' => $orderedPosts,
        ];

        return view((string) $view, $viewParams);
<<<<<<< HEAD
=======
>>>>>>> .merge_file_vFXEWe
        $parameters = [
            'articles' => $orderedPosts,
        ];

        return view((string) $view, $parameters);
<<<<<<< .merge_file_OpLBY8
=======
        $viewParams = [
            'articles' => $orderedPosts,
        ];

        return view((string) $view, $viewParams);
=======
>>>>>>> .merge_file_vFXEWe
>>>>>>> laraxot/dev
=======
>>>>>>> laraxot/dev
    }

    public function url(): string
    {
        return '#';
    }
}
