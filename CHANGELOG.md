# Changelog

All notable changes to this theme are documented in this file.
The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.7.1] — 2026-11-25

### Added
- Contact Form 7 sources in `contact-form-7/`: form markup (`forms/`) and the notification/confirmation emails as MJML (`emails/src/<lang>/<form>/`), with shared partials for font and logo.
- `npm run mail` / `npm run mail:watch` compile the emails to `contact-form-7/emails/html/` (ready to paste into CF7).

### Changed
- Email templates: logo now loads from the live site and the HTML is marked as German (`lang="de"`); Kontakt confirmation uses Swiss spelling ("Grüssen").

## [1.7.0] — 2026-11-25

### Added
- Werkstatt pre-footer: contact list with the Werkstatt phone and email (new ACF fields `contact_contacts_title`, `contact_contacts_telephone_text`, `contact_contacts_email_text`; Theme Options `general_phone_number_werkstatt`, `general_email_werkstatt`).

### Changed
- Footer phone number shows the Werkstatt number on the Werkstatt page (falls back to the general number when empty).

## [1.6.1] — 2026-11-23

### Changed
- Kontakt page: smaller bottom spacing under the form on desktop.

## [1.6.0] — 2026-11-23

### Added
- Kontakt page: separate contact cards for the showroom and the Werkstatt (address, email, phone, opening hours), below the form.
- Kontakt page: map with one marker per location (new ACF repeater `map_locations` with `location` and `label`); the label is shown as the marker's info window title.

### Changed
- Kontakt contact details moved out of the form section into the new contact cards, using page fields again.

## [1.5.0] — 2026-11-17

### Added
- Home page: third card for service and repairs next to buy and sell (new ACF fields `repair_title`, `repair_text`, `repair_button`, `repair_icon`).

### Changed
- Werkstatt pre-footer phone number now comes from the general Theme Options.

## [1.4.0] — 2026-11-17

### Added
- Werkstatt address and email on the Kontakt page, and the Werkstatt address in the footer (new ACF fields `general_address_werkstatt` in Theme Options and `contacts_email_werkstatt` on the Kontakt page).

### Changed
- Kontakt page address and phone now come from the general Theme Options instead of page fields.
- Footer heading "Adresse" renamed to "Adressen".

## [1.3.1] — 2026-11-17

### Fixed
- Admin/login styles load after WordPress core in development.
- The production build keeps the dev server's hot file.

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
