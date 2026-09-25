<?php

declare(strict_types=1);

<<<<<<< HEAD
<<<<<<< HEAD
=======
// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/it/banner.php
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
return [
    'navigation' => [
        'name' => 'Banner',
        'plural' => 'Banners',
        'group' => [
            'name' => 'Content',
        ],
    ],
    'fields' => [
        'id' => [
            'label' => 'Id',
        ],
        'title' => [
            'label' => 'Titolo',
        ],
        'category' => [
            'title' => [
                'label' => 'Categoria abbinata',
            ],
        ],
        'image' => [
            'label' => 'Immagine',
        ],
        'file' => [
            'label' => 'file',
        ],
        'fileContent' => [
            'label' => 'fileContent',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'create',
        ],
        'import' => [
            'label' => 'import',
        ],
    ],
];
