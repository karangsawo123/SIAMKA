<!-- file: templates/header.php -->
<?php
// Hitung kedalaman folder dari posisi file yang sedang dibuka
$pathDepth = substr_count($_SERVER['PHP_SELF'], '/');
$basePath = str_repeat('../', $pathDepth - 2);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>SIAMKA</title>

  <!-- CSS utama (otomatis sesuai level folder) -->
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/dashboard.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/table.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/tambah_aset.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/global_button.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/maintenance.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/sidebar_dropdown.css">
  <link rel="stylesheet" href="<?= $basePath ?>assets/css/riwayat_perawatan.css">

  <!-- Font & Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
<header class="header">
  <div class="logo">
    <img src="<?= $basePath ?>assets/img/logo1.png" alt="Logo" class="logo-img" width="40">
    <span class="logo-text">SIAMKA</span>
  </div>

  <div class="user-info">
    <span><?= $_SESSION['nama']; ?> (<?= ucfirst($_SESSION['role']); ?>)</span>
    <a href="<?= $basePath ?>logout.php" class="logout-btn">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </div>
</header>
