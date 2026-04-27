<?php
// Include koneksi database
include 'koneksi.php';

// Pastikan ada ID yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak ada ID, arahkan kembali ke halaman utama atau daftar berita
    header("location: index.php");
    exit();
}

$id_berita = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query untuk mengambil detail berita
$query = "SELECT b.judul, b.isi, b.tanggal_posting, p.nama_lengkap AS penulis 
          FROM berita b 
          JOIN pengguna p ON b.penulis_id = p.id
          WHERE b.id = '$id_berita'";

$result = mysqli_query($koneksi, $query);
$berita = mysqli_fetch_assoc($result);

// Cek apakah berita ditemukan
if (!$berita) {
    echo "<h1>404 Not Found</h1>";
    echo "<p>Berita yang Anda cari tidak ditemukan.</p>";
    exit();
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($berita['judul']); ?> - Sekolah XYZ</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; line-height: 1.6; }
        .container { width: 80%; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .header { border-bottom: 2px solid #005aae; padding-bottom: 15px; margin-bottom: 20px; }
        h1 { color: #004d99; margin-top: 0; }
        .meta { font-size: 0.9em; color: #666; margin-bottom: 20px; }
        .isi-berita { white-space: pre-wrap; /* Mempertahankan format baris dari database */ }
        .back-link { display: inline-block; margin-bottom: 20px; color: #005aae; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Kembali ke Beranda</a>
        
        <div class="header">
            <h1><?php echo htmlspecialchars($berita['judul']); ?></h1>
            <div class="meta">
                Diposting oleh <?php echo htmlspecialchars($berita['penulis']); ?> pada <?php echo date('d F Y H:i', strtotime($berita['tanggal_posting'])); ?>
            </div>
        </div>
        
        <div class="isi-berita">
            <p><?php echo nl2br(htmlspecialchars($berita['isi'])); ?></p>
        </div>

    </div>
</body>
</html>