<?php
include '../koneksi.php';
include '../functions.php';
must_login('admin');

$pesan = '';
$edit = false;
$id_edit = '';
$nama_edit = '';

// Tambah blok
if (isset($_POST['tambah'])) {
  $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
  $cek = mysqli_query($koneksi, "SELECT * FROM blok WHERE nama='$nama'");
  if (mysqli_num_rows($cek) > 0) {
    $pesan = "❌ Nama blok sudah ada.";
  } else {
    mysqli_query($koneksi, "INSERT INTO blok (nama) VALUES ('$nama')");
    $pesan = "✅ Blok berhasil ditambahkan.";
  }
}

// Proses edit
if (isset($_GET['edit'])) {
  $id_edit = intval($_GET['edit']);
  $edit = true;
  $result = mysqli_query($koneksi, "SELECT * FROM blok WHERE id=$id_edit");
  if ($row = mysqli_fetch_assoc($result)) {
    $nama_edit = $row['nama'];
  } else {
    $pesan = "❌ Data tidak ditemukan.";
    $edit = false;
  }
}

// Simpan edit
if (isset($_POST['update'])) {
  $id = intval($_POST['id']);
  $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
  mysqli_query($koneksi, "UPDATE blok SET nama='$nama' WHERE id=$id");
  $pesan = "✅ Blok berhasil diperbarui.";
  $edit = false;
}

// Hapus blok
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($koneksi, "DELETE FROM blok WHERE id=$id");
  header("Location: blok_crud.php");
  exit;
}

// Ambil semua blok
$data = mysqli_query($koneksi, "SELECT * FROM blok ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Kelola Blok Pemakaman</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script>
    function confirmDelete() {
      return confirm("Yakin ingin menghapus blok ini?");
    }
  </script>
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
      margin-top: 15px;
    }
    table th, table td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }
    .btn {
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 5px;
      background: #ddd;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Manajemen Blok Pemakaman</h2>

  <?php if ($pesan): ?>
    <div class="flash-msg"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <form method="post" style="margin-bottom: 20px;">
    <h3><?= $edit ? 'Edit Blok' : 'Tambah Blok Baru' ?></h3>
    <input type="text" name="nama" placeholder="Nama Blok" value="<?= htmlspecialchars($nama_edit) ?>" required>
    <?php if ($edit): ?>
      <input type="hidden" name="id" value="<?= intval($id_edit) ?>">
      <button type="submit" name="update">💾 Update</button>
      <a href="blok_crud.php" class="btn" onclick="return confirm('Batalkan edit?')">↩️ Batal</a>
    <?php else: ?>
      <button type="submit" name="tambah">➕ Tambah</button>
    <?php endif; ?>
  </form>

  <h3>Daftar Blok</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Blok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($b = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $b['id'] ?></td>
          <td><?= htmlspecialchars($b['nama']) ?></td>
          <td>
            <a href="?edit=<?= $b['id'] ?>">✏️ Edit</a> |
            <a href="?hapus=<?= $b['id'] ?>" onclick="return confirmDelete()">🗑️ Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
