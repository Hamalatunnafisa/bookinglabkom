<?php
session_start();
require_once "../../config/config.php";

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

if ($cari !=''){
    $data = $conn->query("SELECT * FROM booking_lab WHERE nim LIKE '%$cari%' OR lab LIKE '%$cari%' OR jam_mulai LIKE '%$cari%'  ORDER BY tanggal DESC");
} else {
    $data = $conn->query("SELECT * FROM booking_lab ORDER BY tanggal DESC");
}
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Manajemen Booking</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>

<div class="container py-5">
    <div class="card shadow p-2 w-100">

        <h3 class="mb-4">Manajemen Booking Laboratorium</h3>
        <div class="header-left">
            <a href="dashboard.php" class="btn btn-secondary">
                &larr; Kembali ke Dashboard
            </a>
    </div>
        <!-- Form Pencarian Full Width dengan input group -->
        <form method="GET ">
            <div class="input-group ">
                <input 
                    type="text" 
                    name="cari" 
                    class="form-control" 
                    placeholder="Cari NIM, Lab, atau Jam..." 
                    value="<?= htmlspecialchars($cari) ?>"
                    aria-label="Search"
                >
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="manage_booking.php" class="btn btn-secondary">Reset</a>
        </form>
        <!-- Tabel Responsive -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped align-middle table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Lab</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($b = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($b['nama']) ?></td>
                        <td><?= htmlspecialchars($b['lab']) ?></td>
                        <td><?= htmlspecialchars($b['tanggal']) ?></td>
                        <td><?= htmlspecialchars($b['jam_mulai']) ?> - <?= htmlspecialchars($b['jam_selesai']) ?></td>
                        <td><?= htmlspecialchars($b['keperluan']) ?></td>
                        <td>
                            <?php 
                                if ($b['status'] == 'pending') echo '<span class="badge bg-warning text-dark">Pending</span>';
                                if ($b['status'] == 'approve') echo '<span class="badge bg-success">Disetujui</span>';
                                if ($b['status'] == 'reject') echo '<span class="badge bg-danger">Ditolak</span>';
                            ?>
                        </td>
                        <td>
                            <a href="manage_booking_process.php?id=<?= $b['id'] ?>&s=approve" 
                            class="btn btn-success btn-sm">Approve</a>
                            <a href="manage_booking_process.php?id=<?= $b['id'] ?>&s=reject" 
                            class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>


</body>
</html>
