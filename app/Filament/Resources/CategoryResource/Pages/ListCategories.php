<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions\CreateAction;
<<<<<<< HEAD
=======
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
>>>>>>> laraxot/dev
// use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
// use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListCategories extends XotBaseListRecords
{
    // use Translatable; // Temporarily disabled until lara-zeus package is working

<<<<<<< HEAD
=======
    /**
     * @return array<string, mixed>
     */
    public function getTableColumns(): array
    {
        return [
            'icon' => IconColumn::make('icon')
                ->icon(fn ($state) => $state),
            'title' => TextColumn::make('title')
                ->searchable()
                ->sortable(),
            'parent_title' => TextColumn::make('parent.title')
                ->searchable()
                ->sortable(),
            'image' => SpatieMediaLibraryImageColumn::make('image')
                ->collection('category'),
        ];
    }

>>>>>>> laraxot/dev
    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->columns($this->getTableColumns())
    //         ->filters([
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //             Tables\Actions\DeleteAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\DeleteBulkAction::make(),
    //         ]);
    // }

    protected function getHeaderActions(): array
    {
        return [
            // 'locale_switcher' => LocaleSwitcher::make(), // Temporarily disabled until lara-zeus package is working
            'create' => CreateAction::make(),
        ];
    }
}
