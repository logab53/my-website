<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<div class="card">
  <h2>📝 Data Pendaftar</h2>
  <table border="1" width="100%" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NISN</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Jenis Kelamin</th>
      <th>Guru</th>
      <th>Mapel</th>
      <th>Biaya</th>
      <th>Tanggal Daftar</th>
      <th>Formulir</th>
      <th>Aksi</th>
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
      <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
      <td><?= htmlspecialchars($row['guru']) ?></td>
      <td><?= htmlspecialchars($row['mapel']) ?></td>
      <td><?= htmlspecialchars($row['biaya']) ?></td>
      <td><?= htmlspecialchars($row['tanggal_daftar']) ?></td>
      <td>
        <?php if($row['file']): ?>
          <a href="../uploads/<?= htmlspecialchars($row['file']) ?>" target="_blank">📄 Lihat</a>
        <?php else: ?>- <?php endif; ?>
      </td>
      <td>
        <a href="edit-pendaftar.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
        <a href="hapus-pendaftar.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">🗑️ Hapus</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
