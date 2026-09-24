<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/it/edit_article.php
return [
    'actions' => [
        'activeLocale' => [
            'label' => 'activeLocale',
        ],
        'delete' => [
            'label' => 'delete',
        ],
        'translate' => [
            'label' => 'translate',
        ],
    ],
    'fields' => [
        'content_blocks' => [
            'label' => 'content_blocks',
        ],
        'sidebar_blocks' => [
            'label' => 'sidebar_blocks',
        ],
        'footer_blocks' => [
            'label' => 'footer_blocks',
        ],
    ],
];
