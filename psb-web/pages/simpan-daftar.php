<?php
include '../includes/db.php';

$nama = $_POST['nama'];
$nisn = $_POST['nisn'];
$sekolah_asal = $_POST['sekolah_asal'];
$nilai_ujian = $_POST['nilai_ujian'];
$jurusan_pilihan = $_POST['jurusan_pilihan'];
$jenis_kelamin = $_POST['jenis_kelamin'];

// Insert ke tabel pendaftaran
mysqli_query($koneksi, "INSERT INTO pendaftaran 
  (nama, nisn, sekolah_asal, nilai_ujian, jurusan_pilihan, tanggal_daftar, jenis_kelamin)
VALUES
  ('$nama', '$nisn', '$sekolah_asal', '$nilai_ujian', '$jurusan_pilihan', NOW(), '$jenis_kelamin')");

header("Location: data-pendaftar.php");
exit;
?>
