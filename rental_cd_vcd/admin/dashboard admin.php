<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';
include '../includes/header.php';

// Ambil data summary
$jumlah_cd = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM cd"))['total'];
$jumlah_pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE role='pelanggan'"))['total'];
$jumlah_transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];
?>

<h1 style="text-align:center; margin-top:30px;">Dashboard Admin</h1>

<div style="max-width:600px; margin:20px auto; text-align:center;">
  <p id="salam">Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!</p>
  <div id="jam" style="font-size:24px; margin:10px 0; font-weight:bold; color:#2196f3;"></div>
</div>

<div class="cards">
  <div class="card">
    <h2>📀 Total CD</h2>
    <p><?= $jumlah_cd; ?></p>
  </div>
  <div class="card">
    <h2>👥 Total Pelanggan</h2>
    <p><?= $jumlah_pelanggan; ?></p>
  </div>
  <div class="card">
    <h2>📝 Total Transaksi</h2>
    <p><?= $jumlah_transaksi; ?></p>
  </div>
</div>

<!-- Tombol ke Upload Cover -->
<div style="text-align:center; margin-top:30px;">
  <a href="upload_cover.php" class="btn-upload">📤 Upload Cover CD</a>
</div>

<style>
.cards {
  display: flex;
  justify-content: center;
  margin: 30px auto;
  gap: 20px;
  flex-wrap: wrap;
}
.card {
  background: rgba(0,0,0,0.8);
  padding: 20px 30px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 0 10px rgba(0,0,0,0.7);
  width: 200px;
}
.card h2 {
  color: #2196f3;
  margin-bottom: 10px;
}
.card p {
  font-size: 24px;
  font-weight: bold;
}
.btn-upload {
  display: inline-block;
  padding: 10px 20px;
  background: #2196f3;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-weight: bold;
  transition: background 0.3s;
}
.btn-upload:hover {
  background: #1976d2;
}
</style>

<script>
// Jam real-time + salam dinamis
function updateJam(){
  var now = new Date();
  var jam = now.getHours().toString().padStart(2,'0');
  var menit = now.getMinutes().toString().padStart(2,'0');
  var detik = now.getSeconds().toString().padStart(2,'0');
  document.getElementById("jam").innerHTML = jam+":"+menit+":"+detik;

  var salam = "Selamat datang";
  if(now.getHours() >= 4 && now.getHours() < 10) salam = "Selamat pagi";
  else if(now.getHours() >= 10 && now.getHours() < 15) salam = "Selamat siang";
  else if(now.getHours() >= 15 && now.getHours() < 18) salam = "Selamat sore";
  else salam = "Selamat malam";
  document.getElementById("salam").innerHTML = salam + ", <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!";
}
setInterval(updateJam, 1000);
updateJam();
</script>

<?php include '../includes/footer.php'; ?>
