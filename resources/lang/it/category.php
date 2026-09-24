<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/category.php
return [
    'navigation' => [
        'name' => 'Category',
        'plural' => 'Categories',
        'group' => [
            'name' => 'Content',
        ],
    ],
    'show' => [
        'title' => 'Articoli della categoria ',
    ],
    'fields' => [
        'image' => [
            'description' => 'image',
            'label' => 'image',
            'placeholder' => 'image',
            'helper_text' => 'image',
        ],
        'title' => [
            'label' => 'title',
            'placeholder' => 'title',
            'helper_text' => 'title',
            'description' => 'title',
        ],
        'slug' => [
            'label' => 'slug',
            'placeholder' => 'slug',
            'helper_text' => 'slug',
            'description' => 'slug',
        ],
        'parent_id' => [
            'label' => 'parent_id',
            'placeholder' => 'parent_id',
            'helper_text' => 'parent_id',
            'description' => 'parent_id',
        ],
        'description' => [
            'label' => 'description',
            'placeholder' => 'description',
            'helper_text' => 'description',
            'description' => 'description',
        ],
    ],
];
