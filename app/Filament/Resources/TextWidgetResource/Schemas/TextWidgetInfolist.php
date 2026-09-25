<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceInfolist;

class TextWidgetInfolist extends XotBaseResourceInfolist
{
    /**
     * @return array<string, Component>
     */
<<<<<<< HEAD
<<<<<<< HEAD
    public function getInfolistSchema(): array
=======
    public static function getInfolistSchema(): array
>>>>>>> laraxot/dev
=======
    public static function getInfolistSchema(): array
>>>>>>> b591d4e (Lint)
    {
        return [
            'key' => TextEntry::make('key'),
            'image' => TextEntry::make('image'),
            'title' => TextEntry::make('title'),
            'content' => TextEntry::make('content')
                ->limit(120),
            'active' => TextEntry::make('active'),
        ];
    }
}
