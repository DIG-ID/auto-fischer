# Changelog

All notable changes to this theme are documented in this file.
The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.3.0] — 2026-11-17

### Changed
- Build tooling migrated from Laravel Mix to Vite (dev server with HMR, hashed assets via manifest). Run `npm run dev` for local development and `npm run prod` before each deploy; requires Node `^20.19.0 || >=22.12.0`.

### Fixed
- 404 page background illustration now loads (the stylesheet pointed to a missing `assets/svg/` folder).

## [1.2.0] — 2026-10-28

### Added
- Styled checkboxes for Contact Form 7 forms (square boxes, blue when checked), in a 4-column grid or inline row.
- Werkstatt form: group labels and a dark dashed upload box for the vehicle registration photo.
- Anchor IDs on the Werkstatt sections (`#form`, `#services`, `#why-us`, `#contact`).

## [1.1.0] — 2026-10-28

First tracked release; earlier history lives in git.

### Added
- Werkstatt page template with intro and contact form sections.
- Werkstatt page uses the transparent header and full-bleed hero layout, like Home and Gut zu wissen.

### Changed
- Contact form grid now has a white background.
- Local dev: BrowserSync proxies the Local site over HTTPS (host can be overridden per machine).
