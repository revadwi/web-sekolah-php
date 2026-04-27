<?php
session_start();
// Cek apakah Admin sudah login DENGAN KEY 'status' DAN NILAI 'login'
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") { 
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Ambil semua data guru
$query = "SELECT * FROM guru ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);
$data_guru = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru - Admin Panel</title>
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

        <h1>Data Guru Sekolah</h1>

        <a href="tambah_guru.php" class="add-button">➕ Tambah Guru Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (count($data_guru) > 0): ?>
                    <?php foreach ($data_guru as $guru): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($guru['nip']); ?></td>
                            <td><?php echo htmlspecialchars($guru['nama']); ?></td>
                            <td><?php echo htmlspecialchars($guru['telepon']); ?></td>
                            <td class="aksi">
                                <a href="edit_guru.php?id=<?php echo $guru['id']; ?>" class="action-link edit">Edit</a>
                                <a href="proses_guru.php?aksi=hapus&id=<?php echo $guru['id']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus guru ini?')">Hapus</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Belum ada data guru yang tercatat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>