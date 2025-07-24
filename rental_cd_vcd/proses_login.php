<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($cek) == 1){
        $user = mysqli_fetch_assoc($cek);
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role']=='admin'){
                header("Location: admin/cd.php");
            } else {
                header("Location: pelanggan/index.php");
            }
            exit();
        } else {
            $_SESSION['notif'] = "Password salah!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['notif'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
