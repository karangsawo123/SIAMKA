<?php
session_start();
if ($_SESSION['role'] != 'manajemen') {
    header("Location: ../../login.php");
    exit();
}
echo "<h2>Selamat datang, Manajemen " . $_SESSION['nama'] . "</h2>";
echo "<a href='../../logout.php'>Logout</a>";
?>
