<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';
include '../includes/header.php';

// join biar dapat nama pelanggan & judul CD
$transaksi = mysqli_query($koneksi, "
  SELECT t.*, u.username, c.judul 
  FROM transaksi t 
  JOIN users u ON t.id_pelanggan=u.id 
  JOIN cd c ON t.id_cd=c.id
  ORDER BY t.id DESC
");
?>

<h1 style="text-align:center;">Data Transaksi</h1>

<table>
  <tr>
    <th>No</th>
    <th>Kode Sewa</th>
    <th>Pelanggan</th>
    <th>Judul CD</th>
    <th>Tanggal Sewa</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>
  <?php $no=1; while($d=mysqli_fetch_assoc($transaksi)){ ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($d['kode_sewa']); ?></td>
    <td><?= htmlspecialchars($d['username']); ?></td>
    <td><?= htmlspecialchars($d['judul']); ?></td>
    <td><?= $d['tanggal_sewa']; ?></td>
    <td><?= $d['tanggal_kembali'] ?? '-'; ?></td>
    <td><?= $d['status']; ?></td>
    <td>
      <a href="ubah_status.php?id=<?= $d['id']; ?>&to=disewa" class="btn gray">Masih Dipinjam</a>
      <a href="ubah_status.php?id=<?= $d['id']; ?>&to=kembali" class="btn">Sudah Dikembalikan</a>
    </td>
  </tr>
  <?php } ?>
</table>

<style>
table {
  width: 95%;
  margin: 20px auto;
  border-collapse: collapse;
  background: rgba(20,20,20,0.95);
}
th, td {
  padding: 8px 12px;
  border-bottom: 1px solid #333;
}
th { color: #2196f3; text-align:left; }
tr:hover { background: rgba(40,40,40,0.8); }
.btn {
  background: #2196f3; color: #fff; padding:4px 8px; border-radius:4px; text-decoration:none; font-size:12px; margin-right:3px;
}
.btn.gray { background:gray; }
.btn:hover { opacity:0.8; }
</style>

<?php include '../includes/footer.php'; ?>
