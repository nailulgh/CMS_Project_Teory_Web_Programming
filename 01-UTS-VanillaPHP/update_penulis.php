<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id            = (int)($_POST['id']             ?? 0);
$nama_depan    = trim($_POST['nama_depan']       ?? '');
$nama_belakang = trim($_POST['nama_belakang']    ?? '');
$user_name     = trim($_POST['user_name']        ?? '');
$password      = $_POST['password']              ?? '';

if (!$id || !$nama_depan || !$nama_belakang || !$user_name) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap.']);
    exit;
}

// Ambil data lama
$stmtOld = $koneksi->prepare("SELECT foto FROM penulis WHERE id = ?");
$stmtOld->bind_param('i', $id);
$stmtOld->execute();
$old = $stmtOld->get_result()->fetch_assoc();
$stmtOld->close();

if (!$old) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
    exit;
}

$foto = $old['foto'];

// Handle foto baru
if (!empty($_FILES['foto']['name'])) {
    $file    = $_FILES['foto'];
    $maxSize = 2 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        echo json_encode(['status' => 'error', 'message' => 'Ukuran file maksimal 2 MB.']);
        exit;
    }
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);
    $allowed  = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak diizinkan.']);
        exit;
    }
    $ext     = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid('penulis_', true) . '.' . $ext;
    $dest    = __DIR__ . '/uploads_penulis/' . $newName;
    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan foto.']);
        exit;
    }
    // Hapus foto lama jika bukan default
    if ($old['foto'] !== 'default.png') {
        $oldPath = __DIR__ . '/uploads_penulis/' . $old['foto'];
        if (file_exists($oldPath)) unlink($oldPath);
    }
    $foto = $newName;
}

// Update password jika diisi
if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt   = $koneksi->prepare(
        "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, password=?, foto=? WHERE id=?"
    );
    $stmt->bind_param('sssssi', $nama_depan, $nama_belakang, $user_name, $hashed, $foto, $id);
} else {
    $stmt = $koneksi->prepare(
        "UPDATE penulis SET nama_depan=?, nama_belakang=?, user_name=?, foto=? WHERE id=?"
    );
    $stmt->bind_param('ssssi', $nama_depan, $nama_belakang, $user_name, $foto, $id);
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Data penulis berhasil diperbarui.']);
} else {
    if ($koneksi->errno === 1062) {
        echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data.']);
    }
}

$stmt->close();
$koneksi->close();
