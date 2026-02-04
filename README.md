# Sistem Peminjaman Barang

## a. Nama Website
**Sistem Peminjaman Barang** (SimPeminjaman)

## b. Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - PHP Framework
- **PHP 8.1+** - Bahasa pemrograman server-side
- **MySQL** - Database Management System

### Frontend
- **Blade Template Engine** - Template engine Laravel
- **CSS** - Styling
- **JavaScript** - Interaktivitas
- **Material Design Icons** - Icon library

### Development Tools
- **Composer** - PHP dependency manager

## c. Deskripsi dan Tujuan Website

### Deskripsi
Sistem Peminjaman Barang adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola proses peminjaman dan pengembalian barang secara efisien. Aplikasi ini memiliki fitur manajemen barang, data peminjam, dan transaksi peminjaman yang terintegrasi dalam satu sistem.

### Fitur Utama
- **Manajemen Barang**: CRUD (Create, Read, Update, Delete) data barang dengan informasi detail seperti kode barang, nama, jumlah, kondisi, dan status ketersediaan
- **Manajemen Peminjam**: Pengelolaan data peminjam dengan validasi nomor identitas unik dan informasi kontak
- **Manajemen Transaksi**: Pencatatan transaksi peminjaman dengan tracking tanggal pinjam, tanggal kembali, dan status peminjaman
- **Dashboard**: Tampilan statistik dan ringkasan data peminjaman secara real-time
- **Autentikasi**: Sistem login dan registrasi pengguna untuk keamanan akses

### Tujuan
1. **Efisiensi**: Mempermudah proses pencatatan dan pelacakan barang yang dipinjam
2. **Akuntabilitas**: Meningkatkan transparansi dalam pengelolaan inventaris dan aset
3. **Otomatisasi**: Mengurangi kesalahan manual dalam pencatatan peminjaman
4. **Kemudahan**: Menyediakan interface yang user-friendly dan mudah digunakan

### Use Case
Sistem ini cocok digunakan untuk:
- Perpustakaan (peminjaman buku)
- Laboratorium (peminjaman alat dan peralatan)
- Kantor (peminjaman peralatan kantor)
- Sekolah/Universitas (peminjaman fasilitas)

## d. Nama Kelompok
**Kelompok 7**

## e. Anggota Kelompok 

| No | Nama Lengkap | NIM |
|----|--------------|-----|
| 1  | Raisya Agni Janatunnisa | 2307011 |
| 2  | Kaka Nugraha | 2307007 |
| 3  | Rexy Surya Ramadhan | 2307010 |

---

## Instalasi dan Penggunaan

### Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

### Langkah Instalasi

1. Clone repository
```bash
git clone https://github.com/raisyaica/SimPeminjaman.git
cd SimPeminjaman
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrasi database
```bash
php artisan migrate --seed
```

6. Jalankan aplikasi
```bash
# Terminal 1
npm run dev

# Terminal 2
php artisan serve
```

7. Akses aplikasi di browser: `http://localhost:8000`

### Login Default
Setelah menjalankan seeder:
- Email: admin@example.com
- Password: password

---

## Struktur Database

### Tabel Users
Menyimpan data pengguna sistem

### Tabel Barangs
Menyimpan data barang dengan kolom:
- `kode_barang` (unique)
- `nama_barang`
- `jumlah`
- `kondisi` (baru, baik, cukup_baik, rusak)
- `status_ketersediaan` (tersedia, tidak_tersedia)

### Tabel Peminjams
Menyimpan data peminjam dengan kolom:
- `nama_peminjam`
- `no_identitas` (unique)
- `kontak`

### Tabel Transaksis
Menyimpan data transaksi peminjaman dengan kolom:
- `barang_id` (foreign key)
- `peminjam_id` (foreign key)
- `tanggal_pinjam`
- `tanggal_kembali`
- `status` (dipinjam, dikembalikan)
