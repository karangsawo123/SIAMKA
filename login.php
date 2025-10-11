<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND status='aktif'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: pages/admin/dashboard.php");
            } elseif ($row['role'] == 'pengguna') {
                header("Location: pages/pengguna/dashboard.php");
            } else {
                header("Location: pages/manajemen/dashboard.php");
            }
            exit();
        } else {
            $error = "⚠️ Password salah!";
        }
    } else {
        $error = "⚠️ Email tidak ditemukan atau akun nonaktif!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIAMKA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="login-box">
            <img src="assets/img/logo.png" alt="Logo SIAMKA" class="logo">
            <h2>SIAMKA</h2>
            <p>Sistem Aset Manajemen Kampus</p>

            <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

            <form method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login">Masuk</button>
            </form>
            <footer>
                <p>© 2025 SIAMKA - Universitas Hogwarts</p>
            </footer>
        </div>
    </div>
</body>
</html>
