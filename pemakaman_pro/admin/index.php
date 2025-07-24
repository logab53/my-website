<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../functions.php';
must_login('admin');

// Ambil nama user yang login
$username = htmlspecialchars($_SESSION['user']['username']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background-image: url('../assets/img/bg-pemakaman.jpg'); /* Pastikan path dan nama file sesuai */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 900px;
      margin: 50px auto;
      padding: 20px;
      background: rgba(255, 255, 255, 0.95); /* sedikit transparan agar background kelihatan */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 10px;
    }
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }
    .menu-grid .card {
      background: #fff;
      padding: 25px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: 0.3s;
      border: 1px solid #ddd;
    }
    .menu-grid .card:hover {
      background: #f9f9f9;
      transform: scale(1.03);
    }
    .menu-grid a {
      display: block;
      font-size: 18px;
      font-weight: bold;
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Selamat Datang, <?= $username ?> 👋</h2>
    <p>Silakan pilih menu manajemen:</p>

    <div class="menu-grid">
      <div class="card"><a href="blok_crud.php">📦 Kelola Blok Makam</a></div>
      <div class="card"><a href="jenazah_crud.php">⚰️ Input Jenazah Manual</a></div>
      <div class="card"><a href="pemesanan_crud.php">📥 Kelola Pemesanan</a></div>
      <div class="card"><a href="users_crud.php">👤 Manajemen User</a></div>
      <div class="card"><a href="laporan.php">📄 Laporan</a></div>
      <div class="card"><a href="../logout.php">🔚 Logout</a></div>
    </div>
  </div>
</body>
</html>
