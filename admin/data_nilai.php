<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

// Query JOIN untuk menampilkan Nama Siswa dan Nama Mapel
$query = "SELECT 
            am.id, 
            s.nis, 
            s.nama AS nama_siswa, 
            mp.nama_mapel, 
            am.nilai 
          FROM ambil_mapel am
          JOIN siswa s ON am.id_siswa = s.id
          JOIN mata_pelajaran mp ON am.id_mapel = mp.id
          ORDER BY s.nama ASC, mp.nama_mapel ASC";
          
$result = mysqli_query($koneksi, $query);
$data_nilai = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian Siswa - Admin Panel</title>
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
        
        <h1>Data Nilai Siswa per Mata Pelajaran</h1>

        <a href="tambah_nilai.php" class="add-button">➕ Input Nilai Siswa Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (count($data_nilai) > 0): ?>
                    <?php foreach ($data_nilai as $nilai): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($nilai['nis']); ?></td>
                            <td><?php echo htmlspecialchars($nilai['nama_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($nilai['nama_mapel']); ?></td>
                            <td><?php echo htmlspecialchars($nilai['nilai']); ?></td>
                            <td class="aksi">
                                <a href="edit_nilai.php?id=<?php echo $nilai['id']; ?>" class="action-link edit">Edit</a>
                                <a href="proses_nilai.php?aksi=hapus&id=<?php echo $nilai['id']; ?>" class="action-link delete" onclick="return confirm('Yakin ingin menghapus nilai ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Belum ada data nilai siswa yang tercatat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>