<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Ambil data aset berdasarkan ID
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM assets WHERE id_aset='$id'");
$data = mysqli_fetch_assoc($query);

// Simpan perubahan data
if (isset($_POST['update'])) {
    $kode_aset = $_POST['kode_aset'];
    $nama_aset = $_POST['nama_aset'];
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $kondisi = $_POST['kondisi'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal_perolehan'];

    $update = "UPDATE assets SET 
                kode_aset='$kode_aset',
                nama_aset='$nama_aset',
                id_kategori='$id_kategori',
                lokasi='$lokasi',
                kondisi='$kondisi',
                harga='$harga',
                tanggal_perolehan='$tanggal'
              WHERE id_aset='$id'";
    mysqli_query($koneksi, $update);
    header("Location: data_aset.php");
    exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-pen-to-square"></i> Edit Aset</h2>
  </div>

  <form method="POST" class="form-container">
    <div class="form-group">
      <label>Kode Aset</label>
      <input type="text" name="kode_aset" value="<?= $data['kode_aset']; ?>">
    </div>

    <div class="form-group">
      <label>Nama Aset</label>
      <input type="text" name="nama_aset" value="<?= $data['nama_aset']; ?>" required>
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <?php
        $kategori = mysqli_query($koneksi, "SELECT * FROM categories");
        while ($row = mysqli_fetch_assoc($kategori)) {
            $selected = ($row['id_kategori'] == $data['id_kategori']) ? 'selected' : '';
            echo "<option value='{$row['id_kategori']}' $selected>{$row['nama_kategori']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label>Lokasi</label>
      <input type="text" name="lokasi" value="<?= $data['lokasi']; ?>">
    </div>

    <div class="form-group">
      <label>Kondisi</label>
      <select name="kondisi">
        <option value="baik" <?= ($data['kondisi'] == 'baik') ? 'selected' : ''; ?>>Baik</option>
        <option value="rusak" <?= ($data['kondisi'] == 'rusak') ? 'selected' : ''; ?>>Rusak</option>
        <option value="hilang" <?= ($data['kondisi'] == 'hilang') ? 'selected' : ''; ?>>Hilang</option>
      </select>
    </div>

    <div class="form-group">
      <label>Harga</label>
      <input type="number" name="harga" value="<?= $data['harga']; ?>">
    </div>

    <div class="form-group">
      <label>Tanggal Perolehan</label>
      <input type="date" name="tanggal_perolehan" value="<?= $data['tanggal_perolehan']; ?>">
    </div>

    <div class="form-actions">
      <button type="submit" name="update" class="btn btn-success"><i class="fa-solid fa-check"></i> Update</button>
      <a href="data_aset.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
  </form>
</main>

<?php include '../../templates/footer.php'; ?>
