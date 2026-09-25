<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

class EditTextWidget extends XotBaseEditRecord
=======
=======
>>>>>>> b591d4e (Lint)
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class EditTextWidget extends EditRecord
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
            'view' => ViewAction::make(),
            'delete' => DeleteAction::make(),
=======
            ViewAction::make(),
            DeleteAction::make(),
>>>>>>> laraxot/dev
=======
            ViewAction::make(),
            DeleteAction::make(),
>>>>>>> b591d4e (Lint)
        ];
    }

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        return (string) static::getResource()::getUrl('index');
>>>>>>> laraxot/dev
=======
        return (string) static::getResource()::getUrl('index');
>>>>>>> b591d4e (Lint)
    }
}
