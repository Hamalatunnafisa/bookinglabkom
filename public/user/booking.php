<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Booking Lab</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>

<div class="container py-5">
  <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
    <h3 class="mb-4">Form Booking Laboratorium</h3>

    <form id="bookingForm">

      <input type="hidden" name="status" value="pending">

      <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap" required>
      <input type="text" name="kelas" class="form-control mb-3" placeholder="Kelas" required>
      <input type="text" name="nim" class="form-control mb-3" placeholder="NIM" required>
      <input type="text" name="nohp" class="form-control mb-3" placeholder="No HP" required>

      <select name="lab" class="form-select mb-3" required>
        <option value="">-- Pilih Lab --</option>
        <option>Lab Komputer 1</option>
        <option>Lab Komputer 2</option>
        <option>Lab Komputer 3</option>
        <option>Lab Komputer 4</option>
      </select>

      <div class="row mb-3">
        <div class="col">
          <label>Tanggal</label>
          <input type="date" name="tanggal" class="form-control" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col">
          <label>Jam Mulai</label>
          <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="col">
          <label>Jam Selesai</label>
          <input type="time" name="jam_selesai" class="form-control" required>
        </div>
      </div>

      <input type="text" name="keperluan" class="form-control mb-4" placeholder="Keperluan / Mata Kuliah" required>

      <button class="btn btn-primary w-100">Submit</button>
    </form>

  </div>
</div>

<script>
document.getElementById('bookingForm').addEventListener('submit', function(e){
  e.preventDefault();
  const fd = new FormData(this);

  fetch('booking_proses.php', {
    method: 'POST',
    body: fd
  })
  .then(r => r.text())
  .then(res => {
      if(res.trim() === "success"){
          alert("Booking berhasil dikirim ke admin");
          window.location = "riwayat.php";
      } else {
          alert("Gagal: " + res);
      }
  });
});
</script>

</body>
</html>
