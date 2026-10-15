---
title: "file naming rules"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-10-15
qmd: "file naming rules"
issues: []
discussions: []
module: theme
topic: file-naming-rules
canonical: ../../../Themes/docs/shared-components/file-naming-rules.md
status: stub
---

See canonical documentation: ../../../Themes/docs/shared-components/file-naming-rules.md

--- BMAD + Second Brain ---
- Scopo: documentazione tecnica del modulo.
- Utilità: riferimento sviluppatori/audit.
- Funzionalità: struttura, dipendenze, convenzioni (no date .md, git avanti).

## Convenzioni `.md` in `docs/`

- Solo **kebab-case minuscolo** (`best-practices.md`), mai `BEST_PRACTICES.md` o `best_practices.md`.
- Eccezione unica: `README.md`.
- Niente date/timestamp ne' suffissi `-1.md`/`-2.md` nel nome (la data sta nel frontmatter).
- Prima di creare un file: verifica che non esista gia' lo stesso argomento; usa `python3 -I bashscripts/tools/docs/md-filenames.py name <percorso>`.
- Se esistono versioni UPPERCASE e lowercase dello stesso argomento: tieni kebab-case, elimina il duplicato (contenuto piu' ricco vince).
