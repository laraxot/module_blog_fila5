<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Schemas\Components\Component;
use Modules\Blog\Filament\Resources\TextWidgetResource\Pages\CreateTextWidget;
use Modules\Blog\Filament\Resources\TextWidgetResource\Pages\EditTextWidget;
use Modules\Blog\Filament\Resources\TextWidgetResource\Pages\ListTextWidgets;
use Modules\Blog\Filament\Resources\TextWidgetResource\Pages\ViewTextWidget;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TextWidgetResource extends XotBaseResource
{
    // protected static ?string $model = TextWidget::class;

    // protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static string|\BackedEnum|null $navigationIcon = 'ui-widgets';

    // protected static ?string $navigationGroup = 'Content';
    /**
     * @return array<string|int, Component>
     */
    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTextWidgets::route('/'),
            'create' => CreateTextWidget::route('/create'),
            'view' => ViewTextWidget::route('/{record}'),
            'edit' => EditTextWidget::route('/{record}/edit'),
        ];
    }
}
