# Dokumentasi Soal Tes Coding Medify

Dokumentasi resmi hasil pengerjaan **Soal Tes Coding Medify** yang dibangun berbasis framework Laravel dengan menerapkan prinsip OOP, Eloquent ORM, *Eager Loading*, dan *Automated Testing*.

---

## 📌 Fitur Utama yang Diimplementasikan

### 1. Upload Foto pada CRUD Master Items
- Penambahan kolom `foto` pada tabel `master_items`.
- Fitur unggah gambar dengan *validation*, penanganan *storage link* (`storage:link`), dan penghapusan otomatis foto lama saat update/delete.
- Tampilan thumbnail foto pada tabel index dan detail single item.

### 2. Perbaikan Bug Filter Harga Min dan Harga Max
- Perbaikan logika kueri pada `MasterItemsController@search`. Filter `hargamin` dan `hargamax` dievaluasi secara independen sehingga dapat digunakan sendiri-sendiri maupun bersamaan tanpa menghasilkan data kosong/error.
- Integrasi sinkronisasi DataTables AJAX realtime.

### 3. Modul CRUD Kategori Items (Many-to-Many)
- Skema database relasional: `kategori_items` (`kode`, `nama`) dan pivot table `kategori_item_master_item`.
- Relasi Eloquent `belongsToMany` pada model `MasterItem` dan `KategoriItem`.
- Halaman Index dengan filter pencarian berdasarkan Kode dan Nama Kategori.
- Halaman Detail Single Kategori yang menampilkan informasi kategori dan **tabel daftar item** yang terhubung (*eager loading*).
- Multi-select checkbox Kategori pada form tambah/edit Master Items.
- Link navigasi cepat "Master Items" dan "Kategori Items" pada Navbar utama.

### 4. Printout PDF Single Data Master Kategori
- Integrasi package `barryvdh/laravel-dompdf`.
- Fitur cetak PDF pada detail single kategori yang memuat Kode Kategori, Nama Kategori, Tabel Daftar Item terhubung, dan *timestamp* tanggal & waktu pencetak di bagian footer (`Dicetak pada: dd-mm-yyyy hh:mm:ss`).

### 5. Download Export Excel Master Items
- Fitur export Excel (`.csv` ber-encode UTF-8 BOM) yang kompatibel secara langsung dengan Microsoft Excel.
- Memuat 7 kolom sesuai ketentuan:
  1. `No`
  2. `Nama kategori` (terpisah koma)
  3. `Nama items`
  4. `Nama supplier`
  5. `Harga` (harga_beli)
  6. `Laba` (%)
  7. `Harga jual` (kalkulasi otomatis)

---

## 🛠️ Arsitektur & Best Practices

- **Eloquent Accessors**:
  - `$item->harga_jual`: Kalkulasi otomatis `harga_beli + (harga_beli * laba / 100)`.
  - `$item->foto_url`: Menghasilkan URL gambar dari storage disk public.
  - `$item->nama_kategori_list`: Menghasilkan string nama kategori terpisah koma.
- **Eager Loading**:
  - Menggunakan `MasterItem::with('kategoriItems')` dan `KategoriItem::with('masterItems')` untuk performa query optimal (mencegah masalah N+1 query).
- **Inheritance & Clean Code**:
  - Penggunaan struktur Controller, Model, Migration, dan Blade template modular yang konsisten dengan tema Master Items yang sudah ada.

---

## 🚀 Panduan Instalasi & Penggunaan

1. **Clone Repository & Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Pengaturan Database (`.env`)**:
   Sesuaikan konfigurasi database pada file `.env`.

3. **Jalankan Migration & Seeder**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Buat Symlink Storage**:
   ```bash
   php artisan storage:link
   ```

5. **Jalankan Server Development**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui `http://127.0.0.1:8000`.

---

## 🧪 Pengujian Otomatis (Automated Testing)

Project ini dilengkapi dengan *Feature Testing* komprehensif menggunakan PHPUnit:

Jalankan perintah pengujian:
```bash
php artisan test
```

### Coverage Pengujian (8/8 Passed):
- `MasterItemsTest`:
  - `test_can_create_master_item_with_photo_and_categories`
  - `test_price_filter_min_and_max_search`
  - `test_can_export_master_items_excel`
- `KategoriItemsTest`:
  - `test_can_create_and_search_kategori`
  - `test_single_view_displays_attached_items`
  - `test_can_export_kategori_pdf`

---

## 📄 Ringkasan Route Utama

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/master-items` | Index Master Items |
| `GET` | `/master-items/search` | AJAX Search & Filter Harga |
| `GET` | `/master-items/export-excel` | Download Export Excel Master Items |
| `GET` | `/kategori-items` | Index Kategori Items |
| `GET` | `/kategori-items/search` | AJAX Search Kategori |
| `GET` | `/kategori-items/view/{id}` | Detail Single Kategori + List Items |
| `GET` | `/kategori-items/export-pdf/{id}` | Download Export PDF Single Kategori |
