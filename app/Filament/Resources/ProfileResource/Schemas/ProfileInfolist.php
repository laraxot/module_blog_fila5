<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Component;
use Modules\Xot\Filament\Resources\Schemas\XotBaseResourceInfolist;

class ProfileInfolist extends XotBaseResourceInfolist
{
    /**
     * @return array<string, Component>
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_BrfF5Q
    public static function getInfolistSchema(): array
=======
    public function getInfolistSchema(): array
=======
    public function getInfolistSchema(): array
=======
    public static function getInfolistSchema(): array
>>>>>>> .merge_file_i3meuQ
>>>>>>> laraxot/dev
=======
    public function getInfolistSchema(): array
>>>>>>> laraxot/dev
    {
        return [
            'id' => TextEntry::make('id'),
            'user' => TextEntry::make('user.name'),
            'email' => TextEntry::make('email'),
            'first_name' => TextEntry::make('first_name'),
            'last_name' => TextEntry::make('last_name'),
            'slug' => TextEntry::make('slug'),
            'extra' => TextEntry::make('extra')->html(),
        ];
    }
}
