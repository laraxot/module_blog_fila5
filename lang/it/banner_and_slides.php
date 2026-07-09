<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/it/banner_and_slides.php
return [
    'fields' => [
        'title' => [
            'label' => 'title',
            'description' => 'title',
            'helper_text' => 'title',
            'placeholder' => 'title',
        ],
        'layout' => [
            'label' => 'layout',
            'description' => 'layout',
            'helper_text' => 'layout',
            'placeholder' => 'layout',
        ],
    ],
];
