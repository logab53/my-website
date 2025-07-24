<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php"); exit();
}
include '../koneksi.php';
$pelanggan = mysqli_query($koneksi, "SELECT * FROM users WHERE role='pelanggan'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Export PDF</title>
<style>
body { font-family: Arial; color:#000; }
table { border-collapse:collapse; width:100%; }
th, td { border:1px solid #333; padding:5px; }
</style>
</head>
<body>
<h2>Data Pelanggan</h2>
<table>
<tr><th>No</th><th>Username</th><th>ID</th></tr>
<?php $no=1; while($d=mysqli_fetch_assoc($pelanggan)){ ?>
<tr>
<td><?= $no++; ?></td>
<td><?= htmlspecialchars($d['username']); ?></td>
<td><?= $d['id']; ?></td>
</tr>
<?php } ?>
</table>
<script>window.print();</script>
</body>
</html>
