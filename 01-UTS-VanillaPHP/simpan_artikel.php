<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'koneksi.php';

$judul      = trim($_POST['judul']       ?? '');
$id_penulis = (int)($_POST['id_penulis'] ?? 0);
$id_kategori = (int)($_POST['id_kategori'] ?? 0);
$isi        = trim($_POST['isi']         ?? '');

if (!$judul || !$id_penulis || !$id_kategori || !$isi) {
    echo json_encode(['status'=>'error','message'=>'Semua field wajib diisi.']); exit;
}

// Upload gambar wajib
if (empty($_FILES['gambar']['name'])) {
    echo json_encode(['status'=>'error','message'=>'Gambar artikel wajib diunggah.']); exit;
}

$file    = $_FILES['gambar'];
$maxSize  = 20 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    echo json_encode(['status'=>'error','message'=>'Ukuran gambar maksimal 20 MB.']); exit;
}
$finfo    = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($file['tmp_name']);
$allowed  = ['image/jpeg','image/png','image/gif','image/webp'];
if (!in_array($mimeType, $allowed)) {
    echo json_encode(['status'=>'error','message'=>'Tipe file tidak diizinkan.']); exit;
}
$ext     = pathinfo($file['name'], PATHINFO_EXTENSION);
$newName = uniqid('artikel_', true) . '.' . $ext;
$dest    = __DIR__ . '/uploads_artikel/' . $newName;
if (!move_uploaded_file($file['tmp_name'], $dest)) {
    echo json_encode(['status'=>'error','message'=>'Gagal menyimpan gambar.']); exit;
}

// Tanggal dari server
date_default_timezone_set('Asia/Jakarta');
$hari   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$bulan  = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
           7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
$now    = new DateTime();
$hari_tanggal = $hari[$now->format('w')] . ', ' . $now->format('j') . ' ' .
                $bulan[(int)$now->format('n')] . ' ' . $now->format('Y') . ' | ' . $now->format('H:i');

$stmt = $koneksi->prepare(
    "INSERT INTO artikel (id_penulis, id_kategori, judul, isi, gambar, hari_tanggal)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param('iissss', $id_penulis, $id_kategori, $judul, $isi, $newName, $hari_tanggal);

if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Artikel berhasil ditambahkan.']);
} else {
    echo json_encode(['status'=>'error','message'=>'Gagal menyimpan artikel: ' . $stmt->error]);
}

$stmt->close(); $koneksi->close();
