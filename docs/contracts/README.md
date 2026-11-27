---
title: "Contratti — Blog"
type: index
tags: [contracts, actions, blog]
created: 2026-11-18
updated: 2026-11-24
---

# Contratti del modulo Blog

Cosa promettono le Action di Blog che scrivono nel DB o scaricano file: i due import JSON (legacy) e la copia dei contenuti
tra lingue. Le Action `Resolve*`, `Format*`, `Filter*` calcolano valori per le viste e non hanno contratto.

Leggili prima di usare o imitare un import: «Non fa» e gli effetti collaterali elencano i difetti ereditati (nessun update,
media duplicati al reimport, nessuna transazione) che non vanno copiati.

Formato (6 sezioni, invarianti con ID e group Pest): [regola canonica](../../../Xot/docs/rules/action-behavioral-contract.md).
Oggi nessuna invariante e' coperta da test (colonna `—`).

## Contratti

- [ImportArticlesFromByJsonTextAction](import-articles-from-by-json-text-action.md) — import articoli, categorie e rating da JSON; crea, non aggiorna.
- [ImportBannerFromByJsonTextAction](import-banner-from-by-json-text-action.md) — import banner e categorie da JSON, immagine scaricata da URL.
- [TranslateContentAction](translate-content-action.md) — copia l'italiano nelle lingue vuote dei blocchi scelti; non traduce.
