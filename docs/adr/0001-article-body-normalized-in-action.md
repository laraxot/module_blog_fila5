---
title: "ADR — Il corpo pubblico dell'articolo si normalizza in un'Action, con le immagini in src e non in url"
type: decision
module: Blog
tags: [adr, blog, blocks, article, frontoffice, immagini]
created: 2026-11-24
updated: 2026-11-26
status: accepted
decision-makers: [team Laraxot]
related:
  - ../../app/Actions/Article/ResolveArticleBodyAction.php
---

# ADR: il corpo pubblico dell'articolo si normalizza in un'Action, con le immagini in `src` e non in `url`

## Contesto

- `content_blocks` di un articolo contiene i blocchi dell'editor: `title`, `paragraph`, `image_spatie` (media per
  `img_uuid`), `images_gallery`, `rating`, `chart` e il vecchio `image` dei seeder.
- La pagina di dettaglio di post ed eventi (tema, partial `article-body`) deve mostrare tutti i blocchi, una sola immagine di
  testata e un solo `h1` (quello della pagina).
- Il renderer dei blocchi del tema localizza le chiavi `url` come link di pagina (`/it/...`): un'immagine passata in `url`
  diventava un percorso rotto.

Domanda: dove trasformare i blocchi grezzi in blocchi pronti per la vista?

## Driver della decisione

- Post ed eventi mostrano lo stesso corpo: una regola sola, non una per Blade.
- La regola deve essere testabile senza render e senza database (modelli non salvati).
- Il renderer dei blocchi del tema e' condiviso da tutte le pagine CMS: non si cambia per un caso dell'articolo.
- Un solo `h1` per pagina (quello del titolo) e una sola immagine di testata.

## Decisione

`ResolveArticleBodyAction` (`app/Actions/Article/`) restituisce `figure` + `blocks`:

- `image_spatie` diventa `image` con l'URL reale del media; ogni immagine esce in `src`, mai in `url`.
- Testata: il blocco che corrisponde a `main_image_url`, altrimenti la prima immagine; viene tolta dal corpo.
- Un blocco titolo che ripete il titolo dell'articolo si scarta; i livelli dei titoli sono solo `h2`-`h6`.
- Paragrafi vuoti e immagini senza URL si scartano; gli altri tipi passano invariati.

## Alternative scartate

- Logica nella Blade del tema: non testabile senza render, e duplicata tra dettaglio post ed evento.
- Tenere `url` e insegnare al renderer a non localizzare le immagini: tocca un renderer condiviso da tutte le pagine CMS.
- Mostrare solo i paragrafi (comportamento precedente): perdeva immagini e titoli intermedi.

## Conseguenze

- Pro: una sola regola per post ed eventi, testabile su modelli non salvati.
- Contro: un nuovo tipo di blocco passa invariato; se ha un'immagine in `url`, va aggiunto alla normalizzazione.

## Conferma

- `cd laravel && vendor/bin/pest Modules/Blog/tests/Feature/ResolveArticleBodyActionTest.php`: tutti i blocchi mantenuti, testata dalla prima
  immagine o da `main_image_url`, titolo ripetuto scartato e nessun `h1`, immagini in `src`. I tre test portano i group `BLOG-BODY-INV-1..5`
  del [contratto](../contracts/resolve-article-body-action.md): `vendor/bin/pest Modules/Blog/tests --group=BLOG-BODY-INV-4`.
- Nessuna conferma automatica per il punto «un nuovo tipo di blocco con immagine in `url` va aggiunto alla normalizzazione»: regola di review.
