<?php
session_start();
include '../../../config/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];

// Hapus data riwayat
mysqli_query($koneksi, "DELETE FROM maintenance_history WHERE id_history='$id'");
header("Location: riwayat_perawatan.php");
exit();
?>
