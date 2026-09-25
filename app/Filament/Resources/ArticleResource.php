<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Schemas\Components\Component;
use Modules\Blog\Filament\Resources\ArticleResource\Schemas\ArticleFormSchema;
use Modules\Blog\Models\Article;
use Modules\Xot\Filament\Resources\XotBaseResource;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_zqbYmI
use Webmozart\Assert\Assert;
=======
=======
=======
use Webmozart\Assert\Assert;
>>>>>>> .merge_file_zyamWu
>>>>>>> laraxot/dev
=======
use Webmozart\Assert\Assert;
>>>>>>> laraxot/dev

class ArticleResource extends XotBaseResource
{
    // use Translatable; // Temporarily disabled until lara-zeus package is working

    protected static ?string $model = Article::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    // protected static \BackedEnum|string|null $navigationIcon = 'icon-article';

    /**
<<<<<<< HEAD
     * @return array<int, string>
=======
     * @return list<string>
>>>>>>> laraxot/dev
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
        return ArticleFormSchema::build();
    }
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_zqbYmI
=======
=======
>>>>>>> .merge_file_zyamWu
=======
>>>>>>> laraxot/dev

    /**
     * @return array<int|string, Component>
     */
<<<<<<< HEAD
    public static function getFormSchema(): array
=======
    public function getFormSchemaOld(): array
>>>>>>> laraxot/dev
    {
        /** @var array<int|string, Component> $fields */
        $fields = static::getFormFields();
        Assert::isArray($fields, 'getFormFields must return array');

        return $fields;
    }
<<<<<<< HEAD
<<<<<<< .merge_file_zqbYmI
=======
=======
>>>>>>> .merge_file_zyamWu
>>>>>>> laraxot/dev
=======
>>>>>>> laraxot/dev
}
