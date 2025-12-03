<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Riwayat Booking</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-light">

  <div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3>Riwayat Booking</h3>

      <!-- Tombol Reset -->
      <button id="btn_reset" class="btn btn-danger btn-sm">
        Reset Data
      </button>
    </div>

    <div id="list_booking"></div>

  </div>

  <script>
    // Fungsi untuk reset data dari localStorage
    document.getElementById('btn_reset').addEventListener('click', () => {
      if (confirm("Yakin ingin menghapus SEMUA data booking?")) {
        localStorage.removeItem('bl_bookings');
        alert("Semua data berhasil dihapus.");
        location.reload(); 
      }
    });

    // Render Riwayat
    document.addEventListener('DOMContentLoaded', () => {
      const data = JSON.parse(localStorage.getItem('bl_bookings') || '[]');
      const root = document.getElementById('list_booking');

      if (!data.length) {
        root.innerHTML = `<p class="text-muted">Belum ada booking.</p>`;
        return;
      }

      data.forEach(item => {
        const box = document.createElement('div');
        box.className = "card p-3 mb-3 shadow-sm";

        box.innerHTML = `
          <h5>${item.nama} (${item.kelas})</h5>
          <p class="mb-1"><strong>Lab:</strong> ${item.lab}</p>
          <p class="mb-1"><strong>Tanggal:</strong> ${item.tanggal}</p>
          <p class="mb-1"><strong>Jam:</strong> ${item.jam}</p>
          <p class="mb-1"><strong>Keperluan:</strong> ${item.keperluan}</p>
          <p class="mt-2"><span class="badge bg-secondary">Kode: ${item.kode}</span></p>
        `;

        root.appendChild(box);
      });
    });
  </script>

</body>
</html>
