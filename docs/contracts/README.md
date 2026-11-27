---
title: "Contratti — Blog"
type: index
tags: [contracts, actions, blog]
created: 2026-11-18
<<<<<<< .merge_file_mtBMIv
updated: 2026-11-24
=======
updated: 2026-11-26
>>>>>>> .merge_file_X641fh
---

# Contratti del modulo Blog

<<<<<<< .merge_file_mtBMIv
Cosa promettono le Action di Blog che scrivono nel DB o scaricano file: i due import JSON (legacy) e la copia dei contenuti
tra lingue. Le Action `Resolve*`, `Format*`, `Filter*` calcolano valori per le viste e non hanno contratto.

Leggili prima di usare o imitare un import: «Non fa» e gli effetti collaterali elencano i difetti ereditati (nessun update,
media duplicati al reimport, nessuna transazione) che non vanno copiati.

Formato (6 sezioni, invarianti con ID e group Pest): [regola canonica](../../../Xot/docs/rules/action-behavioral-contract.md).
Oggi nessuna invariante e' coperta da test (colonna `—`).
=======
Cosa promettono le Action di Blog che scrivono nel DB, scaricano file, chiamano servizi esterni o decidono cosa arriva alla pagina pubblica e alla sitemap:
i due import JSON (legacy), la copia dei contenuti tra lingue, la normalizzazione del corpo dell'articolo, l'elenco dei percorsi per la sitemap e l'abbozzo di NewsAPI.
Le altre Action `Resolve*`, `Format*`, `Filter*` calcolano valori per le viste e non hanno contratto.

Leggili prima di usare o imitare un import: «Non fa» e «Limiti noti» elencano i difetti ereditati (nessun update, media duplicati al reimport, nessuna transazione, nessuna
autorizzazione propria, URL delle immagini scelto da chi scrive il JSON) che non vanno copiati. Un comportamento legacy documentato non diventa modello per codice nuovo (ADR [0012 di Xot](../../../Xot/docs/adr/0012-behavioral-contract-governance.md)).

Formato (6 sezioni, invarianti con ID e group Pest): [regola canonica](../../../Xot/docs/rules/action-behavioral-contract.md).
Provare una promessa: `cd laravel && vendor/bin/pest Modules/Blog/tests --group=<ID>` (per `BLOG-SITEMAP-INV-1` il test sta in Seo: `vendor/bin/pest Modules/Seo/tests --group=BLOG-SITEMAP-INV-1`).

## Contratti

Contenuto pubblico e sitemap:
>>>>>>> .merge_file_X641fh

- [ResolveArticleBodyAction](resolve-article-body-action.md) — corpo pubblico di post ed eventi: tutti i blocchi, una testata, un solo `h1`, immagini in `src`.
- [ListPublishedArticlePathsAction](list-published-article-paths-action.md) — percorsi e `lastmod` di post ed eventi pubblicati per la sitemap di Seo.

Import e lingue (legacy):

- [ImportArticlesFromByJsonTextAction](import-articles-from-by-json-text-action.md) — import articoli, categorie e rating da JSON; crea, non aggiorna.
- [ImportBannerFromByJsonTextAction](import-banner-from-by-json-text-action.md) — import banner e categorie da JSON, immagine scaricata da URL.
- [TranslateContentAction](translate-content-action.md) — copia l'italiano nelle lingue vuote dei blocchi scelti; non traduce.
- [ImportFromNewsApi](import-from-news-api.md) — abbozzo che chiama NewsAPI e non importa nulla; nessun chiamante.

## Stato di copertura

Aggiornato il 2026-11-26. 6 contratti, 23 invarianti: **6 dimostrate** da un test con group, 2 provate da test di Fixcity che non hanno il group, 15 promesse dal codice ma non dimostrate.

