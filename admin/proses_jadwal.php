<?php
session_start();
// Cek Login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../login.php");
    exit();
}

include '../koneksi.php';

// Pastikan aksi ada, jika tidak, arahkan kembali
if (!isset($_GET['aksi'])) {
    header("location: data_jadwal.php");
    exit();
}

$aksi = $_GET['aksi'];

// --- Tambah Jadwal Ajar ---
if ($aksi == 'tambah') {
    $id_guru = mysqli_real_escape_string($koneksi, $_POST['id_guru']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    
    // Query Insert
    $query = "INSERT INTO jadwal_ajar (id_guru, id_mapel, kelas) VALUES ('$id_guru', '$id_mapel', '$kelas')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal ajar berhasil ditambahkan!'); window.location='data_jadwal.php';</script>";
    } else {
        // Cek jika error karena kombinasi Guru, Mapel, dan Kelas sudah ada (constraint UNIQUE KEY)
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! Jadwal ini sudah terdaftar.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menambahkan jadwal ajar: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}
// --- Edit Jadwal Ajar ---
elseif ($aksi == 'edit') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_guru = mysqli_real_escape_string($koneksi, $_POST['id_guru']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    // Query Update
    $query = "UPDATE jadwal_ajar SET 
              id_guru='$id_guru', 
              id_mapel='$id_mapel', 
              kelas='$kelas' 
              WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal ajar berhasil diubah!'); window.location='data_jadwal.php';</script>";
    } else {
        // Cek jika error karena kombinasi Guru, Mapel, dan Kelas sudah ada
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! Jadwal yang Anda masukkan sudah terdaftar.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal mengubah jadwal ajar: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}
// --- Hapus Jadwal Ajar ---
elseif ($aksi == 'hapus') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query Delete Sederhana (Hanya hapus dari tabel jadwal_ajar itu sendiri)
    $query = "DELETE FROM jadwal_ajar WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jadwal ajar berhasil dihapus!'); window.location='data_jadwal.php';</script>";
    } else {
        // Tampilkan error jika ada masalah, meski seharusnya tidak ada Foreign Key error di sini
        echo "<script>alert('Gagal menghapus jadwal ajar: " . mysqli_error($koneksi) . "'); window.location='data_jadwal.php';</script>";
    }
}
mysqli_close($koneksi);
?>