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
    header("location: data_siswa.php");
    exit();
}

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tahun_masuk = mysqli_real_escape_string($koneksi, $_POST['tahun_masuk']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    
    // Query INSERT (Dibuat satu baris lurus tanpa indentasi di tengah string)
    $query = "INSERT INTO siswa (nis, nama, kelas, tahun_masuk, alamat, telepon) VALUES ('$nis', '$nama', '$kelas', '$tahun_masuk', '$alamat', '$telepon')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='data_siswa.php';</script>";
    } else {
        // ... (sisanya tetap sama)
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! NIS sudah terdaftar dalam database.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data siswa: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}
// --- Edit Data Siswa ---
elseif ($aksi == 'edit') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $tahun_masuk = mysqli_real_escape_string($koneksi, $_POST['tahun_masuk']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    // Query Update (Dibuat satu baris lurus)
    $query = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', tahun_masuk='$tahun_masuk', alamat='$alamat', telepon='$telepon' WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil diubah!'); window.location='data_siswa.php';</script>";
    } else {
        // Cek jika error karena NIS sudah ada
        if (mysqli_errno($koneksi) == 1062) {
            echo "<script>alert('Gagal! NIS sudah terdaftar pada siswa lain.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Gagal mengubah data siswa: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
        }
    }
}

// --- Hapus Data Siswa ---
elseif ($aksi == 'hapus') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // 1. Hapus data anak (GANTI 'data_nilai' menjadi 'ambil_mapel')
    $query_hapus_nilai = "DELETE FROM ambil_mapel WHERE id_siswa='$id'"; // <--- INI KOREKSI MUTLAKNYA!
    mysqli_query($koneksi, $query_hapus_nilai);
    
    // 2. Hapus data induk (SISWA)
    $query_hapus_induk = "DELETE FROM siswa WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query_hapus_induk)) {
        echo "<script>alert('Data siswa dan mata pelajaran terkait berhasil dihapus!'); window.location='data_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data siswa: " . mysqli_error($koneksi) . "'); window.location='data_siswa.php';</script>";
    }
}
// ...
mysqli_close($koneksi);
?>