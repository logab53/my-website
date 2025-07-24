<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../functions.php';
must_login('ahliwaris');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Ahli Waris</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('../assets/img/bg-ahliwaris.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      max-width: 800px;
      width: 90%;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.8s ease;
    }

    h2 {
      margin-top: 0;
      text-align: center;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .menu-grid .card {
      background: #fff;
      padding: 25px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
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

    .menu-grid a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
<div class="container">
  <h2>👋 Selamat Datang, <span style="color:#007bff"><?= htmlspecialchars($_SESSION['user']['username']) ?></span></h2>
  <p style="text-align:center;">Gunakan menu berikut untuk mengakses layanan pemakaman:</p>

  <div class="menu-grid">
    <div class="card">
      <a href="pesan.php">📝 Ajukan Pemesanan Makam</a>
    </div>
    <div class="card">
      <a href="status.php">📄 Lihat Status Pemesanan</a>
    </div>
    <div class="card">
      <a href="../logout.php" onclick="return confirm('Yakin ingin logout?')">🚪 Keluar</a>
    </div>
  </div>
</div>
</body>
</html>
