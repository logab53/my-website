<?php
include '../koneksi.php';

// Ambil semua blok
$blok = mysqli_query($koneksi, "SELECT * FROM blok ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Peta Pemakaman</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .blok {
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      margin-bottom: 20px;
      transition: background 0.3s, border-color 0.3s;
    }

    .blok h3 {
      margin-top: 0;
      cursor: pointer;
      user-select: none;
    }

    .blok ul {
      padding-left: 20px;
      margin-top: 10px;
    }

    .blok.aktif {
      background: #e0ffe0;
      border-color: #8bc34a;
    }

    .blok.kosong {
      background: #fbeaea;
      border-color: #e57373;
    }
  </style>

  <script>
    function toggleList(id) {
      var list = document.getElementById("list-" + id);
      if (list.style.display === "none" || list.style.display === "") {
        list.style.display = "block";
      } else {
        list.style.display = "none";
      }
    }
  </script>
</head>
<body>
<div class="container">
  <h2>Peta Pemakaman</h2>
  <p>Klik tiap blok untuk melihat jenazah yang dimakamkan di dalamnya.</p>

  <?php while ($b = mysqli_fetch_assoc($blok)) : ?>
    <?php
      $blok_id = $b['id'];
      $jenazah = mysqli_query($koneksi, "
        SELECT * FROM pemesanan 
        WHERE id_blok = $blok_id AND status = 'diterima'
        ORDER BY tanggal_wafat DESC
      ");
      $is_ada_jenazah = mysqli_num_rows($jenazah) > 0;
      $class = $is_ada_jenazah ? 'aktif' : 'kosong';
    ?>

    <div class="blok <?= $class ?>">
      <h3 onclick="toggleList(<?= $b['id'] ?>)">
        Blok <?= htmlspecialchars($b['nama']) ?> ⬇️
      </h3>
      <ul id="list-<?= $b['id'] ?>" style="display: none;">
        <?php if ($is_ada_jenazah): ?>
          <?php while ($j = mysqli_fetch_assoc($jenazah)) : ?>
            <li><strong><?= htmlspecialchars($j['nama_jenazah']) ?></strong> (Wafat: <?= $j['tanggal_wafat'] ?>)</li>
          <?php endwhile; ?>
        <?php else: ?>
          <li><em>Tidak ada data jenazah.</em></li>
        <?php endif; ?>
      </ul>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
