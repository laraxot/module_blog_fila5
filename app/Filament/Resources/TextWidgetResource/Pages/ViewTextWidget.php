<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\EditAction;
<<<<<<< HEAD
<<<<<<< .merge_file_TjCOAB
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTextWidget extends XotBaseViewRecord
=======
>>>>>>> .merge_file_zDBLJB
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class ViewTextWidget extends ViewRecord
<<<<<<< .merge_file_TjCOAB
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTextWidget extends XotBaseViewRecord
=======
>>>>>>> .merge_file_zDBLJB
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
<<<<<<< .merge_file_TjCOAB
            EditAction::make(),
=======
            'edit' => EditAction::make(),
=======
            'edit' => EditAction::make(),
=======
            EditAction::make(),
>>>>>>> .merge_file_zDBLJB
>>>>>>> laraxot/dev
        ];
    }
}
