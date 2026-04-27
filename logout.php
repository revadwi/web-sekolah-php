<?php
session_start();
session_destroy(); // Hapus semua variabel sesi
header("location: index.php?pesan=logout"); // Arahkan kembali ke halaman utama
exit();
?>