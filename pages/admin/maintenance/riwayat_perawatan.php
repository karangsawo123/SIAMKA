<?php
session_start();
include '../../../config/koneksi.php';
include '../../../templates/header.php';
include '../../../templates/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit();
}

$query = "
  SELECT 
    mh.id_history,
    a.nama_aset,
    c.nama_kategori,
    mh.tanggal_perawatan,
    mh.biaya,
    mh.teknisi,
    mh.deskripsi,
    mh.status_aset_setelah_perawatan
  FROM maintenance_history mh
  LEFT JOIN assets a ON mh.id_aset = a.id_aset
  LEFT JOIN categories c ON a.id_kategori = c.id_kategori
  ORDER BY mh.tanggal_perawatan DESC
";
$result = mysqli_query($koneksi, $query);
?>


<main class="content riwayat-page">
  <div class="content-header">
    <h2><i class="fa-solid fa-screwdriver-wrench"></i> Riwayat Perawatan Aset</h2>
  </div>

  <!-- 🔍 Search box -->
  <div class="search-container">
    <div class="search-wrapper">
      <i class="fa fa-search search-icon"></i>
      <input type="text" id="searchKategori" placeholder="Cari berdasarkan kategori aset..." autocomplete="off">
    </div>
  </div>

  <!-- 📋 Tabel -->
  <div id="resultArea" class="fade">
    <table class="data-table" id="riwayatTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Aset</th>
          <th>Kategori</th>
          <th>Tanggal Perawatan</th>
          <th>Biaya</th>
          <th>Teknisi</th>
          <th>Keterangan</th>
          <th>Kondisi Setelah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <?php
        if (mysqli_num_rows($result) > 0) {
          $no = 1;
          while ($row = mysqli_fetch_assoc($result)) {
            $preview = strlen($row['deskripsi']) > 40 ? substr($row['deskripsi'], 0, 40) . "..." : $row['deskripsi'];
            echo "
              <tr>
                <td>{$no}</td>
                <td>{$row['nama_aset']}</td>
                <td>{$row['nama_kategori']}</td>
                <td>{$row['tanggal_perawatan']}</td>
                <td>Rp " . number_format($row['biaya'], 0, ',', '.') . "</td>
                <td>{$row['teknisi']}</td>
                <td>{$preview}</td>
                <td>{$row['status_aset_setelah_perawatan']}</td>
                <td>
                  <button class='btn-detail'
                          onclick=\"showDetail(
                            '{$row['id_history']}',
                            '{$row['nama_aset']}',
                            '{$row['nama_kategori']}',
                            '{$row['tanggal_perawatan']}',
                            'Rp " . number_format($row['biaya'], 0, ',', '.') . "',
                            '{$row['teknisi']}',
                            '{$row['deskripsi']}',
                            '{$row['status_aset_setelah_perawatan']}'
                          )\">
                    <i class='fa-solid fa-circle-info'></i> Detail
                  </button>
                </td>
              </tr>
            ";
            $no++;
          }
        } else {
          echo "<tr><td colspan='9' style='text-align:center; color:#777;'>Belum ada riwayat perawatan</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</main>

<!-- Modal Detail Riwayat -->
<div id="detailModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h3><i class="fa-solid fa-circle-info"></i> Detail Riwayat Perawatan</h3>
    <p><strong>Nama Aset:</strong> <span id="dNama"></span></p>
    <p><strong>Kategori:</strong> <span id="dKategori"></span></p>
    <p><strong>Tanggal Perawatan:</strong> <span id="dTanggal"></span></p>
    <p><strong>Biaya:</strong> <span id="dBiaya"></span></p>
    <p><strong>Teknisi:</strong> <span id="dTeknisi"></span></p>
    <p><strong>Keterangan:</strong> <span id="dDeskripsi"></span></p>
    <p><strong>Kondisi Setelah:</strong> <span id="dKondisi"></span></p>

    <div class="modal-actions">
      <a id="editLink" class="btn-detail"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
      <a id="deleteLink" class="btn-delete"><i class="fa-solid fa-trash"></i> Hapus</a>
    </div>
  </div>
</div>


<?php include '../../../templates/footer.php'; ?>

