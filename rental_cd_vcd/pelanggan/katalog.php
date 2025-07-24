<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="pelanggan"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';
include '../includes/header.php';

$cd = mysqli_query($koneksi, "SELECT * FROM cd ORDER BY id DESC");
?>

<h1 style="text-align:center;">Katalog CD</h1>

<table>
  <tr>
    <th>No</th>
    <th>Judul</th>
    <th>Genre</th>
    <th>Stok</th>
    <th>Aksi</th>
  </tr>
  <?php $no=1; while($d=mysqli_fetch_assoc($cd)){ ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($d['judul']); ?></td>
    <td><?= htmlspecialchars($d['genre']); ?></td>
    <td><?= $d['stok']; ?></td>
    <td>
      <?php if($d['stok'] > 0){ ?>
        <a href="sewa.php?id=<?= $d['id']; ?>" class="btn">Sewa</a>
      <?php } else { ?>
        <span style="color:gray;">Habis</span>
      <?php } ?>
    </td>
  </tr>
  <?php } ?>
</table>

<style>
table {
  width: 80%;
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
  background: ##2196f3
  color: #fff;
  padding: 4px 8px;
  border-radius: 4px;
  text-decoration: none;
  font-size: 12px;
}
.btn:hover { opacity:0.8; }
</style>

<?php include '../includes/footer.php'; ?>
