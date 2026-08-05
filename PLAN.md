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

## 3. `@vite` references missing from build input — HIGH (breaks production)
- Referenced in blade files but absent from `vite.config.js` `input` (lines 9–15):
  - `resources/css/navbar/global.css`, `navbar.css`, `reset.css` (navbar.blade.php:1-5)
  - `resources/css/footer/global.css`, `footer.css`, `reset.css` (footer.blade.php:1-5)
  - `resources/css/homepage/registrasi-gl.css`, `global.css`, `reset.css` (homepage.blade.php:10-20)
  - `resources/css/priceCompare.css` (priceCompare/index.blade.php:8)
- Current `public/build/manifest.json` only contains `app.css` + `app.js` → Laravel throws `ViteException: Unable to locate file in Vite manifest` in production (works only under `npm run dev`).
- **Fix:** add the 7 missing CSS entries to `vite.config.js` input, then run `npm run build`.

## 4. UTF-8 BOM at start of components — LOW
`resources/views/components/navbar.blade.php:1`, `components/footer.blade.php:1`
- Files begin with a zero-width BOM rendered before `<nav>`/`<footer>`.
- **Fix:** strip the BOM from both files.

## 5. Duplicate stylesheet loading on homepage — LOW
`resources/views/homepage.blade.php:10-20`
- Homepage `@vite`s navbar/footer CSS itself AND includes the components, which `@vite` the same files → same 6 stylesheets loaded twice.
- **Fix:** delete the homepage `@vite` list (lines 10–20); styles now come only from the components.

## 6. Dead carousel JS — LOW
`resources/js/app.js:1` imports `./game-search`, which targets selectors (`.gl06__trending`, `.carousel-card`, `.gl06__nav-btn--*`) that no longer exist; the carousel is driven by the inline script in `game-search.blade.php`.
- **Fix:** remove `import './game-search';` from `app.js`.

## 7. Missing theme token breaks auth input borders — LOW
`resources/css/app.css` `@theme` defines `--color-input` but not `--color-input-border`, so `border-input-border` (used in `auth/login.blade.php` & `auth/register.blade.php`) generates nothing.
- **Fix:** add `--color-input-border` (e.g. `#2A2A2A`) to the theme.

## Verification
1. Run `npm run build`; confirm `public/build/manifest.json` lists all entries.
2. Load `/`, `/search`, `/my-games`, `/price-compare`, `/personal-score`, `/login` — no duplicate navbar, no ViteException.
3. Run `vendor/bin/pint --dirty` per repo rules.

## Left as-is (noted, no change)
- `resources/css/detailgame.css`, `game-search.css`, `search-results.css` are orphaned/unreferenced — harmless.
- `personalScore/index.blade.php` lacks navbar/footer — consistency issue; add on request.
