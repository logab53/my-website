<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>📊 Laporan Data Pendaftar</h2>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NISN</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Guru</th>
      <th>Mapel</th>
      <th>Biaya</th>
      <th>Tanggal Daftar</th>
    </tr>
    <?php
    $no=1;
    $data = mysqli_query($koneksi, "SELECT * FROM pendaftaran ORDER BY tanggal_daftar DESC");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['nisn']) ?></td>
      <td><?= htmlspecialchars($row['alamat']) ?></td>
      <td><?= htmlspecialchars($row['telepon']) ?></td>
      <td><?= htmlspecialchars($row['guru']) ?></td>
      <td><?= htmlspecialchars($row['mapel']) ?></td>
      <td><?= htmlspecialchars($row['biaya']) ?></td>
      <td><?= htmlspecialchars($row['tanggal_daftar']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>

<?php include('../includes/footer.php'); ?>
