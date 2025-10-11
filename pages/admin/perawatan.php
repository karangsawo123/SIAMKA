<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-screwdriver-wrench"></i> Modul Perawatan Aset</h2>
  </div>

  <div class="card-grid">
    <a href="./maintenance/jadwal_perawatan.php" class="card-link">
      <div class="card">
        <i class="fa-solid fa-calendar-days"></i>
        <h3>Jadwal Perawatan</h3>
        <p>Lihat daftar jadwal perawatan aset yang akan datang.</p>
      </div>
    </a>

    <a href="./maintenance/tambah_jadwal.php" class="card-link">
      <div class="card">
        <i class="fa-solid fa-calendar-plus"></i>
        <h3>Tambah Jadwal</h3>
        <p>Buat jadwal perawatan baru untuk aset tertentu.</p>
      </div>
    </a>

    <a href="./maintenance/riwayat_perawatan.php" class="card-link">
      <div class="card">
        <i class="fa-solid fa-clipboard-list"></i>
        <h3>Riwayat Perawatan</h3>
        <p>Lihat riwayat hasil perawatan aset yang telah dilakukan.</p>
      </div>
    </a>
  </div>
</main>

<?php include '../../templates/footer.php'; ?>
