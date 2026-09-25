<?php

declare(strict_types=1);

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< .merge_file_LLHEUM
=======
=======
>>>>>>> .merge_file_Hg9HN3
// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/it/category.php
<<<<<<< .merge_file_LLHEUM
=======
=======
>>>>>>> .merge_file_Hg9HN3
>>>>>>> laraxot/dev
=======
>>>>>>> laraxot/dev
return [
    'navigation' => [
        'name' => 'Category',
        'plural' => 'Categories',
        'group' => [
            'name' => 'Content',
        ],
        'sort' => 21,
        'icon' => 'heroicon-o-tag',
        'label' => 'Categoria',
    ],
    'show' => [
        'title' => 'Articoli della categoria ',
    ],
    'fields' => [
        'icon' => [
            'label' => 'icon',
            'description' => 'icon',
            'helper_text' => 'icon',
            'placeholder' => 'icon',
        ],
        'image' => [
            'label' => 'image',
            'description' => 'image',
            'helper_text' => 'image',
            'placeholder' => 'image',
        ],
        'description' => [
            'label' => 'description',
            'description' => 'description',
            'helper_text' => 'description',
            'placeholder' => 'description',
        ],
        'parent_id' => [
            'label' => 'parent_id',
            'description' => 'parent_id',
            'placeholder' => 'parent_id',
            'helper_text' => 'parent_id',
        ],
        'slug' => [
            'label' => 'slug',
            'placeholder' => 'slug',
            'helper_text' => 'slug',
            'description' => 'slug',
        ],
        'title' => [
            'label' => 'title',
            'placeholder' => 'title',
            'helper_text' => 'title',
            'description' => 'title',
        ],
        'parent' => [
            'title' => [
                'label' => 'parent.title',
            ],
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'create',
        ],
        'activeLocale' => [
            'label' => 'activeLocale',
        ],
    ],
];
