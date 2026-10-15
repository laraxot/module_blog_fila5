---
title: "Blog — BMAD dossier"
type: bmad-module-dossier
module: Blog
status: baseline
updated: 2026-10-07
tags: [bmad, blog, content]
qmd: "Blog module purpose architecture PRD epics gaps release"
issues: ["https://github.com/laraxot/base_fixcity_fila5/issues/383"]
discussions: ["https://github.com/laraxot/base_fixcity_fila5/discussions/392"]
---
# Blog BMAD dossier
**Purpose / product brief:** publish municipal/editorial articles, categories, tags and feeds without mixing editorial content with Ticket workflow.
**Architecture:** module-owned Eloquent models, Filament administration, Cms/Lang/Seo integration; no domain logic in themes.
**PRD:** article lifecycle, draft/publish visibility, localized metadata, author permissions and feed correctness.
**Epics:** editorial lifecycle; moderation/permissions; localization and SEO.
**Discovered gaps:** verify publish scheduling, tenant scoping, media rights, moderation and feed/sitemap integration against current models/tests.
**Release gate:** editor/guest smoke, authorization denial, locale fallback, feed validation and PHPStan/Pest evidence.
