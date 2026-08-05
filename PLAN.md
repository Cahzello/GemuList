# UI Fix Plan — GemuList `resources/`

Errors found by examining all files under `resources/` that break the UI. Working space: `resources/`, plus the approved `vite.config.js` fix.

## 1. Duplicate navbar on Search page — HIGH
`resources/views/search/index.blade.php:7`
- Layout `index.blade.php:15` already renders `<x-navbar />`; the search page's `@section('content')` renders it a second time.
- Result: two navbars, duplicate IDs (`mobileMenuBtn`, `mobileMenu`, `userDropdownToggle`, `userDropdown`) → mobile hamburger & user dropdown break (JS binds to first copy, user clicks second).
- **Fix:** delete `<x-navbar />` on line 7.

## 2. Malformed closing tag `</d>` — HIGH
`resources/views/search/index.blade.php:24`
- Line 24 is `</d>` instead of `</div>`; the wrapper `<div>` opened on line 5 is never closed.
- **Fix:** change `</d>` → `</div>`.

## 3. `@vite` references missing from build input — RESOLVED
- All CSS entries are now present in `vite.config.js` `input` (navbar/footer/homepage/priceCompare), and `npm run build` emits a complete manifest.
- Note: the redundant `reset.css` entries were since removed from both `vite.config.js` and the blade `@vite` lists (see item 8).

## 4. UTF-8 BOM at start of components — LOW
`resources/views/components/navbar.blade.php:1`, `components/footer.blade.php:1`
- Files begin with a zero-width BOM rendered before `<nav>`/`<footer>`.
- **Fix:** strip the BOM from both files.

## 5. Homepage stylesheet loading — VERIFIED, no duplicate
`resources/views/homepage.blade.php:10-14`
- Homepage `@vite`s only its own CSS (`registrasi-gl.css`, `global.css`); navbar/footer CSS comes from the included components. No duplication.
- `homepage/reset.css` removed from the `@vite` list (see item 8).

## 6. Dead carousel JS — LOW
`resources/js/app.js:1` imports `./game-search`, which targets selectors (`.gl06__trending`, `.carousel-card`, `.gl06__nav-btn--*`) that no longer exist; the carousel is driven by the inline script in `game-search.blade.php`.
- **Fix:** remove `import './game-search';` from `app.js`.

## 7. Missing theme token breaks auth input borders — LOW
`resources/css/app.css` `@theme` defines `--color-input` but not `--color-input-border`, so `border-input-border` (used in `auth/login.blade.php` & `auth/register.blade.php`) generates nothing.
- **Fix:** add `--color-input-border` (e.g. `#2A2A2A`) to the theme.

## 8. Unlayered `reset.css` overrides Tailwind utility colors on buttons — RESOLVED
- `resources/css/navbar/reset.css`, `footer/reset.css`, `homepage/reset.css` were Tailwind preflight duplicates shipped as **unlayered** CSS loaded via `@vite` **after** `app.css`. Unlayered rules beat Tailwind v4's `@layer utilities`, so any button/input using utility classes lost its background, border, and text color (e.g. personalScore pagination, sort-bar buttons, myGames apply/sort/status/delete buttons).
- **Fix applied:** removed `reset.css` from `navbar.blade.php`, `footer.blade.php`, `homepage.blade.php` `@vite` lists and from `vite.config.js` input; deleted the three files. Tailwind v4 preflight (via `app.css`, `@layer base`) provides identical resets.

## Verification
1. Run `npm run build`; confirm `public/build/manifest.json` lists all entries.
2. Load `/`, `/search`, `/my-games`, `/price-compare`, `/personal-score`, `/login` — no duplicate navbar, no ViteException.
3. Run `vendor/bin/pint --dirty` per repo rules.

## Left as-is (noted, no change)
- `resources/css/detailgame.css`, `game-search.css`, `search-results.css` are orphaned/unreferenced — harmless.
- `personalScore/index.blade.php` lacks navbar/footer — consistency issue; add on request.
