<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
if (!$id) { echo json_encode(['status'=>'error','message'=>'ID tidak valid.']); exit; }

$stmtCek = $koneksi->prepare("SELECT COUNT(*) AS total FROM artikel WHERE id_kategori = ?");
$stmtCek->bind_param('i', $id);
$stmtCek->execute();
$cek = $stmtCek->get_result()->fetch_assoc();
$stmtCek->close();

if ($cek['total'] > 0) {
    echo json_encode(['status'=>'error','message'=>'Kategori masih memiliki artikel, tidak dapat dihapus.']);
    exit;
}

$stmt = $koneksi->prepare("DELETE FROM kategori_artikel WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) echo json_encode(['status'=>'success','message'=>'Kategori berhasil dihapus.']);
else                  echo json_encode(['status'=>'error','message'=>'Gagal menghapus kategori.']);

$stmt->close(); $koneksi->close();
