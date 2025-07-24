<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>📊 Laporan Data Guru</h2>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Guru</th>
      <th>Telepon</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama");
    while ($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['telepon']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>

<?php include('../includes/footer.php'); ?>
