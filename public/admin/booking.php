<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kelola Booking – Admin</title>

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<!-- STYLE -->
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/adminlte.css">

<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>

<div class="container py-5">
<div class="card shadow p-4 mx-auto" style="max-width: 700px;">
    <h3 class="mb-4">Kelola Booking Laboratorium</h3>

    <!-- FORM ADMIN -->
    <form action="booking_proses.php" method="POST">

    <div class="row">
        <div class="col-md-6">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control mb-3" required>
        </div>

        <div class="col-md-6">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control mb-3" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control mb-3" required>
        </div>

        <div class="col-md-6">
        <label>No HP</label>
        <input type="text" name="nohp" class="form-control mb-3" required>
        </div>
    </div>

    <label>Pilih Lab</label>
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
        <div class="col">
        <label>Jam</label>
        <input type="time" name="jam" class="form-control" required>
        </div>
    </div>

    <label>Keperluan / Mata Kuliah</label>
    <input type="text" name="keperluan" class="form-control mb-4" required>

    <!-- STATUS (KHUSUS ADMIN) -->
    <label>Status Booking</label>
    <select name="status" class="form-select mb-4" required>
        <option value="pending">Pending</option>
        <option value="approve">Disetujui</option>
        <option value="reject">Ditolak</option>
    </select>

    <button class="btn btn-primary w-100">Simpan</button>

    </form>
</div>
</div>

<script src="../assets/js/app.js"></script>

</body>
</html>
