<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
  header("Location: ../../login.php");
  exit();
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama_kategori'];
  $deskripsi = $_POST['deskripsi'];

  if ($nama == "") {
    $error = "Nama kategori tidak boleh kosong!";
  } else {
    mysqli_query($koneksi, "INSERT INTO categories (nama_kategori, deskripsi) VALUES ('$nama', '$deskripsi')");
    header("Location: kategori.php");
    exit();
  }
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-plus"></i> Tambah Kategori</h2>
  </div>

  <form method="POST" class="form-container">
    <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>

    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori" placeholder="Contoh: Elektronik" required>
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="3" placeholder="Keterangan kategori..."></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" name="simpan" class="btn btn-success"><i class="fa-solid fa-check"></i> Simpan</button>
      <a href="kategori.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
  </form>
</main>

<?php include '../../templates/footer.php'; ?>
