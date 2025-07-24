// public/assets/js/script.js

// ==============================
// Auto-hide Flash Message
// ==============================

document.addEventListener('DOMContentLoaded', function () {
  const flash = document.querySelector('.flash-msg');
  if (flash) {
    setTimeout(() => {
      flash.style.opacity = '0';
      flash.style.transition = 'opacity 0.5s ease';
      setTimeout(() => {
        flash.style.display = 'none';
      }, 500);
    }, 3000); // Hilang setelah 3 detik
  }
});

// ==============================
// Konfirmasi Sebelum Hapus Data
// ==============================

function confirmDelete(msg = "Yakin ingin menghapus data ini?") {
  return confirm(msg);
}
