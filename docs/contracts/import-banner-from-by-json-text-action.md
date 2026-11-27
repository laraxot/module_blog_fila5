---
title: "Contratto — ImportBannerFromByJsonTextAction"
type: contract
<<<<<<< .merge_file_MjnO6r
action: "Modules\Blog\Actions\Banner\ImportBannerFromByJsonTextAction"
tags: [contract, action, blog, banner, import, legacy]
created: 2026-11-24
updated: 2026-11-24
=======
action: "Modules\\Blog\\Actions\\Banner\\ImportBannerFromByJsonTextAction"
module: Blog
status: active
tags: [contract, action, blog, banner, import, legacy]
created: 2026-11-24
updated: 2026-11-26
>>>>>>> .merge_file_TWyLZF
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
<<<<<<< .merge_file_MjnO6r
| BLOG-IMPORT-BANNER-INV-1 | Un banner esistente con stessi `title` e `action_text` non viene modificato (`firstOrCreate`). | — |
| BLOG-IMPORT-BANNER-INV-2 | Ogni banner e' legato a una categoria cercata per `slug` di `category_dict`, creata se manca (anche con slug vuoto). | — |
| BLOG-IMPORT-BANNER-INV-3 | Gli elementi del JSON che non sono oggetti si saltano senza errore. | — |
=======
| BLOG-IMPORT-BANNER-INV-1 | Un banner esistente con stessi `title` e `action_text` non viene modificato (`firstOrCreate`). | — (non dimostrato) |
| BLOG-IMPORT-BANNER-INV-2 | Ogni banner e' legato a una categoria cercata per `slug` di `category_dict`, creata se manca (anche con slug vuoto). | — (non dimostrato) |
| BLOG-IMPORT-BANNER-INV-3 | Gli elementi del JSON che non sono oggetti si saltano senza errore. | — (non dimostrato) |
>>>>>>> .merge_file_TWyLZF

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
<<<<<<< .merge_file_MjnO6r
=======

## Limiti noti

- **Nessun test in tutto il repository.** `rg ImportBannerFromByJsonText Modules Themes --glob '*.php'` trova solo la classe e `ListBanners`: le tre invarianti non sono provate.
- **Nessuna autorizzazione propria**: l'azione in `ListBanners.php` non ha `authorize()` ne' `visible()`; il JSON si puo' incollare nel `Textarea`.
- **L'URL di `desktop_thumbnail` lo sceglie chi scrive il JSON** (`addMediaFromUrl`, nessun elenco di host): rischio SSRF per chi ha accesso all'import. Letto dal codice.
>>>>>>> .merge_file_TWyLZF
