---
title: "Contratto — ImportBannerFromByJsonTextAction"
type: contract
action: "Modules\Blog\Actions\Banner\ImportBannerFromByJsonTextAction"
tags: [contract, action, blog, banner, import, legacy]
created: 2026-11-24
updated: 2026-11-24
---

# ImportBannerFromByJsonTextAction

Contratto di comportamento (regola: `Modules/Xot/docs/rules/action-behavioral-contract.md`).
Sorgente: `app/Actions/Banner/ImportBannerFromByJsonTextAction.php`. Chiamante: azione di import in
`Filament/Resources/BannerResource/Pages/ListBanners.php`. Codice legacy: descrive il comportamento com'e'.

## Input

- `$jsonText`: array JSON di banner. Chiavi lette: `title`, `short_description`, `action_text`, `link`, `start_date`,
  `end_date`, `hot_topic`, `open_markets_count`, `landing_banner`, `category_dict` (`title`, `slug`), `desktop_thumbnail`.

## Output

- `void`.

## Invarianti

| ID | Regola | Group Pest |
|---|---|---|
| BLOG-IMPORT-BANNER-INV-1 | Un banner esistente con stessi `title` e `action_text` non viene modificato (`firstOrCreate`). | — |
| BLOG-IMPORT-BANNER-INV-2 | Ogni banner e' legato a una categoria cercata per `slug` di `category_dict`, creata se manca (anche con slug vuoto). | — |
| BLOG-IMPORT-BANNER-INV-3 | Gli elementi del JSON che non sono oggetti si saltano senza errore. | — |

## Effetti collaterali

- `INSERT` in categorie e banner.
- Con `desktop_thumbnail`: download HTTP e nuovo media nella collezione `banner`, **anche per un banner gia' esistente**
  (reimport = media duplicati).

## Errori

- JSON non valido: `Safe\Exceptions\JsonException`; JSON che non e' un array: `InvalidArgumentException` (Webmozart Assert).
- Data non interpretabile da `Carbon::parse`: `InvalidFormatException`.
- URL di immagine irraggiungibile: eccezione di Media Library. Nessuna transazione: i banner gia' importati restano.

## Non fa

- Non aggiorna ne' cancella banner esistenti.
- Non valida `link` (puo' essere qualunque stringa, anche uno schema non http).
- Non autorizza: lo fa la Resource Filament.
