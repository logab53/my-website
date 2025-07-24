<?php
include '../includes/db.php';

// Ambil data input
$nama   = $_POST['nama'];
$nisn   = $_POST['nisn'];
$alamat = $_POST['alamat'];
$telepon= $_POST['telepon'];
$guru   = $_POST['guru'];
$mapel  = $_POST['mapel'];
$biaya  = $_POST['biaya'];
$jenis_kelamin = $_POST['jenis_kelamin'] ?? 'L';
$tanggal= date('Y-m-d');

// Upload file
$fileName = null;
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $fileName = date('YmdHis') . '_' . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/" . $fileName);
}

// Insert ke database
mysqli_query($koneksi, "INSERT INTO pendaftaran 
(nama, nisn, alamat, telepon, guru, mapel, biaya, tanggal_daftar, jenis_kelamin, file) 
VALUES 
('$nama','$nisn','$alamat','$telepon','$guru','$mapel','$biaya','$tanggal','$jenis_kelamin','$fileName')");

header("Location: data-pendaftar.php");
exit;
?>
