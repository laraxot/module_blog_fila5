<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Resources\Pages\PageRegistration;
use Modules\Blog\Filament\Resources\BannerResource\Pages\CreateBanner;
use Modules\Blog\Filament\Resources\BannerResource\Pages\EditBanner;
use Modules\Blog\Filament\Resources\BannerResource\Pages\ListBanners;
use Modules\Blog\Models\Banner;
use Modules\Xot\Filament\Resources\XotBaseResource;

class BannerResource extends XotBaseResource
{
    // use Translatable;
    protected static ?string $model = Banner::class;

    protected static string|\BackedEnum|null $navigationIcon = 'ui-starbanner';

    // public static function getTranslatableLocales(): array
    // {
    //     return ['it', 'en'];
    // }
    /** @return array<string, PageRegistration> */
    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            'create' => CreateBanner::route('/create'),
            'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
