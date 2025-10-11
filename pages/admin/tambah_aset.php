<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Simpan data saat form dikirim
if (isset($_POST['simpan'])) {
    $kode_aset = $_POST['kode_aset'];
    $nama_aset = $_POST['nama_aset'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $kondisi = $_POST['kondisi'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal_perolehan'];

    if ($nama_aset == "" || $id_kategori == "") {
        $error = "Nama aset dan kategori wajib diisi!";
    } else {
        $query = "INSERT INTO assets (kode_aset, nama_aset, id_kategori, lokasi, kondisi, harga, tanggal_perolehan)
                  VALUES ('$kode_aset', '$nama_aset', '$id_kategori', '$lokasi', '$kondisi', '$harga', '$tanggal')";
        mysqli_query($koneksi, $query);
        header("Location: data_aset.php");
        exit();
    }
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-plus"></i> Tambah Aset Baru</h2>
  </div>

  <form method="POST" class="form-container">
    <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>

    <div class="form-group">
      <label>Kode Aset</label>
      <input type="text" name="kode_aset" placeholder="Contoh: AST-001">
    </div>

    <div class="form-group">
      <label>Nama Aset</label>
      <input type="text" name="nama_aset" required>
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <?php
        $kategori = mysqli_query($koneksi, "SELECT * FROM categories");
        while ($row = mysqli_fetch_assoc($kategori)) {
            echo "<option value='{$row['id_kategori']}'>{$row['nama_kategori']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi">
    </div>

    <div class="form-group">
      <label>Kondisi</label>
      <select name="kondisi">
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
        <option value="hilang">Hilang</option>
      </select>
    </div>

    <div class="form-group">
      <label>Harga</label>
      <input type="number" name="harga" min="0" step="0.01">
    </div>

    <div class="form-group">
      <label>Tanggal Perolehan</label>
      <input type="date" name="tanggal_perolehan">
    </div>

    <div class="form-actions">
      <button type="submit" name="simpan" class="btn btn-success"><i class="fa-solid fa-check"></i> Simpan</button>
      <a href="data_aset.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
  </form>
</main>

<?php include '../../templates/footer.php'; ?>
