<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';
include '../includes/header.php';

$cd = mysqli_query($koneksi, "SELECT * FROM cd");
?>

<h1 style="text-align:center;">Data CD</h1>
<div style="text-align:center; margin-bottom:20px;">
  <a href="cd_tambah.php" class="btn">+ Tambah CD</a>
</div>

<table>
  <tr>
    <th>No</th>
    <th>Judul</th>
    <th>Genre</th>
    <th>Stok</th>
    <th>Aksi</th>
  </tr>
  <?php $no=1; while($data=mysqli_fetch_assoc($cd)){ ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($data['judul']); ?></td>
    <td><?= htmlspecialchars($data['genre']); ?></td>
    <td><?= $data['stok']; ?></td>
    <td>
      <a href="cd_edit.php?id=<?= $data['id']; ?>" class="btn">Edit</a>
      <a href="cd_delete.php?id=<?= $data['id']; ?>" class="btn" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>

<style>
table {
  width: 90%;
  margin: 20px auto;
  border-collapse: collapse;
  background: rgba(20,20,20,0.95);
}
th, td {
  padding: 8px 12px;
  text-align: left;
  border-bottom: 1px solid #333;
}
th { color: #2196f3; }
tr:hover { background: rgba(40,40,40,0.8); }
</style>

<?php include '../includes/footer.php'; ?>
