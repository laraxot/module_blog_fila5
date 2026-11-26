---
title: "Contratto — ResolveArticleBodyAction"
type: contract
action: "Modules\\Blog\\Actions\\Article\\ResolveArticleBodyAction"
module: Blog
status: active
tags: [contract, action, blog, blocks, frontoffice, immagini]
created: 2026-11-26
updated: 2026-11-26
---

# ResolveArticleBodyAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`). Perche': ADR [article-body-normalized-in-action](../adr/0001-article-body-normalized-in-action.md).
Sorgente: `app/Actions/Article/ResolveArticleBodyAction.php`. Chiamanti: partial `components/blocks/partials/article-body.blade.php` dei temi Sixteen (riga 10) e Civic (riga 10),
cioe' il dettaglio pubblico di post ed eventi. Action pura (nessuna scrittura): ha un contratto perche' decide cosa del contenuto scritto dall'editor arriva alla pagina pubblica.

## Input

- Un `Article` (anche non salvato). Legge `title` (`getTitle()`), `content_blocks` (array di `{type, data}`) e `main_image_url`.

## Output

- `array{figure: array{src, alt, caption, credit}|null, blocks: list<array{type, data}>}`: la testata (o `null`) e i blocchi normalizzati in ordine.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-BODY-INV-1 | Ogni blocco dell'editor valido resta nel corpo, nello stesso ordine: `title`, `paragraph`, `image`/`image_spatie` (diventano `image`), tranne la testata e gli scarti di INV-4/INV-5. Se cade, un'immagine o un titolo intermedio spariscono dalla pagina. | `BLOG-BODY-INV-1` |
| BLOG-BODY-INV-2 | La testata e' la prima immagine quando `main_image_url` e' vuoto; altrimenti l'immagine il cui `src` e' uguale a `main_image_url`. La testata e' tolta dal corpo: non compare due volte. | `BLOG-BODY-INV-2` |
| BLOG-BODY-INV-3 | Con `main_image_url` valorizzato, `alt`, `caption` e `credit` della testata vengono solo dal blocco con lo stesso `src`; un altro blocco immagine non presta i suoi metadati e resta nel corpo. | `BLOG-BODY-INV-3` |
| BLOG-BODY-INV-4 | Un titolo identico al titolo dell'articolo e' scartato; i livelli emessi sono solo `h2`-`h6` (un livello assente o `h1` diventa `h2`): l'`h1` e' della pagina. | `BLOG-BODY-INV-4` |
| BLOG-BODY-INV-5 | Paragrafi vuoti, immagini senza URL risolvibile ed elementi di `content_blocks` che non sono array sono scartati senza errore. | `BLOG-BODY-INV-5` |
| BLOG-BODY-INV-6 | Con `url` vuoto e `img_uuid` valorizzato su un articolo salvato, l'URL dell'immagine e' `getFirstMediaUrl(<img_uuid>)`; ogni immagine esce con la chiave `src`, mai `url` (il renderer del tema localizza `url` come link di pagina). | — (non dimostrato) |
| BLOG-BODY-INV-7 | I tipi di blocco non riconosciuti (`rating`, `chart`, ...) passano invariati, con i soli `data` a chiavi stringa. | — (non dimostrato) |

## Effetti collaterali

- Nessuna scrittura, nessun evento. Con un articolo salvato e un blocco con `img_uuid` e senza `url` legge la collezione media (`getFirstMediaUrl`, una query).

## Errori

- Nessuna eccezione propria: dati malformati (tipi non stringa, chiavi mancanti) sono ignorati o scartati.

## Non fa

- Non sanifica l'HTML dei paragrafi: il testo passa com'e'; la sicurezza dell'HTML e' di chi lo scrive (editor) e del renderer.
- Non normalizza i tipi sconosciuti: un nuovo tipo di blocco con un'immagine in `url` passa invariato (limite dichiarato nell'ADR).
- Non decide se l'articolo e' pubblicato (`ThemeArticleQueries`) ne' la sua lingua.
- Non valida che `main_image_url` esista: senza blocco corrispondente la testata e' `{src: main_image_url, alt: titolo, caption: '', credit: ''}`.

## Limiti noti

- Il confronto del titolo ripetuto ignora le maiuscole (`mb_strtolower`) ma i test usano solo lo stesso caso; INV-7 non e' coperta (nessun test passa blocchi `rating` o `chart`).
- INV-6 non ha test: il test esistente usa articoli non salvati (`runTestingMigrations()` vuoto) e quindi non puo' passare dal ramo `getFirstMediaUrl`.
- Con `main_image_url` valorizzato e nessun blocco con quel `src`, la prima immagine non diventa testata e resta nel corpo: la testata ha solo `alt` = titolo (ramo non coperto da test).
