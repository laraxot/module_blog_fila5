<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_XhojV5
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateTextWidget extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_mrCOp8
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class CreateTextWidget extends CreateRecord
<<<<<<< .merge_file_XhojV5
=======
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateTextWidget extends XotBaseCreateRecord
=======
>>>>>>> .merge_file_mrCOp8
>>>>>>> laraxot/dev
=======
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Webmozart\Assert\Assert;

class CreateTextWidget extends CreateRecord
>>>>>>> laraxot/dev
{
    protected static string $resource = TextWidgetResource::class;

    protected function getRedirectUrl(): string
    {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_XhojV5
        return (string) static::getResource()::getUrl('index');
=======
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        $url = static::getResource()::getUrl('index');

        return is_string($url) ? $url : '';
=======
        return (string) static::getResource()::getUrl('index');
>>>>>>> .merge_file_mrCOp8
>>>>>>> laraxot/dev
=======
        $url = static::getResource()::getUrl('index');
        Assert::string($url);

        return $url;
>>>>>>> laraxot/dev
    }
}
