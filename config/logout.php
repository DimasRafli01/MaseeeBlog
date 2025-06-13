<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan pengguna ke halaman login atau halaman beranda
header("Location: ./index.php?page=blog&logout=successlogout"); // Ganti index.php dengan halaman yang sesuai
exit();
?>