<?php

declare(strict_types=1);

<<<<<<< HEAD
=======
// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/en/banner.php
>>>>>>> laraxot/dev
return [
    'navigation' => [
        'name' => 'Banner',
        'plural' => 'Banners',
        'group' => [
            'name' => 'Content',
        ],
    ],

    'fields' => [
        'id' => 'Id',
        'title' => 'Title',
        'category' => [
            'title' => 'Matched category',
        ],
        'image' => 'Image',
    ],
];
