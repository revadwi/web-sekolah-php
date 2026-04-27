<?php
// Password yang Anda inginkan untuk akun admin
$password_admin = "adminreva"; 

// Hasilkan hash yang aman menggunakan algoritma BCRYPT (default dan terbaik)
$hash_admin = password_hash($password_admin, PASSWORD_DEFAULT);

echo "Password Asli: " . $password_admin . "<br>";
echo "Hash yang dihasilkan (masukkan ke DB): <b>" . $hash_admin . "</b><br>";
echo "Simpan hash di atas untuk data Admin Anda.";
?>