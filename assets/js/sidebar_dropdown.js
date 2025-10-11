document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dropdown-btn").forEach(btn => {
    btn.addEventListener("click", function(e) {
      // ambil nama file saat ini (basename)
      const cur = window.location.pathname.split("/").pop();

      // nextElementSibling diasumsikan adalah <ul class="dropdown-content">
      const dropdown = this.nextElementSibling;
      if (!dropdown) return;

      // Jika kita sudah berada di data_aset.php -> toggle tanpa navigasi
      if (cur === 'data_aset.php') {
        e.preventDefault();

        const isShown = dropdown.style.display === 'block' || dropdown.classList.contains('show');

        if (isShown) {
          dropdown.style.display = 'none';
          dropdown.classList.remove('show');
          // optional: hapus query string ?menu=aset dari URL tanpa reload
          const newUrl = window.location.pathname;
          history.replaceState(null, '', newUrl);
        } else {
          dropdown.style.display = 'block';
          dropdown.classList.add('show');
          // optional: tambahkan ?menu=aset ke URL tanpa reload
          // history.replaceState(null, '', 'data_aset.php?menu=aset');
        }
      }
      // Kalau bukan di data_aset.php -> biarkan link berjalan (navigasi ke data_aset.php?menu=aset)
    });
  });
});