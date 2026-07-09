<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: lang/it/text_widget.php
return [
    'navigation' => [
        'name' => 'Text Widget',
        'plural' => 'Text Widgets',
        'group' => [
            'name' => 'Content',
        ],
        'sort' => 97,
        'icon' => 'heroicon-o-document-text',
        'label' => 'Widget Testo',
    ],
    'actions' => [
        'create' => [
            'label' => 'create',
        ],
    ],
];
