<?php
include '../koneksi.php';
include '../functions.php';
must_login('admin');

$pesan = '';

// Proses acc/tolak
if (isset($_GET['acc'])) {
  $id = intval($_GET['acc']);
  mysqli_query($koneksi, "UPDATE pemesanan SET status='diterima' WHERE id=$id");
  flash("✅ Pemesanan diterima.");
  header("Location: pemesanan_crud.php");
  exit;
}

if (isset($_GET['tolak'])) {
  $id = intval($_GET['tolak']);
  mysqli_query($koneksi, "UPDATE pemesanan SET status='ditolak' WHERE id=$id");
  flash("❌ Pemesanan ditolak.");
  header("Location: pemesanan_crud.php");
  exit;
}

if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id=$id");
  flash("🗑️ Pemesanan berhasil dihapus.");
  header("Location: pemesanan_crud.php");
  exit;
}

// Ambil semua pemesanan
$data = mysqli_query($koneksi, "
  SELECT p.*, u.username, b.nama AS blok
  FROM pemesanan p
  JOIN users u ON p.id_user = u.id
  JOIN blok b ON p.id_blok = b.id
  ORDER BY p.tanggal_pesan DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manajemen Pemesanan</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .flash-msg {
      padding: 10px;
      margin: 15px 0;
      background-color: #f0f8ff;
      border-left: 5px solid #007bff;
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
    }
  </style>
  <script>
    function confirmDelete() {
      return confirm("Yakin ingin menghapus pemesanan ini?");
    }
  </script>
</head>
<body>
<div class="container">
  <h2>Daftar Pemesanan Makam</h2>

  <?= get_flash(); ?>

  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Pengaju</th>
        <th>Jenazah</th>
        <th>Tgl Wafat</th>
        <th>Blok</th>
        <th>Keterangan</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($p = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= htmlspecialchars($p['tanggal_pesan']) ?></td>
          <td><?= htmlspecialchars($p['username']) ?></td>
          <td><?= htmlspecialchars($p['nama_jenazah']) ?></td>
          <td><?= htmlspecialchars($p['tanggal_wafat']) ?></td>
          <td><?= htmlspecialchars($p['blok']) ?></td>
          <td><?= htmlspecialchars($p['keterangan']) ?></td>
          <td>
            <?php
              if ($p['status'] == 'pending') {
                echo "<span style='color:orange;'>Menunggu</span>";
              } elseif ($p['status'] == 'diterima') {
                echo "<span style='color:green;'>Diterima</span>";
              } else {
                echo "<span style='color:red;'>Ditolak</span>";
              }
            ?>
          </td>
          <td>
            <?php if ($p['status'] == 'pending'): ?>
              <a href="?acc=<?= $p['id'] ?>" onclick="return confirm('Yakin ACC pemesanan ini?')">✅ ACC</a> |
              <a href="?tolak=<?= $p['id'] ?>" onclick="return confirm('Yakin tolak pemesanan ini?')">❌ Tolak</a> |
            <?php endif; ?>
            <a href="?hapus=<?= $p['id'] ?>" onclick="return confirmDelete()">🗑️ Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
