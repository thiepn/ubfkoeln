# UBF Köln Website V2 — WordPress foundation

This directory is the production implementation foundation for **P2-B**. The existing GitHub Pages stakeholder demo remains untouched and serves only as a visual/content reference.

## Architecture

- `wp-content/themes/ubf-v2/` — native WordPress block theme. Presentation, templates, template parts, patterns, and design tokens live here.
- `wp-content/plugins/ubf-core/` — small content-model plugin. Portable church content that must survive a theme change lives here.
- WordPress **6.6+** is the minimum target because the theme uses `theme.json` schema version 3.
- PHP **7.4+** is the conservative baseline until the STRATO/PHP audit is completed.

## Design constraints carried forward

- Editorial Fellowship direction: deep navy `#0B3654`, interactive blue `#2E6F94`, warm paper `#F7F4EE`, ink `#10232D`, white `#FFFFFF`, neutral `#E8EDF0`, stone `#D7C5AC`.
- Source Serif 4 for headings and Source Sans 3 for body/UI, with local/system fallbacks. No third-party font request is made by the theme; approved font files should be self-hosted before production launch.
- 1280px wide layout, 720px reading measure.
- Restrained square geometry, minimal shadow, no gradients, no glassmorphism, no decorative AI/stock imagery.
- Visitor UX takes priority over visual novelty: service information, directions, first-visit clarity, and concrete ministry facts must be easy to find.

## Content ownership

The theme must not own durable church content. `UBF Core` therefore registers the content types and structured metadata for sermons and events. The theme is free to change without making that content disappear.

No example sermon, event, service time, address, person, ministry fact, or other factual content is seeded here. Production content must come from verified UBF Köln source material.

## Installation on staging

1. Copy `wp-content/themes/ubf-v2` into the staging WordPress installation.
2. Copy `wp-content/plugins/ubf-core` into the staging WordPress installation.
3. Activate **UBF Core** first, then activate **UBF Köln V2**.
4. Open **Settings → Permalinks** and save once if routes were already cached before plugin activation.
5. Create/verify the canonical pages used by the shell (`Besuchen`, `Über uns`, `Gemeinschaft`, `Glauben entdecken`) before publishing the navigation.
6. Add only verified real content and approved photography.

## Release gates still required

This foundation is intentionally **not a production activation**. Before the live WordPress site is switched over:

- P1-R must be run against a real production-faithful prototype/staging build and pass responsive, accessibility, content, and visual QA.
- P2-A must be completed with the missing WordPress Site Health export and STRATO/PHP/server configuration.
- Existing URLs, redirects, SEO metadata, analytics/cookie requirements, forms, backups, and rollback must be verified on staging.
- Performance and accessibility must be tested with real content and real media, not placeholders.
