<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="pelanggan"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';
include '../includes/header.php';

// ambil id user yg login
$username = mysqli_real_escape_string($koneksi, $_SESSION['username']);
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'"));
$id_pelanggan = $user['id'];

// ambil data transaksi user ini
$transaksi = mysqli_query($koneksi, "
  SELECT t.*, c.judul 
  FROM transaksi t
  JOIN cd c ON t.id_cd=c.id
  WHERE t.id_pelanggan=$id_pelanggan
  ORDER BY t.id DESC
");
?>

<h1 style="text-align:center;">Status Sewa Anda</h1>

<table>
  <tr>
    <th>No</th>
    <th>Kode Sewa</th>
    <th>Judul CD</th>
    <th>Tanggal Sewa</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
  </tr>
  <?php $no=1; while($d=mysqli_fetch_assoc($transaksi)){ ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($d['kode_sewa']); ?></td>
    <td><?= htmlspecialchars($d['judul']); ?></td>
    <td><?= $d['tanggal_sewa']; ?></td>
    <td><?= $d['tanggal_kembali'] ?? '-'; ?></td>
    <td><?= $d['status']; ?></td>
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
  border-bottom: 1px solid #333;
}
th { color: #2196f3; text-align:left; }
tr:hover { background: rgba(40,40,40,0.8); }
</style>

<?php include '../includes/footer.php'; ?>
