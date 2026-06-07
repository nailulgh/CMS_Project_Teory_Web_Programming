<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'koneksi.php';

$nama_depan   = trim($_POST['nama_depan']   ?? '');
$nama_belakang = trim($_POST['nama_belakang'] ?? '');
$user_name    = trim($_POST['user_name']    ?? '');
$password     = $_POST['password']          ?? '';

if (!$nama_depan || !$nama_belakang || !$user_name || !$password) {
    echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi.']);
    exit;
}

$hashed = password_hash($password, PASSWORD_BCRYPT);

// Handle foto upload
$foto = 'default.png';
if (!empty($_FILES['foto']['name'])) {
    $file     = $_FILES['foto'];
    $maxSize  = 20 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 20 MB.']);
        exit;
    }
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    $allowed  = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan.']);
        exit;
    }
    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName  = uniqid('penulis_', true) . '.' . $ext;
    $dest     = __DIR__ . '/uploads_penulis/' . $newName;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan foto.']);
        exit;
    }
    $foto = $newName;
}

$stmt = $koneksi->prepare(
    "INSERT INTO penulis (nama_depan, nama_belakang, user_name, password, foto)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param('sssss', $nama_depan, $nama_belakang, $user_name, $hashed, $foto);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Penulis berhasil ditambahkan.']);
} else {
    if ($koneksi->errno === 1062) {
        echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $stmt->error]);
    }
}

$stmt->close();
$koneksi->close();
