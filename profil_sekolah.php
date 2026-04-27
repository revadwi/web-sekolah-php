<?php 
// File ini berada di root, jadi koneksi.php juga di root
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah | Nama Sekolah Anda</title>
    <style>
        /* Style Dasar dan Kontainer (Sudah Benar) */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .main-content { width: 80%; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #004d99; border-bottom: 2px solid #005aae; padding-bottom: 10px; margin-bottom: 20px; }
        p, ul { line-height: 1.6; }
        h2 { color: #004d99; margin-top: 25px; }

        /* === STYLE BARU: TABEL === */
        .vimi-table {
            width: 100%;
            border-collapse: collapse; /* Membuat garis border menyatu */
            margin-top: 20px;
        }
        .vimi-table th {
            background-color: #005aae; /* Warna header tabel (Biru) */
            color: white;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .vimi-table td {
            padding: 12px;
            border: 1px solid #ddd;
            vertical-align: top;
            background-color: #f9f9f9; /* Warna baris data */
        }
        .vimi-table ul {
            margin: 0;
            padding-left: 20px;
        }
        /* === END STYLE TABEL === */
    </style>
</head>
<body>
    
    <div class="main-content">
        <h1>Tentang Kami</h1>
        
        <p>
            Selamat datang di Reva High School. Kami berkomitmen menyediakan layanan pendidikan berkualitas, inovatif, dan berorientasi pada pengembangan karakter siswa. Sejak pertama kali didirikan, sekolah ini hadir sebagai lembaga yang mendukung potensi peserta didik melalui pembelajaran yang ramah, inklusif, dan relevan dengan perkembangan teknologi.
        </p>

        <table class="vimi-table">
            <thead>
                <tr>
                    <th style="width: 30%;">Kategori</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><h2>Visi</h2></td>
                    <td>
                        Menjadi sekolah unggulan yang menghasilkan peserta didik berkarakter, berprestasi, serta adaptif terhadap perkembangan ilmu pengetahuan dan teknologi.
                    </td>
                </tr>
                <tr>
                    <td><h2>Misi</h2></td>
                    <td>
                        <ul>
                            <li>Mengembangkan kemampuan akademik dan non-akademik siswa melalui proses pembelajaran yang efektif dan inovatif.</li>
                            <li>Menciptakan lingkungan belajar yang inklusif, inspiratif, dan mendorong kreativitas siswa.</li>
                            <li>Memanfaatkan teknologi sebagai sarana pendukung pembelajaran dan pengelolaan sekolah.</li>
                            <li>Menanamkan nilai moral, etika, karakter, serta budaya disiplin dalam setiap kegiatan pendidikan.</li>
                            <li>Membangun kemitraan dengan orang tua dan masyarakat untuk meningkatkan kualitas layanan pendidikan.</li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p style="margin-top: 30px;">
            Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami melalui formulir kontak atau datang langsung ke sekolah kami.
        </p>
        
        <a href="index.php" style="display: inline-block; margin-top: 20px; color: #004d99; text-decoration: none;">← Kembali ke Beranda</a>
    </div>

</body>
</html>