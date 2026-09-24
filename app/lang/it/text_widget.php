<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: app/lang/it/text_widget.php
return [
    'navigation' => [
        'name' => 'Text Widget',
        'plural' => 'Text Widgets',
        'group' => [
            'name' => 'Content',
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'create',
        ],
    ],
];
