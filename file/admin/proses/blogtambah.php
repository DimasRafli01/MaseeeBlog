<?php
global $conn;             
global $cari;            
global $data_per_halaman;

$penulis = $_POST['penulis'];
$tanggal = $_POST['tanggal'];
$judul = $_POST['judul'];
$isi = $_POST['isiartikel'];
$idC = $_POST['idkategori'];

$query = mysqli_query($conn, "INSERT INTO blog (penulis, tanggalbuat, judul, isi, idkategori) values('$penulis','$tanggal','$judul','$isi','$idC')");

header("Location:index.php?page=admin");
?>