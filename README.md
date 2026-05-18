# 🛣️ INCITRACK! - Platform Pelaporan & Visualisasi Insiden Jalan Tol

<p align="center">
  <img src="public/it.png" width="120" alt="INCITRACK Logo">
</p>

**INCITRACK** adalah platform berbasis web interaktif yang dirancang untuk membantu pengguna jalan melaporkan insiden kecelakaan atau hambatan lalu lintas secara real-time di ruas jalan tol Indonesia. Platform ini bertujuan membantu pengelola jalan tol dan instansi terkait melakukan mitigasi area rawan kecelakaan (black spot) dengan visualisasi peta interaktif.

---

## 🌟 Fitur Utama

1. **Autentikasi Multi-Role (User & Admin)**:
   - **User Publik**: Dapat melihat peta sebaran kecelakaan yang valid, melakukan registrasi, mengedit profil, dan melihat riwayat laporan pribadi.
   - **Administrator**: Memiliki hak penuh untuk mengelola master data jalan tol, meninjau bukti foto/video, mengubah status verifikasi laporan, dan menghapus masukan kontak.

2. **Form Pelaporan Pintar & Real-time (GPS Geolocation)**:
   - Mendeteksi titik koordinat lintang dan bujur (latitude & longitude) secara otomatis menggunakan GPS perangkat browser.
   - **Smart Fallback (Mode Manual)**: Jika akses GPS diblokir oleh browser atau perangkat tidak memiliki sensor GPS, aplikasi secara cerdas beralih ke Mode Manual, memuat peta interaktif, mengaktifkan tombol submit, dan memungkinkan pengguna **mengetuk peta atau menggeser marker merah (draggable pin)** untuk menentukan titik kejadian secara presisi.

3. **Peta Interaktif (Leaflet.js & OpenStreetMap)**:
   - Visualisasi pemetaan dinamis untuk menandai lokasi persis koordinat kecelakaan di jalan tol.
   - Marker pemetaan interaktif dilengkapi popup popup berisi keterangan jenis insiden, lokasi spesifik, tanggal kejadian, dan nama jalan tol.

4. **Sistem Pengarsipan & Verifikasi**:
   - Laporan baru masuk sebagai status `pending`. Setelah diverifikasi oleh Admin, laporan yang ditandai `valid` otomatis terpublikasikan ke peta publik.

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

*   **Backend Framework**: Laravel 11.x (PHP 8.x)
*   **Database**: MySQL
*   **Frontend Engine**: Blade Templating Engine (Laravel Native Views)
*   **Styling**: Vanilla CSS (Modern Sleek UI, Boxicons, Glassmorphism elements)
*   **Mapping Library**: Leaflet.js & OpenStreetMap API

---

## 📂 Struktur Direktori Utama

*   `app/Http/Controllers/`: Logika bisnis utama (`PageController`, `AdminController`, `AuthController`).
*   `app/Models/`: Model database & Relasi Eloquent ORM (`Laporan`, `Jalan`, `User`, `Contact`).
*   `resources/views/`: Komponen Blade UI (`layouts/app.blade.php`, `components/navbar.blade.php`, `pages/`).
*   `public/css/`: Aset stylesheet CSS native yang dinamis dan terpisah per halaman.
*   `routes/web.php`: Peta rute URL aplikasi.

---

## ⚙️ Cara Instalasi & Menjalankan Proyek

### Prerequisites
Pastikan komputer Anda sudah terinstal:
*   PHP >= 8.2
*   Composer
*   XAMPP / MySQL Server

### Langkah-Langkah:
1. **Clone Repository**
   ```bash
   git clone https://github.com/adityaptm/Incitrack-Website.git
   cd Incitrack-Website
   ```

2. **Instal Dependensi PHP**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment (.env)**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan pengaturan database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=incitrack
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi & Seeding Database**
   Nyalakan MySQL di XAMPP, buat database baru bernama `incitrack`, lalu jalankan:
   ```bash
   php artisan migrate --seed
   ```
   *Perintah ini akan membuat semua struktur tabel dan akun administrator default.*

6. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Buka alamat **`http://localhost:8000`** di browser Anda.

---

## 📄 Lisensi
Proyek ini dibangun untuk tujuan akademik / ujian presentasi tugas akhir dan dilisensikan di bawah lisensi MIT.
