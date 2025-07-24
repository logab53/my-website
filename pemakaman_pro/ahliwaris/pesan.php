<?php
include '../koneksi.php';
include '../functions.php';
must_login('ahliwaris');

$user_id = (int) $_SESSION['user']['id'];
$pesan = '';

// Ambil data blok
$blok = mysqli_query($koneksi, "SELECT * FROM blok ORDER BY nama ASC");

// Proses form pemesanan
if (isset($_POST['submit'])) {
  $nama_jenazah   = mysqli_real_escape_string($koneksi, $_POST['nama_jenazah']);
  $tanggal_wafat  = $_POST['tanggal_wafat'];
  $id_blok        = (int) $_POST['id_blok'];
  $keterangan     = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

  $simpan = mysqli_query($koneksi, "
    INSERT INTO pemesanan (id_user, id_blok, nama_jenazah, tanggal_wafat, keterangan, status, tanggal_pesan)
    VALUES ($user_id, $id_blok, '$nama_jenazah', '$tanggal_wafat', '$keterangan', 'pending', NOW())
  ");

  if ($simpan) {
    $pesan = "✅ Pemesanan berhasil diajukan, menunggu konfirmasi.";
  } else {
    $pesan = "❌ Gagal menyimpan pemesanan.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Pemesanan Makam</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/script.js"></script>
</head>
<body>
<div class="container">
  <h2>📝 Form Pemesanan Makam</h2>

  <?php if ($pesan): ?>
    <div class="flash-msg"><?= htmlspecialchars($pesan) ?></div>
  <?php endif; ?>

  <form method="post">
    <label>Nama Jenazah</label>
    <input type="text" name="nama_jenazah" required placeholder="Contoh: Ahmad Zainuddin">

    <label>Tanggal Wafat</label>
    <input type="date" name="tanggal_wafat" required>

    <label>Blok Pemakaman</label>
    <select name="id_blok" required>
      <option value="">- Pilih Blok -</option>
      <?php while ($b = mysqli_fetch_assoc($blok)) : ?>
        <option value="<?= (int) $b['id'] ?>"><?= htmlspecialchars($b['nama']) ?></option>
      <?php endwhile; ?>
    </select>

    <label>Keterangan Tambahan</label>
    <textarea name="keterangan" rows="3" required placeholder="Contoh: Lokasi dekat pohon besar..."></textarea>

    <button type="submit" name="submit">Kirim Pemesanan</button>
  </form>
</div>
</body>
</html>
