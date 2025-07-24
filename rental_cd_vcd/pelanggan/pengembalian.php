<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="pelanggan"){
  header("Location: ../login.php");
  exit();
}

include '../koneksi.php';
include '../includes/header.php';

// Ambil id user
$username = $_SESSION['username'];
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id FROM users WHERE username='$username'"));
$id_pelanggan = $user['id'];

// Ambil data transaksi yg status 'disewa'
$transaksi = mysqli_query($koneksi, "SELECT transaksi.*, cd.judul FROM transaksi 
  JOIN cd ON transaksi.id_cd=cd.id 
  WHERE transaksi.id_pelanggan=$id_pelanggan AND transaksi.status='disewa'");

// Hitung jumlah CD yg sedang dipinjam
$jumlah = mysqli_num_rows($transaksi);

// TAMPILIN NOTIF kalau ada
if(isset($_SESSION['notif'])){
    $type = ($_SESSION['type']=='success') ? '#28a745' : '#e50914';
    echo "<div style='background:$type; color:#fff; padding:8px; text-align:center; border-radius:4px; margin:10px auto; width:80%;'>"
         .htmlspecialchars($_SESSION['notif'])
         ."</div>";
    unset($_SESSION['notif'], $_SESSION['type']);
}
?>

<h2 style="text-align:center; color:#fff;">Pengembalian CD</h2>

<?php if($jumlah > 0){ ?>
  <p style="text-align:center; color:#ccc;">Anda sedang meminjam <?= $jumlah; ?> CD.</p>

  <table>
    <tr>
      <th>No</th>
      <th>Kode Sewa</th>
      <th>Judul</th>
      <th>Tanggal Sewa</th>
      <th>Aksi</th>
    </tr>
    <?php $no=1; while($d=mysqli_fetch_assoc($transaksi)){ ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= htmlspecialchars($d['kode_sewa']); ?></td>
      <td><?= htmlspecialchars($d['judul']); ?></td>
      <td><?= $d['tanggal_sewa']; ?></td>
      <td>
        <a href="proses_kembali.php?id=<?= $d['id']; ?>" class="btn">Kembalikan</a>
      </td>
    </tr>
    <?php } ?>
  </table>
<?php } else { ?>
  <p style="text-align:center; color:#ccc;">Anda tidak sedang meminjam CD apapun.</p>
<?php } ?>

<style>
body {
  background: #111;
  color: #fff;
}
table {
  width:80%; margin:20px auto; border-collapse:collapse; background:rgba(20,20,20,0.95);
}
th, td { padding:8px 12px; border-bottom:1px solid #333; }
th { color:#2196f3; text-align:left; }
.btn {
  background:#2196f3; color:#fff; padding:4px 8px; border-radius:4px; text-decoration:none; font-size:12px;
}
.btn:hover { opacity:0.8; }
</style>

<?php include '../includes/footer.php'; ?>
