<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

class Chunk extends Component
{
    public array $postIds;

    public string $tpl = 'v1';

    public function render(): Renderable
    {
        $articles = Article::whereIn('id', $this->postIds)->get()->keyBy('id');

        $orderedPosts = collect($this->postIds)->map(static fn ($id) => (is_array($articles) ? $articles[$id] : null));

        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'articles' => $orderedPosts,
        ];

        return view((string) $view, $view_params);
    }

    public function url(string $name, array $params): string
    {
        return '#';
    }
}
