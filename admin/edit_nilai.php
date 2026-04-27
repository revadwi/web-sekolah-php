<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Ambil ID Nilai dari URL
$id_ambil_mapel = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query JOIN untuk mengambil data nilai, siswa, dan mapel berdasarkan ID ambil_mapel
$query = "SELECT 
            am.id, 
            am.id_siswa, 
            am.id_mapel, 
            am.nilai,
            s.nis,
            s.nama AS nama_siswa,
            mp.nama_mapel
          FROM ambil_mapel am
          JOIN siswa s ON am.id_siswa = s.id
          JOIN mata_pelajaran mp ON am.id_mapel = mp.id
          WHERE am.id='$id_ambil_mapel'";
          
$result = mysqli_query($koneksi, $query);
$data_nilai = mysqli_fetch_assoc($result);

// Jika ID tidak valid
if (!$data_nilai) {
    header("location: data_nilai.php");
    exit();
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai Siswa - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .container { width: 50%; margin: 20px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #004d99; margin-top: 0; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .disabled-input { background-color: #eee; }
        button { background-color: #005aae; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #004d99; }
        .back-link { display: block; margin-top: 20px; color: #005aae; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Nilai Siswa</h1>
        <form action="proses_nilai.php?aksi=edit" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data_nilai['id']); ?>">
            <input type="hidden" name="id_siswa" value="<?php echo htmlspecialchars($data_nilai['id_siswa']); ?>">
            <input type="hidden" name="id_mapel" value="<?php echo htmlspecialchars($data_nilai['id_mapel']); ?>">

            <div>
                <label>Siswa:</label>
                <input type="text" value="<?php echo htmlspecialchars($data_nilai['nis'] . ' - ' . $data_nilai['nama_siswa']); ?>" disabled class="disabled-input">
            </div>
            <div>
                <label>Mata Pelajaran:</label>
                <input type="text" value="<?php echo htmlspecialchars($data_nilai['nama_mapel']); ?>" disabled class="disabled-input">
            </div>
            <div>
                <label for="nilai">Nilai (Saat Ini: <?php echo htmlspecialchars($data_nilai['nilai']); ?>):</label>
                <input type="text" id="nilai" name="nilai" value="<?php echo htmlspecialchars($data_nilai['nilai']); ?>" required>
            </div>
            <button type="submit">Simpan Perubahan Nilai</button>
        </form>
        <a href="data_nilai.php" class="back-link">← Kembali ke Data Nilai Siswa</a>
    </div>
</body>
</html>