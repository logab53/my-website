<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php"); exit();
}
include '../koneksi.php';
$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id AND role='pelanggan'"));
if(!$data){ die("Data tidak ditemukan!"); }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kartu Member</title>
<style>
body { background:#141414; color:#fff; font-family:Arial; text-align:center; }
.card { background:#222; padding:20px; margin:40px auto; border-radius:10px; width:300px; box-shadow:0 0 10px rgba(0,0,0,0.7);}
h2 { color:#e50914; }
.logo { font-size:40px; color:#e50914; }
</style>
</head>
<body>
<div class="card">
  <div class="logo">📀</div>
  <h2>Kartu Member Rental CD</h2>
  <p><strong>Username:</strong> <?= htmlspecialchars($data['username']); ?></p>
  <p><strong>ID Member:</strong> <?= $data['id']; ?></p>
  <p><strong>Bergabung:</strong> <?= date('d-m-Y'); ?></p>
  <img src="barcode.php?code=<?= $data['id']; ?>" style="margin-top:10px;" alt="Barcode">
</div>
<script>window.print();</script>
</body>
</html>
