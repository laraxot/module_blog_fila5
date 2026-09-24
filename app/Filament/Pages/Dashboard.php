<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Pages;

<<<<<<< HEAD
use Filament\Pages\Page;

class Dashboard extends Page
=======
use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
>>>>>>> laraxot/dev
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'blog::filament.pages.dashboard';
}
