<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Booking Lab</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

  <div class="container py-5">
    <h3 class="mb-4">Laporan Booking Laboratorium</h3>

    <table class="table table-bordered table-striped bg-white shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Lab</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Keperluan</th>
        </tr>
      </thead>
      <tbody id="laporan_table"></tbody>
    </table>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const data = JSON.parse(localStorage.getItem('bl_bookings') || '[]');
      const tbody = document.getElementById('laporan_table');

      if (!data.length) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>`;
        return;
      }

      data.forEach(row => {
        let tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${row.nama}</td>
          <td>${row.kelas}</td>
          <td>${row.lab}</td>
          <td>${row.tanggal}</td>
          <td>${row.jam}</td>
          <td>${row.keperluan}</td>
        `;
        tbody.appendChild(tr);
      });
    });
  </script>

</body>
</html>
