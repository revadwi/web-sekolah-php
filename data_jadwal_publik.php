<?php
include 'koneksi.php'; 

// Query JOIN untuk menampilkan Guru, Mapel, dan Kelas
$query = "SELECT 
            g.nama AS nama_guru, 
            mp.nama_mapel, 
            ja.kelas 
          FROM jadwal_ajar ja
          JOIN guru g ON ja.id_guru = g.id
          JOIN mata_pelajaran mp ON ja.id_mapel = mp.id
          ORDER BY ja.kelas, mp.nama_mapel ASC";
          
$result = mysqli_query($koneksi, $query);
$data_jadwal = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jadwal Ajar Publik</title>
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
        <h1>Jadwal Mata Pelajaran Sekolah</h1>
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
        <h2 class="section-title">📅 Data Jadwal Ajar Guru</h2>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengajar</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (!empty($data_jadwal)): ?>
                    <?php foreach ($data_jadwal as $jadwal): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($jadwal['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($jadwal['nama_mapel']); ?></td>
                            <td><?php echo htmlspecialchars($jadwal['nama_guru']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada jadwal ajar yang tercatat.</td>
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