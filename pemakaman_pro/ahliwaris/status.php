<?php
include '../koneksi.php';
include '../functions.php';
must_login('ahliwaris');

// Ambil ID user dari session login
$user_id = (int) $_SESSION['user']['id'];

// Query data pemesanan berdasarkan user
$data = mysqli_query($koneksi, "
  SELECT p.*, b.nama AS blok
  FROM pemesanan p
  JOIN blok b ON p.id_blok = b.id
  WHERE p.id_user = $user_id
  ORDER BY p.tanggal_pesan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Status Pemesanan Makam</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .status {
      font-weight: bold;
      padding: 4px 8px;
      border-radius: 5px;
      display: inline-block;
    }
    .status.pending { color: orange; }
    .status.diterima { color: green; }
    .status.ditolak { color: red; }
  </style>
</head>
<body>
<div class="container">
  <h2>Status Pemesanan Makam</h2>

  <table>
    <thead>
      <tr>
        <th>Tanggal Pesan</th>
        <th>Nama Jenazah</th>
        <th>Blok</th>
        <th>Keterangan</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($data) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($data)): ?>
          <tr>
            <td><?= htmlspecialchars($row['tanggal_pesan']) ?></td>
            <td><?= htmlspecialchars($row['nama_jenazah']) ?></td>
            <td><?= htmlspecialchars($row['blok']) ?></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td>
              <span class="status <?= htmlspecialchars($row['status']) ?>">
                <?= ucfirst($row['status']) ?>
              </span>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" style="text-align:center;">
            Belum ada pemesanan yang tercatat.
          </td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
