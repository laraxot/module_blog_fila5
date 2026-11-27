---
title: "Contratto — ListPublishedArticlePathsAction"
type: contract
action: "Modules\\Blog\\Actions\\Article\\ListPublishedArticlePathsAction"
module: Blog
status: active
tags: [contract, action, blog, seo, sitemap]
created: 2026-11-26
updated: 2026-11-26
---

# ListPublishedArticlePathsAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [sitemap-reuses-theme-article-queries](../adr/0003-sitemap-reuses-theme-article-queries.md).
Sorgente: `app/Actions/Article/ListPublishedArticlePathsAction.php`. Registrata con `$this->app->tag([...], SitemapPathsContract::TAG)` in `BlogServiceProvider` (riga 32);
chiamante: `Modules\Seo\Actions\Sitemap\BuildSitemapAction` (righe 113-116), che raccoglie i servizi taggati. Implementa `SitemapPathsContract` e `SitemapLastModifiedContract` di Seo.
Sola lettura, ma e' cio' che i motori di ricerca ricevono come elenco degli URL di Blog.

## Input

- Nessuno. Legge i contenuti tramite `ThemeArticleQueries` (container).

## Output

- `execute()`: `list<string>` di percorsi senza lingua, `blog/<slug>` e `events/<slug>` (slug con `rawurlencode`).
- `lastModified()`: `array<string, DateTimeInterface>` con gli stessi percorsi come chiave e `updated_at` come valore.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-SITEMAP-INV-1 | Un post pubblicato e un evento pubblicato compaiono nella sitemap, in ogni lingua del sito, come `/{lang}/blog/{slug}` e `/{lang}/events/{slug}`. Se cade, un contenuto pubblico non e' indicizzabile dalla sitemap. | `BLOG-SITEMAP-INV-1` (in Seo: `SitemapDetailTemplatesTest`, it e en) |
| BLOG-SITEMAP-INV-2 | Una bozza (`published_at` nullo) e un post con `published_at` futuro non compaiono mai in sitemap; «pubblicato» e' la definizione di `ThemeArticleQueries`, la stessa del dettaglio. Se cade, la sitemap elenca URL che rispondono 404. | — (non dimostrato nel pacchetto; provato, senza group, da `Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php`, test «never lists a scheduled post, an unpublished article or a detail template»; per gli eventi senza `published_at` nessun test) |
| BLOG-SITEMAP-INV-3 | `execute()` e `lastModified()` usano le stesse query e lo stesso formato di percorso: ogni chiave di `lastModified()` e' anche in `execute()`. | — (non dimostrato) |
| BLOG-SITEMAP-INV-4 | Slug vuoti o non stringa sono scartati; le date che non sono `DateTimeInterface` sono scartate (mai una data inventata). | — (non dimostrato) |
| BLOG-SITEMAP-INV-5 | Un URL di dettaglio e' in sitemap se e solo se la sua pagina risponde con quell'articolo: ogni link di dettaglio delle liste `/blog` e `/events` e' in sitemap, e ogni dettaglio in sitemap risponde 200 con il titolo. | — (non dimostrato nel pacchetto; provato, senza group, da `Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php`, test «lists every detail link that the blog and events lists show» e «lists only detail urls whose page shows that article») |

## Effetti collaterali

- Quattro `SELECT` su `articles` (slug dei post, slug degli eventi, e per `lastModified()` le due `pluck('updated_at', 'slug')`). Nessuna scrittura, nessuna cache, nessun evento.

## Errori

- Nessuna eccezione propria; errori del DB risalgono al chiamante (`BuildSitemapAction`).

## Non fa

- Non include le pagine Folio statiche (home, elenchi): sono di Seo e del CMS.
- Non filtra per lingua: la lingua la aggiunge Seo.
- Non dice se la pagina risponde davvero 200: dipende dalla pagina Folio del tema, che usa la stessa query.

## Limiti noti

- **La definizione di «pubblicato» e' diversa tra post ed eventi.** Il post richiede `published_at <= oggi` (`ArticleQueryScopes::scopePublishedUntilToday`), l'evento no: un evento con `published_at` futuro e' in sitemap
  (`ThemeArticleQueries::publishedEventsQuery()`, righe 363-368). E' coerente con il dettaglio, ma e' un'asimmetria da sapere (vedi l'ADR [event-publication-is-explicit](../../../Event/docs/adr/0001-event-publication-is-explicit.md) per la pubblicazione degli eventi).
- **Le prove vivono fuori da Blog.** INV-1 ha il group in Seo (`Modules/Seo/tests/Feature/SitemapDetailTemplatesTest.php`, test «lists the published posts and events in every language», it e en; saltato se Blog non e' installato o nessun modulo registra il tag) e un test piu' largo, a 4 lingue e senza group, in Fixcity. INV-2 e INV-5 sono provate solo da test di Fixcity che non portano il group: lo script di audit di Blog non li vede. Aggiungere `->group('BLOG-SITEMAP-INV-2')` e `->group('BLOG-SITEMAP-INV-5')` a quei test e' una modifica a un altro pacchetto, da fare dal suo proprietario.
- **Una sola query di lastmod per percorso**: la data e' `updated_at` del contenuto, non l'ultima modifica di commenti o media (e' la scelta documentata in Seo, ADR [search-engine-presence](../../../Seo/docs/adr/0002-search-engine-presence.md)).
