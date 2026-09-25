<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
<<<<<<< HEAD
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
=======
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Webmozart\Assert\Assert;

class EditTextWidget extends EditRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
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
=======
            ViewAction::make(),
            DeleteAction::make(),
>>>>>>> laraxot/dev
        ];
    }

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
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
=======
        $url = static::getResource()::getUrl('index');
        Assert::string($url);

        return $url;
>>>>>>> laraxot/dev
    }
}
