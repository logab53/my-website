<?php
session_start();
include 'koneksi.php';

if(isset($_POST['daftar'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        $_SESSION['notif'] = "Username sudah digunakan!";
        header("Location: register.php");
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed', 'pelanggan')");
        $_SESSION['notif'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
    }
    exit();
} else {
    header("Location: register.php");
    exit();
}
?>
