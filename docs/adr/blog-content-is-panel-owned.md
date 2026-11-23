---
status: accepted
module: Blog
---

# Il contenuto Blog è governato dal pannello owner

## Contesto

Articoli e contenuti editoriali hanno ciclo di revisione e pubblicazione distinto dalla resa del tema.

## Decisione

Il modulo Blog possiede modello, policy, risorse Filament e stato editoriale; il tema rende soltanto contenuti pubblicati.

## Driver della decisione

- Separare workflow editoriale e presentazione.

## Alternative scartate

- Inserire articoli statici nelle view del tema.
- Consentire alla view di bypassare lo stato editoriale.

## Conseguenze

La pubblicazione è centralizzata e localizzabile; i cambi visuali non alterano il workflow editoriale.

## Conferma

Verificare resource, policy e stato di pubblicazione prima di esporre un contenuto.
