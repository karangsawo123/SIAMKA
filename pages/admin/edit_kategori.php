<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
  header("Location: ../../login.php");
  exit();
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM categories WHERE id_kategori='$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
  $nama = $_POST['nama_kategori'];
  $deskripsi = $_POST['deskripsi'];

  mysqli_query($koneksi, "UPDATE categories SET nama_kategori='$nama', deskripsi='$deskripsi' WHERE id_kategori='$id'");
  header("Location: kategori.php");
  exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-pen"></i> Edit Kategori</h2>
  </div>

  <form method="POST" class="form-container">
    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori" value="<?= $data['nama_kategori']; ?>" required>
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="deskripsi" rows="3"><?= $data['deskripsi']; ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" name="update" class="btn btn-success"><i class="fa-solid fa-check"></i> Update</button>
      <a href="kategori.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    </div>
  </form>
</main>

<?php include '../../templates/footer.php'; ?>