| Contratto | Invarianti | Dimostrate |
|---|---|---|
| ResolveArticleBodyAction | 7 | 5 (`ResolveArticleBodyActionTest`, group con attributo PHPUnit `#[Group]`) |
| ListPublishedArticlePathsAction | 5 | 1 con group (test in Seo: `SitemapDetailTemplatesTest`); altre 2 provate in Fixcity senza group (INV-2, INV-5) |
| ImportArticlesFromByJsonTextAction | 3 | 0 |
| ImportBannerFromByJsonTextAction | 3 | 0 |
| TranslateContentAction | 3 | 0 |
| ImportFromNewsApi | 2 | 0 |

Lo script di audit del pacchetto conta solo i test sotto `Modules/Blog/tests`: vede 5 dimostrate su 23, perche' la prova di `BLOG-SITEMAP-INV-1` e' in Seo e quelle di INV-2 e INV-5 sono in Fixcity senza group.
I tre import e la traduzione non hanno nessun test in tutto il repository (`rg` sui nomi delle classi in `Modules`, `Themes`, `tests`).

## Backlog contract

Action del modulo senza contratto, per rischio:

| Action | Perche' |
|---|---|
| `Actions/Article/ResolveArticleMainImageUrlAction.php` | Falso positivo dell'audit (`Storage::url` e' lettura). Ma `if ($article->media)` e' sempre vero per una collezione Eloquent (anche vuota): i rami `main_image_upload` e `main_image_url` sembrano irraggiungibili. Sospetto non verificato; usata da `Article::getMainImage()` nelle viste legacy di Blog, non dal front office dei temi. |
| `Actions/Article/ConvertArticleToFeedItemAction.php` | Falso positivo dell'audit (`FeedItem::create` costruisce un oggetto, non scrive). Richiede `user` e `updated_at` non nulli: `Assert::notNull` lancia per un articolo senza autore. Candidata a un contratto minimo se il feed RSS diventa pubblico. |

## Backlog test

Invarianti promesse e non dimostrate (da scrivere con `->group('<ID>')` o `#[Group('<ID>')]`, in una passata dedicata ai test):

<<<<<<< .merge_file_mtBMIv
- [ImportArticlesFromByJsonTextAction](import-articles-from-by-json-text-action.md) — import articoli, categorie e rating da JSON; crea, non aggiorna.
- [ImportBannerFromByJsonTextAction](import-banner-from-by-json-text-action.md) — import banner e categorie da JSON, immagine scaricata da URL.
- [TranslateContentAction](translate-content-action.md) — copia l'italiano nelle lingue vuote dei blocchi scelti; non traduce.
=======
| ID | Cosa servirebbe |
|---|---|
| BLOG-IMPORT-ARTICLES-INV-1..3 | Un JSON di due articoli, importato due volte con `Http::fake()`: un solo articolo per `slug`, categorie annidate, `published_at` = oggi. |
| BLOG-IMPORT-BANNER-INV-1..3 | Un JSON di banner con un elemento non oggetto; due import: un solo banner per `title`+`action_text`. |
| BLOG-TRANSLATE-INV-1..3 | `TranslateContentAction` su un articolo con `it` valorizzato e `en` assente/`null`/`''`: riempie solo i mancanti e solo i campi spuntati. |
| BLOG-BODY-INV-6, BLOG-BODY-INV-7 | Articolo salvato con un media nella collezione `img_uuid`; blocchi `rating` e `chart` che passano invariati. |
| BLOG-SITEMAP-INV-2, BLOG-SITEMAP-INV-5 | Aggiungere il group ai test di `Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php` (altro pacchetto); aggiungere il caso evento senza `published_at`. |
| BLOG-SITEMAP-INV-3, BLOG-SITEMAP-INV-4 | Slug vuoto; `execute()` e `lastModified()` con le stesse chiavi. |
| BLOG-NEWSAPI-INV-1, BLOG-NEWSAPI-INV-2 | `Http::fake()`: senza chiave configurata lancia prima della richiesta; con la chiave non scrive nulla. |
>>>>>>> .merge_file_X641fh
