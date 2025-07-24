<?php
include('../includes/db.php');
$id = $_POST['id'];
$nama = $_POST['nama'];
$nisn = $_POST['nisn'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$guru = $_POST['guru'];
$mapel = $_POST['mapel'];
$biaya = $_POST['biaya'];

mysqli_query($koneksi, "UPDATE pendaftaran SET 
  nama='$nama', 
  nisn='$nisn', 
  alamat='$alamat', 
  telepon='$telepon', 
  guru='$guru', 
  mapel='$mapel', 
  biaya='$biaya' 
WHERE id='$id'");

header("Location: data-pendaftar.php");
exit;
?>
