<?php 
session_start();
// Cek status login
if (empty($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil semua data berita
$query = "SELECT b.id, b.judul, b.tanggal_posting, p.nama_lengkap AS penulis FROM berita b 
          JOIN pengguna p ON b.penulis_id = p.id
          ORDER BY b.tanggal_posting DESC";
$result = mysqli_query($koneksi, $query);
$daftar_berita = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita | Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e9ebee; }
        .container { width: 90%; margin: 30px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; }
        .back-link, .add-button { display: inline-block; margin-bottom: 20px; color: white; text-decoration: none; padding: 10px 15px; border-radius: 5px; }
        .back-link { background-color: #6c757d; }
        .add-button { background-color: #28a745; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; vertical-align: top; }
        th { background-color: #005aae; color: white; }
        .action-link { padding: 5px 10px; border-radius: 4px; text-decoration: none; color: white; margin-right: 5px; font-size: 0.9em; }
        .edit { background-color: #ffc107; color: #333; }
        .delete { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <a href="dashboard_admin.php" class="back-link">← Kembali ke Dashboard</a>

        <h1>Kelola Berita & Pengumuman</h1>

        <a href="tambah_berita.php" class="add-button">➕ Tambah Berita Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Tanggal Posting</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (count($daftar_berita) > 0): ?>
                    <?php foreach ($daftar_berita as $berita): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($berita['judul']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($berita['tanggal_posting'])); ?></td>
                            <td><?php echo htmlspecialchars($berita['penulis']); ?></td>
                            <td>
                                <a href="edit_berita.php?id=<?php echo $berita['id']; ?>" class="action-link edit">Edit</a>
                                <a href="proses_berita.php?action=delete&id=<?php echo $berita['id']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada berita yang diposting.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>