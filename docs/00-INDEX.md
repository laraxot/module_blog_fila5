---
title: "Blog: indice operativo"
type: index
status: active
created: 2026-09-26
updated: 2026-10-16
module: Blog
tags: [blog, index, docs, fo, novità, eventi]
qmd: "blog indice operativo content_type post event ThemeComposer FO Sixteen commenti"
---

<!--
Supersedes: versione 2026-10-14 (claim errato «uso Fixcity: nessuno»; stale Predict).
Linked from: README.md, Comment/00-INDEX, Sixteen inbound-fo-blog, fo-comments.
User: «continua costantemente aggiornando studiando e migliorando e organizzando meglio le cartelle docs».
-->

# Blog: indice operativo canonico

Percorso: `laravel/Modules/Blog/docs/`. Alias `index.md` / `INDEX.md` / `00-index.md`
sono redirect qui. Identità e limiti: [README.md](./README.md).

## Perché esiste questo modulo

Pubblicare **novità** (`content_type=post`) e **eventi** (`content_type=event`)
per il cittadino, con authoring Filament e presentazione nel tema Sixteen.
Non mescolare il workflow Ticket.

## Stato verificato 2026-10-16

| Tema | Esito |
|---|---|
| Dominio | `Article` + Parental STI; [bmad/content-type-contract.md](./bmad/content-type-contract.md) |
| FO lista | `/it/blog`, `/it/events` — CMS `blog.index` / `events.index` + ThemeComposer |
| FO dettaglio | `/it/blog/{slug}`, `/it/events/{slug}` — blocchi Sixteen; **sempre `data-dc`** |
| Commenti FO | `CommentsWidget` (owner Comment) sul dettaglio |
| Consumatori | Sixteen, Fixcity (seeder/nav), Cms (Page JSON) |

## Da leggere per primi

1. [brainstorming-post-vs-article.md](./brainstorming-post-vs-article.md)
2. [bmad/content-type-contract.md](./bmad/content-type-contract.md)
3. [blueprints/inbound-blog-events.md](./blueprints/inbound-blog-events.md)
4. FO: [inbound-fo-blog.md](../../../Themes/Sixteen/docs/bmad/blueprints/inbound-fo-blog.md) · [inbound-fo-events.md](../../../Themes/Sixteen/docs/bmad/blueprints/inbound-fo-events.md)
5. Dettaglio+commenti: [blog-detail-data-dc-comments.md](../../../Themes/Sixteen/docs/bmad/investigations/blog-detail-data-dc-comments.md)
6. Commenti: [fo-comments/](../../Comment/docs/bmad/fo-comments/)
7. [bmad/README.md](./bmad/README.md) · [stories/](./stories/)

## Directory

| Percorso | Ruolo |
|---|---|
| `README.md`, `00-INDEX.md` | ingresso |
| `bmad/`, `blueprints/`, `stories/` | BMAD |
| `wiki/`, `models/`, `filament/` | tecnico |
| `raw/` | evidence |
| Root UPPERCASE (`PRD.md`, …) | redirect verso twin minuscolo |

## Moduli collegati

[Comment](../../Comment/docs/00-INDEX.md) · [Cms](../../Cms/docs/README.md) · [Fixcity](../../Fixcity/docs/README.md) · [Sixteen blog-public-index](../../../Themes/Sixteen/docs/bmad/blog-public-index.md)
