---
title: "ADR — Blog"
type: index
tags: [adr, decisioni, blog]
created: 2026-11-18
updated: 2026-11-26
---

# ADR del modulo Blog

Il **perche'** della forma dei contenuti editoriali: come convivono Novita' ed Eventi nello stesso modello, come il corpo di
un articolo diventa HTML pubblico, come la sitemap trova i contenuti pubblicati.

Leggili prima di: aggiungere un tipo di contenuto, usare `type` o `content_type`, toccare il dettaglio pubblico di un
articolo o scrivere una query di "contenuti pubblicati".

Formato (frontmatter `type: decision`; sezioni `Contesto`, `Driver della decisione`, `Alternative scartate`, `Decisione`, `Conseguenze`, `Conferma`):
ADR [0012 di Xot](../../../Xot/docs/adr/0012-behavioral-contract-governance.md) e [regola canonica](../../../Xot/docs/rules/action-behavioral-contract.md). Gate: `PackagesHaveContractsAndAdrTest`.
Le promesse delle Action stanno nei [contratti](../contracts/README.md), non qui.

## Decisioni

- [Novita' ed Eventi sono sottotipi Parental di Article](0002-post-and-event-are-parental-children-of-article.md) — discriminante `type` (`post`/`event`); `content_type` e' un residuo da non usare.
- [Corpo pubblico dell'articolo normalizzato in un'Action](0001-article-body-normalized-in-action.md) — `ResolveArticleBodyAction`: tutti i blocchi, una testata, immagini in `src`.
- [La sitemap riusa le query del front office](0003-sitemap-reuses-theme-article-queries.md) — `ListPublishedArticlePathsAction` taggata per Seo, stessa definizione di «pubblicato».

## Stato di copertura

Aggiornato il 2026-11-26: 3 ADR, tutti con le sei sezioni e la «Conferma».

| ADR | Conferma automatica oggi |
|---|---|
| 0001 article-body-normalized-in-action | `ResolveArticleBodyActionTest` (group `BLOG-BODY-INV-1..5`) |
| 0002 post-and-event-are-parental-children-of-article | `DemoContentSeederTest`, `BlogFrontOfficeNovitaTest`; comando `rg -n content_type Modules/Blog/app` (vuoto). Nessuna conferma automatica per «mai scrivere in `type` valori diversi da `post`/`event`» |
| 0003 sitemap-reuses-theme-article-queries | Nessun test dentro Blog. Fuori: `BLOG-SITEMAP-INV-1` in `Modules/Seo/tests/Feature/SitemapDetailTemplatesTest.php` e `Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php` (dettaglio in sitemap se e solo se risponde, senza group) |

## Da sapere

- Il modulo `Event` e' un segnaposto (`active: 0` in `Modules/Event/module.json`): gli eventi del front office sono i figli Parental `Modules\Blog\Models\Event`, non il suo modello.

## Harness minimo: ownership, evidenza e recupero (2026-11-27)

Questo indice appartiene a **module_blog_fila5**: ogni decisione su codice, dominio o tema va nell'ADR del package owner; il root registra soltanto i vincoli di composizione. Un ADR richiede una scelta reale con alternative e conseguenze, più una **Conferma** ripetibile (oppure la dichiarazione esplicita che manca). Non creare ADR fittizi per riempire un indice.

- [Confine LaravelDay/harness Xot](https://github.com/laraxot/module_xot_fila5/blob/dev/docs/adr/0042-laravel-day-harness-adoption-boundary.md); [ownership root](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/adr/0001-harness-minimo-e-ownership.md).
- **BMAD**: la story owner-local conserva `scope`, `must_not_change`, `evidence`, `approval_required` nei cambi rischiosi.
- **ECC**: nessun marker di merge; distinguere la prova eseguita dal semplice riferimento a un test; se la conferma non è disponibile segnare `non eseguita`.
- **Second Brain**: QMD/Graphify e `.harness/memory/{facts,lessons}.md` sono puntatori a evidenza datata, non copie degli ADR. [Runbook](https://github.com/laraxot/base_ptvx_fila5/blob/dev/docs/harness/README.md) · [Rollout #15](https://github.com/laraxot/base_ptvx_fila5/issues/15).
