<?php
include '../../app/config/config.php';

$today = date('Y-m-d');

// Samakan dengan nama LAB di database
$labs = [
    'Lab Komputer 1' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 2' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 3' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 4' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
];

// Ambil booking hari ini dengan status APPROVE
$query = "
    SELECT lab, jam, kelas
    FROM booking_lab
    WHERE tanggal = '$today'
    AND LOWER(status) = 'approve'
    ORDER BY STR_TO_DATE(jam, '%H:%i') ASC
";

$result = mysqli_query($conn, $query);

// Update status lab
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        $lab = $row['lab'];

        // Pastikan nama lab ada dalam array
        if (!array_key_exists($lab, $labs)) {
            continue;
        }

        // Update hanya jika lab masih kosong
        if ($labs[$lab]['status'] === 'Kosong') {
            $labs[$lab] = [
                'status' => 'Dipakai',
                'jam'    => htmlspecialchars($row['jam']),
                'kelas'  => htmlspecialchars($row['kelas'])
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin – Booking Lab</title>

    <!-- ICON -->
    <link rel="stylesheet" href="../assets/vendor/fontawesome/css/all.min.css">

    <!-- STYLE -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header class="top-header">
    <div>
        <h1 class="title">Dashboard Admin</h1>
        <p class="subtitle">Kelola Booking & Jadwal Laboratorium UIN Saizu</p>
    </div>

    <div class="header-right">
        <a class="login-btn btn btn-danger" href="../login.php">Logout</a>
    </div>
</header>

<div class="container">

    <!-- MENU -->
    <section class="grid-box">
        <a href="booking.php" class="box box1">
            <i class="fas fa-calendar-check icon"></i>
            <h3>Kelola Booking</h3>
            <p>Data booking masuk</p>
        </a>

        <a href="kelola_jadwal.php" class="box box2">
            <i class="fas fa-clock icon"></i>
            <h3>Kelola Jadwal</h3>
            <p>Atur jadwal per lab</p>
        </a>

        <a href="user.php" class="box box3">
            <i class="fas fa-users icon"></i>
            <h3>Data User</h3>
            <p>Kelola akun user</p>
        </a>

        <a href="laporan.php" class="box box4">
            <i class="fas fa-file-alt icon"></i>
            <h3>Laporan</h3>
            <p>Laporan penggunaan lab</p>
        </a>

        <a href="riwayat_booking.php" class="box box5">
            <i class="fas fa-history icon"></i>
            <h3>Riwayat</h3>
            <p>Riwayat pemakaian lab</p>
        </a>
    </section>

    <!-- INTRO -->
    <section class="intro">
        <h2>Selamat Datang Admin</h2>
        <p>Gunakan panel ini untuk memantau dan mengelola seluruh aktivitas booking dan penggunaan laboratorium komputer UIN Saizu.</p>
    </section>

    <div class="main-card">

        <!-- Kalender -->
        <div class="calendar-box">
            <h3>Kalender Ketersediaan</h3>
            <iframe 
                src="https://calendar.google.com/calendar/embed?src=id.indonesian%23holiday%40group.v.calendar.google.com&ctz=Asia%2FJakarta"
                width="100%" height="420" frameborder="0" scrolling="no"
                style="border:0; border-radius:10px;">
            </iframe>
        </div>

        <!-- Status Ruangan -->
        <div class="room-info-box">
            <h3>Status Ruangan Hari Ini</h3>

            <div class="room-grid">
                <?php foreach ($labs as $namaLab => $info): ?>
                    <div class="room-card <?= $info['status'] === 'dipakai' ? 'busy' : 'free'; ?>">
                        <h4><?= htmlspecialchars($namaLab) ?></h4>
                        <p><strong><?= $info['jam'] ?></strong></p>
                        <p><?= $info['kelas'] ?></p>
                        <span class="status"><?= $info['status'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</div>

</body>
</html>
