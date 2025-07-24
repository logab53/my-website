<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>Master Data Mapel</h2>
  <a href="tambah-mapel.php" class="btn-primary">+ Tambah Mapel</a>
  <br><br>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Mapel</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no=1;
    $data = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY nama");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td>
        <a href="edit-mapel.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-mapel.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
