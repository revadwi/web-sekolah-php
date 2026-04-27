<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Ambil data Guru untuk dropdown
$guru_result = mysqli_query($koneksi, "SELECT id, nama FROM guru ORDER BY nama ASC");
$data_guru = mysqli_fetch_all($guru_result, MYSQLI_ASSOC);

// Ambil data Mata Pelajaran untuk dropdown
$mapel_result = mysqli_query($koneksi, "SELECT id, nama_mapel FROM mata_pelajaran ORDER BY nama_mapel ASC");
$data_mapel = mysqli_fetch_all($mapel_result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Ajar - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .container { width: 50%; margin: 20px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #004d99; margin-top: 0; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #005aae; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #004d99; }
        .back-link { display: block; margin-top: 20px; color: #005aae; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Jadwal Ajar Baru</h1>
        <form action="proses_jadwal.php?aksi=tambah" method="POST">
            <div>
                <label for="id_guru">Pilih Guru:</label>
                <select id="id_guru" name="id_guru" required>
                    <option value="">-- Pilih Guru --</option>
                    <?php foreach ($data_guru as $guru): ?>
                        <option value="<?php echo htmlspecialchars($guru['id']); ?>">
                            <?php echo htmlspecialchars($guru['nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="id_mapel">Pilih Mata Pelajaran:</label>
                <select id="id_mapel" name="id_mapel" required>
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    <?php foreach ($data_mapel as $mapel): ?>
                        <option value="<?php echo htmlspecialchars($mapel['id']); ?>">
                            <?php echo htmlspecialchars($mapel['nama_mapel']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="kelas">Kelas yang Diajar (contoh: 10A, 11B):</label>
                <input type="text" id="kelas" name="kelas" required>
            </div>
            <button type="submit">Simpan Jadwal</button>
        </form>
        <a href="data_jadwal.php" class="back-link">← Kembali ke Daftar Jadwal</a>
    </div>
</body>
</html>