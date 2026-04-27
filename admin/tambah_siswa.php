<?php
session_start();
// Cek Session
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
// Tidak perlu include koneksi di sini
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa Baru - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .container { width: 50%; margin: 20px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #004d99; margin-top: 0; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="tel"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; }
        button { background-color: #005aae; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #004d99; }
        .back-link { display: block; margin-top: 20px; color: #005aae; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Siswa Baru</h1>
        <form action="proses_siswa.php?aksi=tambah" method="POST">
            <div>
                <label for="nis">NIS (Nomor Induk Siswa):</label>
                <input type="text" id="nis" name="nis" required>
            </div>
            <div>
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" required>
            </div>
            <div>
                <label for="tahun_masuk">Tahun Masuk (contoh: 2023):</label>
                <input type="text" id="tahun_masuk" name="tahun_masuk" required>
            </div>
            <div>
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat"></textarea>
            </div>
            <div>
                <label for="telepon">Nomor Telepon (Opsional):</label>
                <input type="tel" id="telepon" name="telepon">
            </div>
            <button type="submit">Simpan Data Siswa</button>
        </form>
        <a href="data_siswa.php" class="back-link">← Kembali ke Daftar Siswa</a>
    </div>
</body>
</html>