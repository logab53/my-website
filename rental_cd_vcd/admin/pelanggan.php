<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){
  header("Location: ../login.php"); exit();
}
include '../koneksi.php';
include '../includes/header.php';

$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$sort = isset($_GET['sort']) && $_GET['sort']=='az' ? 'ASC' : 'DESC';
$per_page=10; $page=isset($_GET['page']) ? intval($_GET['page']) : 1; $offset=($page-1)*$per_page;
$total=mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as total FROM users WHERE role='pelanggan' AND username LIKE '%$search%'"))['total'];
$total_pages=ceil($total/$per_page);

$pelanggan = mysqli_query($koneksi, "SELECT * FROM users WHERE role='pelanggan' AND username LIKE '%$search%' ORDER BY username $sort LIMIT $offset,$per_page");
?>
<h1 style="text-align:center;">Data Pelanggan</h1>

<form method="GET" style="text-align:center; margin-bottom:10px;">
  <input type="text" name="search" value="<?= $search; ?>" placeholder="Cari username..." style="padding:5px 10px; border-radius:4px;">
  <button type="submit" class="btn">Cari</button>
</form>

<div style="text-align:center; margin-bottom:10px;">
  <a href="?search=<?= urlencode($search); ?>&sort=az" class="btn">Sort A–Z</a>
  <a href="?search=<?= urlencode($search); ?>&sort=desc" class="btn">Sort Z–A</a>
  <a href="pelanggan_export_excel.php" class="btn-cetak">Export Excel</a>
  <a href="pelanggan_export_pdf.php" target="_blank" class="btn-cetak">Export PDF</a>
</div>

<table>
  <tr>
    <th>No</th><th>Username</th><th>ID</th><th>Aksi</th>
  </tr>
  <?php $no=$offset+1; while($d=mysqli_fetch_assoc($pelanggan)){ ?>
  <tr>
    <td><?= $no++; ?></td>
    <td><?= htmlspecialchars($d['username']); ?></td>
    <td><?= $d['id']; ?></td>
    <td>
      <a href="pelanggan_edit.php?id=<?= $d['id']; ?>" class="btn-edit">Edit</a>
      <a href="pelanggan_delete.php?id=<?= $d['id']; ?>" class="btn-delete" onclick="return confirm('Hapus?')">Hapus</a>
      <a href="pelanggan_cetak.php?id=<?= $d['id']; ?>" class="btn-cetak" target="_blank">Cetak Kartu</a>
      <a href="pelanggan_detail.php?id=<?= $d['id']; ?>" class="btn-page">Detail</a>
    </td>
  </tr>
  <?php } ?>
</table>

<div style="text-align:center; margin:10px;">
<?php for($i=1;$i<=$total_pages;$i++){ ?>
  <a href="?search=<?= urlencode($search); ?>&sort=<?= $sort; ?>&page=<?= $i; ?>" class="btn-page <?= $i==$page?'active':''; ?>"><?= $i; ?></a>
<?php } ?>
</div>

<style>
table { width:70%; margin:20px auto; border-collapse:collapse; background:rgba(20,20,20,0.95);}
th, td {padding:8px 12px; border-bottom:1px solid #333;}
th { color:#2196f3; text-align:left;}
tr:hover { background:rgba(40,40,40,0.8);}
.btn, .btn-edit, .btn-delete, .btn-page, .btn-cetak { padding:4px 8px; border-radius:4px; color:#fff; text-decoration:none; font-size:12px; margin-right:4px;}
.btn { background:#2196f3;}
.btn-edit { background:#ffc107; color:#000;}
.btn-delete { background:#e50914;}
.btn-cetak { background:#17a2b8;}
.btn-page { background:#333;}
.btn-page.active { background:#2196f3;}
.btn:hover, .btn-edit:hover, .btn-delete:hover, .btn-cetak:hover, .btn-page:hover {opacity:0.8;}
</style>

<?php include '../includes/footer.php'; ?>
