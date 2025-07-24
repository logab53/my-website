<?php
include '../includes/db.php';
$id = $_GET['id'];

// cari file lama
$data = mysqli_query($koneksi, "SELECT file FROM pendaftaran WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
if($row && $row['file']){
    @unlink("../uploads/".$row['file']);
}

mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id='$id'");
header("Location: data-pendaftar.php");
exit;
?>
