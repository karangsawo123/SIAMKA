<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit();
}
echo "<h2>Selamat datang, Admin " . $_SESSION['nama'] . "</h2>";
echo "<a href='../../logout.php'>Logout</a>";
?>
