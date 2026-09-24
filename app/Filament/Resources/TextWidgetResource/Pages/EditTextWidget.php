<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
<<<<<<< HEAD
<<<<<<< .merge_file_MsUr8s
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditTextWidget extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tEnPnD
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class EditTextWidget extends EditRecord
<<<<<<< .merge_file_MsUr8s
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditTextWidget extends XotBaseEditRecord
=======
>>>>>>> .merge_file_tEnPnD
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
<<<<<<< .merge_file_MsUr8s
            ViewAction::make(),
            DeleteAction::make(),
=======
            'view' => ViewAction::make(),
            'delete' => DeleteAction::make(),
=======
            'view' => ViewAction::make(),
            'delete' => DeleteAction::make(),
=======
            ViewAction::make(),
            DeleteAction::make(),
>>>>>>> .merge_file_tEnPnD
>>>>>>> laraxot/dev
        ];
    }

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
<<<<<<< .merge_file_MsUr8s
        return (string) static::getResource()::getUrl('index');
=======
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        return (string) static::getResource()::getUrl('index');
>>>>>>> .merge_file_tEnPnD
>>>>>>> laraxot/dev
    }
}
