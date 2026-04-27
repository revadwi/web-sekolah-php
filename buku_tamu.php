<?php
// Include koneksi database
include 'koneksi.php';

// --- 1. PROSES BACA (READ) DATA ---
$query_read = "SELECT nama, pesan, tanggal_kirim FROM buku_tamu ORDER BY tanggal_kirim DESC";
$result_read = mysqli_query($koneksi, $query_read);
$daftar_pesan = mysqli_fetch_all($result_read, MYSQLI_ASSOC);

// Tutup koneksi sementara
mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Sekolah</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 70%; margin: auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 98%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-submit { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-submit:hover { background-color: #1e7e34; }
        .pesan-box { border: 1px solid #ccc; padding: 15px; margin-top: 15px; border-radius: 5px; background-color: #e6f7ff; }
        .pesan-box strong { color: #005aae; }
        .pesan-meta { font-size: 0.8em; color: #666; margin-top: 5px; }
        .alert { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php">← Kembali ke Beranda</a>
        <h2>📚 Buku Tamu Sekolah</h2>

        <?php 
        // Tampilkan notifikasi jika ada pesan dari proses_buku_tamu.php
        if (isset($_GET['status']) && $_GET['status'] == "sukses") {
            echo '<div class="alert">Terima kasih! Pesan Anda berhasil dikirim.</div>';
        }
        ?>

        <h3>Tinggalkan Pesan Anda</h3>
        <form action="proses_buku_tamu.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Anda:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email (Opsional):</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="pesan">Pesan / Saran:</label>
                <textarea id="pesan" name="pesan" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Kirim Pesan</button>
        </form>

        <hr style="margin: 30px 0;">

        <h3>Pesan Dari Pengunjung Lain (<?php echo count($daftar_pesan); ?> pesan)</h3>

        <?php if (count($daftar_pesan) > 0): ?>
            <?php foreach ($daftar_pesan as $pesan): ?>
                <div class="pesan-box">
                    <p><strong><?php echo htmlspecialchars($pesan['nama']); ?></strong> berkata:</p>
                    <p><?php echo nl2br(htmlspecialchars($pesan['pesan'])); ?></p>
                    <div class="pesan-meta">
                        Dikirim pada: <?php echo date('d F Y H:i', strtotime($pesan['tanggal_kirim'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Belum ada pesan di buku tamu ini.</p>
        <?php endif; ?>

    </div>
</body>
</html>