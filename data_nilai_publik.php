<?php
include 'koneksi.php'; 

// Mengambil daftar Siswa yang sudah mengambil Mata Pelajaran (terdaftar di ambil_mapel)
$query = "SELECT 
            s.nis, 
            s.nama 
          FROM ambil_mapel am
          JOIN siswa s ON am.id_siswa = s.id
          GROUP BY s.nis, s.nama
          ORDER BY s.nama ASC";
          
$result = mysqli_query($koneksi, $query);
$data_siswa_terdaftar = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Siswa Terdaftar</title>
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
        .container { width: 60%; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .section-title { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; font-size: 1.5em; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #005aae; color: white; }
        .footer { text-align: center; padding: 10px 0; background-color: #004d99; color: white; margin-top: 20px; }
        .warning { color: red; font-weight: bold; margin-top: 15px; padding: 10px; border: 1px dashed red; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Data Nilai Siswa Terdaftar</h1>
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
        <h2 class="section-title">🧑‍🎓 Daftar Siswa yang mengambil Mata Pelajaran</h2>

        <div class="warning">
            PERHATIAN: Nilai Siswa adalah data rahasia dan TIDAK ditampilkan di halaman publik ini. Ini hanya daftar nama siswa yang terdaftar di sistem.
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (!empty($data_siswa_terdaftar)): ?>
                    <?php foreach ($data_siswa_terdaftar as $siswa): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($siswa['nis']); ?></td>
                            <td><?php echo htmlspecialchars($siswa['nama']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center;">Belum ada siswa yang terdaftar mengambil mata pelajaran.</td>
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