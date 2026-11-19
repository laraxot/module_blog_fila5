<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Widgets;

use Filament\Tables\Table;
<<<<<<< HEAD
use Modules\Xot\Filament\Widgets\XotBaseTableWidget;

class LatestArticlesWidget extends XotBaseTableWidget
=======
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArticlesWidget extends BaseWidget
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
