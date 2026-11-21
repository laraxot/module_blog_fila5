---
title: "phpstan wave zero"
type: story
tags: [phpstan, blog, type-safety]
qmd: "blog phpstan zero generics iterableValue filament live downloadable"
related:
  - ./phpstan-compliance.md
  - ./phpstan-fixes.md
  - ./fixes/phpstan-fixes.md
---

# Blog PHPStan → 0

## Scopo

Portare `Modules/Blog` a zero errori PHPStan (livello max da `phpstan.neon`, senza ignore/neon) dopo il refresh inventario reale (Larastan attivo): baseline **224** errori, dominati da `missingType.iterableValue` / `missingType.generics`.

## Perché

Il Blog è il dominio editoriale (articoli, categorie, menu, composer tema). Tipi espliciti su Collection/Builder/Relation e array shape proteggono la business logic senza `mixed` di comodo e senza baseline ignore.

## Cosa è stato fatto

- PHPDoc class-level: `array<…>` value types, Staudenmeir `Collection<int, T>`, create/firstOrCreate attributi tipizzati
- Relazioni/scopes/Attribute con generics (`BelongsTo<T, $this>`, `EloquentBuilder<static>`, `Attribute<string, string>`)
- Filament: `reactive`→`live`, `lazy`→`live(onBlur)`, `enableOpen/Download`→`openable/downloadable`
- `createOptionForm` riusa `CategoryForm` (niente `CategoryResource::getFormFields` morto)
- Cast `mixed`→string solo dopo guardie `is_string`/`is_scalar`
- Trait morto `HasContentEditor` rimosso
- Factory/seeder tipizzati (`@extends Factory<Model>`, `array<string, mixed>`)

## Verifica

```bash
cd laravel && ./vendor/bin/phpstan analyse Modules/Blog --memory-limit=-1 --error-format=raw
```

| Metric | Before | After |
|--------|--------|-------|
| Blog errors | 224 | **0** |

Inventario: `/tmp/phpstan-wave/Blog.tsv` · `SUMMARY.tsv` → `Blog 0`.

## Lock

Lane `Blog` acquisita/rilasciata via `bashscripts/lock/` durante la wave.
