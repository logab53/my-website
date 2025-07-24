<?php
include '../includes/header.php';
include '../includes/db.php';

// Ambil ID biaya dari URL
$id = $_GET['id'];

// Ambil data biaya lama
$data = mysqli_query($koneksi, "SELECT * FROM biaya WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $jumlah = intval($_POST['jumlah']);

    // Update data biaya
    mysqli_query($koneksi, "UPDATE biaya SET nama='$nama', jumlah='$jumlah' WHERE id='$id'");

    // Balik ke data-biaya.php
    header("Location: data-biaya.php");
    exit;
}
?>

<div class="card">
  <h2>✏️ Edit Biaya</h2>
  <form method="POST">
    <label>Nama Biaya</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
    <br><br>
    <label>Jumlah (Rp)</label><br>
    <input type="number" name="jumlah" value="<?= htmlspecialchars($row['jumlah']) ?>" required>
    <br><br>
    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
