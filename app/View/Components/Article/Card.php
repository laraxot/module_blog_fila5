<?php

declare(strict_types=1);

namespace Modules\Blog\View\Components\Article;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

<<<<<<< HEAD
class Card extends Component
{
    public bool $showAuthor;

    public function __construct(
        public Article $article,
        string $authorDisplay = 'hidden',
        public string $tpl = 'v1',
    ) {
        $this->showAuthor = 'visible' === $authorDisplay;
=======
// use Modules\Xot\View\Components\XotBaseComponent;

/**
 * .
 */
class Card extends Component
{
    public function __construct(
        public Article $article,
        public bool $showAuthor = false,
        public string $tpl = 'v1',
    ) {
>>>>>>> laraxot/dev
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

<<<<<<< HEAD
        $viewParams = [];

        return view($view, $viewParams);
=======
        $view_params = [];

        return view($view, $view_params);
>>>>>>> laraxot/dev
    }
}
