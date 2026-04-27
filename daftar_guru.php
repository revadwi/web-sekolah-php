<?php
include 'koneksi.php';

// Ambil semua data Guru
// Menambahkan kolom nip dan telepon untuk menghindari Warning Undefined Key
$query = "SELECT id, nip, nama FROM guru ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);
$data_guru = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru Sekolah</title>
    <style>
        /* Menggunakan style dasar yang sama */
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .header { 
        /* Gunakan gradien dari biru tua ke biru muda */
        background: linear-gradient(to right, #003366, #005aae); 
        color: white; 
        padding: 25px 0; /* Padding sedikit dilebarkan agar terasa lebih kokoh */
        text-align: center; 
        /* Beri bayangan ringan di bawah header */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        } 
        
        .header h1 {
        margin: 0;
        /* Tambahkan bayangan teks agar H1 lebih menonjol */
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        .nav { display: flex; justify-content: center; background-color: #005aae; padding: 10px 0; }
        .nav a { color: white; margin: 0 5px; text-decoration: none; padding: 10px 15px; border-radius: 5px; transition: background-color 0.3s; }
        .nav a:hover { background-color: #007bff; }
        .container { width: 85%; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .section-title { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; font-size: 1.5em; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #005aae; color: white; }
        .footer { text-align: center; padding: 10px 0; background-color: #004d99; color: white; margin-top: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Daftar Tenaga Pengajar</h1>
        <p>Reva High School</p>
    </div>

    <div class="nav">
        <a href="index.php">Home</a>
        <a href="daftar_guru.php">Daftar Guru</a>
        <a href="data_jadwal_publik.php">Data Jadwal Ajar</a>
        <a href="data_nilai_publik.php">Data Nilai Siswa</a>
        <a href="buku_tamu.php">Buku Tamu</a>
    </div>

    <div class="container">
        <h2 class="section-title">👨‍🏫 Daftar Guru Sekolah</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (!empty($data_guru)): ?>
                    <?php foreach ($data_guru as $guru): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($guru['nip']); ?></td>
                            <td><?php echo htmlspecialchars($guru['nama']); ?></td> 
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Data guru belum tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Reva High School.
    </div>

</body>
</html>