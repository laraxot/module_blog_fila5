<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\EditAction;
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTextWidget extends XotBaseViewRecord
=======
=======
>>>>>>> b591d4e (Lint)
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class ViewTextWidget extends ViewRecord
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
<<<<<<< HEAD
            'edit' => EditAction::make(),
=======
            EditAction::make(),
>>>>>>> laraxot/dev
=======
            EditAction::make(),
>>>>>>> b591d4e (Lint)
        ];
    }
}
