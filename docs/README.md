---
title: "Blog: ingresso del modulo"
type: documentation
status: active
module: Blog
tags: [blog, module, docs]
created: 2026-09-26
updated: 2026-10-14
qmd: "blog modulo articoli categorie banner text widget blocchi filament twentyone cms limiti legacy predict"
issues: []
discussions: []
---

# Blog

Ingresso della documentazione del modulo. Ogni affermazione e' stata confrontata con il codice il 2026-10-14.

## Identita' e ownership

- Namespace `Modules\Blog`, alias `blog`, repository git separato. Descrizione in `module.json`: blog, articoli, categorie e contenuti editoriali.
- Provider in `module.json`: `BlogServiceProvider`, `Providers\Filament\AdminPanelProvider`; il primo e' anche in `laravel/config/app.php`. `Blog: true` in `laravel/modules_statuses.json` e nello stato del tenant Fixcity. Dipendenze dichiarate: Xot, UI, Lang, Cms.
- Il testo precedente di questo README ("Core module for the FixCity Platform") era un modello generico e non corrisponde all'uso: vedi sotto.

## Cosa contiene davvero

| Area | Contenuto verificato | Percorso |
|---|---|---|
| Modelli | `Article`, `Category`, `Banner`, `TextWidget`, `Tag`, `Profile`, `Transaction`, `UpvoteDownvote`, `PostView`, `Comment`, `Menu` e pivot | `app/Models/` |
| Actions | `Article/` (formattazione date e tempo di lettura, immagine e miniatura, traduzione, import da JSON), `Banner/`, `Category/GetBloodline`, `ImportFromNewsApi`, `ParentChilds/GetTreeOptions` | `app/Actions/` |
| Filament | risorse `Article`, `Banner`, `Category`, `Profile`, `TextWidget`; 11 blocchi (`ArticleCard`, `ArticleList`, `BannerAndSlides`, `Chart`, `Filter`, `Leaderboard`, `Search` ...); widget `LatestArticlesWidget` | `app/Filament/` |
| Livewire | `Article/Chunk`, `Article/Lists`, `Headernav/SearchBar`, `Profile`, `Profile/Setting` | `app/Http/Livewire/` |
| Comandi | `ShowArticleCommand`, `ShowArticleListCommand` | `app/Console/Commands/` |
| Dati | 18 file in `database/migrations/` (alcuni con estensione `.to_article`, `.to_cms`, `.to_article_model`: non eseguiti) | `database/migrations/` |
| Test | 1 file con 1 test | `tests/` |

## Chi lo usa davvero in questo repository

- Cms: `Modules/Cms/app/Config/xra.php` mappa `article` e `category` ai modelli Blog.
- Fixcity: solo `Modules/Fixcity/config/morph_map.php`, che elenca `Article` e `Banner`. Nessun codice di `Modules/Fixcity/app` importa Blog.
- Tema TwentyOne: `pages/articles/index`, `pages/articles/[slug]` e `pages/search` usano i modelli Blog. Il tema Sixteen, quello di Fixcity, ha solo stub in `pages_old/` (estensione `.stub`), non attivi.
- Blog usa a sua volta Comment (`Article` usa `HasComments`) e Rating (7 file importano classi Rating).

## Limiti

1. Rotte: `routes/web.php` e `routes/api.php` sono vuoti; `php artisan route:list --json` mostra 23 rotte, tutte del pannello Filament `blog/admin`. Nessuna pagina pubblica nasce da questo modulo.
2. Residui di un altro progetto: `app/resources_to_delete/` contiene 112 file, tra cui viste `play_money_markets` (mercati predittivi), e il nome della cartella dice che vanno eliminati. Molti documenti rimandano a un modulo `Predict` che non esiste in `laravel/Modules`.
3. Duplicati dentro `app/`: `app/config/config.php` e `app/Config/config.php` sono identici; `app/lang/` convive con `lang/`; `app/Models/Article.bak`.
4. Documentazione: [ai.md](./ai.md), [comment.md](./comment.md) e [themes.md](./themes.md) sono elenchi di URL, non descrivono integrazioni.
5. Test quasi assenti: 1 test, passa; non e' una copertura.

## Quick start

Da `laravel/`:

```bash
# rotte del modulo (verificato il 2026-10-14: 23, tutte del pannello Filament blog/admin)
php artisan route:list --name=blog
# test su database usa-e-getta (la variabile vuota evita `unbound variable` dello script)
DB_DATABASE_LIMESURVEY= bash ../bashscripts/tools/pest-scratch-db.sh Modules/Blog/tests
```

## Mappa della documentazione

Indice operativo: [00-INDEX.md](./00-INDEX.md). Decisioni: [decision-log.md](./decision-log.md) (vuoto, solo intestazione). Registro: [wiki/log.md](./wiki/log.md). Story: [stories/](./stories/).

## Post agnostico

[brainstorming-post-vs-article.md](./brainstorming-post-vs-article.md) · rename deferred [IM-BLOG-008](./stories/inbound-rename-article-to-post.story.md).
