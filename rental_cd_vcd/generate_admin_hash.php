<?php
$password = 'admin123'; // ganti sesuai password yg lu mau
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password: $password<br>Hash: <br>$hash";
?>
