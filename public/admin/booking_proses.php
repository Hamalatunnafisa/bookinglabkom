<?php
include "../../app/config/config.php";

// ambil semua booking
$data = $conn->query("SELECT * FROM booking_lab ORDER BY created_at DESC");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kelola Booking – Admin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container py-5">
<h3 class="mb-4">Kelola Booking Laboratorium</h3>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Lab</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Keperluan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php while($b = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $b['nama'] ?></td>
            <td><?= $b['lab'] ?></td>
            <td><?= $b['tanggal'] ?></td>
            <td><?= $b['jam_mulai'] ?> - <?= $b['jam_selesai'] ?></td>
            <td><?= $b['keperluan'] ?></td>
            <td><?= $b['status'] ?></td>

            <td>
                <a href="status_proses.php?id=<?= $b['id'] ?>&s=approve" class="btn btn-success btn-sm">Approve</a>
                <a href="status_proses.php?id=<?= $b['id'] ?>&s=reject" class="btn btn-danger btn-sm">Reject</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</div>

</body>
</html>
