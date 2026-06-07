# 📝 Sistem Manajemen Blog (CMS)

> Aplikasi web Content Management System (CMS) berbasis PHP & MySQL untuk mengelola data **Penulis**, **Artikel**, dan **Kategori Artikel** secara asynchronous menggunakan Fetch API.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES2020-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat-square&logo=docker&logoColor=white)

---

## 🚀 Fitur Utama

### 🧑‍💼 Kelola Penulis (CRUD)
- **Tambah** penulis baru dengan nama, username, password, dan foto profil
- **Lihat** seluruh daftar penulis dalam format tabel
- **Edit** data penulis melalui modal form yang terisi otomatis
- **Hapus** penulis dengan konfirmasi — penulis yang masih memiliki artikel **tidak dapat dihapus**
- Password dienkripsi menggunakan **`password_hash()` (BCRYPT)**
- Foto profil menggunakan `default.png` jika tidak diunggah

### 📄 Kelola Artikel (CRUD)
- **Tambah** artikel dengan judul, isi, penulis, kategori, dan gambar
- **Lihat** seluruh daftar artikel beserta info tanggal, penulis, dan kategori
- **Edit** artikel dengan perbarui gambar (opsional)
- **Hapus** artikel beserta file gambar fisik dari server
- Kolom `hari_tanggal` diisi otomatis dari server PHP (format: `Senin, 13 April 2026 | 15:17`, timezone `Asia/Jakarta`)
- Dropdown penulis dan kategori diisi dinamis dari database

### 🗂️ Kelola Kategori Artikel (CRUD)
- **Tambah**, **edit**, dan **hapus** kategori
- Kategori yang masih memiliki artikel **tidak dapat dihapus**

### ✨ Fitur Tambahan
| Fitur | Keterangan |
|---|---|
| 🌙 **Dark Mode** | Toggle tema gelap/terang yang elegan, pilihan disimpan di `localStorage` |
| 📱 **Responsive Design** | Tampilan optimal di desktop & mobile dengan Navigation Drawer |
| ⚡ **Async / No Reload** | Seluruh operasi CRUD berjalan menggunakan Fetch API tanpa reload halaman |
| 💬 **Toast Notification** | Notifikasi sukses/gagal yang muncul otomatis di pojok layar |
| ✅ **Konfirmasi Hapus** | Modal konfirmasi sebelum data dihapus |

---

## 🛡️ Keamanan

- **Prepared Statements** (`mysqli`) untuk seluruh operasi database — mencegah SQL Injection
- **Validasi tipe file** menggunakan `finfo` (bukan hanya `$_FILES['type']`)
- **Enkripsi password** menggunakan `PASSWORD_BCRYPT`
- **Batasan ukuran** file unggahan maksimal 20 MB
- Folder `uploads_penulis/` dan `uploads_artikel/` dilindungi oleh **`.htaccess`** untuk mencegah eksekusi PHP

---

## 🗄️ Struktur Database

Database: `db_blog`

```sql
-- Tabel penulis
CREATE TABLE penulis (
  id            INT PRIMARY KEY AUTO_INCREMENT,
  nama_depan    VARCHAR(100) NOT NULL,
  nama_belakang VARCHAR(100) NOT NULL,
  user_name     VARCHAR(50)  NOT NULL UNIQUE,
  password      VARCHAR(255) NOT NULL,
  foto          VARCHAR(255) NOT NULL
) ENGINE=InnoDB CHARSET=utf8mb4;

-- Tabel kategori_artikel
CREATE TABLE kategori_artikel (
  id            INT PRIMARY KEY AUTO_INCREMENT,
  nama_kategori VARCHAR(100) NOT NULL UNIQUE,
  keterangan    TEXT
) ENGINE=InnoDB CHARSET=utf8mb4;

-- Tabel artikel (berelasi ke penulis & kategori)
CREATE TABLE artikel (
  id           INT PRIMARY KEY AUTO_INCREMENT,
  id_penulis   INT NOT NULL,
  id_kategori  INT NOT NULL,
  judul        VARCHAR(255) NOT NULL,
  isi          TEXT NOT NULL,
  gambar       VARCHAR(255) NOT NULL,
  hari_tanggal VARCHAR(50)  NOT NULL,
  FOREIGN KEY (id_penulis)  REFERENCES penulis(id) ON DELETE RESTRICT,
  FOREIGN KEY (id_kategori) REFERENCES kategori_artikel(id) ON DELETE RESTRICT
) ENGINE=InnoDB CHARSET=utf8mb4;
```

