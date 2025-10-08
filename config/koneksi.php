<?php
// config/koneksi.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "siamka";

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
} else {
    // echo "Koneksi berhasil"; // bisa diaktifkan untuk testing
}
?>
