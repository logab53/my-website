<?php
session_start();
include 'koneksi.php';

if(isset($_POST['daftar'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){
        $_SESSION['notif'] = "Username sudah digunakan!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed', 'pelanggan')");
        $_SESSION['notif'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register - Rental CD</title>
<style>
body {
  background:#141414; color:#fff; font-family:sans-serif;
  display:flex; justify-content:center; align-items:center; height:100vh; margin:0;
}
form {
  background:#222; padding:20px; border-radius:8px; width:300px;
  box-shadow:0 0 10px rgba(0,0,0,0.7);
}
input[type=text], input[type=password] {
  width:100%; padding:8px; margin:6px 0; border:none; border-radius:4px;
}
.btn {
  background:#2196f3; color:#fff; border:none; padding:8px 12px; width:100%;
  border-radius:4px; cursor:pointer;
}
.btn:hover { opacity:0.8; }
.notif {
  background:#333; color:#0f0; padding:8px; margin-bottom:8px; border-radius:4px; text-align:center;
}
a { color:#2196f3; text-decoration:none; font-size:12px; }
a:hover { text-decoration:underline; }
</style>
</head>
<body>

<form method="POST">
  <h2 style="text-align:center;">Daftar</h2>
  <?php if(isset($_SESSION['notif'])){ ?>
    <div class="notif"><?= $_SESSION['notif']; unset($_SESSION['notif']); ?></div>
  <?php } ?>
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="daftar" class="btn">Daftar</button>
  <p style="text-align:center; margin-top:10px;">Sudah punya akun? <a href="login.php">Login</a></p>
</form>

</body>
</html>
