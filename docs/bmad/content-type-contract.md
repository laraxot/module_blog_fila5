---
title: "Blog Article: content_type e Parental STI"
type: decision-record
status: accepted
updated: 2026-10-15
tags: [blog, post, content-type, parental, event]
qmd: "content_type post event Parental type STI Article"
---

# Contratto dati Blog/Eventi

Il modello Eloquent resta `Modules\Blog\Models\Article`. Nel dominio il
concetto agnostico è **post**. Nel pilota non esiste un modello `Event`
separato.

| Campo | Contratto | Non confondere con |
|---|---|---|
| `content_type` | `post` = Novità/guida/story; `event` = Evento | `Article.type` |
| `Article.type` | `NULL` o FQCN classe figlia (Parental STI) | tassonomia editoriale |
| `event_start_date` / `event_end_date` | intervallo evento | discriminatore del contenuto |

`Article` usa `tightenco/parental` + `HasChildren`: `type` è il discriminatore
STI tecnico. **Non** deve contenere `post`, `event`, `article`, `blog`.
Form, seed e query usano **solo** `content_type`.

Decisione naming: [brainstorming-post-vs-article.md](../brainstorming-post-vs-article.md).

## Query e authoring

- lista Novità: `content_type=post` + stato/pubblicazione;
- lista Eventi: `content_type=event` + stato/pubblicazione;
- eventi futuri: `content_type=event` **e** `event_start_date > now()`;
- date richieste solo per `event`, con fine ≥ inizio;
- `content_type` nullo: non entrare in liste tipizzate senza fallback esplicito.

Filament: campo editabile `content_type`; `Article.type` fuori dal form
editoriale salvo necessità STI.
