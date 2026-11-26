# Blog behavioral contract index

This is the machine-readable inventory of behavioral contracts owned by the **Blog** module.

A contract describes an existing public operation or boundary. It names the owner, input, output, stable invariants, side effects and their order, errors, and non-goals. Every invariant gets a stable ID and a Pest group when a test exists; missing coverage is recorded as debt instead of being implied away.

## Contracts
- [import-articles-from-by-json-text-action](import-articles-from-by-json-text-action.md)
- [import-banner-from-by-json-text-action](import-banner-from-by-json-text-action.md)
- [import-from-news-api](import-from-news-api.md)
- [list-published-article-paths-action](list-published-article-paths-action.md)
- [resolve-article-body-action](resolve-article-body-action.md)
- [translate-content-action](translate-content-action.md)

## Authoring

Use [Xot contract authoring standard](../../../Xot/docs/contracts/contract-authoring-standard.md) and the shared template. Legacy behavior is documented as-is and is not a model for new code.
