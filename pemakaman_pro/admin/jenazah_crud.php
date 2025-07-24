<?php
include '../koneksi.php';
include '../functions.php';
must_login('admin'); // pastikan sudah login dan session tersedia

$pesan = '';

// Tambah jenazah manual
if (isset($_POST['tambah'])) {
  $nama_jenazah = trim(mysqli_real_escape_string($koneksi, $_POST['nama_jenazah']));
  $tanggal_wafat = $_POST['tanggal_wafat'];
  $id_blok = intval($_POST['id_blok']);
  $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']));
  $id_user = $_SESSION['user']['id']; // ambil id user dari session login

  if (!$nama_jenazah || !$tanggal_wafat || !$id_blok || !$keterangan) {
    $pesan = "❌ Semua field wajib diisi.";
  } else {
    $query = mysqli_query($koneksi, "
      INSERT INTO pemesanan (id_user, id_blok, nama_jenazah, tanggal_wafat, keterangan, status, tanggal_pesan)
      VALUES ($id_user, $id_blok, '$nama_jenazah', '$tanggal_wafat', '$keterangan', 'diterima', NOW())
    ");
    $pesan = $query ? "✅ Jenazah berhasil ditambahkan." : "❌ Gagal menambah data. " . mysqli_error($koneksi);
  }
}

// Hapus jenazah manual (id_user sesuai login)
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  $id_user = $_SESSION['user']['id'];
  mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id=$id AND id_user=$id_user");
  header("Location: jenazah_crud.php");
  exit;
}

// Ambil data jenazah dari user yang login
$id_user = $_SESSION['user']['id'];
$data = mysqli_query($koneksi, "
  SELECT p.*, b.nama AS blok
  FROM pemesanan p
  JOIN blok b ON p.id_blok = b.id
  WHERE p.id_user = $id_user
  ORDER BY p.tanggal_pesan DESC
");

// Ambil data blok untuk select option
$blok = mysqli_query($koneksi, "SELECT * FROM blok ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Jenazah Manual</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .flash-msg {
      padding: 10px;
      margin-bottom: 15px;
      background: #e0ffe0;
      border-left: 5px solid #28a745;
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table th, table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    form {
      margin-bottom: 30px;
    }
    textarea {
      width: 100%;
      height: 60px;
    }
    input, select, textarea {
      padding: 8px;
      margin-bottom: 10px;
      width: 100%;
    }
    button {
      padding: 10px 15px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
  </style>
  <script>
    function confirmDelete() {
      return confirm("Yakin ingin menghapus data jenazah ini?");
    }
  </script>
</head>
<body>
<div class="container">
  <h2>Data Jenazah (Input Manual)</h2>

  <?php if ($pesan): ?>
    <div class="flash-msg"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <form method="post">
    <h3>Tambah Data Jenazah</h3>
    <input type="text" name="nama_jenazah" placeholder="Nama Jenazah" required>
    <input type="date" name="tanggal_wafat" required>
    <select name="id_blok" required>
      <option value="">- Pilih Blok -</option>
      <?php while ($b = mysqli_fetch_assoc($blok)) : ?>
        <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nama']) ?></option>
      <?php endwhile; ?>
    </select>
    <textarea name="keterangan" placeholder="Keterangan lokasi atau identitas lainnya" required></textarea>
    <button type="submit" name="tambah">➕ Tambah Jenazah</button>
  </form>

  <h3>Daftar Jenazah (Manual)</h3>
  <table>
    <thead>
      <tr>
        <th>Tanggal Input</th>
        <th>Nama Jenazah</th>
        <th>Tanggal Wafat</th>
        <th>Blok</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($j = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= htmlspecialchars($j['tanggal_pesan']) ?></td>
          <td><?= htmlspecialchars($j['nama_jenazah']) ?></td>
          <td><?= htmlspecialchars($j['tanggal_wafat']) ?></td>
          <td><?= htmlspecialchars($j['blok']) ?></td>
          <td><?= htmlspecialchars($j['keterangan']) ?></td>
          <td>
            <a href="?hapus=<?= $j['id'] ?>" onclick="return confirmDelete()">🗑️ Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
