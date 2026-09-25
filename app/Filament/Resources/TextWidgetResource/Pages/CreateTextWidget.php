<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateTextWidget extends XotBaseCreateRecord
=======
=======
>>>>>>> b591d4e (Lint)
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class CreateTextWidget extends CreateRecord
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
{
    protected static string $resource = TextWidgetResource::class;

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
