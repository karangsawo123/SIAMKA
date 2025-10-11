<?php
session_start();
include '../../../config/koneksi.php';     
include '../../../templates/header.php';
include '../../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit();
}
?>

<main class="content">
  <div class="content-header">
    <h2><i class="fa-solid fa-screwdriver-wrench"></i> Jadwal Perawatan Aset</h2>
    <a href="tambah_jadwal.php" class="btn btn-primary">
      <i class="fa-solid fa-calendar-plus"></i> Tambah Jadwal
    </a>
  </div>

  <table class="data-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Aset</th>
        <th>Tanggal Jadwal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $query = mysqli_query($koneksi, "SELECT js.*, a.nama_aset 
                FROM maintenance_schedule js 
                LEFT JOIN assets a ON js.id_aset = a.id_aset 
                ORDER BY js.tanggal_jadwal DESC");

      while ($row = mysqli_fetch_assoc($query)) {
          $statusColor = ($row['status'] == 'selesai') ? 'green' : 
                         (($row['status'] == 'dibatalkan') ? 'red' : 'blue');
          echo "<tr>
                  <td>{$no}</td>
                  <td>{$row['nama_aset']}</td>
                  <td>{$row['tanggal_jadwal']}</td>
                  <td style='color:$statusColor;font-weight:600'>{$row['status']}</td>
                  <td>
                    <a href='input_riwayat.php?id={$row['id_jadwal']}' class='btn btn-success'>
                      <i class='fa-solid fa-clipboard-check'></i> Input Hasil
                    </a>
                  </td>
                </tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>
</main>

<?php include '../../../templates/footer.php'; ?>
