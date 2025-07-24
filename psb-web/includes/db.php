<?php
// Buat koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'psb'); // ganti 'psb' kalau nama DB kamu beda

// Alias supaya file lama & baru tetep jalan:
$conn = $koneksi;

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
