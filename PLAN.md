# Plan: Refactor `routes/web.php` + Kandidat Controller

## Masalah saat ini

1. Nama route ganda `search.index` di `/` dan `/search` — nama kedua menimpa yang pertama.
2. Path `/search` didaftarkan dua kali dengan nama berbeda (`search.index` & `games.search`) — rawan konflik.
3. Semua halaman memakai Closure di `web.php`; logika bisnis (filter `?q=`, trending 10 game, map deskripsi) ada di blok `@php` dalam blade.
4. Login tidak punya handler POST — form `login.blade.php` POST ke route GET `login` (akan 405).
5. Bug redirect: `RegisterController` mengarah ke `route('dashboard')` yang tidak ada.
6. Logout pakai Closure (`Auth::logout()` + invalidate session) — pindah ke controller.

## Route target

| Method | URI | Aksi | Nama |
|---|---|---|---|
| GET | `/` | `HomeController@index` (render `homepage.blade.php`) | `home` |
| GET | `/search` | `GameController@search` (filter `?q=`) | `games.search` |
| GET | `/search/detail` | `GameController@show` (detail + deskripsi) | `games.detail` |
| GET | `/my-games` | `MyGamesController@index` | `myGames.index` |
| GET | `/price-compare` | `PriceCompareController@index` | `priceCompare.index` |
| GET | `/personal-score` | `PersonalScoreController@index` | `personalScore.index` |
| GET | `/login` | `Auth\LoginController@showLoginForm` | `login` |
| GET/POST | `/register` | `Auth\RegisterController` | `register` |
| POST | `/logout` | `Auth\LoginController@logout` | `logout` |

## Kandidat Controller (dibuat via `php artisan make:controller`)

- `HomeController` — `index()` → `view('homepage')`.
- `GameController` — `search()` (filter `config('games.list')` oleh `?q=` + trending games), `show()` (detail game + deskripsi).
- `MyGamesController` — `index()` → `view('myGames.index')`.
- `PriceCompareController` — `index()` → `view('priceCompare.index')`.
- `PersonalScoreController` — `index()` → `view('personalScore.index')`.
- `Auth\LoginController` — `showLoginForm()` → `view('auth.login')`, `logout()` (pindahan dari Closure lama).

## Perubahan lain

- `Auth\RegisterController` — redirect `route('dashboard')` → `route('home')`.
- `components/navbar.blade.php` — `search.index` → `games.search`, `routeIs('search.*')` → `routeIs('games.*')`.
- View search (`search/index`, `search/game-search`, `search/search-results`, `search/detail-game`) — terima data dari controller, hapus blok `@php` logika.

## Konvensi

- Semua pembuatan file yang punya fitur Laravel memakai `php artisan` (mis. `make:controller`), tidak menulis file dari awal.
- Tidak ada model/resource baru yang di-generate → controller dibuat tanpa `-m`/`-r`.

## Out of scope (dicatat)

- POST `/login` belum punya handler — perlu `AuthController@login` (`Auth::attempt` + remember) tersendiri nanti.

## Verifikasi

1. `php artisan route:list` — nama route bersih & unik.
2. `npm run build` — manifest build sukses.
3. Cek semua halaman (/, /search?q=, /my-games, /price-compare, /personal-score, /login, /register) status 200.
4. `php artisan test --compact` — test lolos.
5. `vendor/bin/pint --format agent` — sesuai gaya repo.
