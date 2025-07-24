<?php
include 'koneksi.php';

$adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
$warisPassword = password_hash('admin123', PASSWORD_DEFAULT);

mysqli_query($koneksi, "DELETE FROM users");

mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES 
  ('admin', '$adminPassword', 'admin'),
  ('ahliwaris', '$warisPassword', 'ahliwaris')
");

echo "✅ User berhasil ditambahkan. Username: admin / ahliwaris, Password: admin123";
?>
