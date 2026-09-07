---
name: blog-coverage
description: Coverage notes for Modules/Blog, tracked incrementally per fix
metadata:
  type: project
---

## 2026-09-07 — Profile::$model static/instance collision fix

`Modules\Blog\Http\Livewire\Profile` had `public BlogProfile $model;`
colliding with `Filament\Pages\Page`'s static `$model` — PHPStan
`property.nonStatic` (non-ignorable). Renamed to `$profile`.

No dedicated Pest test exists yet for `Modules\Blog\Http\Livewire\Profile`
(checked `Modules/Blog/tests` — no `*Profile*` file). Not adding one in
this pass: reproducing this class's Livewire mount cycle needs a real
`BlogProfile` fixture and this module's test harness wasn't otherwise
touched today. Flagged here as a coverage gap for a future pass, not
silently left undocumented.

phpstan analyse Modules/Blog: 0 errors (before this fix: 1).
