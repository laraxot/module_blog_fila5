# Blog - Product Requirements Document (PRD)

> Documento vivente. Modulo editoriale di base.
> Stato stimato: 72% implementato, 28% da consolidare.

## 1. Purpose & Vision

Il modulo **Blog** gestisce l'identita' editoriale del progetto: articoli, categorie, banner e profili autore. Nel prediction market rappresenta il layer di contenuto pubblicabile sopra cui il dominio Predict innesta comportamenti e dati di mercato.

**Visione**: un backbone editoriale unico, riusabile e multiuso, da cui derivano contenuti informativi e subtype specializzati come `Predict`.

## 2. Problem Statement

Senza Blog:
- manca una shell editoriale comune per pagine pubbliche, SEO e tassonomie
- i contenuti previsionali dovrebbero reinventare articoli, categorie e banner
- si duplicherebbero tabelle e comportamenti tra dominio editoriale e dominio market

## 3. Target Users

| User | Ruolo | Bisogni |
|------|-------|---------|
| **Editor** | Gestisce contenuti | Articoli, categorie e banner coerenti |
| **Admin** | Cura homepage e tassonomie | Bannering e classificazione |
| **Modulo Predict** | Riusa contenuto base | Identita' editoriale pubblicabile |

## 4. Scope

### In Scope
- Articoli pubblicabili con contenuto e metadata
- Categorie editoriali
- Banner per homepage e contenuti in evidenza
- Profili autore collegati agli utenti
- Supporto a subtype editoriali riusabili

### Out of Scope
- Meccanica di trading e settlement
- Ledger, ordini e payout
- Decisioni di moderazione dei commenti

## 5. Functional Requirements (Prioritized)

### P0
- **FR-001**: Gestire articoli come contenuto editoriale canonico.
- **FR-002**: Fornire categorie riusabili da frontoffice e admin.
- **FR-003**: Fornire banner per homepage e superfici promozionali.
- **FR-004**: Esporre profili autore coerenti con gli utenti applicativi.

### P1
- **FR-005**: Consentire subtype editoriali con comportamento aggiuntivo.
- **FR-006**: Rendere i contenuti traducibili e indicizzabili.
- **FR-007**: Integrare tag, media e relazioni editoriali.

## 6. Non-Functional Requirements

- **NFR-001**: Blog resta dominio editoriale, non engine di mercato.
- **NFR-002**: Una sola ownership canonica per tabella e migration.
- **NFR-003**: Compatibilita' con homepage e listing del Cms.

## 7. Technical Architecture

- **Dipendenze**: Xot, Media, Lang, Cms, User.
- **Modelli centrali**: `Article`, `Category`, `Banner`, `Profile`.
- **Ruolo nel progetto**: base editoriale riusata da Predict tramite subtype.
- **Contratto critico**: lo schema Blog deve esistere nel database `predict_data` quando Predict ne estende i modelli.

## 8. Current State & Gaps

### Stato reale al 2026-03-12
- Articoli e categorie: **80%**
- Banner runtime per homepage: **75%**
- Profili autore: **60%**
- Allineamento schema/migrazioni canoniche: **55%**

### Gap prioritari
- Va ripulita definitivamente l'ownership canonica delle migration condivise con Predict.
- Il contratto tra `Article` e subtype specializzati va documentato meglio.
- I profili devono restare coerenti con lo schema realmente in uso.

## 9. Success Metrics

| Metrica | Target |
|--------|--------|
| Homepage senza errori su `banners/categories/articles` | 100% |
| PHPStan su `Modules/Blog` | 0 errori |
| Drift di migration duplicate | 0 |

## 10. Risks & Assumptions

- Assunzione: `Predict` continua a usare Blog come base editoriale.
- Rischio: duplicazione tra migration di Blog e moduli consumatori.
- Rischio: usare Blog per logica non editoriale aumenta accoppiamento e confusione.

## 11. References

- [PRD Indice Centrale](../../../project_docs/PRD_INDEX_2026_03_12.md)
- [README.md](../README.md)
- [PRD Predict](../../Predict/docs/prd.md)

## Testing & Coverage

- test di schema e runtime homepage
- test di subtype editoriali dove il dominio riusa `Article`
- nessun comando distruttivo di migrazione
