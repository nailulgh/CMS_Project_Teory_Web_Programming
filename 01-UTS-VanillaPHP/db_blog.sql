-- ============================================================
-- Sistem Manajemen Blog (CMS)
-- Database: db_blog
-- Mata Kuliah: Pemrograman Web
-- Dosen: A'la Syauqi, M.Kom.
-- ============================================================

-- Membuat database
CREATE DATABASE IF NOT EXISTS db_blog
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Menggunakan database
USE db_blog;

-- ============================================================
-- Tabel: penulis
-- ============================================================
CREATE TABLE penulis (
  id             INT          NOT NULL AUTO_INCREMENT,
  nama_depan     VARCHAR(100) NOT NULL,
  nama_belakang  VARCHAR(100) NOT NULL,
  user_name      VARCHAR(50)  NOT NULL,
  password       VARCHAR(255) NOT NULL,
  foto           VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_user_name (user_name)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: kategori_artikel
-- ============================================================
CREATE TABLE kategori_artikel (
  id             INT          NOT NULL AUTO_INCREMENT,
  nama_kategori  VARCHAR(100) NOT NULL,
  keterangan     TEXT,
  PRIMARY KEY (id),
  UNIQUE KEY uq_nama_kategori (nama_kategori)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: artikel
-- ============================================================
CREATE TABLE artikel (
  id             INT          NOT NULL AUTO_INCREMENT,
  id_penulis     INT          NOT NULL,
  id_kategori    INT          NOT NULL,
  judul          VARCHAR(255) NOT NULL,
  isi            TEXT         NOT NULL,
  gambar         VARCHAR(255) NOT NULL,
  hari_tanggal   VARCHAR(50)  NOT NULL,
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

-- ============================================================
-- Contoh data kategori
-- ============================================================
INSERT INTO kategori_artikel (nama_kategori, keterangan) VALUES
  ('Tutorial',   'Artikel panduan langkah demi langkah'),
  ('Database',   'Artikel seputar pengelolaan database'),
  ('Web Design', 'Artikel tentang desain antarmuka web');

-- ============================================================
-- Contoh data penulis (password: admin123)
-- ============================================================
INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto) VALUES
  ('Ahmad',  'Fauzi',   'ahmad_f', '$2y$10$examplehashforahmad', 'default.png'),
  ('Siti',   'Rahayu',  'siti_r',  '$2y$10$examplehashforsiti',  'default.png'),
  ('Budi',   'Santoso', 'budi_s',  '$2y$10$examplehashforbudi',  'default.png');
