<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php"); exit();
}
include '../koneksi.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pelanggan.xls");
echo "Username\tID\n";
$pelanggan = mysqli_query($koneksi, "SELECT * FROM users WHERE role='pelanggan'");
while($d=mysqli_fetch_assoc($pelanggan)){
    echo $d['username']."\t".$d['id']."\n";
}
?>
