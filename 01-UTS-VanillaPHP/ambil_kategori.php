<?php
header('Content-Type: application/json');
require 'koneksi.php';

$result = $koneksi->query("SELECT * FROM kategori_artikel ORDER BY id DESC");
$data   = [];
while ($row = $result->fetch_assoc()) $data[] = $row;

echo json_encode(['status' => 'success', 'data' => $data]);
$koneksi->close();
