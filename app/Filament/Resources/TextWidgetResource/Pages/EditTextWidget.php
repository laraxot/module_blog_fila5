<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Webmozart\Assert\Assert;

class EditTextWidget extends EditRecord
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $url = static::getResource()::getUrl('index');
        Assert::string($url);

        return $url;
    }
}
