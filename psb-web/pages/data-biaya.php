<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>Master Data Biaya</h2>
  <a href="tambah-biaya.php" class="btn-primary">+ Tambah Biaya</a>
  <br><br>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Biaya</th>
      <th>Jumlah (Rp)</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no=1;
    $data = mysqli_query($koneksi, "SELECT * FROM biaya ORDER BY nama");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= number_format($row['jumlah']) ?></td>
      <td>
        <a href="edit-biaya.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-biaya.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
