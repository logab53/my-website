<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>+ Tambah Formulir</h2>
  <form method="post" enctype="multipart/form-data">
    <label>Nama Formulir</label><br>
    <input type="text" name="nama" required>
    <br><br>
    <label>File (PDF/JPG)</label><br>
    <input type="file" name="file" required>
    <br><br>
    <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
  </form>

<?php
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $file = $_FILES['file']['name'];
    $tmp  = $_FILES['file']['tmp_name'];

    // pastikan folder uploads ada
    if (!file_exists('../uploads')) {
        mkdir('../uploads', 0777, true);
    }

    // pindahkan file
    if (move_uploaded_file($tmp, '../uploads/'.$file)) {
        mysqli_query($koneksi, "INSERT INTO formulir (nama, file) VALUES ('$nama', '$file')");
        echo "<script>alert('Formulir berhasil ditambahkan'); location.href='data-formulir.php';</script>";
    } else {
        echo "<p style='color:red;'>Upload file gagal</p>";
    }
}
?>
</div>

<?php include('../includes/footer.php'); ?>
