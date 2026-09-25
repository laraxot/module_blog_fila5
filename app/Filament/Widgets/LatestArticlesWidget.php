<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Widgets;

use Filament\Tables\Table;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_DTxYTz
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArticlesWidget extends BaseWidget
=======
use Modules\Xot\Filament\Widgets\XotBaseTableWidget;

class LatestArticlesWidget extends XotBaseTableWidget
=======
use Modules\Xot\Filament\Widgets\XotBaseTableWidget;

class LatestArticlesWidget extends XotBaseTableWidget
=======
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArticlesWidget extends BaseWidget
>>>>>>> .merge_file_y5QZtb
>>>>>>> laraxot/dev
=======
use Modules\Xot\Filament\Widgets\XotBaseTableWidget;

class LatestArticlesWidget extends XotBaseTableWidget
>>>>>>> laraxot/dev
{
    public function table(Table $table): Table
    {
        return $table;
        /*
            ->query(
                // ...
            )
            ->columns([
                // ...
            ]);
        */
    }
}
