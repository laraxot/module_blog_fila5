<?php

declare(strict_types=1);

<<<<<<< HEAD
<<<<<<< HEAD
=======
// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/it/category.php
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
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
        'icon' => [
            'label' => 'icon',
        ],
        'image' => [
            'label' => 'image',
        ],
        'description' => [
            'label' => 'description',
        ],
        'parent_id' => [
            'label' => 'parent_id',
        ],
        'slug' => [
            'label' => 'slug',
        ],
        'title' => [
            'label' => 'title',
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
