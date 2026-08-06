# Pencapaian Project GemuList

## Ringkasan
- Web app manajemen list game berbasis **Laravel 13**, **Tailwind CSS 4**, **Vite**, dan **Pest** untuk testing.
- Seluruh fitur utama sudah terhubung ke database MySQL (tidak lagi data statis/`localStorage`).

## Fitur & Halaman
- **Homepage** — halaman beranda.
- **Search Game** — cari game berdasarkan nama + daftar trending game.
- **Price Compare** — perbandingan harga game antar store lengkap dengan link toko.
- **My Games** — daftar game di library user beserta status, tambah, ubah status, dan hapus.
- **Personal Score** — beri score (1–10) dan review untuk game yang sudah selesai/di-drop.
- **Auth** — login & register via Laravel Breeze.

## Backend / Database (MySQL)
- Schema tabel: `users`, `games`, `stores`, `game_prices`, `my_games` dengan primary key custom (`id_user`, `id_game`, `id_myGame`, `id_store`, `id_gamePrice`) dan tanpa timestamps.
- 5 model dengan relasi Eloquent (`Game`, `Store`, `GamePrice`, `MyGame`, `User`).
- Migrasi & seeder idempotent (`updateOrCreate`) — aman dijalankan berulang.
- Data seed:
  - 69 game (dibaca dari `config/games.php`),
  - 4 store (termasuk kolom `url`),
  - 276 harga game per store,
  - 18 entri library untuk user demo `budi`,
  - 2 user (termasuk `testuser`).

## Integrasi Data (statis → dinamis)
- Semua halaman membaca dari database:
  - **My Games** — daftar library user.
  - **Personal Score** — score & review per game.
  - **Price Compare** — harga + link per store.
  - **Search & halaman detail** — hasil pencarian dan informasi game.
- Aksi tulis tersimpan permanen ke database:
  - `PATCH` ubah status game di library,
  - `DELETE` hapus game dari library,
  - `POST` simpan score & review,
  - `POST` tambah game ke library.

## Fitur "Add to My Games"
- Endpoint `POST /my-games` (wajib login) dengan validasi `id_game` dan `status`.
- Duplikat `(id_user, id_game)` → respons **409**; sukses → **201**.
- **Server-render flag**: game yang sudah ada di library langsung dirender tombol disabled berteks **"Added"** di halaman detail, dari mana pun user mengaksesnya dari hasil pencarian.
- Kirim data via `fetch` + CSRF token; guest / sesi kedaluwarsa (401/403) diarahkan ke halaman login.

## Keamanan
- **Ownership check** pada setiap aksi (ubah status, hapus, score/review) — akses ke data milik user lain ditolak dengan **403**.
- Validasi server-side untuk semua input (status enum, rentang score, panjang review, keberadaan game).
- `bootstrap/app.php` dikonfigurasi agar request AJAX/JSON menerima respons validasi dalam format **JSON (422)**.

## Testing (Pest) — 28 test / 51 assertion, semua pass
- **MyGames**: wajib login (401), tambah sukses (201), duplikat (409), status invalid (422), game tidak ada (422), hapus + larangan akses antar user, render tombol `Added` / aktif di halaman detail.
- **PersonalScore**: tampilkan & perbarui score/review, validasi, dan ownership.
- Semua verifikasi terakhir: `php artisan test --compact` ✅, `vendor/bin/pint --dirty --format agent` ✅, `npm run build` ✅.

## Perbaikan & Keputusan Teknis
- Konfigurasi store diperluas dengan kolom `url` (untuk link beli).
- `dbPriceCompare.js` dihapus dan dihapus dari input Vite → bundle lebih ramping.
- Standarisasi nilai status `on_progress` → `progress` (konsisten dengan database).
- Logika penambahan game lama (berbasis `localStorage`) dihapus, diganti simpan ke database.

## Perintah Verifikasi
```bash
php artisan test --compact
vendor/bin/pint --dirty --format agent
npm run build
```

## Fitur / Perbaikan Terbaru: Link Deal CheapShark (`dealUrl`)

- Tombol **"GO TO STORE"** di Price Compare kini memakai **link redirect deal CheapShark** (`https://www.cheapshark.com/redirect?dealID=<dealID>`), bukan homepage store.
- Migration baru `add_deal_url_to_game_prices_table` — kolom `dealUrl VARCHAR(255) NULL` di tabel `game_prices` (camelCase, konsisten dgn `retailPrice`).
- `CheapSharkService::pricesFor()` menyimpan `dealUrl` dari `$deal['dealID']` saat `GamePrice::updateOrCreate`.
- `GamePrice` model: `dealUrl` masuk `$fillable`; factory mendapat default redirect URL.
- `PriceCompareController::gamesWithPrices()`: `url = dealUrl ?: store.url` (baris lama tanpa `dealUrl` fallback ke homepage store).
- Update test: assert `dealUrl` tersimpan di DB (unit) & muncul sebagai `url` di JSON (feature).
- Verifikasi: `php artisan migrate` ✅, 44 test / 100 assertion ✅, pint ✅. Tidak ada perubahan frontend (`priceCompare.js` tetap memakai `store.url`).
