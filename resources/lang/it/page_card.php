<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/page_card.php
return [
    'fields' => [
        'page_id' => [
            'label' => 'page_id',
            'placeholder' => 'page_id',
            'helper_text' => 'page_id',
            'description' => 'page_id',
        ],
        'text' => [
            'label' => 'text',
            'placeholder' => 'text',
            'helper_text' => 'text',
            'description' => 'text',
        ],
    ],
];
