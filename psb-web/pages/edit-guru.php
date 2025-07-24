<?php
include '../includes/db.php';

// Ambil ID guru dari URL
$id = $_GET['id'];

// Cek kalo form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);

    // Update data guru
    mysqli_query($koneksi, "UPDATE guru SET nama='$nama', telepon='$telepon' WHERE id='$id'");

    // Balik ke data guru
    header("Location: data-guru.php");
    exit;
}

// Ambil data guru untuk diedit
$data = mysqli_query($koneksi, "SELECT * FROM guru WHERE id='$id'");
$row = mysqli_fetch_assoc($data);
?>

<?php include('../includes/header.php'); ?>

<div class="card">
  <h2>✏️ Edit Data Guru</h2>
  <form method="post">
    <label>Nama Guru</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
    <label>Telepon</label>
    <input type="text" name="telepon" value="<?= htmlspecialchars($row['telepon']) ?>" required>
    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
