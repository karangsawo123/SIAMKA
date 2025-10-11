<?php
session_start();
include '../../../config/koneksi.php';
include '../../../templates/header.php';
include '../../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $id_admin = $_SESSION['id_user'];
    $id_aset = $_POST['id_aset'];
    $tanggal = $_POST['tanggal_jadwal'];
    $status = 'terjadwal';

    mysqli_query($koneksi, "INSERT INTO maintenance_schedule (id_admin, id_aset, tanggal_jadwal, status)
                VALUES ('$id_admin', '$id_aset', '$tanggal', '$status')");
    header("Location: jadwal_perawatan.php");
    exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-calendar-plus"></i> Tambah Jadwal Perawatan</h2>
  </div>

  <form method="POST" class="form-container">
    <div class="form-group">
      <label>Pilih Aset</label>
      <select name="id_aset" required>
        <option value="">-- Pilih Aset --</option>
        <?php
        $aset = mysqli_query($koneksi, "SELECT * FROM assets");
        while ($row = mysqli_fetch_assoc($aset)) {
          echo "<option value='{$row['id_aset']}'>{$row['nama_aset']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Tanggal Jadwal</label>
      <input type="date" name="tanggal_jadwal" required>
    </div>

    <div class="form-actions">
      <button type="submit" name="simpan" class="btn btn-success">
        <i class="fa-solid fa-check"></i> Simpan
      </button>
      <a href="jadwal_perawatan.php" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
      </a>
    </div>
  </form>
</main>

<?php include '../../../templates/footer.php'; ?>
