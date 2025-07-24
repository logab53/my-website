<?php
include '../includes/db.php';  // WAJIB: supaya $koneksi ada

$id = $_GET['id'];

// Hapus data mapel
mysqli_query($koneksi, "DELETE FROM mapel WHERE id='$id'");

// Balik ke halaman data mapel
header("Location: data-mapel.php");
exit;
?>
