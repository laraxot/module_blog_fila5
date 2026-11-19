<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Modules\Blog\Filament\Resources\ArticleResource\Schemas\ArticleFormSchema;
use Modules\Blog\Models\Article;
use Modules\Lang\Filament\Resources\LangBaseResource;

class ArticleResource extends LangBaseResource
{
    // Le pagine estendono LangBase*Record (Translatable): la risorsa deve estendere LangBaseResource,
    // altrimenti "getDefaultTranslatableLocale does not exist" (500 su crea/modifica).

    protected static ?string $model = Article::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    // protected static \BackedEnum|string|null $navigationIcon = 'icon-article';
=======
use Modules\Blog\Filament\Resources\ArticleResource\Pages\CreateArticle;
use Modules\Blog\Filament\Resources\ArticleResource\Pages\EditArticle;
use Modules\Blog\Filament\Resources\ArticleResource\Pages\ListArticles;
use Modules\Blog\Filament\Resources\ArticleResource\Pages\ViewArticle;
use Modules\Blog\Models\Article;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ArticleResource extends XotBaseResource
{
    protected static ?string $model = Article::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
>>>>>>> laraxot/dev

    /**
     * @return array<int, string>
     */
    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }

<<<<<<< HEAD
    /**
     * @return array<int|string, Component>
     */
    public static function getFormFields(): array
    {
        return ArticleFormSchema::build();
=======
    public static function getPages(): array
    {
        return [
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
            'view' => ViewArticle::route('/{record}'),
        ];
>>>>>>> laraxot/dev
    }
}
