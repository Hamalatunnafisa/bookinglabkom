<?php 
session_start();
include '../../config/config.php';

// Cek login
if (!isset($_SESSION['id'])) {
    echo "Anda belum login";
    exit;
}

$user_id = $_SESSION['id'];

// Ambil semua riwayat booking user
$sql = "SELECT * FROM booking_lab 
        WHERE id = '$user_id'
        ORDER BY tanggal DESC, jam_mulai DESC";

$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Riwayat Booking Saya</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
.card-booking {
    border-left: 6px solid #0d6efd;
    transition: 0.2s;
}
.card-booking:hover {
    transform: scale(1.01);
    background: #f8f9fa;
}
.label-bold {
    font-weight: bold;
}
</style>

</head>

<body>

<div class="container py-4">

    <h3 class="mb-4 fw-bold">Riwayat Booking Saya</h3>

    <?php
    if (mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-info'>Anda belum memiliki riwayat booking.</div>";
    }

    while ($row = mysqli_fetch_assoc($result)) : ?>

    <div class="card mb-3 card-booking shadow-sm">
        <div class="card-body">

            <!-- STATUS -->
            <div class="text-end">
                <?php if ($row['status'] == 'pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php elseif ($row['status'] == 'approved'): ?>
                    <span class="badge bg-success">Disetujui</span>
                <?php elseif ($row['status'] == 'rejected'): ?>
                    <span class="badge bg-danger">Ditolak</span>
                <?php endif; ?>
            </div>

            <!-- ISI DATA BOOKING -->
            <h5 class="fw-bold mb-3"><?= $row['lab']; ?></h5>

            <p class="mb-1"><span class="label-bold">Tanggal:</span> <?= $row['tanggal']; ?></p>
            <p class="mb-1"><span class="label-bold">Jam:</span> <?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></p>
            <p class="mb-1"><span class="label-bold">Keperluan:</span> <?= htmlspecialchars($row['keperluan']); ?></p>

                <!-- KODE BOOKING -->
        <p class="mt-3 mb-1"><span class="label-bold">Kode Booking:</span></p>
        <div class="p-2 bg-light border rounded">
            <?= $row['kode_booking']; ?>
        </div>

        <!-- TOMBOL QR -->
        <a href="qrcode.php?nama=<?= urlencode($row['nama']); ?>
        &nim=<?= urlencode($row['nim']); ?>
        &lab=<?= urlencode($row['lab']); ?>
        &tanggal=<?= urlencode($row['tanggal']); ?>
        &waktu=<?= urlencode($row['jam_mulai'].' - '.$row['jam_selesai']); ?>"
        class="btn btn-primary mt-3">
            Lihat QR
        </a>



        </div>
    </div>

    <?php endwhile; ?>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</body>
</html>
