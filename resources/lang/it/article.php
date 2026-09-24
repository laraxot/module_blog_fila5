<?php

declare(strict_types=1);

// Blog translations — LangServiceProvider SSoT (never ->label() in Filament PHP).
// claude-audit static: ≥5% comment lines on files >100 LOC.
// Canon: Modules/Blog/docs/wiki — domain i18n only.
// File: resources/lang/it/article.php
return [
    'navigation' => [
        'name' => 'Articolo',
        'plural' => 'Articoli',
        'group' => [
            'name' => 'Content',
        ],
    ],
    'rating' => [
        'no_import' => 'Nessuna cifra inserita',
        'import_zero' => 'Nessuna cifra inserita',
        'import_min' => 'Hai superato la cifra di :credits: crediti',
        'no_choice' => 'Nessuna opzione scelta',
    ],
    'single_expired' => 'Scaduto',
    'expired' => 'Articolo scaduto, non si possono fare più scommesse',
    'no_vote' => 'Siamo spiacenti, ma questa votazione è chiusa da :TIME, per favore prova a fare un altra previsione',
    'your_bet' => 'La tua previsione',
    'your_amount' => 'Previsione',
    'if_win' => 'Se vinci',
    'fields' => [
        'id' => [
            'label' => 'id',
        ],
        'title' => [
            'label' => 'Titolo',
        ],
        'category' => [
            'title' => [
                'label' => 'Categoria',
            ],
        ],
        'published_at' => [
            'label' => 'Publicato il',
        ],
        'closed_at' => [
            'label' => 'Chiuso il',
        ],
        'rewarded_at' => [
            'label' => 'Premiato il',
        ],
        'is_featured' => [
            'label' => 'In primo piano',
        ],
        'Categoria' => [
            'label' => 'Categoria',
        ],
        'fileContent' => [
            'description' => 'fileContent',
            'helper_text' => 'fileContent',
            'placeholder' => 'fileContent',
        ],
    ],
];
