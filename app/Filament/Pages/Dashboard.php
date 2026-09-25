<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
=======
use Filament\Pages\Page;

class Dashboard extends Page
>>>>>>> laraxot/dev
=======
use Filament\Pages\Page;

class Dashboard extends Page
>>>>>>> b591d4e (Lint)
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'blog::filament.pages.dashboard';
}
