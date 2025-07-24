<?php
include '../includes/db.php';
$id = (int)$_GET['id']; // biar aman cast ke integer

mysqli_query($koneksi, "DELETE FROM pelajaran WHERE id='$id'");

header("Location: data-pelajaran.php");
exit;
?>
