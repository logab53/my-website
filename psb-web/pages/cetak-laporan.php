<?php
session_start();
include '../includes/db.php';
$data = mysqli_query($koneksi, "SELECT * FROM pendaftaran ORDER BY tanggal_daftar DESC");
?>
<?php include('../includes/header.php'); ?>

<div class="card">
  <h2><i class="fas fa-print"></i> Laporan Pendaftaran</h2>
  <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NISN</th>
      <th>Sekolah Asal</th>
      <th>Nilai</th>
      <th>Jurusan</th>
      <th>Tanggal</th>
    </tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nama']) ?></td>
      <td><?= htmlspecialchars($row['nisn']) ?></td>
      <td><?= htmlspecialchars($row['sekolah_asal']) ?></td>
      <td><?= htmlspecialchars($row['nilai_ujian']) ?></td>
      <td><?= htmlspecialchars($row['jurusan_pilihan']) ?></td>
      <td><?= htmlspecialchars($row['tanggal_daftar']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <button onclick="window.print()" class="btn-primary"><i class="fas fa-print"></i> Cetak</button>
</div>

<?php include('../includes/footer.php'); ?>
