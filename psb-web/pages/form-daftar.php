<?php include('../includes/header.php'); ?>
<div class="card">
  <h2>📝 Formulir Pendaftaran</h2>
  <form method="post" enctype="multipart/form-data" action="proses-daftar.php">
    <label>Nama Lengkap:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NISN:</label><br>
    <input type="text" name="nisn" required><br><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" required><br><br>

    <label>Telepon:</label><br>
    <input type="text" name="telepon" required><br><br>

    <label>Jenis Kelamin:</label><br>
    <select name="jenis_kelamin" required>
      <option value="L">Laki-laki</option>
      <option value="P">Perempuan</option>
    </select><br><br>

    <label>Guru:</label><br>
    <input type="text" name="guru"><br><br>

    <label>Mapel:</label><br>
    <input type="text" name="mapel"><br><br>

    <label>Biaya:</label><br>
    <input type="number" name="biaya"><br><br>

    <label>Upload Formulir (PDF/JPG):</label><br>
    <input type="file" name="file"><br><br>

    <button type="submit" class="btn-primary">Daftar</button>
  </form>
</div>
<?php include('../includes/footer.php'); ?>
