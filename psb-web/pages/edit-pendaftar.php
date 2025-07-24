<?php
include('../includes/db.php');
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM pendaftaran WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
include('../includes/header.php');
?>
<div class="card">
  <h2>✏️ Edit Data Pendaftar</h2>
  <form method="post" action="update-pendaftar.php">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required><br>
    <label>NISN</label>
    <input type="text" name="nisn" value="<?= htmlspecialchars($row['nisn']) ?>" required><br>
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($row['alamat']) ?>"><br>
    <label>Telepon</label>
    <input type="text" name="telepon" value="<?= htmlspecialchars($row['telepon']) ?>"><br>
    <label>Guru</label>
    <input type="text" name="guru" value="<?= htmlspecialchars($row['guru']) ?>"><br>
    <label>Mapel</label>
    <input type="text" name="mapel" value="<?= htmlspecialchars($row['mapel']) ?>"><br>
    <label>Biaya</label>
    <input type="text" name="biaya" value="<?= htmlspecialchars($row['biaya']) ?>"><br>
    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>
<?php include('../includes/footer.php'); ?>
