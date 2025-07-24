<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="pelanggan"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';

$id = intval($_GET['id']); // id transaksi

// Ambil dulu id_cd dari transaksi
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_cd FROM transaksi WHERE id=$id"));
$id_cd = $data['id_cd'];

// Update status transaksi jadi 'kembali' + tanggal_kembali
$q1 = mysqli_query($koneksi, "UPDATE transaksi SET status='kembali', tanggal_kembali=NOW() WHERE id=$id");

// Tambah stok CD
$q2 = mysqli_query($koneksi, "UPDATE cd SET stok = stok + 1 WHERE id=$id_cd");

if($q1 && $q2){
  $_SESSION['notif'] = "Pengembalian berhasil & stok CD diperbarui!";
  $_SESSION['type'] = "success";
} else {
  $_SESSION['notif'] = "Gagal mengembalikan CD!";
  $_SESSION['type'] = "error";
}

header("Location: pengembalian.php");
exit();
?>
