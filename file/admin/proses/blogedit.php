<?php
include 'config/db.php';

$id = $_POST['id'];
$penulis = $_POST['penulis'];
$tanggal = $_POST['tanggal'];
$judul = $_POST['judul'];
$isi = $_POST['isiartikel'];
$idC = $_POST['idkategori'];

$query = mysqli_query($conn,"UPDATE blog SET penulis = '$penulis', tanggalbuat= '$tanggal', judul= '$judul', isi= '$isi',idkategori='$idC' where idblog = '$id' ");

header("Location:index.php?page=admin");
?>