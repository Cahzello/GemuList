# Plan: Integrasi API RAWG (Game) + CheapShark (Harga)

## Scope

- **Search game** (`GET /search`): pencarian lokal (tabel `games`) tetap prioritas. Jika hasil kosong → fetch **RAWG API** → simpan hasil ke tabel `games` (cache lokal) → query ulang.
- **Price Compare** (`/price-compare`): data harga per store dari **CheapShark API** → simpan ke `game_prices`. Saat game dicari tapi tidak ada harga di DB → fetch CheapShark → simpan.
- **Konversi mata uang:** harga CheapShark dalam USD dikonversi ke Rupiah via `https://open.er-api.com/v6/latest/USD` (rate di-cache 6 jam; fallback `IDR_FALLBACK_RATE=16000`).
- **Store:** memakai daftar **store aktif CheapShark** (Steam, GOG, Epic Games Store, Humble, Fanatical, dst). G2A dihapus karena tidak ada di CheapShark.
- **Seeder harga acak (`GamePriceSeeder`) dihapus** — harga murni dari CheapShark.
- RAWG memerlukan API key (`RAWG_API_KEY`); jika kosong, fetch RAWG dilewati (tampil "tidak ditemukan").
- Halaman `/search`, `/search/detail`, `/price-compare` tetap publik.

## Langkah

1. **Konfigurasi**
   - `.env` & `.env.example`: `RAWG_API_KEY=`, `CHEAPSHARK_URL=https://www.cheapshark.com/api/1.0`, `ER_API_URL=https://open.er-api.com/v6/latest/USD`, `IDR_FALLBACK_RATE=16000`.
   - `config/services.php`: blok `rawg`, `cheapshark`, `erapi`.

2. **Service (`app/Services/`)**
   - `ExchangeRateService` — `idr(): float`; fetch ER API → `rates.IDR`, cache 6 jam; gagal → fallback.
   - `RawgService` — `search(string $q, int $pageSize = 12): array`; `GET /games?key=&search=&page_size=`; mapping `title=name`, `image=background_image`; gagal/401 → `[]`.
   - `CheapSharkService` —
     - `syncStores(): void` — upsert 14 store aktif CheapShark (dengan `cheapshark_id`, homepage URL, icon).
     - `pricesFor(string $title): void` — `GET /games?title=` (buat game bila belum ada dari `external`+`thumb`) → `GET /deals?title=<external>` → `GamePrice::updateOrCreate` tiap store (harga = USD × `ExchangeRateService::idr()`).

3. **Migration**
   - `add_cheapshark_id_to_stores`: kolom `cheapshark_id` (nullable, unique) pada `stores`.

4. **Seeder**
   - `StoreSeeder` ditulis ulang → 14 store aktif CheapShark.
   - `GamePriceSeeder` dihapus + panggilannya dihapus dari `DatabaseSeeder`.

5. **Search (RAWG)**
   - `GameController@search`: query lokal dulu; jika `keyword != ''`, hasil kosong, dan key RAWG terisi → `RawgService::search` → `Game::updateOrCreate(['game_name'], ['thumbnail'])` → query ulang.
   - Teks kosong di `search-results.blade.php` disesuaikan (sudah dicoba ke DB & RAWG).

6. **Price Compare (CheapShark)**
   - Route baru `GET /price-compare/search` (publik) → JSON.
   - Logika: cari game lokal berharga via LIKE; jika kosong → `CheapSharkService::pricesFor(q)` → query ulang; struktur respons sama seperti sekarang (`id, title, thumbnail, stores[]`).
   - `priceCompare.js`: filter client-side (`window.games`) diganti fetch debounce ke endpoint; render & mobile tabs tetap.

7. **Testing (Pest)**
   - Unit: `ExchangeRateServiceTest`, `RawgServiceTest`, `CheapSharkServiceTest` — pakai `Http::fake()`.
   - Feature: search kosong → fetch RAWG & game tersimpan; `/price-compare/search` tanpa harga → fetch CheapShark & tersimpan.
   - Cek test lama yang merujuk `GamePriceSeeder` dan sesuaikan.

8. **Verifikasi**
   - `php artisan test --compact` hijau.
   - `vendor/bin/pint --format agent`.
   - `npm run build` (karena `priceCompare.js` diubah).
   - `php artisan migrate:fresh --seed` (store baru aktif, tanpa harga palsu).

## Catatan

- `GameFactory` & `GamePriceFactory` tetap dipakai test, tidak dihapus.
- Struktur kolom `games` tidak berubah (dedup berbasis `game_name`).
- CheapShark: harga per store lewat endpoint `/deals`; store aktif yang dipakai: Steam(1), GamersGate(2), GreenManGaming(3), GOG(7), Humble Store(11), Uplay(13), Fanatical(15), WinGameStore(21), GameBillet(23), Epic Games Store(25), Gamesplanet(27), Gamesload(28), IndieGala(30), DreamGame(35).
