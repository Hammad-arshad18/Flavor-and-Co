# Flavour & Co. — Design System

> Page overrides live in `design-system/flavour-co/pages/`. If a page file exists,
> it overrides this Master. Otherwise follow this file.

**Project:** Flavour & Co. Restaurants Management
**Direction:** Editorial hospitality — warm, restrained, premium without gloss
**Stack:** Plain PHP 8 + hand-written CSS (no build step)

---

## 1. Content rules (non-negotiable)

- Only verified facts: business name, Dubai location, restaurant management activity,
  the published phone number and email address.
- **Never publish trade licence details**: licence number, issue/expiry dates,
  register number, DCCI number, D&B number, member names, parcel or office numbers.
- No invented statistics, awards, years in business, outlet counts or testimonials.
- Photography is licensed stock imagery. Label it as illustrative where a caption
  could imply it is the company's own venue. Credit Unsplash in the footer.
- Address is displayed only as **Dubai, United Arab Emirates**.

## 2. Colour

| Role | Value | Variable |
|------|-------|----------|
| Ink (primary dark) | `#17120e` | `--ink` |
| Ink soft | `#241d17` | `--ink-2` |
| Paper (page) | `#fbf8f2` | `--paper` |
| Cream (band) | `#f3ebdd` | `--cream` |
| Gold (accent) | `#c8a46b` | `--gold` |
| Gold deep (text on light) | `#856731` | `--gold-deep` |
| Muted text | `#675f56` | `--muted` |
| Line | `rgba(23,18,14,0.14)` | `--line` |
| Line on dark | `rgba(251,248,242,0.18)` | `--line-light` |

Rules:
- Gold is an accent, never the colour of body copy on light surfaces.
- Use `--gold-deep` for small gold text on cream/paper.
- Section rhythm alternates paper → paper → ink → cream → ink.
- Text on dark: `rgba(251,248,242,0.85)` for body, `#fbf8f2` for headings.

## 3. Typography

- **Display:** Cormorant Garamond (300/400/500 + italic)
- **Sans:** Montserrat (300/400/500/600)
- H1 hero: `clamp(3.1rem, 7.2vw, 6.4rem)`, line-height 0.97, weight 300.
- H1 inner pages: `clamp(2.8rem, 5.2vw, 4.9rem)`, max 22ch.
- H2: `clamp(2.35rem, 4.6vw, 3.9rem)`, max 20ch.
- H3: `clamp(1.4rem, 1.7vw, 1.7rem)`, weight 500.
- Body: 1rem / 1.7; long copy max 60ch.
- Eyebrow: 0.66rem, 600, 0.24em tracking, uppercase, 28px rule, gold deep.
- Italic serif is reserved for emphasis in headlines.

## 4. Layout & spacing

- Container: 1240px max, gutters `clamp(1.25rem, 4vw, 3.5rem)`.
- Section spacing: `clamp(4.5rem, 9vw, 8.5rem)`.
- Header height: 84px (76px ≤1020px).
- Grids collapse at 1020px (2-col → 1-col), 760px (mobile), 420px (compact).
- Use 1px hairlines rather than shadows to divide sections.
- Keep card radius at 0–2px; pills are reserved for buttons.

## 5. Components

### Buttons
- Pill, 48px min height, uppercase 0.72rem / 0.14em.
- Primary: gold fill + ink text.
- On light headers when scrolled: ink fill + paper text.
- On dark imagery: paper fill + ink text, or 1px outline.
- Hover uses colour/arrow movement only; no layout shift.

### Header
- Fixed, transparent over the page hero, cream + blur once scrolled (`.is-scrolled`).
- Mobile nav is a full-screen ink panel; toggles `aria-expanded`, locks body scroll,
  traps focus and returns focus to the toggle on close.

### Cards / services
- 1px grid lines, paper surface, no shadow.
- Number + icon top row; title; one-line summary; "Explore" cue.
- Entire card is clickable via a stretched link on the title.

### Forms
- Labels above fields, uppercase 0.6rem.
- Gold focus ring, red border + inline error for invalid fields.
- Error summary focused on submit; `aria-invalid` and `aria-describedby` set.
- Contact form posts to itself, validates server-side, sends via `mail()`.
  Never store submissions.

### Imagery
- Hero: full-bleed, dark gradient, portrait crop for ≤760px via `<picture>`.
- Content images: 4:5 or 16:10, optional offset gold rule.
- Always provide width/height, `loading="lazy"` below the fold, descriptive alt text.
- Captions on stock imagery say "Illustrative image".

## 6. Motion

- Reveal: opacity 0→1, translateY 26px→0, 0.85s `cubic-bezier(.22,.61,.36,1)`.
- Hero image: 2.2s scale 1.06→1.
- Ticker: 42s linear, duplicated groups for a seamless loop.
- All motion disabled under `prefers-reduced-motion: reduce`.
- `.js` is added by `main.js`, so content stays visible if JS fails.

## 7. Accessibility

- Skip link, visible `:focus-visible` rings, logical heading order.
- Touch targets ≥44px; mobile nav links full-width.
- Contrast: body text ≥4.5:1; do not place gold small text on cream.
- Decorative icons use `aria-hidden="true"`; icon-only controls have labels.
- Form errors announced via `role="alert"` summary and inline messages.
- Do not rely on colour alone for state.

## 8. Bilingual (English / Arabic)

- English is the default. Arabic is chosen with the header toggle and stored in
  `localStorage` under `flavour-lang`. Never put the language in the URL.
- Arabic sets `lang="ar"` and `dir="rtl"`; Amiri headings, Cairo body, no letter-spacing.
- Strings use `data-i18n` (text) or `data-i18n-html` (headings/labels with markup).
  Attributes use `data-i18n-aria`, `data-i18n-placeholder` and `data-i18n-alt`.
- Keep Latin values LTR: brand name, phone, email, legal name, form email/phone fields.
- Mirror direction-sensitive layout: hero gradients, offset image borders, arrows,
  place card and error-list bullets.
- Arabic display type is larger and needs more line-height; do not copy the
  English heading sizes or tracking.

## 9. Avoid

- Glassmorphism, neon, gradients unrelated to photography, stock "luxury" clichés.
- Generic marketing numbers, review quotes, logo walls or menu prices.
- Emoji as icons.
- Autoplay audio/video, parallax, or scroll-jacking.
