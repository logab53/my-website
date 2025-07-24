<?php
include '../includes/db.php';

$id = intval($_GET['id']); // pastikan id integer

// Ambil data lama
$data = mysqli_query($conn, "SELECT * FROM formulir WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Data formulir tidak ditemukan!");
}

// Proses update saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    if (!empty($_FILES['file']['name'])) {
        $fileName = time() . '-' . basename($_FILES['file']['name']); // unik
        $target = "../uploads/" . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
            // Hapus file lama
            if (!empty($row['file']) && file_exists("../uploads/".$row['file'])) {
                unlink("../uploads/".$row['file']);
            }
            // Update nama + file
            $query = "UPDATE formulir SET nama='$nama', file='$fileName' WHERE id='$id'";
        } else {
            die("Gagal upload file baru!");
        }
    } else {
        // Update hanya nama
        $query = "UPDATE formulir SET nama='$nama' WHERE id='$id'";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: data-formulir.php");
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>

<?php include('../includes/header.php'); ?>
<div class="card">
  <h2>✏️ Edit Formulir</h2>
  <form method="post" enctype="multipart/form-data">
    <label>Nama Formulir</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required><br><br>

    <label>File (kosongkan jika tidak diganti)</label><br>
    <input type="file" name="file"><br><br>

    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>
<?php include('../includes/footer.php'); ?>
