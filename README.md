# Sistem Peminjaman Ruangan

## 1. Judul Proyek & Ringkasan
**Sistem Peminjaman Ruangan**
Sistem informasi web untuk manajemen peminjaman dan pemesanan ruangan/kamar di suatu fasilitas (seperti institusi atau perusahaan). Berbasis kontrol akses multi-peran, aplikasi ini menyederhanakan operasi dari pengajuan peminjam hingga pemantauan sarpras, serta menyediakan rekam jejak dan laporan pemesanan melalui kalender yang komprehensif.

## 2. Teknologi yang Digunakan (Tech Stack)
- **Frontend**: Laravel UI, Blade Template Engine, Tailwind CSS
- **Backend**: PHP 8.2+, Laravel Framework v11.31
- **Reporting/Export**: barryvdh/laravel-dompdf (PDF), maatwebsite/excel (Laporan Excel)
- **Database**: MySQL atau SQLite bergantung pada variabel konfigurasi `.env`.

## 3. Fitur Utama & Logika Bisnis
- **Dashboard Multi-Peran (Multi-role Dashboards)**: Antarmuka berbeda untuk Peminjam, Admin, BAAK (Bagian Akademik), dan SARPRAS (Sarana dan Prasarana) dengan izin tindakan masing-masing.
- **Manajemen Jadwal Pemesanan (Booking Management)**: Mengirim pengajuan pemesanan ruangan, mengubah status persetujuan, dan membatalkan permohonan ruangan (`/submit-booking`, `/peminjaman/status/{id}`).
- **Manajemen Ruangan**: Pendaftaran, pengeditan, dan penghapusan ruangan dari daftar sistem.
- **Manajemen Pengguna (User Management)**: CRUD pengguna baru serta tampilan tabel daftar anggota atau staf.
- **Kalender Reservasi Terintegrasi**: Tampilan kalender interaktif untuk melihat tanggal pemesanan (`/get-events`).
- **Export Laporan**: Fasilitas unduh riwayat peminjaman dalam bentuk file `PDF` dan `Excel`.

## 4. Struktur Direktori Proyek
- `app/Http/Controllers/`: Berisi logika pemrosesan untuk setiap *routes*, seperti `PeminjamanController`, `DashboardController`, `RuanganController`, `AuthController`.
- `routes/web.php`: Pengaturan *routes* (URL) sistem pemesanan dan fungsi administrasi.
- `resources/views/`: Desain visual, tata letak, *template form*, serta dashboard menggunakan Blade dan Tailwind.
- `database/`: Berisi skema database ruangan, pengguna, dan transaksi pemesanan melalui file migration.
- `public/`: Direktori di mana proses CSS, *script* JavaScript, serta aset gambar ditempatkan.

## 5. Panduan Instalasi & Cara Menjalankan Proyek
Langkah-langkah untuk pengaturan di lingkungan *local*:

1. **Jalankan Instalasi *Dependencies* Inti**:
   ```bash
   composer install
   npm install
   ```
2. **Pengaturan File *Environment***:
   Buat file *environment* untuk aplikasi:
   ```bash
   cp .env.example .env
   ```
   *Catatan: Masukkan informasi database MySQL atau ubah ke format SQLite secara manual jika diperlukan.*
3. **Pembangunan Sistem Database (Migration)**:
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
4. **Pemrosesan Tampilan (Frontend) & Server**:
   Buka dua jendela terminal:
   ```bash
   npm run dev
   php artisan serve
   ```

## 6. Endpoint API / Skema Database
Beberapa *routes* dan fungsi logika utama:
- **Authentication & Utama**:
  - `GET /`, `GET /login`, `POST /login`, `POST /logout`
- **Dashboard & Kalender**:
  - `GET /dashboard/{role}` : Pengendalian Dashboard spesifik peran
  - `GET /{role}/kalendar-reservasi` : UI Kalender Reservasi Ruang
  - `GET /get-events`, `GET /get-events-by-date` : Penarikan Data (AJAX Calendar)
- **Ruangan & Pemesanan**:
  - `GET /{role}/ruangan`, `POST /add/ruangan`, `PUT /rooms/{id}` : CRUD Ruangan
  - `POST /submit-booking` : Menyimpan pemesanan
  - `PUT /peminjaman/status/{id}` : Respons pengelola terhadap pengajuan ruangan
- **Laporan**:
  - `GET /download/excel` : Laporan spreadsheet (Excel).
  - `GET /download/pdf` : Laporan arsip dokumen (PDF).
