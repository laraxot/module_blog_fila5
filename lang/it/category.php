<?php

declare(strict_types=1);

return [
    'navigation' => [
        'name' => 'Category',
        'plural' => 'Categories',
<<<<<<< HEAD
        'group' => 'Contenuti',
        'sort' => 21,
        'icon' => 'heroicon-o-tag',
        'label' => 'Categorie',
=======
        'group' => [
            'name' => 'Content',
        ],
        'sort' => 21,
        'icon' => 'heroicon-o-tag',
        'label' => 'Categoria',
>>>>>>> laraxot/dev
    ],
    'show' => [
        'title' => 'Articoli della categoria ',
    ],
    'fields' => [
        'icon' => [
<<<<<<< HEAD
            'label' => 'Icona',
            'description' => '',
            'helper_text' => '',
            'placeholder' => '',
        ],
        'image' => [
            'label' => 'Immagine',
            'description' => '',
            'helper_text' => '',
            'placeholder' => '',
        ],
        'description' => [
            'label' => 'Descrizione',
            'description' => '',
            'helper_text' => '',
            'placeholder' => '',
        ],
        'parent_id' => [
            'label' => 'Voce superiore',
            'description' => '',
            'placeholder' => '',
            'helper_text' => '',
        ],
        'slug' => [
            'label' => 'Indirizzo (slug)',
            'placeholder' => '',
            'helper_text' => '',
            'description' => '',
        ],
        'title' => [
            'label' => 'Titolo',
            'placeholder' => '',
            'helper_text' => '',
            'description' => '',
        ],
        'parent' => [
            'title' => [
                'label' => 'Titolo',
=======
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
>>>>>>> laraxot/dev
            ],
        ],
    ],
    'actions' => [
        'create' => [
<<<<<<< HEAD
            'label' => 'Nuovo',
        ],
        'activeLocale' => [
            'label' => 'Lingua',
        ],
        'logout' => [
            'tooltip' => '',
            'icon' => 'logout',
            'label' => 'logout',
=======
            'label' => 'create',
        ],
        'activeLocale' => [
            'label' => 'activeLocale',
>>>>>>> laraxot/dev
        ],
    ],
];
