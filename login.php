<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Website Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .login-box h2 {
            color: #004d99;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-login {
            background-color: #005aae;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #004d99;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            color: #005aae;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login Area Sekolah</h2>

        <?php 
        // Menampilkan pesan error jika ada
        if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
            echo '<div class="alert">Login gagal! Username atau password salah.</div>';
        }
        ?>

        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <a href="index.php" class="back-link">← Kembali ke Beranda</a>
    </div>

</body>
</html>