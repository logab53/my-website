<?php
include '../includes/db.php';

$id = (int)$_GET['id']; // Biar lebih aman, cast ke integer
mysqli_query($koneksi, "DELETE FROM nota WHERE id='$id'");

header("Location: data-nota.php");
exit;
?>
