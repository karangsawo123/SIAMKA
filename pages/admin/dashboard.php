<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit();
}
include '../../templates/header.php';
include '../../templates/sidebar.php';
?>

<main class="content">
  <h1>Selamat datang, <?= $_SESSION['nama']; ?> 👋</h1>
  <p>Ini adalah Dashboard Admin. Anda dapat mengelola data aset, peminjaman, dan perawatan.</p>
</main>

<?php include '../../templates/footer.php'; ?>
