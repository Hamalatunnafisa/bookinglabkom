<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cek Ketersediaan</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="container py-5">
  <div class="card p-4 shadow mx-auto" style="max-width:650px;">
    <h3 class="mb-4">Cek Ketersediaan Ruangan</h3>

    <input type="date" id="cek_date" class="form-control mb-3" value="<?= date('Y-m-d'); ?>">

    <div id="cek_result"></div>
  </div>
</div>

<script src="assets/js/app.js"></script>
<script>

function render(date){
  const bookings = getBookings();
  const labs = ["Lab Komputer 1","Lab Komputer 2","Lab Komputer 3","Lab Komputer 4"];
  const out = document.getElementById('cek_result');

  out.innerHTML = "";

  labs.forEach(lab => {
    const card = document.createElement("div");
    card.className = "p-3 mb-3 bg-white border rounded shadow-sm";

    const title = `<h5>${lab}</h5>`;
    card.innerHTML = title;

    const used = bookings.filter(b => b.lab === lab && b.tanggal === date);

    if(used.length === 0){
      card.innerHTML += `<p class="text-success fw-bold">Tersedia</p>`;
    } else {
      used.forEach(b => {
        card.innerHTML += `
          <div class="d-flex justify-content-between border-start border-3 border-danger ps-2 my-2">
            <div><strong>${b.jam}</strong> — ${b.nama} (${b.kelas})</div>
            <span class="badge bg-danger">Terpakai</span>
          </div>
        `;
      });
    }

    out.appendChild(card);
  });

}

cek_date.addEventListener('change', () => render(cek_date.value));

window.onload = () => render(cek_date.value);

</script>
</body>
</html>
