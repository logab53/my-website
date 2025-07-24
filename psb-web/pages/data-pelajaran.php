<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>Transaksi Penerimaan - Data Pelajaran</h2>
  <a href="tambah-pelajaran.php" class="btn-primary">+ Tambah Pelajaran</a>
  <br><br>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Pelajaran</th>
      <th>Guru</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no=1;
    $data = mysqli_query($koneksi, "SELECT * FROM pelajaran ORDER BY nama");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['keterangan']) ?></td>
      <td>
        <a href="edit-pelajaran.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-pelajaran.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
