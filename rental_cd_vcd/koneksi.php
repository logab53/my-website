<?php
$koneksi = mysqli_connect("localhost","root","","rental_cd_vcd");
// ganti user db, password & nama db sesuai setup lu
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
