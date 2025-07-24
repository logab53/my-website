<?php
include '../koneksi.php';
include '../functions.php';
must_login('admin');

// Ambil semua data pemesanan
$data = mysqli_query($koneksi, "
  SELECT p.*, u.username, b.nama AS blok
  FROM pemesanan p
  JOIN users u ON p.id_user = u.id
  JOIN blok b ON p.id_blok = b.id
  ORDER BY p.tanggal_pesan DESC
");

function tanggalIndo($tgl) {
  return date('d/m/Y', strtotime($tgl));
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Laporan Pemesanan Makam</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      padding: 20px;
    }
    .header-laporan {
      text-align: center;
      margin-bottom: 20px;
    }
    .header-laporan h2, .header-laporan h3 {
      margin: 0;
    }
    .print-btn {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table, th, td {
      border: 1px solid #000;
    }
    th, td {
      padding: 8px;
      text-align: left;
      font-size: 14px;
    }
    .signature {
      margin-top: 50px;
      width: 100%;
      display: flex;
      justify-content: flex-end;
    }
    .signature div {
      text-align: center;
      width: 200px;
    }
    @media print {
      .no-print {
        display: none;
      }
      body {
        margin: 0;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header-laporan">
    <h2>PEMERINTAH DESA / KELURAHAN</h2>
    <h3>Laporan Pemesanan Makam</h3>
    <p><?= date('d-m-Y') ?></p>
  </div>

  <button class="btn no-print print-btn" onclick="window.print()">🖨️ Cetak Laporan</button>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Pengaju</th>
        <th>Jenazah</th>
        <th>Tgl Wafat</th>
        <th>Blok</th>
        <th>Keterangan</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= tanggalIndo($row['tanggal_pesan']) ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= htmlspecialchars($row['nama_jenazah']) ?></td>
          <td><?= tanggalIndo($row['tanggal_wafat']) ?></td>
          <td><?= htmlspecialchars($row['blok']) ?></td>
          <td><?= htmlspecialchars($row['keterangan']) ?></td>
          <td>
            <?php
              if ($row['status'] == 'pending') echo "<span style='color: orange;'>Pending</span>";
              elseif ($row['status'] == 'diterima') echo "<span style='color: green;'>Diterima</span>";
              else echo "<span style='color: red;'>Ditolak</span>";
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="signature">
    <div>
      <p>Admin Pemakaman</p>
      <br><br><br>
      <p>(_________________)</p>
    </div>
  </div>
</div>
</body>
</html>
