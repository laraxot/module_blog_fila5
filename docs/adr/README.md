---
title: "ADR — Blog"
type: index
tags: [adr, decisioni, blog]
created: 2026-11-18
updated: 2026-11-24
---

# ADR del modulo Blog

Il **perche'** della forma dei contenuti editoriali: come convivono Novita' ed Eventi nello stesso modello, come il corpo di
un articolo diventa HTML pubblico, come la sitemap trova i contenuti pubblicati.

Leggili prima di: aggiungere un tipo di contenuto, usare `type` o `content_type`, toccare il dettaglio pubblico di un
articolo o scrivere una query di "contenuti pubblicati".

Formato (5 sezioni, frontmatter `type: decision`): [regola canonica](../../../Xot/docs/rules/action-behavioral-contract.md).

## Decisioni

- [Novita' ed Eventi sono sottotipi Parental di Article](post-and-event-are-parental-children-of-article.md) — discriminante `type` (`post`/`event`), `content_type` e' un residuo da non usare.
- [Corpo pubblico dell'articolo normalizzato in un'Action](article-body-normalized-in-action.md) — `ResolveArticleBodyAction`: tutti i blocchi, una testata, immagini in `src`.
- [La sitemap riusa le query del front office](sitemap-reuses-theme-article-queries.md) — `ListPublishedArticlePathsAction` taggata per Seo, stessa definizione di "pubblicato".
