<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>Transaksi Penerimaan - Data Nota</h2>
  <a href="tambah-nota.php" class="btn-primary">+ Tambah Nota</a>
  <br><br>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>No Nota</th>
      <th>Tanggal</th>
      <th>Jumlah (Rp)</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM nota ORDER BY tanggal DESC");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['no_nota']) ?></td>
      <td><?= htmlspecialchars($row['tanggal']) ?></td>
      <td><?= number_format($row['jumlah']) ?></td>
      <td><?= htmlspecialchars($row['keterangan']) ?></td>
      <td>
        <a href="edit-nota.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-nota.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
