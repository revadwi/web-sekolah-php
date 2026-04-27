<?php
// Memulai sesi untuk menyimpan status login
session_start();

// Koneksi ke database
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// 1. Mencegah SQL Injection
// Gunakan prepared statements (lebih aman), tapi untuk contoh dasar kita pakai real_escape_string dulu
$username = mysqli_real_escape_string($koneksi, $username);

// 2. Query untuk mencari user berdasarkan username
$query = "SELECT * FROM pengguna WHERE username='$username'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Memeriksa hasil query
if ($user) {
    // 3. Verifikasi Password
    // HARAP GANTI 'password_hash_admin' atau hash default di DB dengan hash asli
    // Untuk contoh, kita anggap hash sudah diverifikasi (di lingkungan produksi, gunakan password_verify($password, $user['password']))
    
    // --- Simulasi Verifikasi Password (Ganti ini dengan password_verify() di produksi!) ---
    $is_password_valid = false;
    // PENTING: Karena kita tidak benar-benar menghash di langkah 1, kita cek langsung.
    // GANTI INI DENGAN LOGIKA PASSWORD_VERIFY YANG AMAN:
    if ($password == 'admin123' && $user['username'] == 'admin') {
         // HANYA UNTUK TESTING CEPAT. HAPUS DI APLIKASI ASLI!
        $is_password_valid = true;
    } else if (password_verify($password, $user['password'])) {
        $is_password_valid = true; // Ini adalah cara yang benar
    } else if ($password == $user['password'] && $user['role'] == 'siswa') {
        $is_password_valid = true; // JIKA TIDAK MENGGUNAKAN HASH
    }
    // -----------------------------------------------------------------------------------


    if ($is_password_valid) {
        // Login Berhasil!

        // 4. Buat variabel session
        $_SESSION['status'] = "login";
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nama'] = $user['nama_lengkap'];

        // 5. Arahkan ke halaman dashboard sesuai role
        if ($user['role'] == 'admin') {
            header("location: dashboard_admin.php");
        } elseif ($user['role'] == 'guru') {
            header("location: dashboard_guru.php");
        } else { // siswa
            header("location: dashboard_siswa.php");
        }
        exit();
    } else {
        // Password salah
        header("location: login.php?pesan=gagal");
        exit();
    }
} else {
    // Username tidak ditemukan
    header("location: login.php?pesan=gagal");
    exit();
}

mysqli_close($koneksi);
?>