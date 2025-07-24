<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form & amanin
    $no_nota    = mysqli_real_escape_string($conn, $_POST['no_nota']);
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $jumlah     = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Query simpan
    $query = "INSERT INTO nota (no_nota, tanggal, jumlah, keterangan)
              VALUES ('$no_nota', '$tanggal', '$jumlah', '$keterangan')";

    if (mysqli_query($conn, $query)) {
        header("Location: data-nota.php");
        exit;
    } else {
        echo "Gagal simpan: " . mysqli_error($conn);
    }
}
?>

<?php include('../includes/header.php'); ?>
<div class="card">
  <h2>+ Tambah Nota</h2>
  <form method="post">
    <label>No Nota</label><br>
    <input type="text" name="no_nota" required><br><br>
    
    <label>Tanggal</label><br>
    <input type="date" name="tanggal" required><br><br>
    
    <label>Jumlah (Rp)</label><br>
    <input type="number" name="jumlah" required><br><br>
    
    <label>Keterangan</label><br>
    <input type="text" name="keterangan"><br><br>
    
    <button type="submit" class="btn-primary">💾 Simpan</button>
  </form>
</div>
<?php include('../includes/footer.php'); ?>
