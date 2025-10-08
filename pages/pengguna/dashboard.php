<?php
session_start();
if ($_SESSION['role'] != 'pengguna') {
    header("Location: ../../login.php");
    exit();
}
echo "<h2>Selamat datang, Pengguna " . $_SESSION['nama'] . "</h2>";
echo "<a href='../../logout.php'>Logout</a>";
?>