---

## 📁 Struktur Folder

```
01-UTS-VanillaPHP/
├── index.php                 # Halaman utama (UI + JavaScript)
├── koneksi.php               # Koneksi ke database MySQL
├── db_blog.sql               # Skrip SQL untuk membuat database & tabel
├── docker-compose.yml        # Konfigurasi Docker
├── Dockerfile
│
├── ambil_penulis.php         # [READ] Daftar penulis
├── ambil_satu_penulis.php    # [READ] Detail satu penulis
├── simpan_penulis.php        # [CREATE] Tambah penulis
├── update_penulis.php        # [UPDATE] Edit penulis
├── hapus_penulis.php         # [DELETE] Hapus penulis
│
├── ambil_kategori.php        # [READ] Daftar kategori
├── ambil_satu_kategori.php   # [READ] Detail satu kategori
├── simpan_kategori.php       # [CREATE] Tambah kategori
├── update_kategori.php       # [UPDATE] Edit kategori
├── hapus_kategori.php        # [DELETE] Hapus kategori
│
├── ambil_artikel.php         # [READ] Daftar artikel
├── ambil_satu_artikel.php    # [READ] Detail satu artikel
├── simpan_artikel.php        # [CREATE] Tambah artikel
├── update_artikel.php        # [UPDATE] Edit artikel
├── hapus_artikel.php         # [DELETE] Hapus artikel
│
├── uploads_penulis/
│   ├── .htaccess             # Proteksi eksekusi PHP
│   └── default.png           # Foto profil default
│
└── uploads_artikel/
    └── .htaccess             # Proteksi eksekusi PHP
```

---

## ⚙️ Cara Menjalankan

### Menggunakan Docker (Direkomendasikan)

Pastikan **Docker** dan **Docker Compose** sudah terinstal.

```bash
# 1. Clone repository ini
git clone <URL_REPOSITORY_ANDA>
cd blog

# 2. Jalankan semua service
docker compose up -d

# 3. Akses aplikasi di browser
# - Aplikasi : http://localhost:8080
# - phpMyAdmin: http://localhost:8081
```

> Database akan otomatis dibuat dari file `db_blog.sql` saat container pertama kali dijalankan.

### Menggunakan XAMPP / LAMP

1. Salin folder `blog/` ke dalam direktori `htdocs/` (XAMPP) atau `/var/www/html/` (LAMP).
2. Import file `db_blog.sql` melalui phpMyAdmin.
3. Sesuaikan konfigurasi di `koneksi.php`:
   ```php
   $host = 'localhost';
   $user = 'root';
   $pass = ''; // password MySQL Anda
   $db   = 'db_blog';
   ```
4. Akses aplikasi di browser: `http://localhost/blog/`

---

## 💻 Teknologi yang Digunakan

| Teknologi | Fungsi |
|---|---|
| **PHP 8.x** | Backend, logika server, dan API endpoint |
| **MySQL 8.0** | Sistem manajemen database relasional |
| **JavaScript (ES2020)** | Logika frontend, Fetch API untuk operasi async |
| **HTML5 & CSS3** | Struktur dan styling antarmuka |
| **Docker & Docker Compose** | Containerisasi dan manajemen environment |
| **Google Fonts (Plus Jakarta Sans)** | Tipografi modern |

---

## 📊 Rubrik Penilaian UTS

| No | Komponen | Bobot |
|:---:|---|:---:|
| 1 | Struktur database dan perintah SQL | 10 |
| 2 | Koneksi PHP dan database | 5 |
| 3 | Tampilan / GUI | 10 |
| 4 | CRUD Kategori Artikel | 10 |
| 5 | CRUD Penulis | 25 |
| 6 | CRUD Artikel | 30 |
| 7 | Validasi dan keamanan | 10 |
| | **Total** | **100** |

---

## 📋 Informasi Tugas

```
Mata Kuliah : Pemrograman Web
Dosen       : A'la Syauqi, M.Kom.
Semester    : Genap 2025/2026
Jenis Ujian : Ujian Tengah Semester (Take Home Test)
Deadline    : Rabu, 29 Mei 2026 | Pukul 23.59 WIB
```

---

> Proyek ini dibuat sebagai bagian dari pemenuhan tugas UTS Mata Kuliah Pemrograman Web.
# Sistem-Manajemen-Blog-CMS 
# Project-UTS-Teory-Web-Programming
