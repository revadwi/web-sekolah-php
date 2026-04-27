<?php
session_start();
// Cek status login
if (empty($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != "admin") {
    header("location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$status_redirect = 'admin_berita.php'; // Halaman default redirect

if ($action == 'add') {
    // --- CREATE (Tambah Berita) ---
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
        $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
        // Penulis ID diambil dari session admin yang sedang login
        
        // Asumsi: Admin ID disimpan di session. Anda mungkin perlu mengambil ID dari database berdasarkan username jika belum ada di session.
        // Untuk contoh ini, kita asumsikan ID Admin adalah 1 (atau Anda harus mengambilnya saat login)
        $penulis_id_query = "SELECT id FROM pengguna WHERE username = '{$_SESSION['username']}'";
        $result_id = mysqli_query($koneksi, $penulis_id_query);
        $user_data = mysqli_fetch_assoc($result_id);
        $penulis_id = $user_data['id']; 

        $query_insert = "INSERT INTO berita (judul, isi, penulis_id) VALUES ('$judul', '$isi', '$penulis_id')";
        
        if (mysqli_query($koneksi, $query_insert)) {
            header("location: $status_redirect?status=add_sukses");
        } else {
            die("Error: " . mysqli_error($koneksi));
        }
    }

} elseif ($action == 'update') {
    // --- UPDATE (Edit Berita) ---
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
        $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);

        $query_update = "UPDATE berita SET 
                         judul = '$judul', 
                         isi = '$isi' 
                         WHERE id = '$id'";
        
        if (mysqli_query($koneksi, $query_update)) {
            header("location: $status_redirect?status=edit_sukses");
        } else {
            die("Error: " . mysqli_error($koneksi));
        }
    }
    
} elseif ($action == 'delete') {
    // --- DELETE (Hapus Berita) ---
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $query_delete = "DELETE FROM berita WHERE id='$id'";
    
    if (mysqli_query($koneksi, $query_delete)) {
        header("location: $status_redirect?status=delete_sukses");
    } else {
        die("Error: " . mysqli_error($koneksi));
    }

} else {
    // Jika action tidak valid
    header("location: $status_redirect");
}

mysqli_close($koneksi);
exit();
?>