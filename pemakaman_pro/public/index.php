<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Website Pemakaman Digital</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background-image: url('../assets/img/bg-pemakaman.jpg'); /* GANTI sesuai nama file */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .container {
      max-width: 800px;
      margin: 60px auto;
      padding: 30px;
      background-color: rgba(255, 255, 255, 0.95); /* semi transparan */
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .hero {
      text-align: center;
    }

    .hero h1 {
      font-size: 32px;
      margin-bottom: 15px;
      color: #333;
    }

    .hero p {
      font-size: 18px;
      color: #555;
      line-height: 1.6;
    }

    .btn-list {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 30px;
    }

    .btn-list a {
      padding: 15px 25px;
      background-color: #007bff;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-list a:hover {
      background-color: #0056b3;
    }

    @media (max-width: 600px) {
      .btn-list {
        flex-direction: column;
        align-items: center;
      }

      .btn-list a {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="hero">
      <h1>Selamat Datang di Sistem Informasi Pemakaman</h1>
      <p>Temukan informasi jenazah dan pemesanan makam secara online dengan mudah, cepat, dan transparan.</p>

      <div class="btn-list">
        <a href="cari.php">🔍 Cari Jenazah</a>
        <a href="map.php">🗺️ Lihat Peta Pemakaman</a>
        <a href="../login.php">🔐 Login</a>
        <a href="../register.php">📝 Daftar Akun</a>
      </div>
    </div>
  </div>
</body>
</html>
