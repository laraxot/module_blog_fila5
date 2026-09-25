<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
<<<<<<< HEAD
<<<<<<< HEAD
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

class RatingMorphsRelationManager extends XotBaseRelationManager
=======
=======
>>>>>>> b591d4e (Lint)
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RatingMorphsRelationManager extends RelationManager
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
{
    // protected static string $relationship = 'ratings';
    protected static string $relationship = 'ratingMorphs';

<<<<<<< HEAD
<<<<<<< HEAD
    public function getFormSchema(): array
    {
        return [
            'title' => TextInput::make('title')
                ->required()
                ->maxLength(255),
        ];
=======
=======
>>>>>>> b591d4e (Lint)
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
<<<<<<< HEAD
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                TextColumn::make('rating.title'),
                // Tables\Columns\TextColumn::make('pivot.user.name'),
                /*
                Tables\Columns\TextColumn::make('user.name')->default(function($record){
                    dddx($record);
                    if($record->pivot->user_id==null){
                        return null;
                    }
                    return $record->pivot->user->name;
                }),
                //*/
                TextColumn::make('value'),
                TextColumn::make('is_winner'),
                TextColumn::make('reward'),
                TextColumn::make('updated_at'),
            ])
            ->filters([
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
