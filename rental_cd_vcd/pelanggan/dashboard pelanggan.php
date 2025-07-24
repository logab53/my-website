<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "pelanggan") {
  header("Location: ../login.php");
  exit();
}
include '../includes/header.php';
include '../koneksi.php';

// Data grafik sewa terbanyak
$data_grafik = mysqli_query($koneksi, "
  SELECT cd.judul, COUNT(*) as jumlah 
  FROM transaksi 
  JOIN cd ON transaksi.id_cd = cd.id 
  GROUP BY transaksi.id_cd 
  ORDER BY jumlah DESC 
  LIMIT 5
");

// Data galeri cover
$data_cover = mysqli_query($koneksi, "SELECT cover, judul FROM cd WHERE cover IS NOT NULL AND cover != '' LIMIT 10");
?>

<h1 style="text-align:center; margin-top:20px;">Dashboard Pelanggan</h1>

<div style="max-width:600px; margin:20px auto; text-align:center;">
  <p id="salam">Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!</p>
  <div id="jam" style="font-size:24px; margin:10px 0; font-weight:bold; color:#2196f3;"></div>
</div>

<!-- Navigasi -->
<div style="max-width:600px; margin:20px auto; text-align:center;">
  <a href="katalog.php" class="btn">Lihat Katalog CD</a>
  <a href="status_sewa.php" class="btn">Status Sewa</a>
  <a href="pengembalian.php" class="btn">Pengembalian</a>
  <a href="riwayat.php" class="btn">Riwayat Sewa</a>
</div>

<!-- Grafik CD Terbanyak -->
<h3 style="text-align:center; margin-top:40px;">CD Paling Sering Disewa</h3>
<canvas id="grafik" width="400" height="400" style="display:block; margin: 0 auto;"></canvas>

<!-- Galeri Cover CD -->
<h3 style="text-align:center; margin-top:40px;">Galeri Cover CD</h3>
<div class="galeri">
  <?php while($row = mysqli_fetch_assoc($data_cover)): ?>
    <div class="slide">
      <img src="../assets/covers/<?= htmlspecialchars($row['cover']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>">
      <p><?= htmlspecialchars($row['judul']); ?></p>
    </div>
  <?php endwhile; ?>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JS Grafik Pie -->
<script>
const ctx = document.getElementById('grafik').getContext('2d');
const chart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php
          mysqli_data_seek($data_grafik, 0);
          while($d = mysqli_fetch_assoc($data_grafik)){ echo "'".$d['judul']."',"; } 
        ?>],
        datasets: [{
            label: 'Jumlah Sewa',
            data: [<?php
              mysqli_data_seek($data_grafik, 0);
              while($d = mysqli_fetch_assoc($data_grafik)){ echo $d['jumlah'].","; } 
            ?>],
            backgroundColor: [
              '#2196f3', '#4caf50', '#ff9800', '#f44336', '#9c27b0'
            ],
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: '#2196f3',
              font: {
                weight: 'bold'
              }
            }
          },
          title: {
            display: true,
            text: 'Top 5 CD Paling Sering Disewa',
            color: '#2196f3',
            font: {
              size: 16,
              weight: 'bold'
            }
          }
        }
    }
});
</script>

<!-- Jam & Salam -->
<script>
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

<!-- CSS -->
<style>
.btn {
  display: inline-block;
  padding: 10px 15px;
  margin: 5px;
  background: #2196f3;
  color: white;
  border-radius: 6px;
  text-decoration: none;
  font-weight: bold;
}
.btn:hover {
  background: #1976d2;
}
.galeri {
  display: flex;
  overflow-x: auto;
  gap: 20px;
  padding: 20px;
  scroll-snap-type: x mandatory;
}
.galeri .slide {
  flex: 0 0 auto;
  scroll-snap-align: start;
  text-align: center;
}
.galeri img {
  height: 180px;
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0,0,0,0.5);
}
.galeri p {
  margin-top: 5px;
  font-weight: bold;
}
</style>

<?php include '../includes/footer.php'; ?>
