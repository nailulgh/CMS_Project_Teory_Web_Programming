<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
if (!$id) { echo json_encode(['status'=>'error','message'=>'ID tidak valid.']); exit; }

$stmtG = $koneksi->prepare("SELECT gambar FROM artikel WHERE id = ?");
$stmtG->bind_param('i', $id);
$stmtG->execute();
$row = $stmtG->get_result()->fetch_assoc();
$stmtG->close();

if (!$row) { echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan.']); exit; }

$stmt = $koneksi->prepare("DELETE FROM artikel WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    $path = __DIR__ . '/uploads_artikel/' . $row['gambar'];
    if (file_exists($path)) unlink($path);
    echo json_encode(['status'=>'success','message'=>'Artikel berhasil dihapus.']);
} else {
    echo json_encode(['status'=>'error','message'=>'Gagal menghapus artikel.']);
}

$stmt->close(); $koneksi->close();
