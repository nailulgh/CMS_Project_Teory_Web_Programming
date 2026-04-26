# SOAL UJIAN TENGAH SEMESTER (UTS)

```
Mata Kuliah Pemrograman Web
Dosen A’la Syauqi, M.Kom.
Semester Genap 2025/
Sifat Ujian Take Home Test
Batas Pengumpulan Rabu, 29 Mei 2026 Pukul 23.59 WIB
```
## A. Deskripsi Proyek

Buatlah sebuah aplikasi web berbasis PHP dengan nama _Sistem Manajemen Blog (CMS)_
yang memungkinkan pengelolaan data penulis, artikel, dan kategori artikel secara
lengkap. Aplikasi dibangun menggunakan _PHP_ , _MySQL_ , dan _JavaScript_ dengan
pendekatan _asynchronous_ menggunakan _fetch API_ sehingga seluruh operasi berlangsung
tanpa _reload_ halaman.

## B. Ketentuan Database

Gunakan database dengan nama db_blog yang terdiri dari tiga tabel. Jalankan perintah
_SQL_ berikut melalui tab _SQL_ pada _phpMyAdmin_ untuk membuat _database_ dan seluruh
tabel yang diperlukan.
-- Membuat database
CREATE DATABASE IF NOT EXISTS db_blog
CHARACTER SET utf8mb
COLLATE utf8mb4_unicode_ci;
-- Menggunakan database
USE db_blog;
-- Membuat tabel penulis
CREATE TABLE penulis (
id INT NOT NULL AUTO_INCREMENT,
nama_depan VARCHAR(100) NOT NULL,
nama_belakang VARCHAR(100) NOT NULL,
user_name VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
foto VARCHAR(255) NOT NULL,
PRIMARY KEY (id),
UNIQUE KEY uq_user_name (user_name)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- Membuat tabel kategori_artikel
CREATE TABLE kategori_artikel (
id INT NOT NULL AUTO_INCREMENT,
nama_kategori VARCHAR(100) NOT NULL,
keterangan TEXT,
PRIMARY KEY (id),
UNIQUE KEY uq_nama_kategori (nama_kategori)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


-- Membuat tabel artikel
CREATE TABLE artikel (
id INT NOT NULL AUTO_INCREMENT,
id_penulis INT NOT NULL,
id_kategori INT NOT NULL,
judul VARCHAR(255) NOT NULL,
isi TEXT NOT NULL,
gambar VARCHAR(255) NOT NULL,
hari_tanggal VARCHAR(50) NOT NULL,
PRIMARY KEY (id),
CONSTRAINT fk_artikel_penulis
FOREIGN KEY (id_penulis)
REFERENCES penulis (id)
ON DELETE RESTRICT
ON UPDATE CASCADE,
CONSTRAINT fk_artikel_kategori
FOREIGN KEY (id_kategori)
REFERENCES kategori_artikel (id)
ON DELETE RESTRICT
ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
Relasi antartabel ditunjukkan pada gambar berikut.
_Gambar 1. Relasi antartabel_

## C. Ketentuan Aplikasi

**1. Tampilan (GUI)**
Aplikasi terdiri dari satu halaman utama (index.php) dengan tata letak sebagai berikut:
    a. Bagian atas berisi _header_ yang menampilkan nama aplikasi.
    b. Bagian kiri berisi navigasi dengan tiga menu: Kelola Penulis, Kelola Artikel, dan
       Kelola Kategori Artikel.
    c. Bagian kanan menampilkan data sesuai menu yang dipilih.
Tampilan aplikasi mengacu pada gambar berikut.


_Gambar 2. Tampilan bagian kelola penulis
Gambar 3. Tampilan tambah penulis
Gambar 4. Tampilan edit penulis
Gambar 5. Konfirmasi hapus penulis_


_Gambar 6. Tampilan bagian kelola artikel
Gambar 7. Tampilan tambah artikel
Gambar 8. Tampilan edit artikel
Gambar 9. Tampilan konfitmasi hapus artikel_


```
Gambar 10. Tampilan kelola kategori artikel
Gambar 11. Tampilan tambah kategori
Gambar 12. Tampilan edit kategori
Gambar 13. Tampilan konfirmasi hapus kategori
```
**2. Fitur yang Harus Diimplementasikan**
Setiap menu navigasi harus memiliki fitur _CRUD (Create, Read, Update, Delete)_ yang
berjalan secara _asynchronous_ menggunakan _fetch API_. Berikut ketentuan untuk
masing-masing menu.
**a. Kelola Penulis**
    1. Menampilkan data penulis dalam format tabel yang memuat kolom foto, nama,
       username, password, dan aksi.


2. Tombol _Tambah Penulis_ membuka _modal form_ untuk menambah data baru.
3. Kolom foto menampilkan foto profil penulis. Jika penulis tidak mengunggah foto,
    tampilkan gambar siluet _default_ (default.png) yang disimpan di _folder_
    uploads_penulis/.
4. Password dienkripsi menggunakan fungsi password_hash() dengan
    algoritma PASSWORD_BCRYPT sebelum disimpan ke _database_.
5. Tombol _Edit_ membuka modal _form_ yang terisi otomatis dengan data terbaru dari
    _database_.
6. Tombol _Hapus_ menampilkan konfirmasi sebelum data dihapus. Jika penulis masih
    memiliki artikel, data tidak dapat dihapus.
**b. Kelola Artikel**
1. Menampilkan data artikel dalam format tabel yang memuat kolom gambar, judul,
kategori, penulis, tanggal, dan aksi.
2. Tombol _Tambah Artikel_ membuka _modal form_ untuk menambah data baru.
3. Kolom hari_tanggal diisi otomatis dari _server_ menggunakan _PHP_ dengan
format “Senin, 13 April 2026 | 15:17” dan timezone Asia/Jakarta. Berikut
potongan fungsi yang dapat digunakan:
date_default_timezone_set('Asia/Jakarta');
$hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$bulan = [
1=>'Januari', 2=>'Februari', 3=>'Maret',
4=>'April', 5=>'Mei', 6=>'Juni',
7=>'Juli', 8=>'Agustus', 9=>'September',
10=>'Oktober',11=>'November',12=>'Desember'
];
$sekarang = new DateTime();
$nama_hari = $hari[$sekarang->format('w')];
$tanggal = $sekarang->format('j');
$nama_bulan = $bulan[(int)$sekarang->format('n')];
$tahun = $sekarang->format('Y');
$jam = $sekarang->format('H:i');
$hari_tanggal = "$nama_hari, $tanggal $nama_bulan $tahun | $jam";
4. _Upload_ gambar artikel wajib dilakukan. Gambar disimpan di _folder_
uploads_artikel/.
5. _Dropdown_ Penulis diisi dari data tabel penulis di _database_.
6. _Dropdown_ Kategori diisi dari data tabel kategori_artikel di database.
7. Tombol _Edit_ membuka _modal form_ yang terisi otomatis dengan data terbaru dari
_database_.
8. Tombol _Hapus_ menampilkan konfirmasi sebelum data dihapus. _File_ gambar ikut
dihapus dari _server_ ketika data artikel dihapus.
**c. Kelola Kategori Artikel**
1. Menampilkan data kategori dalam format tabel yang memuat kolom nama
kategori, keterangan, dan aksi.
2. Tombol _Tambah Kategori_ membuka _modal form_ untuk menambah data baru.


3. Tombol _Edit_ membuka _modal form_ yang terisi otomatis dengan data terbaru dari
    _database_.
4. Tombol _Hapus_ menampilkan konfirmasi sebelum data dihapus. Jika kategori
    masih memiliki artikel, data tidak dapat dihapus.
**3. Validasi dan Keamanan**
1. Seluruh operasi _database_ menggunakan _prepared statements_ dengan mysqli.
2. Validasi tipe _file_ menggunakan fungsi finfo, bukan dari
$_FILES['foto']['type'].
3. Ukuran file maksimal 2 MB.
4. Sanitasi output menggunakan htmlspecialchars().
5. Folder uploads_penulis/ dan uploads_artikel/ dilindungi
menggunakan _file_ .htaccess untuk mencegah eksekusi _file PHP_.

## D. Struktur Folder Proyek

Seluruh _file_ disimpan dalam _folder_ blog/ dengan struktur sebagai berikut.
blog/
├── index.php
├── koneksi.php
│
├── ambil_penulis.php
├── simpan_penulis.php
├── ambil_satu_penulis.php
├── update_penulis.php
├── hapus_penulis.php
│
├── ambil_kategori.php
├── simpan_kategori.php
├── ambil_satu_kategori.php
├── update_kategori.php
├── hapus_kategori.php
│
├── ambil_artikel.php
├── simpan_artikel.php
├── ambil_satu_artikel.php
├── update_artikel.php
├── hapus_artikel.php
│
├── uploads_penulis/
│ ├── .htaccess
│ └── default.png
│
└── uploads_artikel/
└── .htaccess

## E. Ketentuan Pengumpulan

1. Seluruh _folder_ tugas, termasuk _subfolder_ , _file program_ , serta _file database_ hasil
    ekspor berformat _.sql_ , diunggah ke repositori _GitHub_.
2. Repositori harus mencakup seluruh _folder blog/_ beserta seluruh isinya.
3. Buat video yang mendemonstrasikan program, kemudian diunggah ke Youtube.
4. Tautan repositori _GitHub_ dan _Youtube_ dikumpulkan melalui _google classroom_
    paling lambat Rabu, 29 Mei 2026 pukul 23.59 WIB.
5. Keterlambatan pengumpulan akan dikenakan pengurangan nilai.


## F. Rubrik Penilaian

**Tabel 1. Rubrik Penilaian UTS
No Komponen Bobot**
1 Struktur database dan perintah SQL 10
2 Koneksi PHP dan database 5
3 Tampilan/GUI 10
4 CRUD Kategori Artikel 10
5 CRUD Penulis 25
6 CRUD Artikel 30
7 Validasi dan keamanan 10
Total^100


