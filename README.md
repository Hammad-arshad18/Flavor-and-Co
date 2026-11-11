# Flavour & Co. — website

A small, static-feeling website for **Flavour & Co Restaurants Management L.L.C**, a
restaurant management company in Dubai, United Arab Emirates.

Built with plain PHP 8 and hand-written CSS. No framework, database, build step or
composer dependencies.

## Run locally

```bash
php -S 127.0.0.1:8080 router.php
```

Then open <http://127.0.0.1:8080>.

`router.php` is required for clean URLs. It serves:

- `/`
- `/about`
- `/services`
- `/contact`

Direct requests to `/about.php` are redirected permanently to `/about`; unknown
paths show the branded `404.php` page.

On Apache or Nginx, add an equivalent rewrite so the clean paths map to the PHP
files (or run the site behind a front controller). The PHP itself does not depend
on the router.

## Languages

English is the default. The `AR` button in the header switches the interface to
Arabic and stores the choice in `localStorage` under `flavour-lang` (`en` or `ar`).
The choice survives navigation and future visits. There is no language query
parameter and nothing is stored server-side.

Arabic applies:

- `lang="ar"` and `dir="rtl"` on the document
- Amiri (headings) and Cairo (body) from Google Fonts
- translated page titles, meta descriptions, navigation, content, form labels,
  validation errors, success messages and image alt text
- mirrored layout details and left-pointing arrow icons

To return to English, press the `EN` button. To reset a visitor manually, clear
the `flavour-lang` key from localStorage.

## Structure

```
index.php          Home
about.php          About
services.php       Services (anchors: #operations, #concept, #kitchen, ...)
contact.php        Contact + enquiry form
404.php            Not-found page
router.php         Clean URLs for PHP's built-in server
inc/config.php     Site details, services, approach, principles, SMTP
inc/functions.php  Escaping, current route, inline SVG icons
inc/mailer.php     Minimal SSL SMTP client for the contact form
inc/header.php     Document head, header, language toggle, mobile navigation
inc/footer.php     Footer and script includes
inc/cta.php        Shared enquiry band
assets/css/        Design tokens, RTL rules and all page styles
assets/js/i18n.js  Arabic dictionary and localStorage language layer
assets/js/         Header state, mobile nav, reveal-on-scroll
assets/img/        Optimised imagery and favicon
design-system/     Design system reference (not served content)
```

## Content accuracy

The site deliberately publishes only verified facts:

- Business name: Flavour & Co Restaurants Management L.L.C
- Activity: restaurant management
- Address: Dubai, United Arab Emirates (general location, as requested)
- Phone and email as provided

No trade licence number, issue/expiry date, register number, DCCI/D&B number,
member details, parcel ID or office number is published anywhere in the site.
No statistics, awards, years-in-business claims or testimonials were invented.

## Contact form

`contact.php` validates on the server, uses a session CSRF token and a honeypot,
then sends the message over SMTP. It does not write to a database or store
submission data.

SMTP settings live in `inc/config.php`:

- Host: `send.one.com`
- Port: `465` (implicit SSL)
- Sender / login: `no-reply@whiteseastar.com`
- Authentication: `AUTH LOGIN`
- Recipient: `$to = 'info@whiteseastar.com';` in `inc/config.php`

To change the receiving address, edit the single `$to` line in `inc/config.php`.
No other file needs to change.

The message is sent as UTF-8 plain text with the visitor's address as `Reply-To`.
If SMTP fails, the visitor sees a fallback message and the SMTP error is written to
the PHP error log without exposing credentials. The published public address in
`SITE_EMAIL` remains the fallback contact.

One.com uses `AUTH LOGIN` on this account. If the server answers `535`, the supplied
mailbox password or username is being rejected — update `SMTP_USER` / `SMTP_PASS` in
`inc/config.php`. The SMTP password is stored there as requested; keep that file out
of public version control and move the credentials to environment variables or the
host's secret storage before deploying publicly.

## Imagery

Photography is licensed stock imagery from [Unsplash](https://unsplash.com) and is
used illustratively. It does not depict the company's own venues. The footer states
this on every page.

Source images (`https://images.unsplash.com/<id>`):

| File | Source id |
|------|-----------|
| hero-dining.jpg | photo-1517248135467-4c7edcad34c4 |
| hero-dining-mobile.jpg | portrait crop of the above |
| interior.jpg | photo-1552566626-52f8b828add9 |
| chef.jpg | photo-1577219491135-ce391730fb2c |
| plated.jpg | photo-1414235077428-338989a2e8c0 |
| dubai.jpg | photo-1512453979798-5ea266f8880c |
| terrace.jpg | photo-1559339352-11d035aa65de |
| grill.jpg | photo-1544025162-d76694265947 |
| cocktail.jpg | photo-1470337458703-46ad1756a187 |

Only large-format derivatives (`-800.jpg`) are served to small screens through
`srcset`.

## Browser support

Modern evergreen browsers. Progressive enhancement: without JavaScript the site
remains fully readable and the enquiry form still works.

## Design

See `design-system/flavour-co/MASTER.md` for colour, type, spacing, motion and
accessibility rules.
