<?php
include '../includes/db.php';
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM guru WHERE id='$id'");
header("Location: data-guru.php");
exit;
?>
