<?php
include '../includes/db.php';
$id = (int)$_GET['id']; // biar aman cast ke integer

// hapus file juga
$data = mysqli_query($koneksi, "SELECT file FROM formulir WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
if ($row && $row['file']) {
    @unlink("../uploads/" . $row['file']);
}

// hapus data dari DB
mysqli_query($koneksi, "DELETE FROM formulir WHERE id='$id'");

header("Location: data-formulir.php");
exit;
?>
