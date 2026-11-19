---
title: "Blog Module Wiki Index"
type: index
module: Blog
tags: [blog, wiki, index]
created: 2026-04-15
updated: 2026-06-05
qmd: "blog module wiki index second brain harness"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/272"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/273"
related:
<<<<<<< HEAD
  - ../../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md
  - ../../../../../docs/wiki/bmad/architecture.md
  - ../../../../../docs/wiki/rules/wiki-markdown-frontmatter-mandatory.md
  - ../../docs/wiki/concepts/ai-harness-module-discipline.md
status: draft
=======
  - ../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md
  - ../../../../docs/wiki/bmad/architecture.md
  - ../../../../docs/wiki/rules/wiki-markdown-frontmatter-mandatory.md
  - ../../docs/wiki/concepts/ai-harness-module-discipline.md
>>>>>>> laraxot/dev
---

# Blog Module LLM Wiki

## AI / second brain

<<<<<<< HEAD
- [hackernoon-ai-coding-tips-fixcity-map](../../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md)
- [bmad/architecture](../../../../../docs/wiki/bmad/architecture.md)
- [frontmatter + GitHub](../../../../../docs/wiki/rules/wiki-markdown-frontmatter-mandatory.md)
- ai-harness-module-discipline _(riferimento non presente nel repository, verificato 2026-10-14)_
=======
- [hackernoon-ai-coding-tips-fixcity-map](../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md)
- [bmad/architecture](../../../../docs/wiki/bmad/architecture.md)
- [frontmatter + GitHub](../../../../docs/wiki/rules/wiki-markdown-frontmatter-mandatory.md)
- [ai-harness-module-discipline](../../docs/wiki/concepts/ai-harness-module-discipline.md)
>>>>>>> laraxot/dev
- [second-brain-local-discipline](./concepts/second-brain-local-discipline.md) → canon Xot


Indice operativo del wiki Blog.

## Struttura canonica (sacra)

- [concepts/](./concepts/): Pattern architetturali e metodologie.
- [entities/](./entities/): Modelli e componenti chiave.
<<<<<<< HEAD
- sources/ _(riferimento non presente nel repository, verificato 2026-10-14)_: Dati di ricerca e link esterni.
- [comparisons/](./comparisons/): Implementazioni alternative.
- [decisions/](./decisions/): ADL (Architectural Decision Log).
- [troubleshooting/](./troubleshooting/): Problemi noti e soluzioni.
- _archive/ _(riferimento non presente nel repository, verificato 2026-10-14)_: Documentazione legacy.
=======
- [sources/](./sources/): Dati di ricerca e link esterni.
- [comparisons/](./comparisons/): Implementazioni alternative.
- [decisions/](./decisions/): ADL (Architectural Decision Log).
- [troubleshooting/](./troubleshooting/): Problemi noti e soluzioni.
- [_archive/](./_archive/): Documentazione legacy.
>>>>>>> laraxot/dev
- [_templates/](./_templates/): Template standard.

## Regole collegate

<<<<<<< HEAD
- [forbidden-folders-rule](../../../../../docs/wiki/concepts/forbidden-folders.md): Vincoli strutturali strict.
- [llm-wiki-standard](../../../../../docs/project/karpathy-llm-wiki-adoption.md): Mapping repository e ciclo di vita conoscenza.
- cms-driven-pages _(riferimento non presente nel repository, verificato 2026-10-14)_: Pagine CMS per blog.
=======
- [forbidden-folders-rule](../../../../docs/wiki/concepts/forbidden-folders.md): Vincoli strutturali strict.
- [llm-wiki-standard](../../../../docs/project/karpathy-llm-wiki-adoption.md): Mapping repository e ciclo di vita conoscenza.
- [cms-driven-pages](../../../../docs/wiki/concepts/cms-driven-pages.md): Pagine CMS per blog.
>>>>>>> laraxot/dev

## Scopo Blog Module

Gestione articoli, categorie, tag e contenuti editoriali con supporto CMS.

## Compiled Pages

| Pagina | Tipo | Argomento | Data |
|--------|------|-----------|------|
| [.gitkeep](./concepts/.gitkeep) | Concept | - | 2026-04-21 |

## Best Practices

<<<<<<< HEAD
- Usare CMS-driven pages con JSON config (vedi cms-driven-pages _(riferimento non presente nel repository, verificato 2026-10-14)_)
- Implementare `casts()` method non `$casts` property (vedi model-casts-phpstan _(riferimento non presente nel repository, verificato 2026-10-14)_)
- Usare Folio routing per pagine blog (vedi folio-routing _(riferimento non presente nel repository, verificato 2026-10-14)_)
=======
- Usare CMS-driven pages con JSON config (vedi [cms-driven-pages](../../../../docs/wiki/concepts/cms-driven-pages.md))
- Implementare `casts()` method non `$casts` property (vedi [model-casts-phpstan](../../../../docs/wiki/concepts/model-casts-phpstan.md))
- Usare Folio routing per pagine blog (vedi [folio-routing](../../../../docs/wiki/concepts/folio-routing.md))
>>>>>>> laraxot/dev

## Bad Practices

- NON creare Service classes - usare Actions (vedi [actions-over-services-governance](https://github.com/laraxot/base_fixcity_fila5/blob/main/.opencode/skills/actions-over-services-governance/SKILL.md))
- NON usare `dehydrated(false)` nei trait - blocca salvataggio (vedi Geo CoordinatePicker fix)
<<<<<<< HEAD
- NON duplicare slug logic - usare trait dedicati (vedi slug-unique-rule _(riferimento non presente nel repository, verificato 2026-10-14)_)

## False Friends

- `live()` in Filament non rende il campo sempre live - serve `$applyStateBindingModifiers()` (vedi [coordinate-picker-state-binding-rule](../../../Geo/docs/wiki/concepts/coordinate-picker-state-binding-rule.md))
=======
- NON duplicare slug logic - usare trait dedicati (vedi [slug-unique-rule](../../../../docs/wiki/concepts/slug-unique-rule.md))

## False Friends

- `live()` in Filament non rende il campo sempre live - serve `$applyStateBindingModifiers()` (vedi [coordinate-picker-state-binding-rule](../../Geo/docs/wiki/concepts/coordinate-picker-state-binding-rule.md))
>>>>>>> laraxot/dev
- `dehydrated(false)` sembra mantenere il campo nei dati ma blocca il salvataggio

## Troubleshooting

| Pagina | Tipo | Argomento |
|--------|------|-----------|
| [.gitkeep](./concepts/.gitkeep) | Concept | Template iniziale |

Aggiornato: 2026-04-28
