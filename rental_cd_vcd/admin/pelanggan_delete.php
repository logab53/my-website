<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';

$id = intval($_GET['id']);
$hapus = mysqli_query($koneksi, "DELETE FROM users WHERE id=$id AND role='pelanggan'");

if($hapus){
    $_SESSION['notif'] = "✅ Pelanggan berhasil dihapus!";
} else {
    $_SESSION['notif'] = "❌ Gagal menghapus pelanggan!";
}

header("Location: pelanggan.php");
exit();
?>
