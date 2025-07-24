<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';

$id = intval($_GET['id']);
$to = ($_GET['to']=='kembali') ? 'kembali' : 'disewa';

// Cek id_cd
$cd = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_cd FROM transaksi WHERE id=$id"));
$id_cd = intval($cd['id_cd']);

if($to=='kembali'){
    $q1 = mysqli_query($koneksi, "UPDATE transaksi SET status='kembali', tanggal_kembali=NOW() WHERE id=$id");
    $q2 = mysqli_query($koneksi, "UPDATE cd SET stok=stok+1 WHERE id=$id_cd");
}else{
    $q1 = mysqli_query($koneksi, "UPDATE transaksi SET status='disewa', tanggal_kembali=NULL WHERE id=$id");
    $q2 = mysqli_query($koneksi, "UPDATE cd SET stok=stok-1 WHERE id=$id_cd");
}

if(!$q1){
    die('Query update status gagal: '.mysqli_error($koneksi));
}
if(!$q2){
    die('Query update stok gagal: '.mysqli_error($koneksi));
}

$_SESSION['notif'] = "✅ Status transaksi berhasil diubah!";
header("Location: transaksi.php");
exit();
?>
