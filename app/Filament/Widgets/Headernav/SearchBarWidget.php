<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Widgets\Headernav;

use Filament\Tables\Table;
use Modules\Blog\Models\Article;
use Modules\Xot\Filament\Widgets\XotBaseTableWidget;

class SearchBarWidget extends XotBaseTableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Article::query()
                    ->whereIn('content_type', ['post', 'event'])
                    ->where('title', 'like', '%'.$this->filters['search'] ?? ''.'%')
            )
            ->columns([
                // Per il widget di ricerca, potremmo voler mostrare solo il titolo, slug, ecc.
                // Ma la modalità di ricerca attuale usa una vista personalizzata, quindi teniamo la logica semplice.
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30 seconds');
    }
}
