---
title: "Contratto — TranslateContentAction"
type: contract
action: "Modules\Blog\Actions\Article\TranslateContentAction"
tags: [contract, action, blog, traduzioni, blocks]
created: 2026-11-24
updated: 2026-11-24
---

# TranslateContentAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`).
Sorgente: `app/Actions/Article/TranslateContentAction.php`. Chiamanti: azione "traduci" di
`Filament/Resources/ArticleResource/Pages/EditArticle.php` e `ViewArticle.php` (checkbox `content_blocks`, `sidebar_blocks`,
`footer_blocks`; la modale chiede di salvare prima la versione italiana).

## Input

- `$modelClass` + `$articleId`: tipo morph e chiave, risolti con `Xot\Actions\GetModelByModelTypeAction`.
- `$locales`: lingue della Resource (`getTranslatableLocales()`).
- `$data`: quali dei tre campi trattare (valore vero = si').
- `$class`: classe attesa del modello (oggi `Article::class`).

## Output

- `void`.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-TRANSLATE-INV-1 | Una lingua che ha gia' un valore non viene sovrascritta: si riempiono solo le lingue mancanti. | — |
| BLOG-TRANSLATE-INV-2 | La lingua mancante riceve una copia del contenuto `it` (o vuoto se manca anche quello): nessuna traduzione automatica. | — |
| BLOG-TRANSLATE-INV-3 | Si toccano solo i campi spuntati in `$data`. | — |

## Effetti collaterali

- `UPDATE` dell'articolo (`$model->update()` senza argomenti: salva gli attributi cambiati).

## Errori

- Modello non trovato o di classe diversa da `$class`: `InvalidArgumentException` (Webmozart Assert).
- `content_blocks` non serializzabile: `Safe\Exceptions\JsonException`.

## Non fa

- Non chiama servizi di traduzione: nonostante il nome, copia l'italiano nelle lingue vuote, che poi l'editor traduce a mano.
- Non tocca `title` (pure traducibile in `Article::$translatable`).
- Non autorizza: lo fa la pagina Filament.
