<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class BannerAndSlides
{
    public static function make(
        string $name = 'banner_and_slides',
<<<<<<< HEAD
=======
        string $context = 'form',
>>>>>>> laraxot/dev
    ): Block {
        return Block::make($name)
            ->schema([
                TextInput::make('title')
                    ->required(),
                Select::make('layout')
                    ->label('layout')
                    ->options([
                        'v1' => 'layout 1 (Bootstrap)',
                    ])
                    ->required(),
            ]);
    }
}
