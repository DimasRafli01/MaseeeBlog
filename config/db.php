<?php

// Baca variabel lingkungan dari .env
// $env = parse_ini_file('../.env');
$env = parse_ini_file(dirname(__DIR__) . '/./.env');

// Konfigurasi database
$db_host = $env['DB_HOST'];
$db_user = $env['DB_USER'];
$db_pass = $env['DB_PASS'];
$db_name = $env['DB_NAME'];

// Koneksi ke database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// else {
//     // echo "Koneksi berhasil";
// }

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}
?>