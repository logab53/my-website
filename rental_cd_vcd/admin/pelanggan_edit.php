<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';

$id = intval($_GET['id']);
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id AND role='pelanggan'"));

if(!$data){
    $_SESSION['notif'] = "⚠️ Pelanggan tidak ditemukan!";
    header("Location: pelanggan.php");
    exit();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    
    if(!empty($password)){
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE users SET username='$username', password='$hashed' WHERE id=$id");
        $_SESSION['notif'] = "✅ Username & password berhasil diupdate!";
    } else {
        mysqli_query($koneksi, "UPDATE users SET username='$username' WHERE id=$id");
        $_SESSION['notif'] = "✅ Username berhasil diupdate!";
    }
    header("Location: pelanggan.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<h2 style="text-align:center;">Edit Pelanggan</h2>

<form method="POST" style="max-width:400px; margin:20px auto;">
  <label>Username:</label>
  <input type="text" name="username" value="<?= htmlspecialchars($data['username']); ?>" required style="width:100%;padding:8px;margin:8px 0;">

  <label>Password baru (kosongkan jika tidak diubah):</label>
  <input type="password" name="password" placeholder="Masukkan password baru" style="width:100%;padding:8px;margin:8px 0;">

  <button type="submit" class="btn">Simpan</button>
</form>

<style>
.btn {
  background:#e50914; color:#fff; padding:6px 12px; border:none; border-radius:4px; text-decoration:none;
}
.btn:hover { opacity:0.8; }
</style>

<?php include '../includes/footer.php'; ?>
