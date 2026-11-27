# Archive — documentazione legacy del modulo Blog

Contenuto spostato da `docs/` durante la razionalizzazione (tracking:
[issue #25](https://github.com/laraxot/module_blog_fila5/issues/25)).
`docs/` resta entro 100 file `.md`: indice, `adr/`, `contracts/`,
`stories/` attive, guide e documentazione corrente.

## Cosa contiene

| Percorso | Provenienza | Note |
|---|---|---|
| `bmad/` | `docs/bmad/` | Dossier BMAD, blueprint, brainstorming/planning |
| `wiki/` | `docs/wiki/` | LLM Wiki generata — sovrapposta alla documentazione corrente |
| `llm-wiki/` | `docs/llm-wiki/` | AGENTS.md wiki locale |
| `raw/` | `docs/raw/` | Import raw e test di sync |
| `investigation/` | `docs/investigation/` | Note di indagine concluse |
| `fixes/` | `docs/fixes/` | Note fix PHPStan obsolete |
| `roadmap/` | `docs/roadmap/` | Vecchia roadmap directory (la canonica e' `docs/roadmap.md`) |
| `stories/` | `docs/stories/phpstan-*` | Story PHPStan/qualita' concluse |
| `filament/` | `docs/filament/best_practices.md` | Duplica di `docs/filament/best-practices.md` |
| `*.md` (radice) | `docs/*.md` | Analisi una tantum (phpstan-*, redundancy-*, merge-conflict*, sync-test*, sprint*, product_* dup, audit) e doc superate |

Inoltre sono stati eliminati 18 file stale (`*.md.old`) in `docs/`.
I link interni dei documenti mantenuti sono stati ripuntati qui.
