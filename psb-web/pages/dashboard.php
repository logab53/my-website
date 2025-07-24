<?php include('../includes/header.php'); ?>
<?php include('../includes/db.php'); ?>

<?php
$pendaftar = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pendaftaran"))['total'];
$guru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM guru"))['total'];
$mapel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mapel"))['total'];
$biaya = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM biaya"))['total'];

$laki = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM pendaftaran WHERE jenis_kelamin='L'"))['jumlah'];
$perempuan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM pendaftaran WHERE jenis_kelamin='P'"))['jumlah'];
?>

<div class="card">
  <h2>📊 Dashboard</h2>
  
  <div style="display: flex; flex-wrap: wrap; gap: 10px;">
    <div style="flex:1; text-align:center; background:#36A2EB; color:white; padding:10px; border-radius:8px;">
      <div style="font-size:2em;"><?= $pendaftar ?></div>
      <div>Total Pendaftar</div>
    </div>
    <div style="flex:1; text-align:center; background:#FF6384; color:white; padding:10px; border-radius:8px;">
      <div style="font-size:2em;"><?= $guru ?></div>
      <div>Total Guru</div>
    </div>
    <div style="flex:1; text-align:center; background:#4BC0C0; color:white; padding:10px; border-radius:8px;">
      <div style="font-size:2em;"><?= $mapel ?></div>
      <div>Total Mapel</div>
    </div>
    <div style="flex:1; text-align:center; background:#FFCE56; color:white; padding:10px; border-radius:8px;">
      <div style="font-size:2em;"><?= $biaya ?></div>
      <div>Total Biaya</div>
    </div>
  </div>
</div>

<br>

<div class="card">
  <h3>📈 Grafik Siswa Berdasarkan Jenis Kelamin</h3>
  <div style="max-width:300px; margin:auto;">
    <canvas id="genderChart" height="200"></canvas>
  </div>
</div>

<br>

<div class="card">
  <h3>🏫 Profil Sekolah</h3>
  <p>SMK Contoh Negeri adalah sekolah berbasis teknologi dan inovasi, berdiri sejak 2005, dengan visi mencetak lulusan siap kerja dan berprestasi.</p>
</div>

<br>

<div class="card">
  <h3>📰 Berita Terbaru</h3>
  <ul>
    <li>[20/07/2025] Pendaftaran PPDB 2025 sudah dibuka!</li>
    <li>[18/07/2025] Workshop IoT untuk siswa kelas XI</li>
    <li>[15/07/2025] Juara 1 Lomba Robotik se-Kota</li>
  </ul>
</div>

<br>

<div class="card">
  <h3>📢 Pengumuman</h3>
  <ul>
    <li>Pengambilan seragam siswa baru mulai 25 Juli 2025</li>
    <li>Pengumuman hasil seleksi: 30 Juli 2025</li>
  </ul>
</div>

<br>

<div class="card">
  <h3>🖼️ Galeri</h3>
  <div style="display:flex; gap:10px; flex-wrap:wrap;">
    <img src="../uploads/galeri1.jpg" alt="Galeri 1" width="100">
    <img src="../uploads/galeri2.jpg" alt="Galeri 2" width="100">
    <img src="../uploads/galeri3.jpg" alt="Galeri 3" width="100">
  </div>
</div>

<br>

<div class="card" style="text-align:center;">
  <h3>📝 Formulir Pendaftaran Siswa Baru</h3>
  <a href="form-daftar.php" class="btn-primary">📄 Isi Formulir Sekarang</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('genderChart').getContext('2d');
var genderChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Laki-laki', 'Perempuan'],
        datasets: [{
            data: [<?= $laki ?>, <?= $perempuan ?>],
            backgroundColor: ['#36A2EB', '#FF6384'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});
</script>

<?php include('../includes/footer.php'); ?>
