<?php
session_start();
// Cek Session
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Ambil semua data siswa
$query = "SELECT * FROM siswa ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);
$data_siswa = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Admin Panel</title>
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
        
        <h1>Data Siswa Sekolah</h1>

        <a href="tambah_siswa.php" class="add-button">➕ Tambah Siswa Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Tahun Masuk</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (count($data_siswa) > 0): ?>
                    <?php foreach ($data_siswa as $siswa): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($siswa['nis']); ?></td>
                            <td><?php echo htmlspecialchars($siswa['nama']); ?></td>
                            <td><?php echo htmlspecialchars($siswa['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($siswa['tahun_masuk']); ?></td>
                            <td><?php echo htmlspecialchars($siswa['telepon']); ?></td>
                            <td class="aksi">
                                <a href="edit_siswa.php?id=<?php echo $siswa['id']; ?>" class="action-link edit">Edit</a>
                                <a href="proses_siswa.php?aksi=hapus&id=<?php echo $siswa['id']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus data siswa ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada data siswa yang tercatat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>