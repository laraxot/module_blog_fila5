<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateTextWidget extends XotBaseCreateRecord
=======
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class CreateTextWidget extends CreateRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

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
