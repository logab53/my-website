<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
include 'functions.php';

if (is_login()) {
    $role = strtolower($_SESSION['user']['role']);
    header("Location: {$role}/index.php");
    exit;
}

$err = '';
$flash = flash();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        $err = "❌ Username dan password wajib diisi!";
    } else {
        $username = mysqli_real_escape_string($koneksi, $username);
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username' LIMIT 1");
        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $role = strtolower($user['role']);
            header("Location: {$role}/index.php");
            exit;
        } else {
            $err = "❌ Username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Pemakaman</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background-image: url('assets/img/bg-login.jpg'); /* Ganti sesuai path gambar */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.95); /* Bening dikit biar background kelihatan */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 320px;
            animation: fadeIn 1s ease;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        .error,
        .flash {
            text-align: center;
            margin-bottom: 12px;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .flash {
            color: green;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if ($flash): ?>
        <div class="flash"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <?php if ($err): ?>
        <div class="error"><?= htmlspecialchars($err) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>

</body>
</html>
