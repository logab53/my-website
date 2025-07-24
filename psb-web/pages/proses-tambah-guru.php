<?php
include '../includes/db.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];

// Simpan ke database
mysqli_query($koneksi, "INSERT INTO guru (nama, telepon) VALUES ('$nama','$telepon')");

// Balik ke data guru
header("Location: data-guru.php");
exit;
?>
