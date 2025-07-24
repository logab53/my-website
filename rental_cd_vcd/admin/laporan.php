<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php");
  exit();
}
include '../koneksi.php';
include '../includes/header.php';

// hitung summary
$total_cd = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM cd"))['total'];

$total_stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(stok) as total FROM cd"))['total'];
$total_stok = $total_stok ? $total_stok : 0;

$total_cd_tersedia = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM cd WHERE stok>0"))['total'];
$total_cd_habis = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM cd WHERE stok=0"))['total'];

$total_pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users WHERE role='pelanggan'"))['total'];

$total_transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];
$total_transaksi_selesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE status='selesai'"))['total'];
$total_transaksi_belum = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE status!='selesai'"))['total'];
?>

<h1 style="text-align:center; margin-top:20px;">📊 Laporan Summary Lengkap</h1>

<div style="text-align:center; margin:20px;">
  <button onclick="window.print()" class="btn">🖨 Print</button>
  <button onclick="exportTableToExcel('laporanTable', 'laporan_summary')" class="btn">📥 Export ke Excel</button>
</div>

<table id="laporanTable">
  <tr>
    <th>Data</th>
    <th>Jumlah</th>
  </tr>
  <tr>
    <td>Total Judul CD</td>
    <td><?= $total_cd; ?></td>
  </tr>
  <tr>
    <td>Total Stok CD (semua)</td>
    <td><?= $total_stok; ?></td>
  </tr>
  <tr>
    <td>Jumlah CD Tersedia (stok>0)</td>
    <td><?= $total_cd_tersedia; ?></td>
  </tr>
  <tr>
    <td>Jumlah CD Habis (stok=0)</td>
    <td><?= $total_cd_habis; ?></td>
  </tr>
  <tr>
    <td>Total Pelanggan</td>
    <td><?= $total_pelanggan; ?></td>
  </tr>
  <tr>
    <td>Total Transaksi</td>
    <td><?= $total_transaksi; ?></td>
  </tr>
  <tr>
    <td>Transaksi Selesai</td>
    <td><?= $total_transaksi_selesai; ?></td>
  </tr>
  <tr>
    <td>Transaksi Belum Selesai</td>
    <td><?= $total_transaksi_belum; ?></td>
  </tr>
</table>

<style>
table {
  width: 60%;
  margin: 20px auto;
  border-collapse: collapse;
  background: rgba(20,20,20,0.95);
  border-radius: 8px;
  overflow: hidden;
}
th, td {
  padding: 10px 15px;
  border-bottom: 1px solid #333;
}
th { color: #2196f3; text-align:left; font-size:16px; }
td { font-size:15px; color: #eee; }
tr:hover { background: rgba(40,40,40,0.8); }

@media print {
  body * { visibility: hidden; }
  #laporanTable, #laporanTable * { visibility: visible; }
  #laporanTable { position: absolute; left:0; top:0; width:100%; }
}
.btn {
  background: #2196f3;
  color:#fff;
  padding:6px 12px;
  border:none;
  border-radius:4px;
  cursor:pointer;
  margin: 0 5px;
  font-size:14px;
}
.btn:hover { opacity:0.85; }
</style>

<script>
function exportTableToExcel(tableID, filename = ''){
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    filename = filename?filename+'.xls':'excel_data.xls';
    
    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob( blob, filename);
    } else {
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>

<?php include '../includes/footer.php'; ?>
