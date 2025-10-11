<?php
session_start();
include '../../config/koneksi.php';
include '../../templates/header.php';
include '../../templates/sidebar.php';

// Pastikan hanya admin yang bisa mengakses
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}
?>

<main class="content">
    <div class="content-header">
        <h2><i class="fa-solid fa-boxes-stacked"></i> Data Aset Kampus</h2>
        <a href="tambah_aset.php" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Aset
        </a>
    </div>


    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Harga</th>
                <th>Tanggal Perolehan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT a.*, c.nama_kategori 
                FROM assets a 
                LEFT JOIN categories c ON a.id_kategori = c.id_kategori
                ORDER BY a.id_aset DESC";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
            <td>{$no}</td>
            <td>{$row['kode_aset']}</td>
            <td>{$row['nama_aset']}</td>
            <td>{$row['nama_kategori']}</td>
            <td>{$row['lokasi']}</td>
            <td>{$row['kondisi']}</td>
            <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
            <td>{$row['tanggal_perolehan']}</td>
            <td>
              <a href='edit_aset.php?id=" . $row['id_aset'] . "' class='btn btn-success'>
                <i class=\"fa-solid fa-pen-to-square\"></i> Edit
              </a>
              <a href='#' onclick='confirmDelete(" . $row['id_aset'] . ")' class='btn btn-danger'>
                <i class=\"fa-solid fa-trash\"></i> Hapus
              </a>
            </td>
          </tr>";
          
                $no++;
            }

            ?>
        </tbody>
    </table>

</main>
<script>
function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // Ganti path sesuai lokasi file hapus_aset.php
        window.location.href = "hapus_aset.php?id=" + id;
    }
}
</script>

<?php include '../../templates/footer.php'; ?>

