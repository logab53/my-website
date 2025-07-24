<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';

$id = intval($_POST['id']);
$judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
$genre = mysqli_real_escape_string($koneksi, $_POST['genre']);
$stok = intval($_POST['stok']);

mysqli_query($koneksi, "UPDATE cd SET judul='$judul', genre='$genre', stok=$stok WHERE id=$id");
$_SESSION['notif'] = "CD berhasil diupdate!";
header("Location: cd.php");
exit();
?>
