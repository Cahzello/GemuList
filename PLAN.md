# Plan: Autentikasi dengan Laravel Breeze (Blade)

## Scope

**Masuk:** login, register, logout — redirect pasca login/register ke `games.search` (`/search`).
**Skip:** forgot/reset password, verifikasi email (MustVerifyEmail nonaktif), halaman profil, dashboard Breeze.

**Proteksi autentikasi (`middleware('auth')`):**
- `GET /my-games` (`myGames.index`) + route asosiasinya.
- `GET /personal-score` (`personalScore.index`) + route asosiasinya.
- Guest yang membuka halaman tersebut diarahkan ke `route('login')`, lalu kembali via `intended()`.

**Tetap publik (tanpa autentikasi):**
- `/` (`home`), `/search` (`games.search`), `/search/detail` (`games.detail`), `/price-compare`, `/login`, `/register`.
- Guest bebas mencari game & melihat detail.

## Langkah

1. Install Breeze: `composer require laravel/breeze --dev` → `php artisan breeze:install blade --pest --no-interaction`.
2. Pulihkan file yang berisiko tertimpa Breeze:
   - `resources/js/app.js` (Alpine + `import './personalScore'`).
   - `resources/css/app.css` (`@theme` + `@import 'Mygames.css'`).
   - Cek `vite.config.js` & `package.json`; `npm install` hanya bila perlu.
3. Route:
   - `bootstrap/app.php` → verifikasi `routes/auth.php` terdaftar.
   - `routes/auth.php` → sisakan login/register/logout saja.
   - `routes/web.php` → hapus route auth custom + route `/dashboard` & `/profile` Breeze; beri `middleware('auth')` pada `myGames.index` & `personalScore.index`; redirect pasca login/register → `games.search`.
4. Hapus controller custom lama (`Auth/RegisterController.php`, `Auth/LoginController.php`) + controller Breeze tak terpakai (reset password, verify email, confirm password, profile).
5. Hapus view tak terpakai: `auth/{forgot-password,reset-password,verify-email,confirm-password}.blade.php`, `profile/*`, `dashboard.blade.php`, `layouts/{app,navigation}.blade.php`.
6. Restyle `layouts/guest.blade.php`, `auth/login.blade.php`, `auth/register.blade.php` ke tema gelap (bg `#141414`, aksen `#FF6B35`, font Sora/Inter, card auth custom; field register memakai `name`).
7. Navbar (`components/navbar.blade.php`):
   - Guest: tombol "Login" → `route('login')`.
   - Logged in: "Hi, {Auth::user()->name}!" + dropdown Logout.
   - Mobile menu menyesuaikan.
8. Test: buang test Breeze untuk fitur yang di-skip (`PasswordResetTest`, `EmailVerificationTest`, `PasswordConfirmationTest`, `ProfileTest`); sesuaikan redirect assertion `AuthenticationTest`/`RegistrationTest` → `/search`.
9. Verifikasi:
   - `php artisan test --compact` hijau.
   - `npm run build`.
   - Alur manual: register → `/search`, login → `/search`, logout → `/`; guest search tetap 200; `/my-games` & `/personal-score` redirect ke login saat guest lalu kembali setelah login.
   - `vendor/bin/pint --format agent`.

## Catatan

- Tidak ada migrasi baru (tabel `users`, `password_reset_tokens`, `sessions` sudah ada).
- Breeze menambah dependency dev `laravel/breeze`.
