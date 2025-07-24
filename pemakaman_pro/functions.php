<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi: Cek login & role
function must_login($role = null) {
    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    if ($role) {
        $user_role = strtolower(trim($_SESSION['user']['role']));
        $expected_role = strtolower(trim($role));
        
        if ($user_role !== $expected_role) {
            http_response_code(403);
            echo "<h3 style='color:red;'>❌ Akses ditolak. Hanya untuk $expected_role.</h3>";
            exit;
        }
    }
}

// Fungsi: Cek apakah user sudah login
function is_login() {
    return isset($_SESSION['user']);
}

// Fungsi: Set flash message
function flash($msg = null) {
    if ($msg !== null) {
        $_SESSION['flash'] = $msg;
    } else {
        return $_SESSION['flash'] ?? null;
    }
}

// Fungsi: Ambil dan hapus flash message
function get_flash() {
    if (!empty($_SESSION['flash'])) {
        $msg = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return "<div style='color:green; font-weight:bold; margin:10px 0;'>$msg</div>";
    }
    return '';
}
