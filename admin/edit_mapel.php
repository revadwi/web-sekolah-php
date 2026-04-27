<?php
session_start();
// Cek Session
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query untuk mengambil data mapel berdasarkan ID
$query = "SELECT * FROM mata_pelajaran WHERE id='$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika ID tidak valid
if (!$data) {
    header("location: data_mapel.php");
    exit();
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Pelajaran - Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .container { width: 50%; margin: 20px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #004d99; margin-top: 0; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; }
        button { background-color: #005aae; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #004d99; }
        .back-link { display: block; margin-top: 20px; color: #005aae; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Mata Pelajaran: <?php echo htmlspecialchars($data['nama_mapel']); ?></h1>
        
        <form action="proses_mapel.php?aksi=edit" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

            <div>
                <label for="kode_mapel">Kode Mata Pelajaran:</label>
                <input type="text" id="kode_mapel" name="kode_mapel" value="<?php echo htmlspecialchars($data['kode_mapel']); ?>" required>
            </div>
            <div>
                <label for="nama_mapel">Nama Mata Pelajaran:</label>
                <input type="text" id="nama_mapel" name="nama_mapel" value="<?php echo htmlspecialchars($data['nama_mapel']); ?>" required>
            </div>
            <div>
                <label for="deskripsi">Deskripsi Singkat (Opsional):</label>
                <textarea id="deskripsi" name="deskripsi"><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="data_mapel.php" class="back-link">← Kembali ke Daftar Mata Pelajaran</a>
    </div>
</body>
</html>