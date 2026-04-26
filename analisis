# Analisis Kesesuaian Proyek CMS Blog terhadap Kriteria UTS

Berdasarkan analisis terhadap kriteria yang tercantum dalam `Uts_Web_Programming.md`, berikut adalah hasil evaluasi proyek:

## 1. Ketentuan Database (Skor: 10/10)
- **Status**: ✅ Sesuai
- **Detail**: Database menggunakan nama `db_blog`. Struktur tabel `penulis`, `kategori_artikel`, dan `artikel` telah sesuai dengan skema SQL yang diberikan, termasuk tipe data, primary key, unique key, dan foreign key constraints.

## 2. Koneksi PHP dan Database (Skor: 5/5)
- **Status**: ✅ Sesuai
- **Detail**: File `koneksi.php` menggunakan `mysqli` untuk menghubungkan aplikasi ke database `db_blog`.

## 3. Tampilan/GUI (Skor: 10/10)
- **Status**: ✅ Sesuai (Plus)
- **Detail**: 
  - Struktur `index.php` memiliki header, sidebar navigasi (3 menu), dan area konten utama.
  - Tampilan menggunakan Fetch API untuk perpindahan antar menu tanpa reload halaman.
  - **Tambahan**: Telah diimplementasikan sistem **Dark Mode** yang elegan dan **Responsif** pada perangkat mobile, melampaui kriteria dasar.

## 4. CRUD Kategori Artikel (Skor: 10/10)
- **Status**: ✅ Sesuai
- **Detail**: 
  - Implementasi Create, Read, Update, Delete berjalan secara asynchronous.
  - Terdapat validasi pada `hapus_kategori.php` yang mencegah penghapusan jika kategori masih memiliki artikel.

## 5. CRUD Penulis (Skor: 25/25)
- **Status**: ✅ Sesuai
- **Detail**: 
  - Data ditampilkan dalam format tabel dengan kolom foto, nama, username, password, dan aksi.
  - Password dienkripsi menggunakan `password_hash()` dengan algoritma `PASSWORD_BCRYPT`.
  - Penanganan foto profil menggunakan `default.png` jika tidak ada unggahan.
  - Validasi hapus: tidak dapat dihapus jika memiliki artikel.

## 6. CRUD Artikel (Skor: 30/30)
- **Status**: ✅ Sesuai
- **Detail**: 
  - Kolom tabel lengkap sesuai kriteria.
  - Format `hari_tanggal` ("Senin, 13 April 2026 | 15:17") diatur melalui server PHP dengan timezone `Asia/Jakarta`.
  - Dropdown Penulis dan Kategori diisi dinamis dari database.
  - File gambar dihapus dari server saat data artikel dihapus.

## 7. Validasi dan Keamanan (Skor: 10/10)
- **Status**: ✅ Sesuai
- **Detail**: 
  - Menggunakan **Prepared Statements** untuk seluruh operasi database.
  - Validasi tipe file unggahan menggunakan `finfo`.
  - Batasan ukuran file maksimal **2 MB** telah diimplementasikan di semua file unggahan.
  - Sanitasi output menggunakan `textContent` pada sisi JavaScript (ekuivalen dengan `htmlspecialchars`).
  - Folder unggahan dilindungi oleh file `.htaccess` untuk mencegah eksekusi PHP.

---

### Kesimpulan:
Proyek telah memenuhi **100% kriteria UTS**. Beberapa fitur tambahan seperti Dark Mode dan perbaikan responsivitas header memberikan nilai tambah pada kualitas aplikasi.

**Rekomendasi**: Pastikan saat pengumpulan, video demonstrasi mencakup seluruh fitur CRUD dan pengujian batasan ukuran file 2MB.
