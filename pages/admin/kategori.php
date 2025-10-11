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
    <h2><i class="fa-solid fa-layer-group"></i> Kategori Aset</h2>
    <a href="tambah_kategori.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Kategori</a>
  </div>

  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $result = mysqli_query($koneksi, "SELECT * FROM categories ORDER BY id_kategori DESC");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr>
          <td>{$no}</td>
          <td>{$row['nama_kategori']}</td>
          <td>{$row['deskripsi']}</td>
          <td>
            <a href='edit_kategori.php?id={$row['id_kategori']}' class='btn btn-success btn-sm mb-2'>
              <i class='fa-solid fa-pen'></i>
            </a>
            <a href='hapus_kategori.php?id={$row['id_kategori']}' onclick='return confirm(\"Hapus kategori ini?\")' class='btn btn-danger btn-sm'>
              <i class='fa-solid fa-trash'></i>
            </a>
          </td>
        </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</main>

<?php include '../../templates/footer.php'; ?>
