<?php

declare(strict_types=1);

namespace Modules\Blog\Traits;

trait HasContentEditor
{
    public static function getContentEditor(string $field): string
    {
        $defaultEditor = config('filament-blog.editor');

        return $defaultEditor::make($field)
            ->label((string) __('filament-blog::filament-blog.content'))
            ->required()
            ->toolbarButtons(config('filament-blog.toolbar_buttons'))
            ->columnSpan([
                'sm' => 2,
            ]);
    }
}
