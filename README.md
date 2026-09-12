# 🏥 Medify Coding Test - Project Documentation

[![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-14%2F14%20Passed-2496ED?style=for-the-badge&logo=php&logoColor=white)](https://phpunit.de)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

Dokumentasi lengkap implementasi sistem **Master Items & Kategori Items** untuk Medify Coding Test. Proyek ini dibangun menggunakan framework **Laravel 9** dengan menerapkan prinsip-prinsip **OOP, Eloquent ORM, Many-to-Many Relationships, Eager Loading, SweetAlert2 UX, dan Automated Testing**.

---

## 📂 Struktur Direktori Proyek

```text
dwi-lutfi-medify-coding-test/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Auth/
│   │       │   ├── LoginController.php          # Controller Autentikasi Login & Logout
│   │       │   ├── RegisterController.php       # Controller Pendaftaran User Baru
│   │       │   └── ForgotPasswordController.php
│   │       ├── HomeController.php
│   │       ├── MasterItemsController.php        # Controller CRUD Master Items & Excel Export
│   │       └── KategoriItemsController.php      # Controller CRUD Kategori & PDF Export
│   └── Models/
│       ├── MasterItem.php                       # Model MasterItem + Accessors (harga_jual, foto_url)
│       ├── KategoriItem.php                     # Model KategoriItem + BelongsToMany Relation
│       ├── Pasien.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── 2022_11_05_005605_create_master_items_table.php
│   │   ├── 2026_09_12_000001_add_foto_to_master_items_table.php
│   │   ├── 2026_09_12_000002_create_kategori_items_table.php
│   │   └── 2026_09_12_000003_create_kategori_item_master_item_table.php   # Pivot Table
│   └── seeders/
│       └── DatabaseSeeder.php                   # Seeder sampel item & kategori
├── public/
│   ├── images/
│   │   └── logo.jpg                             # Brand Logo Resmi Aplikasi
│   └── storage/ -> storage/app/public           # Symlink storage foto item
├── resources/
│   ├── sass/
│   │   └── app.scss                             # Modern Design System (Plus Jakarta Sans, Compact UI)
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php                  # Halaman Login + Brand Logo + Eye Toggle Password
│       │   └── register.blade.php               # Halaman Register + Brand Logo + Eye Toggle
│       ├── layouts/
│       │   └── app.blade.php                    # Layout utama + Navbar Auth + SweetAlert2 Engine
│       ├── master_items/
│       │   ├── index/
│       │   │   ├── index.blade.php              # Halaman Index Master Items
│       │   │   ├── filter.blade.php             # Filter Kode, Nama, Harga Min, Harga Max
│       │   │   ├── table.blade.php              # DataTables Responsive
│       │   │   └── js.blade.php                 # Datatables AJAX handler
│       │   ├── form/
│       │   │   ├── index.blade.php
│       │   │   └── form.blade.php               # Form Tambah/Edit + Foto Upload + Multi Kategori
│       │   ├── single/
│       │   │   └── index.blade.php              # Detail Item Single View
│       │   └── excel/
│       │       └── template.blade.php           # Template Styled Spreadsheet Excel (.xls)
│       └── kategori_items/
│           ├── index/
│           │   ├── index.blade.php              # Halaman Index Kategori
│           │   ├── filter.blade.php             # Filter Kode & Nama
│           │   ├── table.blade.php
│           │   └── js.blade.php
│           ├── form/
│           │   ├── index.blade.php
│           │   └── form.blade.php               # Form Tambah/Edit Kategori
│           ├── single/
│           │   └── index.blade.php              # Detail Single Kategori + List Item Terhubung
│           └── pdf/
│               └── template.blade.php           # Template Printout PDF DomPDF
├── routes/
│   └── web.php                                  # Route Endpoints Aplikasi
├── storage/
│   └── app/public/items/                       # Direktori Penyimpanan Foto Upload Item
└── tests/
    └── Feature/
        ├── AuthenticationTest.php               # Test suite Render, Login, Register, Logout
        ├── MasterItemsTest.php                  # Test suite CRUD, Foto, Filter, Excel Export
        └── KategoriItemsTest.php                # Test suite CRUD Kategori, Search, PDF Export
```

---

## 📊 Skema Database & Relasi

### Relasi Many-to-Many
`master_items` **M : N** `kategori_items` dihubungkan melalui tabel pivot `kategori_item_master_item`.

- **`master_items`**: `id`, `kode`, `nama`, `foto`, `harga_beli`, `laba`, `supplier`, `jenis`, `created_at`, `updated_at`, `deleted_at`.
- **`kategori_items`**: `id`, `kode`, `nama`, `created_at`, `updated_at`, `deleted_at`.
- **`kategori_item_master_item`**: `id`, `kategori_item_id`, `master_item_id`, `created_at`, `updated_at`.

---

## 📌 Rincian Fitur Utama

### 1. Upload Foto pada CRUD Master Items
- Mendukung unggah gambar item (`.jpg`, `.jpeg`, `.png`, `.webp`).
- Penanganan otomatis pembuatan file unik dan pembersihan foto lama saat update/delete.
- Accessor Eloquent `$item->foto_url` untuk mendapatkan URL publik secara fleksibel.

### 2. Fitur Filter Harga Min dan Harga Max (Bug Fixed)
- Kueri diperbaiki pada `MasterItemsController@search` menggunakan `$request->filled()`.
- Filter `hargamin` (>=) dan `hargamax` (<=) bekerja secara mandiri maupun bersamaan tanpa menghasilkan error data kosong.

### 3. Modul CRUD Kategori Items (Many-to-Many)
- Pengelolaan master kategori (Kode & Nama).
- Eager Loading `MasterItem::with('kategoriItems')` dan `KategoriItem::with('masterItems')` mencegah masalah *N+1 query*.
- Multi-select checkbox Kategori pada form tambah/edit Master Items.

### 4. Printout Export PDF Single Kategori
- Menggunakan library `barryvdh/laravel-dompdf`.
- Mencetak detail Kategori, Kode Kategori, Tabel Daftar Item terhubung, dan Footer tanggal/waktu pencetakan (`Dicetak pada: dd-mm-yyyy hh:mm:ss`).
- Dilengkapi konfirmasi SweetAlert2 modal sebelum mengunduh PDF.

### 5. Export Excel Master Items (Styled Spreadsheet)
- Mengunduh data dalam format Spreadsheet Excel (`.xls`) profesional dengan desain bermerek.
- **Styling Premium**: Header banner dark slate (`#1e293b`), timestamp pencetakan, zebra striping baris (`#f8fafc`), format mata uang Rupiah (`Rp 15.000`), persen laba (`20%`), border rapi, & baris **Total Keseluruhan** di bagian footer.
- Memuat 7 kolom sesuai ketentuan:
  1. `No`
  2. `Nama kategori` (terpisah koma)
  3. `Nama items`
  4. `Nama supplier`
  5. `Harga` (harga_beli)
  6. `Laba` (%)
  7. `Harga jual` (kalkulasi otomatis)

### 6. Interactive SweetAlert2 UX Feedback
- **Konfirmasi Hapus**: SweetAlert2 Warning Modal saat mengklik tombol Hapus (`.btn-confirm-delete`).
- **Konfirmasi Export Excel**: SweetAlert2 Modal Question sebelum mengunduh Excel (`.btn-export-excel`).
- **Konfirmasi Export PDF**: SweetAlert2 Modal Question sebelum mengunduh PDF (`.btn-export-pdf`).
- **Toast Notifications**: Notifikasi pop-up otomatis setelah berhasil melakukan operasi CRUD.

### 7. Otentikasi, Brand Logo & Password Eye Toggle
- **Keamanan Route**: Proteksi route `MasterItemsController` & `KategoriItemsController` dengan `$this->middleware('auth')`.
- **Navbar Autentikasi**: Navbar disembunyikan secara kondisional jika user belum login (`@auth` wrapper) agar tampilan login/register bersih.
- **Brand Logo Header**: Menampilkan logo resmi (`public/images/logo.jpg`) pada header card login, register, dan navbar.
- **Password Eye Icon Toggle**: Tombol mata interaktif toggle tampilkan/sembunyikan karakter password (`bi bi-eye` / `bi bi-eye-slash`) pada form login & register.

---

## 🌐 Daftar Endpoint (Routes)

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/master-items` | Halaman Index Master Items |
| `GET` | `/master-items/search` | AJAX Search & Filter Harga |
| `GET` | `/master-items/form/{method}/{id?}` | Form View Create / Edit Item |
| `POST` | `/master-items/form/{method}/{id?}` | Submit Create / Edit Item + Foto + Kategori Sync |
| `GET` | `/master-items/view/{kode}` | Single View Detail Item |
| `GET` | `/master-items/delete/{id}` | Soft Delete Master Item |
| `GET` | `/master-items/export-excel` | Export Data Master Items ke Excel |
| `GET` | `/kategori-items` | Halaman Index Kategori Items |
| `GET` | `/kategori-items/search` | AJAX Search Kategori |
| `GET` | `/kategori-items/form/{method}/{id?}` | Form View Create / Edit Kategori |
| `POST` | `/kategori-items/form/{method}/{id?}` | Submit Create / Edit Kategori |
| `GET` | `/kategori-items/view/{id}` | Single View Kategori + List Item Terhubung |
| `GET` | `/kategori-items/delete/{id}` | Soft Delete Kategori |
| `GET` | `/kategori-items/export-pdf/{id}` | Export Laporan Single Kategori ke PDF |

---

## 🛠️ Cara Menginstal & Menjalankan Proyek

1. **Clone Repository**:
   ```bash
   git clone <URL_REPOSITORY>
   cd dwi-lutfi-medify-coding-test
   ```

2. **Install Composer & NPM Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment (`.env`)**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Migration & Seeder**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Buat Storage Symlink**:
   ```bash
   php artisan storage:link
   ```

6. **Build Asset & Jalankan Server**:
   ```bash
   npm run build
   php artisan serve
   ```
   Aplikasi siap diakses di `http://127.0.0.1:8000`.

---

## 🧪 Panduan Cara Pengujian Code (Automated Testing)

Proyek ini telah dilengkapi dengan unit & feature testing komprehensif menggunakan PHPUnit dan trait `DatabaseTransactions` sehingga **data pengembangan lokal tidak akan terhapus saat testing dijalankan**.

### 1. Jalankan Seluruh Test Suite
Untuk mengeksekusi seluruh 14 test kasus sekaligus, jalankan perintah berikut di terminal:

```bash
php artisan test
```

atau menggunakan binary phpunit langsung:

```bash
./vendor/bin/phpunit
```

### 2. Jalankan Test Per-Modul / Spesifik Class

- **Menguji Modul Otentikasi** (Render Login, Authenticate, Invalid Password, Render Register, Register User Baru, Logout):
  ```bash
  php artisan test --filter AuthenticationTest
  ```

- **Menguji Modul Master Items** (CRUD, Upload Foto, Filter Harga Min/Max, & Export Excel):
  ```bash
  php artisan test --filter MasterItemsTest
  ```

- **Menguji Modul Kategori Items** (CRUD Kategori, Search, Single View List Item, & Export PDF):
  ```bash
  php artisan test --filter KategoriItemsTest
  ```

### 3. Rincian Coverage Test Case (14/14 PASSED)

```text
PASS  Tests\Unit\ExampleTest
  ✓ that true is true

PASS  Tests\Feature\AuthenticationTest
  ✓ login screen can be rendered
  ✓ users can authenticate using the login screen
  ✓ users can not authenticate with invalid password
  ✓ register screen can be rendered
  ✓ new users can register
  ✓ users can logout

PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response

PASS  Tests\Feature\KategoriItemsTest
  ✓ can create and search kategori
  ✓ single view displays attached items
  ✓ can export kategori pdf

PASS  Tests\Feature\MasterItemsTest
  ✓ can create master item with photo and categories
  ✓ price filter min and max search
  ✓ can export master items excel

Tests:  14 passed (100% Green)
Time:   1.14s
```
