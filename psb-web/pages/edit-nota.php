<?php
include '../includes/header.php';
include '../includes/db.php';

$id = $_GET['id'];

// Ambil data lama
$data = mysqli_query($koneksi, "SELECT * FROM nota WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_nota = htmlspecialchars($_POST['no_nota']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $jumlah = intval($_POST['jumlah']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    mysqli_query($koneksi, "UPDATE nota SET 
        no_nota='$no_nota', 
        tanggal='$tanggal', 
        jumlah='$jumlah', 
        keterangan='$keterangan' 
        WHERE id='$id'");

    header("Location: data-nota.php");
    exit;
}

// Format tanggal ke YYYY-MM-DD (buat input type="date")
$tanggal_value = '';
if (!empty($row['tanggal'])) {
    $tanggal_value = date('Y-m-d', strtotime($row['tanggal']));
}
?>

<div class="card">
  <h2>✏️ Edit Nota</h2>
  <form method="POST">
    <label>No Nota</label><br>
    <input type="text" name="no_nota" value="<?= htmlspecialchars($row['no_nota']) ?>" required>
    <br><br>

    <label>Tanggal</label><br>
    <input type="date" name="tanggal" value="<?= $tanggal_value ?>" required>
    <br><br>

    <label>Jumlah (Rp)</label><br>
    <input type="number" name="jumlah" value="<?= htmlspecialchars($row['jumlah']) ?>" required>
    <br><br>

    <label>Keterangan</label><br>
    <input type="text" name="keterangan" value="<?= htmlspecialchars($row['keterangan']) ?>">
    <br><br>

    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
