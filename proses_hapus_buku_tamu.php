<?php
session_start();
// Pastikan hanya admin yang bisa mengakses
if ($_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    // KOREKSI 1: Path login.php (ada di root) sudah benar
    header("location: login.php?pesan=belum_login");
    exit();
}

// KONEKSI: koneksi.php ada di root, jadi path-nya benar
include 'koneksi.php';

// Pastikan ID dikirim melalui GET
if (isset($_GET['id'])) {
    // Amankan data input
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query DELETE
    $query_delete = "DELETE FROM buku_tamu WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query_delete)) {
        // KOREKSI 2: Tujuan redirect harus ke folder admin/
        header("location: admin/admin_buku_tamu.php?status=hapus_sukses");
    } else {
        // KOREKSI 3: Redirect juga jika gagal agar tidak stuck di halaman error
        // Alternatif: echo "Error: Gagal menghapus data. " . mysqli_error($koneksi);
        header("location: admin/admin_buku_tamu.php?status=hapus_gagal");
    }
} else {
    // Jika tidak ada ID, arahkan kembali
    header("location: admin/admin_buku_tamu.php");
}

mysqli_close($koneksi);
exit();
// TIDAK ADA TAG PENUTUP PHP UNTUK MENCEGAH WHITESPACE ERROR