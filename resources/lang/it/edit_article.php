<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/edit_article.php
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
            'placeholder' => 'content_blocks',
            'helper_text' => 'content_blocks',
            'description' => 'content_blocks',
        ],
        'sidebar_blocks' => [
            'label' => 'sidebar_blocks',
            'placeholder' => 'sidebar_blocks',
            'helper_text' => 'sidebar_blocks',
            'description' => 'sidebar_blocks',
        ],
        'footer_blocks' => [
            'label' => 'footer_blocks',
            'placeholder' => 'footer_blocks',
            'helper_text' => 'footer_blocks',
            'description' => 'footer_blocks',
        ],
    ],
];
