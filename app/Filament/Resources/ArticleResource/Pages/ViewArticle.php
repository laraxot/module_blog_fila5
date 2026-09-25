<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Models\Article;
// use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
// use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Modules\Rating\Filament\Widgets\StatsOverview;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
// use Modules\Rating\Filament\Actions\Header\BetHeaderAction;
// use Modules\Rating\Filament\Actions\Header\WinHeaderAction;

class ViewArticle extends XotBaseViewRecord
{
    // use Translatable; // Temporarily disabled until lara-zeus package is working

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // LocaleSwitcher::make(), // Temporarily disabled until lara-zeus package is working
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
            // BetHeaderAction::make(),
            // WinHeaderAction::make(),
            'change_closed_at' => Action::make('change_closed_at')
                ->tooltip('cambia data chiusura')
                ->label('')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    DateTimePicker::make('closed_at')
                        ->native(false),
                ])
                ->action(static function (array $data, Article $record): void {
                    $record->closed_at = $data['closed_at'] ?? null;
                    $record->save();
                }),
            /*
            Actions\Action::make('translate')
                ->label('Copia Blocchi nelle altre lingue')
                ->tooltip('translate')
                ->icon('heroicon-o-language')
                ->requiresConfirmation()
                ->modalDescription('Assicurati che la versione italiana sia stata settata e salvata')
                ->form([
                    Checkbox::make('content_blocks')->inline(),
                    Checkbox::make('sidebar_blocks')->inline(),
                    Checkbox::make('footer_blocks')->inline(),
                ])
                ->action(function (Article $record, ArticleResource $article_resource, array $data) {
                    return app(TranslateContentAction::class)->execute(
                        'article',
                        $record->id, $article_resource->getTranslatableLocales(),
                        $data,
                        Article::class
                    );
                }),
            */
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
