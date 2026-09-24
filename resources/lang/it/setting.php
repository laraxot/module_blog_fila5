<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/setting.php
return [
    'fields' => [
        'version' => [
            'label' => 'version',
            'placeholder' => 'version',
            'helper_text' => 'version',
            'description' => 'version',
        ],
    ],
];
