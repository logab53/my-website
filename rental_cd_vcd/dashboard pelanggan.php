<?php
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'admin'){
        header("Location: admin/cd.php");
    } elseif($_SESSION['role'] == 'pelanggan'){
        header("Location: pelanggan/index.php");
    } else {
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
exit();
?>