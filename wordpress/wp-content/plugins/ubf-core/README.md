# UBF Core

Small presentation-independent WordPress plugin for durable UBF Köln content.

## Registered content

### `ubf_sermon` — Predigten

- Archive/rewrite slug: `/predigten/`
- Block editor enabled through the REST API.
- Supports title, editor content, excerpt, featured image, and revisions.
- Structured metadata:
  - `ubf_bible_passage`
  - `ubf_speaker`
  - `ubf_media_url`
- Hierarchical taxonomy: `ubf_sermon_series` (`/predigtreihen/`).

### `ubf_event` — Veranstaltungen

- Archive/rewrite slug: `/veranstaltungen/`
- Block editor enabled through the REST API.
- Supports title, editor content, excerpt, featured image, and revisions.
- Structured metadata:
  - `ubf_start_at` — ISO 8601 date/time string
  - `ubf_end_at` — ISO 8601 date/time string
  - `ubf_location`
  - `ubf_registration_url`

## Boundaries

This plugin intentionally does **not** contain:

- colors, CSS, templates, or layout logic;
- analytics, cookies, consent logic, or third-party embeds;
- forms or newsletter integrations;
- fabricated demo content;
- automatic content deletion on uninstall/deactivation;
- event filtering/sorting assumptions that have not yet been editorially approved.

A later implementation phase can add editor controls or custom blocks for the registered metadata after the staging WordPress version and editor workflow are verified.
