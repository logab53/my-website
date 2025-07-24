<?php
$host = "localhost";
$user = "root";
$pass = ""; // Ganti kalau MySQL-mu ada password
$db   = "pemakaman";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
