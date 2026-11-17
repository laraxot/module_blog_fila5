<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
// use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\CreateCategory;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\EditCategory;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\ListCategories;
use Modules\Blog\Models\Category;
use Modules\UI\Filament\Forms\Components\IconPicker;
use Modules\Xot\Actions\Cast\SafeArrayCastAction;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Webmozart\Assert\Assert;

class CategoryResource extends XotBaseResource
{
    // use Translatable; // Temporarily disabled until lara-zeus package is working

    // protected static ?string $model = Category::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Content';

    /**
     * @return array<int, string>
     */
    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }


    public static function getPages(): array
    {
        return [
            // 'index' => Pages\ManageCategories::route('/'),
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
