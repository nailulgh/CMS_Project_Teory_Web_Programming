<?php
$host = 'db';
$user = 'root';
$pass = 'root';
$db   = 'db_blog';

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die(json_encode([
        'status'  => 'error',
        'message' => 'Koneksi database gagal: ' . $koneksi->connect_error
    ]));
}

$koneksi->set_charset('utf8mb4');
