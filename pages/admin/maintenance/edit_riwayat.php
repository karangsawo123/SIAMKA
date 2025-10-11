<?php
session_start();
include '../../../config/koneksi.php';
include '../../../templates/header.php';
include '../../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit();
}

// Ambil ID riwayat dari URL
$id = $_GET['id'];

// Ambil data riwayat berdasarkan ID
$query = "
  SELECT mh.*, a.nama_aset 
  FROM maintenance_history mh
  LEFT JOIN assets a ON mh.id_aset = a.id_aset
  WHERE mh.id_history = '$id'
";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Update data
if (isset($_POST['update'])) {
    $tanggal = $_POST['tanggal_perawatan'];
    $biaya = $_POST['biaya'];
    $teknisi = $_POST['teknisi'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status_aset_setelah_perawatan'];

    $update = "UPDATE maintenance_history SET 
                tanggal_perawatan='$tanggal',
                biaya='$biaya',
                teknisi='$teknisi',
                deskripsi='$deskripsi',
                status_aset_setelah_perawatan='$status'
               WHERE id_history='$id'";
    mysqli_query($koneksi, $update);
    header("Location: riwayat_perawatan.php");

}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-pen-to-square"></i> Edit Riwayat Perawatan</h2>
  </div>

  <form method="POST" class="form-container">
    <div class="form-group">
      <label>Nama Aset</label>
      <input type="text" value="<?= $data['nama_aset']; ?>" disabled>
    </div>

    <div class="form-group">
      <label>Tanggal Perawatan</label>
      <input type="date" name="tanggal_perawatan" value="<?= $data['tanggal_perawatan']; ?>" required>
    </div>

    <div class="form-group">
      <label>Biaya (Rp)</label>
      <input type="number" name="biaya" value="<?= $data['biaya']; ?>" required>
    </div>

    <div class="form-group">
      <label>Teknisi</label>
      <input type="text" name="teknisi" value="<?= $data['teknisi']; ?>" required>
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="deskripsi" rows="4" required><?= $data['deskripsi']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Kondisi Setelah Perawatan</label>
      <select name="status_aset_setelah_perawatan" required>
        <option value="Baik" <?= ($data['status_aset_setelah_perawatan'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
        <option value="Rusak Ringan" <?= ($data['status_aset_setelah_perawatan'] == 'Rusak Ringan') ? 'selected' : ''; ?>>Rusak Ringan</option>
        <option value="Rusak Berat" <?= ($data['status_aset_setelah_perawatan'] == 'Rusak Berat') ? 'selected' : ''; ?>>Rusak Berat</option>
      </select>
    </div>

    <div class="form-actions">
      <button type="submit" name="update" class="btn btn-success">
        <i class="fa-solid fa-check"></i> Simpan Perubahan
      </button>
      <a href="riwayat_perawatan.php" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
      </a>
    </div>
  </form>
</main>

<?php include '../../../templates/footer.php'; ?>
