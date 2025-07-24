<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';
include '../includes/header.php';

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM cd WHERE id=$id"));
?>

<h2 style="text-align:center;">Edit CD</h2>

<form method="post" action="cd_update.php" enctype="multipart/form-data" style="max-width:400px;margin:auto;">
  <input type="hidden" name="id" value="<?= $data['id']; ?>">

  <label>Judul:</label>
  <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required><br><br>

  <label>Genre:</label>
  <input type="text" name="genre" value="<?= htmlspecialchars($data['genre']); ?>" required><br><br>

  <label>Stok:</label>
  <input type="number" name="stok" value="<?= $data['stok']; ?>" required><br><br>

  <label>Cover Saat Ini:</label><br>
  <?php if (!empty($data['cover'])): ?>
    <img src="../assets/covers/<?= $data['cover']; ?>" style="height:100px;"><br>
  <?php else: ?>
    <p><i>Belum ada cover</i></p>
  <?php endif; ?>
  <br>

  <label>Upload Cover Baru (opsional):</label>
  <input type="file" name="cover" accept="image/*"><br><br>

  <button type="submit" class="btn">Simpan Perubahan</button>
</form>

<?php include '../includes/footer.php'; ?>
