---
title: "dependencies"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "dependencies"
issues: []
discussions: []
status: draft
---

# Dipendenze modulo Blog

## spatie/laravel-feed

Package dichiarato in **Modules/Seo/composer.json**, non qui: capacità feed RSS/Atom è generica (riusabile anche da vetrine prodotti, non solo blog), quindi vive nel modulo trasversale Seo, non in Blog. Blog la consuma.

Uso reale nel codice (Blog):
- `Modules/Blog/app/Models/Article.php` — `implements Feedable`
- `Modules/Blog/app/Models/Concerns/ArticleFeedable.php` — trait `toFeedItem()`
- `Modules/Blog/app/Adapters/ArticlePresentationAdapter.php`
- `Modules/Blog/app/Actions/Article/ConvertArticleToFeedItemAction.php`

Blog dichiara comunque `spatie/laravel-feed: *` nel proprio `composer.json:47` (ridondante con Seo, ma innocuo: merge-plugin nwidart unisce tutti i `Modules/*/composer.json`, versioni compatibili coesistono).

Vedi anche: `phpstan-fix-plan.md` (sezione FeedItem type safety), `structure.md` (elenco dipendenze), `Modules/Seo/docs/dependencies.md`.
<<<<<<< .merge_file_9a1ifB

--- BMAD + Second Brain ---
- Scopo: documentazione tecnica del modulo.
- Utilità: riferimento sviluppatori/audit.
- Funzionalità: struttura, dipendenze, convenzioni (no date .md, git avanti).
=======
>>>>>>> .merge_file_PsVY4W
