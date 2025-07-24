<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>+ Tambah Biaya</h2>
  <form method="post">
    <label>Nama Biaya</label><br>
    <input type="text" name="nama" required>
    <br><br>
    <label>Jumlah (Rp)</label><br>
    <input type="number" name="jumlah" required>
    <br><br>
    <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
    $nama   = htmlspecialchars($_POST['nama']);
    $jumlah = (int)$_POST['jumlah'];
    mysqli_query($koneksi, "INSERT INTO biaya (nama, jumlah) VALUES ('$nama', '$jumlah')");
    echo "<script>alert('Biaya berhasil ditambah'); location.href='data-biaya.php';</script>";
  }
  ?>
</div>

<?php include('../includes/footer.php'); ?>
