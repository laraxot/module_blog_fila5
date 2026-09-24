<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditTextWidget extends XotBaseEditRecord
=======
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class EditTextWidget extends EditRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
            'view' => ViewAction::make(),
            'delete' => DeleteAction::make(),
=======
            ViewAction::make(),
            DeleteAction::make(),
>>>>>>> laraxot/dev
        ];
    }

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        return (string) static::getResource()::getUrl('index');
>>>>>>> laraxot/dev
    }
}
