<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';

$judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
$genre = mysqli_real_escape_string($koneksi, $_POST['genre']);
$stok = intval($_POST['stok']);

mysqli_query($koneksi, "INSERT INTO cd (judul, genre, stok) VALUES ('$judul','$genre',$stok)");
$_SESSION['notif'] = "CD berhasil ditambahkan!";
header("Location: cd.php");
exit();
?>
