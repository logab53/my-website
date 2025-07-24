<?php
include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    mysqli_query($koneksi, "DELETE FROM biaya WHERE id='$id'");
}

header('Location: data-biaya.php');
exit;
?>
