# Sistem Peminjaman Ruangan

## 1. Tajuk Projek & Ringkasan
**Sistem Peminjaman Ruangan**
Sistem maklumat web pengurusan peminjaman dan tempahan ruangan/bilik di suatu fasiliti (seperti institusi atau syarikat). Berasaskan kawalan jenis pengaksesan berbilang peranan, aplikasi ini memperkemas operasi dari permohonan peminjam sehingga pemantauan sarpras, serta menyediakan rekod jejak dan laporan tempahan menerusi takwim kalendar komprehensif.

## 2. Teknologi yang Digunakan (Tech Stack)
- **Frontend**: Laravel UI, Enjin Templat Blade, Tailwind CSS
- **Backend**: PHP 8.2+, Laravel Framework v11.31
- **Laporan/Pengeksportan**: barryvdh/laravel-dompdf (PDF), maatwebsite/excel (Laporan Excel)
- **Pangkalan Data**: MySQL atau SQLite bergantung pada pembolehubah konfigurasi `.env`.

## 3. Ciri-Ciri Utama & Logik Perniagaan
- **Papan Pemuka Berbilang Peranan (Multi-role Dashboards)**: Antaramuka berbeza bagi Peminjam, Admin, BAAK (Bahagian Akademik), dan SARPRAS (Sarana dan Prasarana) dengan keizinan tindakan tersendiri.
- **Pengurusan Jadual Tempahan (Booking Management)**: Menghantar permohonan tempahan ruangan, mengubah status kelulusan, dan pembatalan ruangan permohonan (`/submit-booking`, `/peminjaman/status/{id}`).
- **Pengurusan Bilik / Ruang**: Pendaftaran, penyuntingan dan penghapusan bilik dari senarai sistem.
- **Pengurusan Pengguna (User Management)**: CRUD pengguna baru serta paparan jadual senarai ahli atau kakitangan.
- **Kalendar Tempahan Bersepadu**: Pemaparan kalendar interaktif untuk melihat tarikh tempahan (`/get-events`).
- **Eksport Laporan**: Kemudahan muat turun rekod peminjaman dalam bentuk fail `PDF` dan `Excel`.

## 4. Struktur Direktori Projek
- `app/Http/Controllers/`: Mengandungi pemprosesan bagi setiap laluan, seperti `PeminjamanController`, `DashboardController`, `RuanganController`, `AuthController`.
- `routes/web.php`: Tetapan laluan (URL) sistem tempahan dan fungsi pentadbiran.
- `resources/views/`: Rekaan visual, susun atur, templat borang serta papan pemuka menggunakan Blade dan Tailwind.
- `database/`: Mengandungi skema pangkalan data ruangan, pengguna, dan transaksi tempahan menerusi fail migrasi.
- `public/`: Direktori di mana pemprosesan CSS, skrip JavaScript, serta aset imej diletakkan.

## 5. Panduan Pemasangan & Cara Menjalankan Projek
Langkah-langkah untuk persediaan di persekitaran *local*:

1. **Jalankan Pemasangan Pustaka Teras**:
   ```bash
   composer install
   npm install
   ```
2. **Tetapan Fail Persekitaran**:
   Wujudkan fail pembolehubah environment bagi aplikasi:
   ```bash
   cp .env.example .env
   ```
   *Nota: Masukkan maklumat pangkalan data MySQL atau set ke format SQLite secara manual jika diperlukan.*
3. **Pembinaan Sistem Asas Data**:
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
4. **Pemprosesan Paparan (Frontend) & Pelayan**:
   Buka dua buah tab terminal:
   ```bash
   npm run dev
   php artisan serve
   ```

## 6. Endpoint API / Skema Pangkalan Data
Antara rute (*routes*) dan fungsi logik utama:
- **Autentikasi & Utama**:
  - `GET /`, `GET /login`, `POST /login`, `POST /logout`
- **Papan Pemuka & Kalendar**:
  - `GET /dashboard/{role}` : Pengendalian Dashboard spesifik peranan
  - `GET /{role}/kalendar-reservasi` : UI Kalendar Tempahan Ruang
  - `GET /get-events`, `GET /get-events-by-date` : Penarikan Data (AJAX Calendar)
- **Ruangan & Tempahan**:
  - `GET /{role}/ruangan`, `POST /add/ruangan`, `PUT /rooms/{id}` : CRUD Ruangan
  - `POST /submit-booking` : Menyimpan tempahan
  - `PUT /peminjaman/status/{id}` : Maklum balas pengurusan pada permohonan bilik
- **Laporan**:
  - `GET /download/excel` : Laporan hamparan kembangan.
  - `GET /download/pdf` : Laporan arkib.
