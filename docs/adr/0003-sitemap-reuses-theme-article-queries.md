---
title: "ADR — La sitemap di post ed eventi riusa le query del front office tramite un tag del container"
type: decision
module: Blog
tags: [adr, blog, seo, sitemap, container]
created: 2026-11-24
updated: 2026-11-26
status: accepted
decision-makers: [team Laraxot]
related:
  - ../../app/Actions/Article/ListPublishedArticlePathsAction.php
  - ../../app/Providers/BlogServiceProvider.php
  - ../../app/View/Composers/Queries/ThemeArticleQueries.php
---

# ADR: la sitemap di post ed eventi riusa le query del front office tramite un tag del container

## Contesto

- La sitemap del modulo Seo deve elencare `/{lang}/blog/{slug}` e `/{lang}/events/{slug}` dei soli contenuti pubblicati
  (DCP-273), con la data di ultima modifica.
- Quelle pagine le serve la pagina Folio del tema tramite `Cms\Actions\ResolvePageAction`, che chiede a
  `ThemeArticleQueries` i contenuti pubblicati: e' quella la definizione di "pubblicato".
- Blog e' opzionale: Seo non puo' dipendere da Blog.

Domanda: chi conosce i percorsi di Blog, e come li trova Seo?

## Driver della decisione

- Una sola definizione di «pubblicato»: la pagina e la sitemap non devono divergere (un URL in sitemap che risponde 404 e' un difetto SEO).
- Seo non puo' dipendere da Blog, che e' opzionale; un modulo nuovo deve poter aggiungere percorsi senza toccare Seo.
- Le date di ultima modifica devono essere quelle vere dei contenuti, mai inventate.

## Decisione

- `ListPublishedArticlePathsAction` implementa `Modules\Seo\Contracts\SitemapPathsContract` e `SitemapLastModifiedContract`
  e usa `ThemeArticleQueries::publishedPostSlugs()`, `publishedEventSlugs()` e le relative `*LastModified()`.
- `BlogServiceProvider` la registra con `$this->app->tag([...], SitemapPathsContract::TAG)`: Seo raccoglie i servizi taggati
  senza conoscere Blog.

## Alternative scartate

- Una query propria nella sitemap: due definizioni di "pubblicato" che divergono (una pagina in sitemap che risponde 404, o il
  contrario).
- Seo che interroga `Article` direttamente: dipendenza da un modulo opzionale.

## Conseguenze

- Pro: sitemap e pagine concordano per costruzione; un modulo nuovo aggiunge percorsi con lo stesso tag.
- Contro: un cambio a `ThemeArticleQueries` cambia anche la sitemap (voluto, ma va saputo).

## Conferma

- Test che passano dall'Action attraverso `GET /sitemap.xml` (nessuno la chiama direttamente: `rg -n ListPublishedArticlePaths Modules Themes --glob '*.php' --glob '!**/docs/**'`
  trova solo la classe e `BlogServiceProvider` riga 32):
  - `cd laravel && vendor/bin/pest Modules/Seo/tests/Feature/SitemapDetailTemplatesTest.php` (group `BLOG-SITEMAP-INV-1`: post ed evento pubblicati in sitemap);
  - `vendor/bin/pest Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php`: post ed evento in 4 lingue, ogni link di dettaglio delle liste in sitemap, nessuna bozza ne' post programmato,
    ogni dettaglio in sitemap risponde con il titolo dell'articolo. E' la prova della frase «un URL e' in sitemap se e solo se la sua pagina risponde con l'articolo»; non ha il group.
- Non provato: `lastModified()` e `execute()` con le stesse chiavi, e l'evento senza `published_at` ([contratto](../contracts/list-published-article-paths-action.md), INV-3, INV-4).
- Comando da `laravel/`: `rg -n "SitemapPathsContract::TAG" Modules/Blog/app/Providers/BlogServiceProvider.php` deve trovare la riga del tag.
- Regola di review: la classe usa solo i metodi di `ThemeArticleQueries` (`publishedPostSlugs`, `publishedEventSlugs` e le `*LastModified`), mai query proprie.
