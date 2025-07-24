<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
  header("Location: ../login.php");
  exit();
}

include '../includes/header.php';
include '../koneksi.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_cd = $_POST['id_cd'];

  if ($_FILES['cover']['error'] === 0) {
    $nama_file = basename($_FILES['cover']['name']);
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $new_name = uniqid('cover_', true) . '.' . $ext;
    $tujuan = "../assets/covers/" . $new_name;

    if (move_uploaded_file($_FILES['cover']['tmp_name'], $tujuan)) {
      $update = mysqli_query($koneksi, "UPDATE cd SET cover='$new_name' WHERE id_cd='$id_cd'");
      if ($update) {
        $pesan = "✅ Cover berhasil diunggah.";
      } else {
        $pesan = "❌ Gagal menyimpan ke database.";
      }
    } else {
      $pesan = "❌ Upload file gagal.";
    }
  } else {
    $pesan = "❌ Pilih file gambar terlebih dahulu.";
  }
}

$cd_list = mysqli_query($koneksi, "SELECT id_cd, judul FROM cd ORDER BY judul ASC");
?>

<h2 style="text-align:center; margin-top:20px;">Upload Cover CD</h2>

<div style="max-width:600px; margin:auto;">
  <?php if($pesan): ?>
    <p style="color:green; font-weight:bold;"><?= $pesan; ?></p>
  <?php endif; ?>
  
  <form method="POST" enctype="multipart/form-data" style="margin-top:30px;">
    <label for="id_cd">Pilih Judul CD:</label><br>
    <select name="id_cd" required style="width:100%; padding:8px; margin-bottom:15px;">
      <option value="">-- Pilih CD --</option>
      <?php while($cd = mysqli_fetch_assoc($cd_list)): ?>
        <option value="<?= $cd['id_cd']; ?>"><?= htmlspecialchars($cd['judul']); ?></option>
      <?php endwhile; ?>
    </select>

    <label for="cover">Tambahkan File Cover di Sini:</label><br>

    <!-- AREA DROPZONE -->
    <div class="drop-zone">
      <span class="drop-zone__prompt">Klik atau seret file gambar ke sini</span>
      <input type="file" name="cover" accept="image/*" class="drop-zone__input" required>
    </div>

    <br>
    <button type="submit" class="btn">Upload Cover</button>
  </form>
</div>

<!-- CSS & JS -->
<style>
.drop-zone {
  max-width: 100%;
  padding: 20px;
  border: 2px dashed #2196f3;
  border-radius: 10px;
  text-align: center;
  cursor: pointer;
  color: #888;
  background-color: #f9f9f9;
  transition: background 0.2s ease-in-out;
}
.drop-zone:hover {
  background: #eef6fd;
}
.drop-zone__input {
  display: none;
}
.btn {
  padding: 10px 20px;
  background: #2196f3;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}
.btn:hover {
  background: #1976d2;
}
</style>

<script>
// Drop zone logic
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", () => {
    inputElement.click();
  });

  inputElement.addEventListener("change", () => {
    if (inputElement.files.length) {
      dropZoneElement.querySelector(".drop-zone__prompt").textContent = inputElement.files[0].name;
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.style.backgroundColor = "#e3f2fd";
  });

  dropZoneElement.addEventListener("dragleave", () => {
    dropZoneElement.style.backgroundColor = "#f9f9f9";
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();
    inputElement.files = e.dataTransfer.files;
    dropZoneElement.querySelector(".drop-zone__prompt").textContent = inputElement.files[0].name;
  });
});
</script>

<?php include '../includes/footer.php'; ?>
