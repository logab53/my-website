<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>📊 Laporan Data Pengajar</h2>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Pelajaran</th>
      <th>Nama Guru</th>
    </tr>
    <?php
    $no = 1;
    $query = "
        SELECT p.nama AS nama_pelajaran, g.nama AS nama_guru
        FROM pelajaran p
        LEFT JOIN guru g ON p.guru_id = g.id
        ORDER BY p.nama
    ";
    $data = mysqli_query($koneksi, $query);

    if (!$data) {
        die('Query Error: ' . mysqli_error($koneksi));
    }

    while ($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama_pelajaran']) ?></td>
      <td><?= htmlspecialchars($row['nama_guru']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <button onclick="window.print()" class="btn-primary">🖨️ Cetak</button>
</div>

<?php include('../includes/footer.php'); ?>
