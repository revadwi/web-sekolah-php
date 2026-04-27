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
    header("location: data_nilai.php");
    exit();
}

$aksi = $_GET['aksi'];

// --- Tambah Nilai Siswa ---
if ($aksi == 'tambah') {
    $id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nilai = mysqli_real_escape_string($koneksi, $_POST['nilai']);
    
    // Query Insert ke tabel ambil_mapel
    $query = "INSERT INTO ambil_mapel (id_siswa, id_mapel, nilai) VALUES ('$id_siswa', '$id_mapel', '$nilai')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Nilai siswa berhasil ditambahkan!'); window.location='data_nilai.php';</script>";
    } else {
        // Cek jika error karena Siswa sudah mengambil Mapel ini (constraint UNIQUE KEY)
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! Siswa ini sudah memiliki nilai untuk mata pelajaran tersebut.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menambahkan nilai siswa: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}
// --- Edit Nilai Siswa ---
elseif ($aksi == 'edit') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nilai = mysqli_real_escape_string($koneksi, $_POST['nilai']);

    // Query Update nilai (Dibuat satu baris untuk menghindari masalah spasi)
    $query = "UPDATE ambil_mapel SET nilai='$nilai' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Nilai siswa berhasil diubah!'); window.location='data_nilai.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah nilai siswa: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
// --- Hapus Nilai Siswa ---
elseif ($aksi == 'hapus') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query Delete
    $query = "DELETE FROM ambil_mapel WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Nilai siswa berhasil dihapus!'); window.location='data_nilai.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus nilai siswa: " . mysqli_error($koneksi) . "'); window.location='data_nilai.php';</script>";
    }
}

mysqli_close($koneksi);
?>