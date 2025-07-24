<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="pelanggan"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';

// Ambil id CD dari URL
$id_cd = intval($_GET['id']);

// Cek CD ada & stok > 0
$cek = mysqli_query($koneksi, "SELECT * FROM cd WHERE id=$id_cd AND stok>0");
if(mysqli_num_rows($cek)==0){
    $_SESSION['notif'] = "CD tidak tersedia atau stok habis!";
    header("Location: katalog.php");
    exit();
}

// Buat kode sewa random
$kode = 'SEWA'.time();

// Ambil id user pelanggan
$username = $_SESSION['username'];
$pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM users WHERE username='$username'"));
$id_pelanggan = $pelanggan['id'];

// Tambah ke transaksi
mysqli_query($koneksi, "INSERT INTO transaksi (kode_sewa, id_pelanggan, id_cd) VALUES 
  ('$kode', '$id_pelanggan', '$id_cd')");

// Kurangi stok CD
mysqli_query($koneksi, "UPDATE cd SET stok=stok-1 WHERE id=$id_cd");

// Notif & redirect
$_SESSION['notif'] = "✅ Berhasil menyewa CD!";
header("Location: katalog.php");
exit();
?>
