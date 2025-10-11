// 🪟 Tampilkan Detail Modal
function showDetail(id, nama, kategori, tanggal, biaya, teknisi, deskripsi, kondisi) {
  // Isi data ke dalam modal
  document.getElementById('dNama').textContent = nama;
  document.getElementById('dKategori').textContent = kategori;
  document.getElementById('dTanggal').textContent = tanggal;
  document.getElementById('dBiaya').textContent = biaya;
  document.getElementById('dTeknisi').textContent = teknisi;
  document.getElementById('dDeskripsi').textContent = deskripsi;
  document.getElementById('dKondisi').textContent = kondisi;

  // Set link edit & hapus
  document.getElementById('editLink').href = 'edit_riwayat.php?id=' + id;
  document.getElementById('deleteLink').href = 'hapus_riwayat.php?id=' + id;

  // Tampilkan modal (gunakan class agar bisa animasi)
  const modal = document.getElementById('detailModal');
  modal.classList.add('active');
  document.body.style.overflow = 'hidden'; // nonaktifkan scroll di background
}

// ❌ Tutup Modal
function closeModal() {
  const modal = document.getElementById('detailModal');
  modal.classList.remove('active');
  document.body.style.overflow = ''; // aktifkan scroll lagi
}

// Klik di luar modal → tutup
window.onclick = function(e) {
  const modal = document.getElementById('detailModal');
  if (e.target === modal) closeModal();
};

// Tekan ESC → tutup modal
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModal();
});

// 🔎 Live Search dengan efek fade
const searchInput = document.getElementById('searchKategori');
const resultArea = document.getElementById('resultArea');
const tableBody = document.getElementById('tableBody');

searchInput.addEventListener('keyup', function() {
  const keyword = this.value.trim();
  resultArea.classList.remove('fade-in');

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'search_riwayat.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (this.status === 200) {
      tableBody.innerHTML = this.responseText;
      resultArea.classList.add('fade-in');
    }
  };
  xhr.send('keyword=' + encodeURIComponent(keyword));
});
