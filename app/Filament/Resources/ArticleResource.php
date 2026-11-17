<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

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
            'index' => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit' => EditArticle::route('/{record}/edit'),
            'view' => ViewArticle::route('/{record}'),
        ];
    }
}
