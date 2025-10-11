<?php
session_start();
include '../../config/koneksi.php';

// Cek apakah user admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Pastikan ada ID dikirim lewat URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // hindari injeksi

    // Jalankan query hapus
    mysqli_query($koneksi, "DELETE FROM categories WHERE id_kategori = '$id'");
}

// Kembali ke halaman kategori
header("Location: kategori.php");
exit();
?>
