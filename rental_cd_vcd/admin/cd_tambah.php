<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../includes/header.php';
?>

<h2 style="text-align:center;">Tambah CD Baru</h2>

<form method="post" action="cd_tambah_proses.php" enctype="multipart/form-data" style="max-width:400px; margin:auto;">
  <label>Judul CD:</label><br>
  <input type="text" name="judul" required><br><br>

  <label>Genre:</label><br>
  <input type="text" name="genre" required><br><br>

  <label>Stok:</label><br>
  <input type="number" name="stok" min="1" required><br><br>

  <label>Cover (opsional):</label><br>
  <input type="file" name="cover" accept="image/*"><br><br>

  <button type="submit" class="btn">Simpan</button>
</form>

<?php include '../includes/footer.php'; ?>
