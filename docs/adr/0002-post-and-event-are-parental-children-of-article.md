---
title: "ADR — Novita' ed Eventi sono sottotipi Parental di Article sulla colonna type"
type: decision
module: Blog
tags: [adr, blog, parental, sti, post, event, article]
created: 2026-11-24
updated: 2026-11-26
status: accepted
decision-makers: [team Laraxot]
related:
  - ../../app/Models/Article.php
  - ../../app/Models/Post.php
  - ../../app/Models/Event.php
  - ../../app/View/Composers/Queries/ThemeArticleQueries.php
  - ../brainstorming-post-vs-article.md
---

# ADR: Novita' ed Eventi sono sottotipi Parental di Article sulla colonna `type`

## Contesto

- Il front office ha due sezioni di contenuti, Novita' (`/{lang}/blog`) ed Eventi (`/{lang}/events`), con campi quasi uguali
  (titolo, blocchi, immagine) e qualche campo solo per gli eventi (`event_start_date`, `event_end_date`).
- `Modules\Blog\Models\Article` e' gia' il modello di Resource Filament, morph dei commenti, factory e seeder.
- Il brainstorming del 2026-10-15 (`../brainstorming-post-vs-article.md`) aveva scelto una colonna `content_type` e vietato
  `type`; la migrazione `database/migrations/2026_10_26_add_content_type_to_articles.php` aggiunge `content_type`
  (default `post`). Il codice poi ha preso l'altra strada: misurato il 2026-11-24, nessun file di `app/` legge `content_type`.

Domanda: come distinguere Novita' ed Eventi senza due tabelle e senza rinominare `Article`?

## Driver della decisione

- Un solo modello base per i contenuti editoriali evita di duplicare Resource Filament, traduzioni, commenti, media e sitemap.
- Novita' ed Eventi devono restare distinguibili nelle query del front office e nella sitemap senza tabelle separate.
- Il nome della classe `Article` e i dati esistenti (morph dei commenti, factory, seeder) non si rompono.
- Un solo discriminante, quello gia' usato da Parental: niente secondo campo che divergerebbe.

## Decisione

- Single Table Inheritance con `tightenco/parental`: `Article` usa `HasChildren` con
  `$childTypes = ['post' => Post::class, 'event' => Event::class]`; `Post` ed `Event` estendono `Article` con `HasParent`.
- Il discriminante e' la colonna `type` (`post` | `event`). Le query del front office filtrano `where('type', ...)` in
  `app/View/Composers/Queries/ThemeArticleQueries.php`; i seeder creano con `Post::query()` / `Event::query()`.
- La classe resta `Article`: nel linguaggio di prodotto si dice "post" (Novita') ed "evento".

## Alternative scartate

- Colonna `content_type` libera (proposta del brainstorming): un secondo discriminante accanto a quello di Parental, senza
  classi dedicate; e' la strada abbandonata, la colonna e' rimasta come residuo.
- Due tabelle (posts, events): duplica Resource, traduzioni, commenti, media e sitemap.
- Rinominare `Article` in `Post`: rompe morph dei commenti, Resource, factory e dati; epica a se', non bloccante.

## Conseguenze

- Pro: `Post::query()` ed `Event::query()` sono gia' filtrati; un modello solo per Filament e commenti.
- Contro: un valore di `type` non in `$childTypes` rompe l'istanziazione Parental (Parental prova a usarlo come classe):
  mai scrivere in `type` valori diversi da `post`/`event`.
- Debito: la colonna `content_type` e i documenti che la citano (`../sitemap.md`, `../afc-pattern-adaptation.md`,
  `../bmad-planning.md`) descrivono la strada abbandonata. Non leggere ne' scrivere `content_type` in codice nuovo; toglierla
  richiede una migrazione dedicata.

## Conferma

- `Modules/Blog/tests/Feature/DemoContentSeederTest.php`: 8 post, 6 eventi, nessun `type` nullo.
- `Modules/Blog/tests/Feature/BlogFrontOfficeNovitaTest.php`: l'elenco Novita' e la ricerca per slug restituiscono solo
  `type = post`.
- Comando da `laravel/`: `rg -n content_type Modules/Blog/app` non deve trovare nulla (verificato il 2026-11-26: vuoto).
- Nessuna conferma automatica per «mai scrivere in `type` valori diversi da `post`/`event`»: regola di review; proposta: un test che verifichi che i valori di `type` in uso siano le chiavi di `Article::$childTypes` (riga 250).
