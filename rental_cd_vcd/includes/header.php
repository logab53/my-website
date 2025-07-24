<?php
// mulai session kalo belum
if(session_status() == PHP_SESSION_NONE){ session_start(); }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Rental CD</title>
<style>
body {
  margin:0; padding:0;
  font-family: Arial, sans-serif;
  color: #fff;
  background: linear-gradient(to top, rgba(20,20,40,0.9) 0%, rgba(20,20,40,0.6) 100%),
              url('/rental_cd_vcd/assets/img/background1.jpg') no-repeat center center fixed;
  background-size: cover;
}
.navbar {
  background: rgba(0,0,50,0.8);
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.navbar a {
  color: #2196f3;
  text-decoration: none;
  margin-right: 15px;
  font-weight: bold;
}
.navbar a:hover { text-decoration: underline; }
.btn {
  background: #2196f3;
  color:#fff;
  padding:5px 10px;
  border:none;
  text-decoration:none;
  border-radius:4px;
}
.btn:hover { opacity:0.8; }
.notif {
  background: rgba(33,150,243,0.9);
  color: #fff;
  margin: 10px auto;
  padding: 8px 12px;
  max-width:400px;
  text-align:center;
  border-radius:5px;
  font-weight:bold;
  box-shadow:0 0 10px rgba(0,0,0,0.5);
}
</style>
</head>
<body>

<div class="navbar">
  <div style="display:flex; align-items:center;">
    <span style="font-size:20px; color:#2196f3; margin-right:8px;">📀</span>
    <a href="#" style="font-size:20px;">Rental CD</a>
  </div>
  <div>
    <?php if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){ ?>
      <a href="/rental_cd_vcd/admin/cd.php">CD</a>
      <a href="/rental_cd_vcd/admin/transaksi.php">Transaksi</a>
      <a href="/rental_cd_vcd/admin/pelanggan.php">Pelanggan</a>
      <a href="/rental_cd_vcd/admin/laporan.php">Laporan</a>
    <?php } elseif(isset($_SESSION['role']) && $_SESSION['role']=='pelanggan'){ ?>
      <a href="/rental_cd_vcd/pelanggan/dashboard pelanggan.php">Dashboard</a>
      <a href="/rental_cd_vcd/pelanggan/katalog.php">Katalog</a>
      <a href="/rental_cd_vcd/pelanggan/status_sewa.php">Status</a>
      <a href="/rental_cd_vcd/pelanggan/pengembalian.php">Pengembalian</a>
      <a href="/rental_cd_vcd/pelanggan/riwayat.php">Riwayat</a>
    <?php } ?>
    <?php if(isset($_SESSION['username'])){ ?>
      <a href="/rental_cd_vcd/logout.php">Logout</a>
    <?php } else { ?>
      <a href="/rental_cd_vcd/login.php">Login</a>
      <a href="/rental_cd_vcd/register.php">Register</a>
    <?php } ?>
  </div>
</div>

<?php if(isset($_SESSION['notif'])){ ?>
  <div class="notif"><?= htmlspecialchars($_SESSION['notif']); unset($_SESSION['notif']); ?></div>
<?php } ?>
