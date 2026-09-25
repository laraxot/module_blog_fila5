<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

<<<<<<< HEAD
=======
use Filament\Resources\Pages\PageRegistration;
>>>>>>> laraxot/dev
use Filament\Schemas\Components\Component;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\CreateCategory;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\EditCategory;
use Modules\Blog\Filament\Resources\CategoryResource\Pages\ListCategories;
use Modules\Blog\Filament\Resources\CategoryResource\Schemas\CategoryFormSchema;
use Modules\Xot\Filament\Resources\XotBaseResource;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> laraxot/dev

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

    /**
     * @return array<int|string, Component>
     */
    public static function getFormFields(): array
    {
        return CategoryFormSchema::build();
    }

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_R8fvBu
=======
=======
>>>>>>> .merge_file_InX8bu
    /**
     * @return array<string|int, Component>
     */
    public static function getFormSchema(): array
    {
        /** @var array<string|int, Component> $fields */
        $fields = static::getFormFields();
        Assert::isArray($fields, 'getFormFields must return array');

        return $fields;
    }

<<<<<<< .merge_file_R8fvBu
=======
=======
>>>>>>> .merge_file_InX8bu
>>>>>>> laraxot/dev
=======
    /** @return array<string, PageRegistration> */
>>>>>>> laraxot/dev
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
