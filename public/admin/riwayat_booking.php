<?php
// Koneksi
include '../../app/config/config.php';

// Ambil data booking
$sql = "SELECT * FROM booking_lab ORDER BY tanggal DESC";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Riwayat Booking</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container py-5">
    <h3 class="mb-4">Riwayat Booking Laboratorium</h3>

    <div class="card p-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
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
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['kelas']; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nohp']; ?></td>
                    <td><?= $row['lab']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['jam']; ?></td>
                    <td><?= $row['keperluan']; ?></td>
                    <td class="text-capitalize"><?= $row['status']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
