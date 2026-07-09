<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/it/article_card.php
return [
    'fields' => [
        'article_id' => [
            'label' => 'article_id',
            'description' => 'article_id',
            'helper_text' => 'article_id',
            'placeholder' => 'article_id',
        ],
        'text' => [
            'label' => 'text',
            'description' => 'text',
            'helper_text' => 'text',
            'placeholder' => 'text',
        ],
    ],
];
