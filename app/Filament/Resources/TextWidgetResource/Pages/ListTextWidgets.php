<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

<<<<<<< HEAD
=======
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
>>>>>>> laraxot/dev
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListTextWidgets extends XotBaseListRecords
{
<<<<<<< HEAD
=======
    /**
     * @return array<string, mixed>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->sortable(),
            'key' => TextColumn::make('key')->searchable(),
            'title' => TextColumn::make('title')->limit(40),
            'active' => IconColumn::make('active')->boolean(),
            'created_at' => TextColumn::make('created_at')->dateTime()->sortable(),
        ];
    }
>>>>>>> laraxot/dev
    // protected static string $resource = TextWidgetResource::class;
}
