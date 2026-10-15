---
title: "Blog: indice operativo"
type: index
status: active
created: 2026-09-26
updated: 2026-10-14
module: Blog
tags: [blog, index, docs]
qmd: "blog indice operativo articoli categorie banner blocchi twentyone cms predict legacy"
---

# Blog: indice operativo canonico

Percorso: `laravel/Modules/Blog/docs/`. Questo e' l'indice canonico del contratto docs. `index.md`, `INDEX.md` e `00-index.md` sono stub o copie segnati come tali; nessun file e' stato rimosso.

Identita', contenuto reale del codice, consumatori e limiti: [README.md](./README.md).

## Stato verificato il 2026-10-14

| Tema | Esito | Prova |
|---|---|---|
| Uso in Fixcity | nessuno nel codice; solo `morph_map.php` | grep su `Modules/Fixcity/app` |
| Uso altrove | Cms (`xra.php`) e tema TwentyOne | grep |
| Rotte | solo pannello Filament `blog/admin` (23) | `php artisan route:list --json` |
| Modulo `Predict` citato dai documenti | non esiste | `ls laravel/Modules` |
| Gestione pagine | non in questo modulo | nessun `PageResource`; migrazione `.to_cms` |
| Modello `Transaction` | ancora presente | `app/Models/Transaction.php` |
| Test | 1 file, 1 test (passa) | Pest su DB usa-e-getta |

## Da leggere per primi

- [README.md](./README.md): cosa fornisce, chi lo usa, limiti.
- [decision-log.md](./decision-log.md): vuoto (solo intestazione).
- [wiki/log.md](./wiki/log.md): registro datato delle verifiche.
- [stories/](./stories/): 7 file, quasi tutti PHPStan.
- [dependencies.md](./dependencies.md), [module.md](./module.md): riferimenti brevi, bozze.

## Riferimento tecnico (bozze non riverificate riga per riga)

- [blocks.md](./blocks.md): blocchi per contenuti modulari (nel codice esistono 11 blocchi in `app/Filament/Blocks/`).
- [base-model.md](./base-model.md), [04-datas.md](./04-datas.md), [models/README.md](./models/README.md).
- [parental-sti-architecture.md](./parental-sti-architecture.md) e [multi-database-architecture.md](./multi-database-architecture.md): lunghe, da verificare contro i modelli.
- [filament/best-practices.md](./filament/best-practices.md), [phpstan-analysis.md](./phpstan-analysis.md).
- [bmad/README.md](./bmad/README.md): baseline BMAD del modulo.

## Directory

| Percorso | Ruolo |
|---|---|
| `README.md`, `00-INDEX.md`, `decision-log.md` | canonico |
| `stories/` | cronologia BMAD |
| `wiki/` | regole e concetti locali |
| `models/`, `filament/`, `bmad/`, `investigation/`, `fixes/` | riferimento tecnico e diagnosi |
| `raw/` | evidence immutabile |
| `llm-wiki/`, `img/` | strumenti e immagini |
| file `.md` nella radice (95) | misto, con coppie che differiscono per maiuscole o underscore (25 collisioni); consolidamento in DOC-004 e DOC-006 |
| 15 stub con `canonical: .../Themes/docs/shared-components/...` | il percorso non esiste: la cartella reale e' `Themes/Barthelemy/docs/shared-components/` |

## Documenti segnati stale il 2026-10-14

- [pages.md](./pages.md): descrive la gestione pagine, che Blog non ha.
- [models/transaction-removal.md](./models/transaction-removal.md): dichiara rimosso un modello ancora presente.

## Elenchi di URL, non integrazioni

[ai.md](./ai.md), [comment.md](./comment.md), [themes.md](./themes.md), [iconpicker.md](./iconpicker.md) contengono segnalibri e appunti. Una versione precedente di questo indice li presentava come "Integrazione AI" e "Integrazione sistema commenti". L'integrazione reale con i commenti e' nel codice (`Article` usa `HasComments` del modulo Comment); `visual_editor.md` non esiste.

## Moduli collegati

[Comment](../../Comment/docs/00-INDEX.md), [Rating](../../Rating/docs/00-INDEX.md), [UI](../../UI/docs/00-INDEX.md), [Xot](../../Xot/docs/00-INDEX.md), [Cms](../../Cms/docs/README.md), tema [TwentyOne](../../../Themes/TwentyOne/docs/00-INDEX.md).
