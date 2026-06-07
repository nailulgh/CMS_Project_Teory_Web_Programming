<?php
header('Content-Type: application/json');
require 'koneksi.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { echo json_encode(['status'=>'error','message'=>'ID tidak valid.']); exit; }

$stmt = $koneksi->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close(); $koneksi->close();

if ($row) echo json_encode(['status'=>'success','data'=>$row]);
else      echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan.']);
