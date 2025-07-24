<!DOCTYPE html>
<html>
<head>
    <title>PSB Sekolah Internasional</title>
    <style>
        body { margin:0; font-family:'Poppins', sans-serif; background:#f3f5f7; }
        .sidebar {
            width:220px; background:#4B55C7; color:#fff; height:100vh; position:fixed;
            display:flex; flex-direction:column; padding:20px 10px;
        }
        .sidebar h2 { font-size:18px; margin-bottom:20px; display:flex; align-items:center; }
        .sidebar h2 span { margin-left:10px; }
        .sidebar a {
            color:#fff; text-decoration:none; display:flex; align-items:center; margin:8px 0;
            padding:8px 12px; width:100%; border-radius:5px; font-size:14px;
        }
        .sidebar a:hover { background:rgba(255,255,255,0.2); }
        .sidebar a span { margin-left:10px; }
        .content { margin-left:220px; padding:20px; }
        .card { background:#fff; border-radius:8px; padding:20px; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
        .btn-primary {
            background:#4B55C7; color:#fff; padding:6px 12px; border:none; border-radius:4px;
            text-decoration:none; cursor:pointer; display:inline-block;
        }
        footer {
            background:#4B55C7; color:#fff; text-align:center; padding:8px; margin-top:20px;
        }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        th, td { padding:8px; border:1px solid #ddd; text-align:left; }
        th { background:#f7f7f7; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🏫 <span>PSB</span></h2>
        <a href="dashboard.php">📊 <span>Dashboard</span></a>
        <a href="data-pendaftar.php">📝 <span>Data Pendaftar</span></a>
        <a href="data-guru.php">👨‍🏫 <span>Data Guru</span></a>
        <a href="data-mapel.php">📚 <span>Data Mapel</span></a>
        <a href="data-biaya.php">💰 <span>Data Biaya</span></a>
        <a href="data-nota.php">🧾 <span>Data Nota</span></a>
        <a href="data-pelajaran.php">📖 <span>Data Pelajaran</span></a>
        <a href="data-formulir.php">📄 <span>Data Formulir</span></a>
        <a href="laporan-pendaftar.php">📊 <span>Laporan Pendaftar</span></a>
        <a href="laporan-guru.php">📊 <span>Laporan Guru</span></a>
        <a href="laporan-biaya.php">📊 <span>Laporan Biaya</span></a>
        <a href="laporan-pengajar.php">📊 <span>Laporan Pengajar</span></a>
        <a href="logout.php">↩️ <span>Logout</span></a>
    </div>
    <div class="content">
