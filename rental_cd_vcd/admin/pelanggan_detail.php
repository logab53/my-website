<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php"); exit();
}
include '../koneksi.php';
$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id AND role='pelanggan'"));
if(!$data){ die("Data tidak ditemukan!"); }
include '../includes/header.php';
?>
<h2 style="text-align:center;">Detail Pelanggan</h2>
<div style="max-width:400px; margin:20px auto; background:#222; padding:20px; border-radius:8px;">
<p><strong>Username:</strong> <?= htmlspecialchars($data['username']); ?></p>
<p><strong>ID:</strong> <?= $data['id']; ?></p>
<p><strong>Role:</strong> <?= $data['role']; ?></p>
<a href="pelanggan.php" class="btn">Kembali</a>
</div>
<?php include '../includes/footer.php'; ?>
