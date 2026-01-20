<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\File;
// use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
// use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Blog\Actions\Article\ImportArticlesFromByJsonTextAction;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Models\Category;
use Modules\Xot\Actions\Cast\SafeArrayCastAction;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListArticles extends XotBaseListRecords
{
    // use Translatable; // Temporarily disabled until lara-zeus package is working

    // protected static string $resource = ArticleResource::class;
    /**
     * @return array<string, mixed>
     */
    /**
     * @return array<string, Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id'),
            'title' => TextColumn::make('title')
                ->wrap()
                ->sortable()
                ->searchable(),
            'category_title' => TextColumn::make('category.title')
                ->sortable()
                ->searchable(),
            'published_at' => TextColumn::make('published_at')
                ->dateTime()
                ->sortable(),
            'closed_at' => TextColumn::make('closed_at')
                ->dateTime()
                ->sortable(),
            'rewarded_at' => TextColumn::make('rewarded_at')
                ->dateTime()
                ->sortable(),
            'is_featured' => IconColumn::make('is_featured')
                ->boolean()
                ->sortable(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getTableFilters(): array
    {
        /** @var array<array<string>|string> $categoryOptions */
        $categoryOptions = SafeArrayCastAction::cast(Category::getTreeCategoryOptions());

        return [
            'is_featured' => Filter::make('is_featured')->toggle(),
            'category' => SelectFilter::make('Categoria')
                ->options($categoryOptions)
                ->attribute('category_id'),
        ];
    }

    /**
     * Get header actions.
     *
     * @return array<string, Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            // 'locale_switcher' => LocaleSwitcher::make(), // Temporarily disabled until lara-zeus package is working
            'create' => CreateAction::make(),
            'import' => Action::make('import')
                ->schema([
                    FileUpload::make('file')
                        ->label('')
                        // ->acceptedFileTypes(['application/json', 'json'])
                        ->imagePreviewHeight('250')
                        ->reactive()
                        ->afterStateUpdated(static function (callable $set, TemporaryUploadedFile $state): void {
                            $set('fileContent', File::get($state->getRealPath()));
                        }),
                    Textarea::make('fileContent'),
                ])
                ->label('')
                ->tooltip('Import')
                ->icon('heroicon-o-folder-open')
                ->action(static fn (array $data) => app(ImportArticlesFromByJsonTextAction::class)->execute((string) $data['fileContent'])),
        ];
    }
}
