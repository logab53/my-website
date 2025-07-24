<?php
session_start();
include '../koneksi.php';
include '../functions.php';

// Hanya admin yang boleh akses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak. Halaman ini hanya untuk Admin'); window.location='../login.php';</script>";
    exit;
}

$pesan = '';

// Tambah User
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "❌ Username sudah terdaftar.";
    } else {
        mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
        $pesan = "✅ User berhasil ditambahkan.";
    }
}

// Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
    header("Location: users_crud.php");
    exit;
}

// Ambil data user
$data = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manajemen User</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script>
    function confirmDelete() {
      return confirm("Yakin ingin menghapus user ini?");
    }
  </script>
</head>
<body>
<div class="container">
  <h2>Manajemen User</h2>

  <?php if ($pesan): ?>
    <div class="flash-msg"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <form method="post" style="margin-bottom: 30px;">
    <h3>Tambah User Baru</h3>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
      <option value="">- Pilih Role -</option>
      <option value="admin">Admin</option>
      <option value="ahliwaris">Ahli Waris</option>
    </select>
    <button type="submit" name="tambah">Tambah User</button>
  </form>

  <h3>Daftar User</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($u = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <td><?= $u['role'] ?></td>
          <td>
            <a href="users_crud.php?hapus=<?= $u['id'] ?>" onclick="return confirmDelete()">🗑️ Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
