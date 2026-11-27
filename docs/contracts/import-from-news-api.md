---
title: "Contratto — ImportFromNewsApi"
type: contract
action: "Modules\\Blog\\Actions\\ImportFromNewsApi"
module: Blog
status: active
tags: [contract, action, blog, import, servizi-esterni, legacy]
created: 2026-11-26
updated: 2026-11-26
---

# ImportFromNewsApi

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`).
Sorgente: `app/Actions/ImportFromNewsApi.php`. Chiamanti: **nessuno** (`rg ImportFromNewsApi Modules app routes --glob '*.php'` trova solo la classe). Codice legacy abbozzato: ha un contratto perche' chiama un servizio esterno con una chiave segreta nell'URL.

## Input

- Nessuno. Legge `config('services.newsapi.app_key')` (definita in `Modules/Fixcity/config/services.php` riga 29).

## Output

- `void`. La risposta non viene usata: l'importazione degli articoli e' commentata nel sorgente («from POST to ARTICLE»).

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-NEWSAPI-INV-1 | La chiave API viene solo da `config('services.newsapi.app_key')`, mai scritta nel sorgente; se non e' una stringa l'Action lancia prima di qualunque richiesta. | — (non dimostrato) |
| BLOG-NEWSAPI-INV-2 | L'Action non scrive nulla (ne' articoli ne' media): oggi e' una chiamata a vuoto. Se qualcuno decomenta l'import, questo contratto va riscritto con idempotenza e limiti. | — (non dimostrato) |

## Effetti collaterali

- Una `GET https://newsapi.org/v2/everything?q=cripto&sortBy=popularity&apiKey=<chiave>` (`Http::get`). La chiave e' nella query string: finisce nei log del servizio e di eventuali proxy.
- Nessuna scrittura su DB, file o cache.

## Errori

- `InvalidArgumentException` (Webmozart `Assert::string`) se la chiave non e' configurata come stringa; `Assert::isArray` se la risposta non e' JSON array (una risposta di errore HTTP con corpo JSON, per esempio un 401, passa lo stesso controllo).
- Eccezioni di rete/HTTP del client `Http` risalgono al chiamante: nessun retry, nessun timeout esplicito.

## Non fa

- Non importa articoli: il ciclo `Post::create()` e' dentro un commento.
- Non verifica lo stato HTTP della risposta.
- Non e' pianificata ne' esposta (nessuna rotta, comando o voce Filament la chiama).

## Limiti noti

- **Codice morto con un'uscita di rete.** Se qualcuno la chiama, esce verso `newsapi.org` con una query fissa (`q=cripto`, tema di un altro progetto) senza usare il risultato. Candidata alla cancellazione; decisione del proprietario del modulo.
- La chiave in query string e' il metodo documentato da NewsAPI, ma un header (`X-Api-Key`) eviterebbe di lasciarla negli URL: da fare solo se l'Action viene riattivata.
