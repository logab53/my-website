<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>+ Tambah Guru</h2>
  <form method="post" action="proses-tambah-guru.php">
    <label>Nama Guru:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" required><br><br>

    <button type="submit" class="btn-primary">Simpan</button>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
