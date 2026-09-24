<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\EditAction;
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTextWidget extends XotBaseViewRecord
=======
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class ViewTextWidget extends ViewRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
            'edit' => EditAction::make(),
=======
            EditAction::make(),
>>>>>>> laraxot/dev
        ];
    }
}
