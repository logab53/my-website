<?php
// Optional: hilangkan error NOTICE (bisa dihapus kalau gak mau)
error_reporting(E_ALL & ~E_NOTICE);

include 'koneksi.php';
include 'functions.php';

// Fix session_start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pesan = '';

if (isset($_POST['daftar'])) {
    $username   = trim($_POST['username']);
    $password   = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi input
    if ($username === '' || $password === '' || $konfirmasi === '') {
        $pesan = "❌ Semua field wajib diisi.";
    } elseif (strlen($password) < 6) {
        $pesan = "❌ Password minimal 6 karakter.";
    } elseif ($password !== $konfirmasi) {
        $pesan = "❌ Konfirmasi password tidak sesuai.";
    } else {
        $username_safe = mysqli_real_escape_string($koneksi, $username);
        $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username_safe'");

        if (mysqli_num_rows($cek) > 0) {
            $pesan = "❌ Username sudah terdaftar.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username_safe', '$hash', 'ahliwaris')");
            $_SESSION['flash'] = "✅ Akun berhasil dibuat. Silakan login.";
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Akun Ahli Waris</title>
  <style>
    body {
      font-family: Arial;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .box {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
      font-weight: bold;
    }
    .footer {
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="box">
  <h2>Daftar Akun</h2>

  <?php if ($pesan): ?>
    <div class="error"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
    <button type="submit" name="daftar">Daftar</button>
  </form>

  <div class="footer">
    Sudah punya akun? <a href="login.php">Login</a>
  </div>
</div>

</body>
</html>
