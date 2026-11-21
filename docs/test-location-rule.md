---
title: "Test Location Rule — Blog"
type: note
status: draft
updated: 2026-11-19
tags: [docs, blog]
qmd: "test location rule   blog blog"
---
# Test Location Rule — Blog

- Tests: `laravel/Modules/Blog/tests/`.
- Module fixtures: `laravel/Modules/Blog/tests/Fixtures/`.
- `laravel/tests/` is reserved for application, cross-module and theme tests.
- Do not create `laravel/tests/Modules/Blog/` as a duplicate.

## Namespace dei test

Il namespace segue il PSR-4 del modulo (`Modules\Blog\Tests\` → `tests/`): `tests/Feature/X.php` è
`Modules\Blog\Tests\Feature`, `tests/Unit/Models/X.php` è `Modules\Blog\Tests\Unit\Models`. Fino al
2026-11-19 sette file usavano `Tests\Feature\Modules\Blog` / `Tests\Unit\Modules\Blog\Models` (il layout
di `laravel/tests/`), e Composer li saltava a ogni `dump-autoload` ("does not comply with psr-4").
Controllo: `composer dump-autoload -o 2>&1 | grep 'psr-4 autoloading' | grep Blog` → nessuna riga.
