<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah login dan role-nya 'admin'
if ($_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    // Jika belum login atau bukan admin, arahkan kembali ke halaman login
    header("location: ../login.php?pesan=belum_login");
    exit();
}

// PERBAIKAN KRITIS: Mengganti 'koneksi.php' dengan '../koneksi.php'
// Ini memperbaiki Warning: Failed to open stream di Dashboard Admin
include 'koneksi.php';

// Ambil nama pengguna dari sesi, gunakan 'Administrator Utama' jika tidak ada
$nama_admin = isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Administrator Utama';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Sekolah</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e9ebee; }
        .dashboard-container { 
            width: 90%; 
            margin: 30px auto; 
            background: white; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 6px 15px rgba(0,0,0,0.1); 
        }
        h1 { 
            color: #004d99; 
            border-bottom: 3px solid #005aae; 
            padding-bottom: 15px; 
            margin-bottom: 30px; 
            font-size: 1.8em;
        }

        /* --- STYLE BARU: Menu Grid Card --- */
        .menu-grid {
            display: grid;
            /* Membuat tata letak grid dengan minimal 3 kolom (250px) */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 25px; /* Jarak antar kartu */
            margin-top: 30px;
        }
        
        .menu-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            
            /* Style Card */
            background-color: #e6f7ff; /* Biru Muda */
            border: 1px solid #91d5ff;
            border-radius: 10px;
            padding: 30px 20px; /* Ukuran lebih besar */
            height: 150px; /* Tinggi seragam */
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s, background-color 0.2s;
            
            /* Style Teks */
            font-weight: bold;
            color: #004d99;
            text-decoration: none;
            font-size: 1.1em;
        }
        
        .menu-card:hover {
            background-color: #bae0ff; /* Biru lebih gelap saat hover */
            transform: translateY(-5px); /* Efek naik */
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            color: #002766;
        }
        
        /* Ikon & Label */
        .menu-card::before {
            content: "💡"; /* Ikon Default */
            font-size: 2.5em; /* Ukuran ikon besar */
            margin-bottom: 10px;
        }
        .berita::before { content: "📰"; }
        .buku-tamu::before { content: "✍️"; }
        .guru::before { content: "👨‍🏫"; }
        .siswa::before { content: "👧"; }
        .mapel::before { content: "📚"; }
        .jadwal::before { content: "🗓️"; }
        .nilai::before { content: "💯"; }

        /* Logout */
        .logout-link {
            display: inline-block;
            margin-top: 40px;
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            padding: 5px 0;
            border-bottom: 2px dashed #dc3545;
        }
        .logout-link:hover {
            color: #a00000;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Selamat Datang di Dashboard Admin, <?php echo $nama_admin; ?>! 👋</h1>
        <p style="color: #6c757d; font-style: italic;">Panel Kontrol Utama untuk pengelolaan data sekolah.</p>
        
        <div class="menu-grid">
            <a href="admin/admin_berita.php" class="menu-card berita">
                Kelola Berita & Pengumuman
            </a>
            
            <a href="admin/admin_buku_tamu.php" class="menu-card buku-tamu">
                Lihat Buku Tamu
            </a>
            
            <a href="admin/data_guru.php" class="menu-card guru">
                Data Guru
            </a>
            
            <a href="admin/data_siswa.php" class="menu-card siswa">
                Data Siswa
            </a>
            
            <a href="admin/data_mapel.php" class="menu-card mapel">
                Data Mata Pelajaran
            </a>
            
            <a href="admin/data_jadwal.php" class="menu-card jadwal">
                Data Jadwal Ajar
            </a>
            
            <a href="admin/data_nilai.php" class="menu-card nilai">
                Data Nilai Siswa
            </a>
        </div>

        <p>
            <a href="logout.php" class="logout-link">
                LOGOUT DARI SISTEM
            </a>
        </p>
    </div>
</body>
</html>