---
name: blog-coverage
description: PHPStan/PHPMD/Pest gate status for Modules/Blog — 2026-09-06/07 PHPStan L10 cleanup
metadata:
  type: quality-gate
---

# Blog — quality gate status (2026-09-07)

## PHPStan

- Before: 8 errors — `Filament\Forms\Components\BaseFileUpload::enableOpen()`/`enableDownload()`
  deprecated in Filament v5, replaced by `openable()`/`downloadable()`.
- Fix: mechanical rename in `CategoryForm.php`, `CategoryFormSchema.php`,
  `TextWidgetResource.php`, `TextWidgetResource/Schemas/TextWidgetForm.php`.
- After: **0 errors** (`phpstan analyse Modules/Blog`, clean cache).

## PHPMD

No new findings in touched files (pre-existing `ShortVariable` notes elsewhere,
unrelated to this fix).

## Pest

Not run for this module in this pass (mechanical, zero-behavior-change rename;
verified via PHPStan + `php -l` only). No functional change to test coverage.

## 2026-09-07 (later same day) — Profile::$model static/instance collision fix

`Modules\Blog\Http\Livewire\Profile` had `public BlogProfile $model;`
colliding with `Filament\Pages\Page`'s static `$model` — PHPStan
`property.nonStatic` (non-ignorable, a real PHP engine-level incompatibility).
Renamed to `$profile` throughout the class and `heading_photo.blade.php`.

No dedicated Pest test exists yet for `Modules\Blog\Http\Livewire\Profile`
(checked `Modules/Blog/tests` — no `*Profile*` file). Not adding one in
this pass: reproducing this class's Livewire mount cycle needs a real
`BlogProfile` fixture and this module's test harness wasn't otherwise
touched today. Flagged here as a coverage gap for a future pass, not
silently left undocumented.

phpstan analyse Modules/Blog: 0 errors (before this second fix: 1).
