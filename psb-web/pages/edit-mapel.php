<?php
include '../includes/header.php';
include '../includes/db.php';

// Ambil ID mapel dari URL
$id = $_GET['id'];

// Ambil data mapel lama
$data = mysqli_query($koneksi, "SELECT * FROM mapel WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);

    // Update data mapel
    mysqli_query($koneksi, "UPDATE mapel SET nama='$nama' WHERE id='$id'");

    // Balik ke data-mapel.php
    header("Location: data-mapel.php");
    exit;
}
?>

<div class="card">
  <h2>✏️ Edit Mapel</h2>
  <form method="POST">
    <label>Nama Mapel</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
    <br><br>
    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>

