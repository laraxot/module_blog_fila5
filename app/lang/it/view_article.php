<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/it/view_article.php
return [
    'actions' => [
        'activeLocale' => [
            'label' => 'activeLocale',
        ],
        'edit' => [
            'label' => 'edit',
        ],
        'delete' => [
            'label' => 'delete',
        ],
        'change_closed_at' => [
            'label' => 'change_closed_at',
        ],
    ],
    'fields' => [
        'closed_at' => [
            'label' => 'closed_at',
        ],
    ],
];
