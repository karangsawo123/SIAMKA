<?php
session_start();
include '../../../config/koneksi.php';
include '../../../templates/header.php';
include '../../../templates/sidebar.php';

$id_jadwal = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT js.*, a.nama_aset, a.id_aset
                FROM maintenance_schedule js 
                LEFT JOIN assets a ON js.id_aset = a.id_aset
                WHERE js.id_jadwal='$id_jadwal'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['simpan'])) {
    $id_aset = $data['id_aset'];
    $tanggal = $_POST['tanggal_perawatan'];
    $biaya = $_POST['biaya'];
    $teknisi = $_POST['teknisi'];
    $deskripsi = $_POST['deskripsi'];
    $status_aset = $_POST['status_aset'];

    mysqli_query($koneksi, "INSERT INTO maintenance_history (id_aset, tanggal_perawatan, biaya, teknisi, deskripsi, status_aset_setelah_perawatan)
                VALUES ('$id_aset', '$tanggal', '$biaya', '$teknisi', '$deskripsi', '$status_aset')");
    mysqli_query($koneksi, "UPDATE maintenance_schedule SET status='selesai' WHERE id_jadwal='$id_jadwal'");
    header("Location: riwayat_perawatan.php");
    exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-clipboard-check"></i> Input Hasil Perawatan</h2>
  </div>

  <form method="POST" class="form-container">
    <div class="form-group">
      <label>Nama Aset</label>
      <input type="text" value="<?= $data['nama_aset']; ?>" readonly>
    </div>

    <div class="form-group">
      <label>Tanggal Perawatan</label>
      <input type="date" name="tanggal_perawatan" required>
    </div>

    <div class="form-group">
      <label>Biaya</label>
      <input type="number" name="biaya" step="0.01">
    </div>

    <div class="form-group">
      <label>Teknisi</label>
      <input type="text" name="teknisi">
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="3"></textarea>
    </div>

    <div class="form-group">
      <label>Status Aset Setelah Perawatan</label>
      <select name="status_aset">
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
        <option value="hilang">Hilang</option>
      </select>
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
