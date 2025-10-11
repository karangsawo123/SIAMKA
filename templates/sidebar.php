<!-- file: templates/sidebar.php -->
<?php
// Hitung kedalaman folder otomatis
$pathDepth = substr_count($_SERVER['PHP_SELF'], '/');
$basePath = str_repeat('../', $pathDepth - 2);
$currentFile = basename($_SERVER['PHP_SELF']);
?>

<aside class="sidebar">
  <nav>
    <ul>
      <?php if ($_SESSION['role'] == 'admin'): ?>

        <!-- DASHBOARD -->
        <li>
          <a href="<?= $basePath ?>pages/admin/dashboard.php"
             class="<?= $currentFile == 'dashboard.php' ? 'active' : '' ?>">
            🏠 Dashboard
          </a>
        </li>

        <!-- DATA ASET (Dropdown) -->
        <?php
          $isAsetActive = in_array($currentFile, ['data_aset.php', 'kategori.php']) ||
                          (isset($_GET['menu']) && $_GET['menu'] === 'aset');
          $isKategoriActive = $currentFile == 'kategori.php';
        ?>
        <li class="dropdown">
          <a href="<?= $basePath ?>pages/admin/data_aset.php?menu=aset"
             class="dropdown-btn <?= $isAsetActive ? 'active' : '' ?>">
            📦 Data Aset ▾
          </a>

          <ul class="dropdown-content" <?= $isAsetActive ? 'style="display:block;"' : '' ?>>
            <li>
              <a href="<?= $basePath ?>pages/admin/kategori.php"
                 class="<?= $isKategoriActive ? 'active-sub' : '' ?>">
                🗂 Kategori Aset
              </a>
            </li>
          </ul>
        </li>

        <!-- MENU LAIN -->
        <li>
          <a href="<?= $basePath ?>pages/admin/peminjaman.php"
             class="<?= $currentFile == 'peminjaman.php' ? 'active' : '' ?>">
            📋 Peminjaman
          </a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/admin/perawatan.php"
             class="<?= $currentFile == 'perawatan.php' ? 'active' : '' ?>">
            🛠 Perawatan
          </a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/admin/laporan.php"
             class="<?= $currentFile == 'laporan.php' ? 'active' : '' ?>">
            📊 Laporan
          </a>
        </li>

      <?php elseif ($_SESSION['role'] == 'pengguna'): ?>
        <li>
          <a href="<?= $basePath ?>pages/pengguna/dashboard.php">🏠 Dashboard</a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/pengguna/pinjam_aset.php">📦 Pinjam Aset</a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/pengguna/riwayat.php">🧾 Riwayat</a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/pengguna/lapor_kerusakan.php">⚠ Lapor Kerusakan</a>
        </li>

      <?php elseif ($_SESSION['role'] == 'manajemen'): ?>
        <li>
          <a href="<?= $basePath ?>pages/manajemen/dashboard.php">🏠 Dashboard</a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/manajemen/laporan_aset.php">📊 Laporan Aset</a>
        </li>
        <li>
          <a href="<?= $basePath ?>pages/manajemen/laporan_perawatan.php">🛠 Laporan Perawatan</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</aside>
