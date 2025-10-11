<!-- file: templates/footer.php -->
<?php
// Hitung otomatis berapa level folder dari root "siamka"
$pathDepth = substr_count($_SERVER['PHP_SELF'], '/');
$basePath = str_repeat('../', $pathDepth - 2);
?>
<footer class="footer">
  <p>© <?= date("Y"); ?> Sistem Aset Manajemen Kampus (SIAMKA)</p>
</footer>

<!-- Script JS -->
<script src="<?= $basePath ?>assets/js/sidebar_dropdown.js"></script>
<script src="<?= $basePath ?>assets/js/modal_riwayatPerawatan.js"></script>
</body>
</html>
