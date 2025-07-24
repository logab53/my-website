<?php
include '../koneksi.php';

$hasil = [];
$keyword = '';

// Proses pencarian
if (isset($_GET['cari'])) {
  $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
  $query = "
    SELECT p.*, b.nama AS blok
    FROM pemesanan p
    JOIN blok b ON p.id_blok = b.id
    WHERE p.status = 'diterima' 
      AND p.nama_jenazah LIKE '%$keyword%'
    ORDER BY p.tanggal_wafat DESC
  ";
  $hasil = mysqli_query($koneksi, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cari Jenazah</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    form {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 30px;
    }
    input[type="text"] {
      flex: 1;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      padding: 12px 24px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background: #0056b3;
    }
    .hasil {
      background: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      line-height: 1.6;
    }
    .hasil strong {
      color: #333;
    }
    .not-found {
      font-style: italic;
      color: #999;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>🔍 Pencarian Jenazah</h2>
  
  <form method="get">
    <input type="text" name="cari" placeholder="Masukkan nama jenazah..." value="<?= htmlspecialchars($keyword) ?>" required>
    <button type="submit">Cari</button>
  </form>

  <?php if (isset($_GET['cari'])): ?>
    <h3>Hasil untuk: "<em><?= htmlspecialchars($keyword) ?></em>"</h3>

    <?php if (mysqli_num_rows($hasil) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($hasil)) : ?>
        <div class="hasil">
          <strong>Nama:</strong> <?= htmlspecialchars($row['nama_jenazah']) ?><br>
          <strong>Tanggal Wafat:</strong> <?= htmlspecialchars($row['tanggal_wafat']) ?><br>
          <strong>Blok:</strong> <?= htmlspecialchars($row['blok']) ?><br>
          <strong>Keterangan:</strong> <?= htmlspecialchars($row['keterangan']) ?>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="not-found">Tidak ditemukan hasil untuk pencarian ini.</p>
    <?php endif; ?>
  <?php endif; ?>
</div>
</body>
</html>
