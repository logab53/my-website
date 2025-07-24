<?php
include 'koneksi.php';

// Buat hash password
$adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
$pelangganPassword = password_hash('pelanggan123', PASSWORD_DEFAULT);

// Bersihin tabel users dulu
mysqli_query($koneksi, "DELETE FROM users");

// Tambahkan user admin & pelanggan
mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES 
  ('admin', '$adminPassword', 'admin'),
  ('kosasih', '$pelangganPassword', 'pelanggan')
");

echo "✅ User berhasil ditambahkan. 
<br>- Username: admin | Password: admin123 | Role: admin
<br>- Username: kosasih | Password: pelanggan123 | Role: pelanggan";
?>
