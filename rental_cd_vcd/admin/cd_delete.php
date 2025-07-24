<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';

$id = intval($_GET['id']);
$cek = mysqli_query($koneksi, "SELECT * FROM cd WHERE id=$id");

if(mysqli_num_rows($cek) > 0){
    $hapus = mysqli_query($koneksi, "DELETE FROM cd WHERE id=$id");
    if($hapus){
        $_SESSION['notif'] = "✅ CD berhasil dihapus!";
    }else{
        $_SESSION['notif'] = "❌ Gagal menghapus CD. Mungkin sudah ada transaksi yang menggunakan CD ini.";
    }
} else {
    $_SESSION['notif'] = "⚠️ CD tidak ditemukan!";
}

header("Location: cd.php");
exit();
?>
