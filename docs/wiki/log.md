## [2026-06-05] docs | HackerNoon harness — tips 001-022 in wiki locale

- Stub/checklist: second-brain → canon Xot, ai-harness, [hackernoon map](../../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md), [llm-wiki.txt](../../../../../bashscripts/tools/prompts/llm-wiki.txt)
- GitHub: [#272](https://github.com/laraxot/base_fixcity_fila5/issues/272) / [D#273](https://github.com/laraxot/base_fixcity_fila5/discussions/273)

# Blog Wiki Log

## [2026-04-15] init | wiki bootstrap
- Struttura wiki/log.md inizializzata.
- Layer raw: tutti i file in `docs/` (eccetto `wiki/`).
- Layer wiki: `docs/wiki/` — LLM-maintained, sintesi ad alto riuso.
- Schema: `docs/.schema/WIKI_SCHEMA.md`
- Adozione moduli: `docs/project/llm-wiki-module-adoption.md`

## [2026-07-12] phpstan | Article presentation Support -> QueueableAction

- `Article` non passa piu da `Modules\Blog\Support\ArticleDelegates`: ogni use case usa direttamente la sua `Modules\Blog\Actions\Article\*Action` con `execute()`.
- Il vecchio delegatore statico e stato ritirato come `app/Support/ArticleDelegates.php.old` senza cancellazione e senza cartelle archive.
- Regola: nuova logica Blog di presentazione/trasformazione articolo = Action queueable, non Support statico.
