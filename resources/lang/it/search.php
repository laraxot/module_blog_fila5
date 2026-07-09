<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/search.php
return [
    'fields' => [
        'limit' => [
            'label' => 'limit',
            'placeholder' => 'limit',
            'helper_text' => 'limit',
            'description' => 'limit',
        ],
        'layout' => [
            'label' => 'layout',
            'placeholder' => 'layout',
            'helper_text' => 'layout',
            'description' => 'layout',
        ],
    ],
];
