---
title: "00 index"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "00 index"
issues: []
discussions: []
status: stale
---

> Nota 2026-10-14 (docs-audit): Copia concorrente del vecchio 00-INDEX.md, con link a visual_editor.md (inesistente), a un hub di audit inesistente e al modulo Predict (inesistente). Indice canonico: 00-INDEX.md (riscritto 2026-10-14). Contenuto non riscritto, verificare prima di usarlo.

# Blog Module Documentation Index

**Path**: `laravel/Modules/Blog/docs/`  
**Last updated**: 2026-06-30

## Audit over-engineering

| Documento | Scopo |
|-----------|--------|
| [ponytail-audit-over-engineering.md](./ponytail-audit-over-engineering.md) | Findings Ponytail Blog |
| Hub repo _(riferimento non presente nel repository, verificato 2026-10-14)_ | Audit repo-wide |

## Hub Canonici

| File | Scopo |
|---|---|
| [README.md](./README.md) | Panoramica completa del modulo Blog |
| [blocks.md](./blocks.md) | Sistema di blocchi per contenuti modulari |
| [pages.md](./pages.md) | Gestione pagine, SEO e metadati |
| [comment.md](./comment.md) | Integrazione sistema commenti |
| visual_editor.md _(riferimento non presente nel repository, verificato 2026-10-14)_ | Editor WYSIWYG e UI |
| [themes.md](./themes.md) | Sistema di tematizzazione |
| [ai.md](./ai.md) | Integrazione AI |
| [iconpicker.md](./iconpicker.md) | Icon picker tool |

## Regola Chiave di Questa Fase

- Il modulo Blog gestisce contenuti editoriali strutturati
- Supporta multi-lingua e SEO nativo
- Integrato con Filament per l'admin
- Blocchi riutilizzabili rispettano i confini modulo-tema
- Commenti integrati con il modulo Comment

## Riferimenti Bidirezionali

- Predict docs index _(riferimento non presente nel repository, verificato 2026-10-14)_ - Modulo principale predizioni
- [Comment docs index](../../Comment/docs/00-INDEX.md) - Sistema commenti integrato
- [UI docs index](../../UI/docs/00-INDEX.md) - Componenti UI riutilizzabili
- [Xot docs index](../../Xot/docs/00-INDEX.md) - Core functionality
- [TwentyOne Theme index](../../../Themes/TwentyOne/docs/00-INDEX.md) - Theme utilizzato dai blog

--- BMAD + Second Brain ---
- Scopo: documentazione tecnica del modulo.
- Utilità: riferimento sviluppatori/audit.
- Funzionalità: struttura, dipendenze, convenzioni (no date .md, git avanti).
