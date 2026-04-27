<?php 
session_start();
// Cek status login
if (empty($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: login.php?pesan=belum_login");
    exit();
}
// Tidak perlu include koneksi di sini, hanya di proses_berita.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita | Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 70%; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input[type="text"], .form-group textarea { width: 98%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-submit { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-submit:hover { background-color: #1e7e34; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #005aae; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_berita.php" class="back-link">← Kembali ke Daftar Berita</a>
        <h2>➕ Tambah Berita Baru</h2>

        <form action="proses_berita.php" method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="judul">Judul Berita:</label>
                <input type="text" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="isi">Isi Berita:</label>
                <textarea id="isi" name="isi" rows="15" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Posting Berita</button>
        </form>
    </div>
</body>
</html>