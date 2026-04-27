<?php
// Include koneksi database
include 'koneksi.php';

// Memeriksa apakah data form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil dan bersihkan data dari form (Penting untuk mencegah SQL Injection!)
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // Query INSERT (CREATE) data
    $query_insert = "INSERT INTO buku_tamu (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    
    // Jalankan query
    if (mysqli_query($koneksi, $query_insert)) {
        // Berhasil disimpan, arahkan kembali ke halaman buku tamu dengan notifikasi sukses
        header("location: buku_tamu.php?status=sukses");
        exit();
    } else {
        // Gagal menyimpan
        echo "Error: " . $query_insert . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika diakses tanpa POST, arahkan kembali
    header("location: buku_tamu.php");
    exit();
}

// Tutup koneksi
mysqli_close($koneksi);
?>