<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/en/banner.php
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
