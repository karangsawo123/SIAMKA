<?php
include '../../../config/koneksi.php';

$keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);

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
  WHERE c.nama_kategori LIKE '%$keyword%'
  ORDER BY mh.tanggal_perawatan DESC
";

$result = mysqli_query($koneksi, $query);
$no = 1;

if (mysqli_num_rows($result) > 0) {
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
  echo "<tr><td colspan='9' style='text-align:center; color:#777;'>Tidak ada data ditemukan</td></tr>";
}
