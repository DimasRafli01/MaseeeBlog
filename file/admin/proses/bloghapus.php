<?php
global $conn;             
global $cari;            
global $data_per_halaman;

$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM blog WHERE idblog='$id'");

header("Location:index.php?page=admin");
?>