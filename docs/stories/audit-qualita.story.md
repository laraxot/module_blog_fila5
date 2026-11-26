---
title: "Audit qualita' modulo Blog"
type: story
status: in-review
module: Blog
created: 2026-11-19
updated: 2026-11-19
issues: ["laraxot/base_techplanner_fila5#64"]
tags: [audit, qualita, docs, phpstan, pest]
---

# Audit qualita' — modulo Blog

Story BMAD dell'audit di qualita' coordinato nella issue
[#64](https://github.com/laraxot/base_techplanner_fila5/issues/64).
Ambito: solo `Modules/Blog` (documentazione e `app/`).

## Baseline e risultato

| Verifica | Prima | Dopo |
|---|---|---|
| PHPStan max (`Modules/Blog`) | 0 errori | 0 errori |
| Pest (`Modules/Blog/tests`) | 1 passato | 1 passato |
| Occorrenze `mixed` in `app/` | 130 | 122 |

## Documentazione

- File `.md` con data/timestamp nel nome: 2 rinominati, 0 uniti al file canonico
  omonimo (contenuto unico conservato sotto "Contenuto unito da ..."), 0 rimossi perche' vuoti
  o gia' contenuti nel canonico. La data originale e' ora nel frontmatter `created:`.
- Duplicati esatti (contenuto identico) rimossi: 0; tenuta la copia meglio collocata
  (no `archive/`, `raw/`, suffissi `-1`/`_1`, maiuscole o underscore) e link interni aggiornati.
- `docs/index.md` (indice canonico): aggiunta la sezione "Mappa delle cartelle" con link relativi
  a tutte le aree; link rotti agli altri moduli corretti dove la destinazione era determinabile.

## Codice (`app/`)

- `Models/Category.php`, `Menu.php`, `Comment.php`: rimosse righe `@property`/`@method` duplicate nel PHPDoc di classe (72+32+2) generate da ide-helper ripetuti
- `$translations` di `Category`, `Article`, `Tag` tipizzato `array<string, array<string, mixed>>` (attributo `translations()` di spatie/laravel-translatable) invece di `mixed`; rimosso `@property mixed $post_counter` inesistente
- Rimossi file morti: `Models/BaseModel.php.backup-20251015-092511`, `Filament/Resources/ArticleResource/RelationManagers/RatingsRelationManager.to_rating`, `Http/Middleware/FilamentMiddleware.fila2`
- Rimosso `DataObjects/ArticleData.php` (cartella vietata dalla convenzione Datas, nessun riferimento; resta `Datas/ArticleData`)

## Scoperte da gestire (non risolte in questo audit)

- Copertura test quasi nulla (1 test): servono test per modelli e Actions
- `docs/README.md` contiene link rotti verso file mai esistiti
- Nell'indice restano link rotti verso file mai esistiti o di altri progetti: da rivedere a mano.
- `docs/` contiene ancora `INDEX.md`, `README.md` e `index.md` affiancati (collisione su filesystem
  case-insensitive): da consolidare in un solo indice con decisione condivisa.

## Criteri di accettazione

- [x] PHPStan max a 0 errori senza ignore/baseline
- [x] Nessun `.md` con data nel nome
- [x] Nessun duplicato esatto in `docs/`
- [x] Test Pest non peggiorati
- [ ] Punti aperti sopra risolti
