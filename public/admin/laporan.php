<?php
include "../../app/config/config.php";

// Ambil laporan penggunaan lab
$query = mysqli_query($conn, "
    SELECT lp.*, lab.nama_lab
    FROM laporan_penggunaan_lab lp
    JOIN lab ON lab.id = lp.lab_id
    ORDER BY lp.tanggal DESC, lp.jam_mulai ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penggunaan Lab</title>

    <link rel="stylesheet" href="../../public/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/assets/css/adminlte.min.css">

    <style>
        .card { border-radius: 10px; }
        thead { background:#000; color:#fff; }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <div class="content-wrapper p-4">

        <div class="card">
            <div class="card-header bg-black text-white">
                <h4 class="mb-0">Laporan Penggunaan Lab</h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lab</th>
                            <th>Peminjam</th>
                            <th>Keperluan</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Dibuat</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(mysqli_num_rows($query) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['nama_lab'] ?></td>
                                    <td><?= $row['peminjam'] ?></td>
                                    <td><?= $row['keperluan'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= substr($row['jam_mulai'], 0, 5) ?></td>
                                    <td><?= substr($row['jam_selesai'], 0, 5) ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada laporan penggunaan lab</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<script src="../../public/assets/plugins/jquery/jquery.min.js"></script>
<script src="../../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../public/assets/js/adminlte.min.js"></script>

</body>
</html>
