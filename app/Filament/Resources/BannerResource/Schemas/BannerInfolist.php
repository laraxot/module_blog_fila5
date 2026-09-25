<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceInfolist;

class BannerInfolist extends XotBaseResourceInfolist
{
    /**
     * @return array<string, Component>
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_q9XHsN
    public static function getInfolistSchema(): array
=======
    public function getInfolistSchema(): array
=======
    public function getInfolistSchema(): array
=======
    public static function getInfolistSchema(): array
>>>>>>> .merge_file_aNNpDh
>>>>>>> laraxot/dev
=======
    public function getInfolistSchema(): array
>>>>>>> laraxot/dev
    {
        return [
            'title' => TextEntry::make('title'),
            'slug' => TextEntry::make('slug'),
            'description' => TextEntry::make('description'),
            'image' => ImageEntry::make('image'),
            'link' => TextEntry::make('link'),
            'position' => TextEntry::make('position'),
            'active' => TextEntry::make('active')->badge(),
        ];
    }
}
