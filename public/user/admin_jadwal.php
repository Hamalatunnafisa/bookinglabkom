<?php ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Manajemen Jadwal - Admin</title>

  <!-- Bootstrap saja biar rapi -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- Custom CSS kamu sendiri -->
  <link rel="stylesheet" href="assets/css/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="bg-light">

  <div class="container py-5">
    <div class="card shadow p-4 mx-auto" style="max-width:600px;">

      <h3 class="mb-4">Manajemen Jadwal (Admin)</h3>

      <form id="schedForm" class="mb-4">

        <label class="form-label">Lab</label>
        <select id="s_lab" class="form-select mb-3" required>
          <option>Lab Komputer 1</option>
          <option>Lab Komputer 2</option>
          <option>Lab Komputer 3</option>
          <option>Lab Komputer 4</option>
        </select>

        <label class="form-label">Tanggal</label>
        <input type="date" id="s_tanggal" class="form-control mb-3" required>

        <label class="form-label">Jam</label>
        <input type="time" id="s_jam" class="form-control mb-3" required>

        <label class="form-label">Tipe</label>
        <select id="s_type" class="form-select mb-3">
          <option value="block">Tutup (Tidak tersedia)</option>
          <option value="slot">Jadwal tetap</option>
        </select>

        <button class="btn btn-primary w-100" type="submit">Simpan Jadwal</button>
      </form>


      <h4 class="mb-3">Jadwal & Penutupan</h4>
      <div id="sched_list"></div>

    </div>
  </div>

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
    function renderSched(){
      const arr = JSON.parse(localStorage.getItem('bl_admin_schedule') || '[]');
      const root = $('#sched_list');
      root.empty();

      if (!arr.length){
        root.append('<p class="text-muted">Belum ada jadwal khusus.</p>');
        return;
      }

      arr.forEach(s => {
        root.append(`
          <div class="border rounded p-3 mb-2 bg-white shadow-sm">
            <strong>${s.lab}</strong><br>
            ${s.tanggal} • ${s.jam}<br>
            <span class="badge bg-info mt-2">${s.type}</span>
          </div>
        `);
      });
    }

    $(function(){
      $('#schedForm').on('submit', function(e){
        e.preventDefault();

        const arr = JSON.parse(localStorage.getItem('bl_admin_schedule') || '[]');

        arr.push({
          id: 'S' + Date.now(),
          lab: $('#s_lab').val(),
          tanggal: $('#s_tanggal').val(),
          jam: $('#s_jam').val(),
          type: $('#s_type').val()
        });

        localStorage.setItem('bl_admin_schedule', JSON.stringify(arr));
        renderSched();
      });

      renderSched();
    });
  </script>

</body>
</html>
