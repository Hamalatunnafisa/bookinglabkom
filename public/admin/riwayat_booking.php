<?php
include '../../app/config/config.php';

// Ambil semua data booking (riwayat)
$sql = "SELECT * FROM booking_lab ORDER BY tanggal DESC, jam DESC";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Riwayat Booking</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container py-5">

    <h3 class="mb-4 fw-bold">Riwayat Booking Laboratorium</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>NIM</th>
                            <th>No HP</th>
                            <th>Lab</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <td><?= htmlspecialchars($row['nim']); ?></td>
                            <td><?= htmlspecialchars($row['nohp']); ?></td>
                            <td class="text-center"><?= $row['lab']; ?></td>
                            <td class="text-center"><?= $row['tanggal']; ?></td>
                            <td class="text-center"><?= $row['jam']; ?></td>
                            <td><?= htmlspecialchars($row['keperluan']); ?></td>
                            <td class="text-center text-capitalize">
                                <?= $row['status']; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>
