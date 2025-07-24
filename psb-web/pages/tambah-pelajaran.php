<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>+ Tambah Pelajaran</h2>
  <form method="post">
    <label>Nama Pelajaran</label><br>
    <input type="text" name="nama" required>
    <br><br>
    <label>Nama Guru</label><br>
    <input type="text" name="keterangan" required>
    <br><br>
    <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    mysqli_query($koneksi, "INSERT INTO pelajaran (nama, keterangan) VALUES ('$nama', '$keterangan')");

    echo "<script>alert('Pelajaran berhasil ditambahkan'); location.href='data-pelajaran.php';</script>";
  }
  ?>
</div>

<?php include('../includes/footer.php'); ?>
