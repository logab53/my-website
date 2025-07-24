<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>Master Formulir Pendaftaran</h2>
  <a href="tambah-formulir.php" class="btn-primary">+ Tambah Formulir</a>
  <br><br>
  <table width="100%" border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama Formulir</th>
      <th>File</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no=1;
    $data = mysqli_query($koneksi, "SELECT * FROM formulir ORDER BY nama");
    while($row = mysqli_fetch_assoc($data)):
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><a href="../uploads/<?= htmlspecialchars($row['file']) ?>" target="_blank">📄 Lihat File</a></td>
      <td>
        <a href="edit-formulir.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-formulir.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
