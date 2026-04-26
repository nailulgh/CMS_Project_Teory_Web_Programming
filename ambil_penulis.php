<?php
header('Content-Type: application/json');
require 'koneksi.php';

$sql    = "SELECT * FROM penulis ORDER BY id DESC";
$result = $koneksi->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $data]);
$koneksi->close();
