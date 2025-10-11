<?php
session_start();
include '../../config/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

$id = $_GET['id'];

// Hapus data
mysqli_query($koneksi, "DELETE FROM assets WHERE id_aset='$id'");
header("Location: data_aset.php");
exit();
?>
