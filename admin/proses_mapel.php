<?php
session_start();
// Cek Session
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}
include '../koneksi.php';

$aksi = $_GET['aksi'];

// --- Tambah Data Mata Pelajaran ---
if ($aksi == 'tambah') {
    $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kode_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    // Query Insert
    $query = "INSERT INTO mata_pelajaran (kode_mapel, nama_mapel, deskripsi) VALUES ('$kode_mapel', '$nama_mapel', '$deskripsi')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Mata pelajaran berhasil ditambahkan!'); window.location='data_mapel.php';</script>";
    } else {
        // Cek jika error karena Kode Mapel sudah ada
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! Kode Mata Pelajaran sudah terdaftar.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menambahkan mata pelajaran: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}
// --- Edit Data Mata Pelajaran ---
elseif ($aksi == 'edit') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kode_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Query Update
    $query = "UPDATE mata_pelajaran SET 
              kode_mapel='$kode_mapel', 
              nama_mapel='$nama_mapel', 
              deskripsi='$deskripsi' 
              WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Mata pelajaran berhasil diubah!'); window.location='data_mapel.php';</script>";
    } else {
        // Cek jika error karena Kode Mapel sudah ada
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! Kode Mata Pelajaran sudah terdaftar pada mata pelajaran lain.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal mengubah mata pelajaran: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}

// --- Hapus Data Mata Pelajaran ---
elseif ($aksi == 'hapus') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // --- KOREKSI KRITIS UNTUK FOREIGN KEY MATA PELAJARAN ---
    
    // 1. Hapus data anak (JADWAL AJAR) yang merujuk ke Mapel ini
    $query_hapus_jadwal = "DELETE FROM jadwal_ajar WHERE id_mapel='$id'";
    mysqli_query($koneksi, $query_hapus_jadwal);
    
    // 2. Hapus data anak (AMBIL MAPEL/Nilai) yang merujuk ke Mapel ini
    $query_hapus_nilai = "DELETE FROM ambil_mapel WHERE id_mapel='$id'";
    mysqli_query($koneksi, $query_hapus_nilai);
    
    // 3. Hapus data induk (MATA PELAJARAN)
    $query_hapus_induk = "DELETE FROM mata_pelajaran WHERE id='$id'";
    
    // --------------------------------------------------------
    
    if (mysqli_query($koneksi, $query_hapus_induk)) {
        echo "<script>alert('Mata pelajaran dan data terkait berhasil dihapus!'); window.location='data_mapel.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus mata pelajaran: " . mysqli_error($koneksi) . "'); window.location='data_mapel.php';</script>";
    }
}

mysqli_close($koneksi);
?>