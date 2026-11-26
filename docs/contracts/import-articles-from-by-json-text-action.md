---
title: "Contratto — ImportArticlesFromByJsonTextAction"
type: contract
action: "Modules\\Blog\\Actions\\Article\\ImportArticlesFromByJsonTextAction"
module: Blog
status: active
tags: [contract, action, blog, import, legacy]
created: 2026-11-24
updated: 2026-11-26
---

# ImportArticlesFromByJsonTextAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`).
Sorgente: `app/Actions/Article/ImportArticlesFromByJsonTextAction.php`. Chiamante: azione "Import" della lista articoli
(`Filament/Resources/ArticleResource/Pages/Actions/ArticleImportActionFactory.php`), testo JSON da file caricato o incollato.
Codice legacy (formato di un export di mercati predittivi): il contratto descrive il comportamento com'e', non un modello.

## Input

- `$jsonText`: array JSON di articoli. Chiavi lette per articolo: `slug`, `title`, `status`, `status_display`, date
  (`bet_end_date`, `event_start_date`, `event_end_date`), contatori `wagers*`, `volume_*`, `brier_score*`, `is_wagerable`,
  `category` (lista dal padre al figlio, `title`/`slug`), `outcomes` (lista, `title`, `disabled`, `thumbnail_2x`).

## Output

- `void`.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-IMPORT-ARTICLES-INV-1 | Un articolo esistente con lo stesso `slug` non viene modificato (`firstOrCreate`): l'import aggiunge, non aggiorna. | — (non dimostrato) |
| BLOG-IMPORT-ARTICLES-INV-2 | Le categorie si cercano per `slug`; la catena `category` diventa una gerarchia `parent_id` e l'articolo prende l'ultima. | — (non dimostrato) |
| BLOG-IMPORT-ARTICLES-INV-3 | Un articolo nuovo ha `published_at` = oggi, indipendentemente dal JSON. | — (non dimostrato) |

## Effetti collaterali

- `INSERT` in categorie, articoli e rating (relazione `ratings()` dell'articolo), connessione del modulo Blog.
- Per ogni outcome con `thumbnail_2x`: download HTTP dell'immagine (`addMediaFromUrl`) e nuovo media nella collezione
  `rating`, **anche se il rating esisteva gia'**: reimportare lo stesso file duplica i media e ripete i download.

## Errori

- JSON non valido: `Safe\Exceptions\JsonException`.
- Elemento non array, `category` non array, chiavi obbligatorie mancanti (`slug`, `title`, `status`, `outcomes`, ...):
  `InvalidArgumentException` di Webmozart Assert o errore PHP di chiave mancante.
- Nessuna transazione: gli articoli importati prima dell'errore restano.
- URL di immagine irraggiungibile: eccezione di Media Library, l'import si ferma.

## Non fa

- Non aggiorna articoli esistenti ne' cancella quelli assenti dal file.
- Non imposta il `type` Parental (`post`/`event`): la colonna e' nullable, l'articolo importato resta con `type` null e non compare ne' tra le Novita' ne' tra gli Eventi.
- Non valida i contenuti (testo, link) ne' autorizza: l'azione Filament e' gia' dietro la policy della Resource.
- `is_following` riceve `volume_real_money` (difetto ereditato, non imitarlo).

## Limiti noti

- **Nessun test in tutto il repository.** `rg ImportArticlesFromByJsonText Modules Themes --glob '*.php'` trova solo la classe e `ArticleImportActionFactory`: le tre invarianti sono promesse dal codice, non provate.
- **Nessuna autorizzazione propria.** L'azione Filament (`ArticleImportActionFactory`) non ha `authorize()` ne' `visible()`: chi puo' aprire la lista articoli puo' importare. Il testo JSON si puo' anche incollare nel `Textarea`, non solo caricare da file.
- **L'URL delle immagini lo sceglie chi scrive il JSON.** `addMediaFromUrl($rating['thumbnail_2x'])` scarica dal server qualunque URL, senza elenco di host ammessi (rischio SSRF per chi ha accesso all'import). Letto dal codice, non provato con una richiesta.
- Chiavi obbligatorie senza `??` (`slug`, `title`, `status`, `status_display`, `outcomes`, ...): una chiave mancante e' un errore PHP, non un `InvalidArgumentException`.
