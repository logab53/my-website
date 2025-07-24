<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>+ Tambah Mapel</h2>
  <form method="post">
    <label>Nama Mapel</label><br>
    <input type="text" name="nama" required>
    <br><br>
    <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    mysqli_query($koneksi, "INSERT INTO mapel (nama) VALUES ('$nama')");
    echo "<script>alert('Mapel berhasil ditambah'); location.href='data-mapel.php';</script>";
  }
  ?>
</div>

<?php include('../includes/footer.php'); ?>
