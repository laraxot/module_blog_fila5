<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/it/search.php
return [
    'fields' => [
        'limit' => [
            'label' => 'limit',
            'description' => 'limit',
            'helper_text' => 'limit',
            'placeholder' => 'limit',
        ],
        'layout' => [
            'label' => 'layout',
            'description' => 'layout',
            'helper_text' => 'layout',
            'placeholder' => 'layout',
        ],
    ],
];
