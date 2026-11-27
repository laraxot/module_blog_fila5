---
title: "ADR — La sitemap di post ed eventi riusa le query del front office tramite un tag del container"
type: decision
module: Blog
tags: [adr, blog, seo, sitemap, container]
created: 2026-11-24
updated: 2026-11-24
status: accepted
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

## Verifica

- Solo revisione: nessun test del modulo copre `ListPublishedArticlePathsAction`; controllare che usi i metodi di
  `ThemeArticleQueries` e non query proprie, e che il tag in `BlogServiceProvider` resti.
