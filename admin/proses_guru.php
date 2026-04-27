<?php
session_start();
// Cek Login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}

require_once '../koneksi.php';

if (!isset($koneksi)) {
    // Jika koneksi.php gagal dimuat, skrip akan berhenti di require_once.
    // Jika skrip lanjut sampai sini, tapi $koneksi tidak ada, berarti ada masalah lain.
    die("ERROR: Variabel \$koneksi tidak terdefinisi. Path include mungkin salah.");
}

if (mysqli_connect_error()) {
    die("Koneksi MySQLi Gagal: " . mysqli_connect_error());
}

if (isset($_GET['id']) && $_GET['aksi'] == 'hapus') {
    // Jika ini muncul, ID terkirim dan path koneksi sudah benar!
    // echo "ID berhasil diterima: " . $_GET['id'] . " dan Aksi: " . $_GET['aksi']; 
    // exit(); 
}

if (!isset($_GET['aksi'])) {
    header("location: data_guru.php");
    exit();
}

$aksi = $_GET['aksi'];

// --- Tambah Data Guru ---
if ($aksi == 'tambah') {
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    // HAPUS BARIS INI: $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']); 
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    
    // GANTI Query Insert (Hapus kolom mata_pelajaran)
    $query = "INSERT INTO guru (nip, nama, telepon) VALUES ('$nip', '$nama', '$telepon')"; // <-- KOREKSI
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data guru berhasil ditambahkan!'); window.location='data_guru.php';</script>";
    } else {
        // Cek jika error karena NIP sudah ada
        if (mysqli_errno($koneksi) == 1062) {
             echo "<script>alert('Gagal! NIP sudah terdaftar dalam database.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data guru: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
} 
// --- Edit Data Guru ---
elseif ($aksi == 'edit') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    // HAPUS BARIS INI: $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    // GANTI Query Update (Hapus kolom mata_pelajaran)
    $query = "UPDATE guru SET nip='$nip', nama='$nama', telepon='$telepon' WHERE id='$id'"; // <-- KOREKSI
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data guru berhasil diubah!'); window.location='data_guru.php';</script>";
    } else {
        // Cek jika error karena NIP sudah ada
        if (mysqli_errno($koneksi) == 1062) {
             echo "<script>alert('Gagal! NIP sudah terdaftar pada guru lain.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal mengubah data guru: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
} 

// --- Hapus Data Guru ---/
elseif ($aksi == 'hapus') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // --- KOREKSI KRITIS UNTUK FOREIGN KEY ---
    
    // 1. Hapus semua data yang bergantung pada guru ini (misalnya di jadwal_ajar)
    $query_hapus_anak = "DELETE FROM jadwal_ajar WHERE id_guru='$id'";
    mysqli_query($koneksi, $query_hapus_anak);
    // CATATAN: Jika ada tabel lain (misal: 'nilai_siswa') yang juga merujuk ke id guru, Anda harus menambahkannya di sini juga.
    
    // 2. Hapus data induk (Guru)
    $query_hapus_induk = "DELETE FROM guru WHERE id='$id'";
    
    // ------------------------------------------
    
    if (mysqli_query($koneksi, $query_hapus_induk)) {
        // JIKA BERHASIL
        echo "<script>alert('Data guru dan jadwal terkait berhasil dihapus!'); window.location='data_guru.php';</script>";
    } else {
        // JIKA GAGAL
        echo "<script>alert('Gagal menghapus data guru: " . mysqli_error($koneksi) . "'); window.location='data_guru.php';</script>";
    }
}

mysqli_close($koneksi);
?>