<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Booking Lab</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/assets/css/style.css">
  <link rel="stylesheet" href="public/assets/css/adminlte.css">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>

<div class="container py-5">
  <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
    <h3 class="mb-4">Form Booking Laboratorium</h3>

    <form id="bookingForm">
      <input type="text" id="b_nama" class="form-control mb-3" placeholder="Nama Lengkap" required>
      <input type="text" id="b_kelas" class="form-control mb-3" placeholder="Kelas" required>
      <input type="text" id="b_nim" class="form-control mb-3" placeholder="NIM" required>
      <input type="text" id="b_nohp" class="form-control mb-3" placeholder="No HP" required>

      <select id="b_lab" class="form-select mb-3" required>
        <option value="">-- Pilih Lab --</option>
        <option>Lab Komputer 1</option>
        <option>Lab Komputer 2</option>
        <option>Lab Komputer 3</option>
        <option>Lab Komputer 4</option>
      </select>

      <div class="row mb-3">
        <div class="col">
          <label>Tanggal</label>
          <input type="date" id="b_tanggal" class="form-control" required>
        </div>
        <div class="col">
          <label>Jam</label>
          <input type="time" id="b_jam" class="form-control" required>
        </div>
      </div>

      <input type="text" id="b_keperluan" class="form-control mb-4" placeholder="Keperluan / Mata Kuliah" required>

      <button class="btn btn-primary w-100">Submit</button>
      
    </form>

  </div>
</div>

<script src="public/assets/js/app.js"></script>
<script>
function addBooking(data){
  let arr = JSON.parse(localStorage.getItem('bl_bookings') || '[]');
  arr.push(data);
  localStorage.setItem('bl_bookings', JSON.stringify(arr));
}

document.getElementById('bookingForm').addEventListener('submit', function(e){
  e.preventDefault();

  const booking = {
    id: 'BK' + Date.now(),
    nama: b_nama.value,
    kelas: b_kelas.value,
    nim: b_nim.value,
    nohp: b_nohp.value,
    lab: b_lab.value,
    tanggal: b_tanggal.value,
    jam: b_jam.value,
    keperluan: b_keperluan.value,
    status: 'pending',
    kode: Math.random().toString(36).substring(2, 10)
  };

  addBooking(booking);

  alert("Booking berhasil! Kode: " + booking.kode);
  window.location = "riwayat.php";
});
</script>


</body>
</html>
