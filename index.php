<?php
// Include koneksi database
include 'koneksi.php';

// Mengambil 3 berita/pengumuman terbaru untuk ditampilkan di homepage
$query_berita = "SELECT id, judul, LEFT(isi, 150) as isi_singkat, tanggal_posting FROM berita ORDER BY tanggal_posting DESC LIMIT 3";
$result_berita = mysqli_query($koneksi, $query_berita);
$berita_terbaru = mysqli_fetch_all($result_berita, MYSQLI_ASSOC);

// Tutup koneksi setelah selesai mengambil data
mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Website Sekolah</title>
    <style>
        /* CSS Dasar untuk Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        
        /* HEADER (Biru Polos) */
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
        
        /* NAVIGATION */
        .nav {
        display: flex;
        justify-content: center;
        /* Gunakan warna yang lebih cerah atau transparan agar menyatu dengan header */
        background-color: #005aae; 
        padding: 10px 0;
        /* Beri bayangan agar navigasi terlihat sedikit terangkat */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav a:hover {
            background-color: #007bff;
        }
        
        /* CONTAINER CONTENT */
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section-title {
            border-bottom: 2px solid #005aae;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #004d99;
        }
        
        /* BERITA LIST */
        .berita-list {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        .berita-item {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .berita-item h3 {
            color: #005aae;
            margin-top: 0;
        }
        
        /* FOOTER */
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #004d99;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Selamat Datang Di Reva High School 🏫</h1>
        <p>"Belajar Hari Ini, Pemimpin Masa Depan."</p>
    </div>

    <div class="nav">
        <a href="index.php">Home</a>
        <a href="daftar_guru.php">Daftar Guru</a>
        <a href="data_jadwal_publik.php">Data Jadwal Ajar</a>
        <a href="data_nilai_publik.php">Data Nilai Siswa</a>
        <a href="buku_tamu.php">Buku Tamu</a>
        <a href="login.php" style="background-color: #ffc107; color: #333;">Login Admin</a>
    </div>

    <div class="container">
        <h2 id="profil" class="section-title">🌟 Profil Singkat Sekolah</h2>
        <p>Reva High School merupakan lembaga pendidikan yang berkomitmen menyediakan layanan pembelajaran berkualitas, inovatif, dan berorientasi pada perkembangan karakter peserta didik. 
Sekolah ini dibangun dengan semangat untuk menciptakan lingkungan belajar yang ramah, inklusif, serta mendukung potensi akademik dan non-akademik siswa.

Dengan tenaga pendidik yang profesional serta fasilitas yang terus dikembangkan, Reva High School hadir untuk menjadi mitra terbaik dalam mempersiapkan generasi masa depan yang kompeten, kreatif, dan berdaya saing.</p>
        <p>
            Untuk informasi lebih lanjut, silakan klik tombol berikut:
            <a href="profil_sekolah.php" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">Baca Selengkapnya Tentang Kami</a>
        </p>
        
        <hr>

        <h2 id="berita" class="section-title">📢 Berita & Pengumuman Terbaru</h2>
        <div class="berita-list">
            <?php if (count($berita_terbaru) > 0): ?>
                <?php foreach ($berita_terbaru as $berita): ?>
                    <div class="berita-item">
                        <h3><?php echo htmlspecialchars($berita['judul']); ?></h3>
                        <p style="font-size: 0.8em; color: #666;">Tanggal: <?php echo date('d F Y', strtotime($berita['tanggal_posting'])); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($berita['isi_singkat'])) . '...'; ?></p>
                        <a href="detail_berita.php?id=<?php echo $berita['id']; ?>">Baca Selengkapnya</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada berita atau pengumuman terbaru saat ini.</p>
            <?php endif; ?>
        </div>

        <hr>

        <h2 id="bukutamu" class="section-title">✍ Buku Tamu</h2>
        <p>Silakan tinggalkan pesan, kritik, atau saran Anda di <a href="buku_tamu.php">halaman Buku Tamu</a> kami.</p>

    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Reva High School.
    </div>
</body>
</html>