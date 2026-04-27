<?php
// Konfigurasi Database
$host = 'localhost'; // Ganti jika host database Anda berbeda
$db = 'sekolah_db';
$user = 'root';      // Ganti dengan username database Anda
$pass = '';          // Ganti dengan password database Anda

// Membuat koneksi menggunakan MySQLi Procedural
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Opsional: Atur encoding
mysqli_set_charset($koneksi, "utf8");