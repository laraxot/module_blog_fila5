<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Pages;

<<<<<<< HEAD
<<<<<<< .merge_file_NL5Aqe
use Filament\Pages\Page;

class Dashboard extends Page
=======
use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
=======
use Modules\Xot\Filament\Pages\XotBasePage;

class Dashboard extends XotBasePage
=======
use Filament\Pages\Page;

class Dashboard extends Page
>>>>>>> .merge_file_NFDUQk
>>>>>>> laraxot/dev
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected string $view = 'blog::filament.pages.dashboard';
}
