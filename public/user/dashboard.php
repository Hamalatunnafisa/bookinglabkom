<?php
session_start();
include 'chek_login.php';
include '../../config/config.php';

$today = date('Y-m-d');
$now_time = date('H:i:s');

$labs = [
    'Lab Komputer 1' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 2' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 3' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 4' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
];

// Ambil semua booking hari ini yang statusnya pending ATAU approve
$query = "
    SELECT lab, jam_mulai, jam_selesai, kelas, status
    FROM booking_lab
    WHERE tanggal = '$today'
    AND LOWER(status) IN ('pending', 'approve')
    ORDER BY jam_mulai ASC
";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $lab = $row['lab'];

        if (!isset($labs[$lab])) continue;

        $jam_mulai   = $row['jam_mulai'];
        $jam_selesai = $row['jam_selesai'];
        $kelas       = $row['kelas'];
        $statusDB    = strtolower($row['status']);

        // Booking yang sedang berlangsung
        if ($now_time >= $jam_mulai && $now_time < $jam_selesai) {
            $labs[$lab] = [
                'status' => 'Sedang Dipakai',
                'jam'    => "$jam_mulai - $jam_selesai",
                'kelas'  => $kelas
            ];
        }
        
        // Booking yang belum mulai (upcoming)
        elseif ($now_time < $jam_mulai && $labs[$lab]['status'] === 'Kosong') {
            $labs[$lab] = [
                'status' => $statusDB === 'pending' ? 'Menunggu Persetujuan' : 'Dipesan',
                'jam'    => "$jam_mulai - $jam_selesai",
                'kelas'  => $kelas
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Booking Lab – UIN Saizu</title>

    <!-- ICON -->
    <link rel="stylesheet" href="../../public/assets/css/all.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header class="top-header">
    <div class="header-left">
        <h5 class="subtitle">Selamat Datang, User</h5>
        <h1 class="title">Booking Laboratorium</h1>
        <p class="subtitle">Sistem pemantauan & booking lab komputer — UIN Saizu</p>
    </div>
    <br>
    <div class="header-left">
        <a class="login-btn btn btn-danger" href="../logout.php">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</header>

<div class="container">

    <!-- GRID FITUR 3 MENU -->
    <section class="grid-box">

        <!-- BOOKING -->
        <a href="booking.php" class="box">
            <i class="fas fa-calendar-plus icon"></i>
            <h3>Booking</h3>
            <p>Buat booking lab</p>
        </a>

        <!-- CEK KETERSEDIAAN -->
        <a href="cek.php" class="box">
            <i class="fas fa-door-open icon"></i>
            <h3>Cek Ketersediaan</h3>
            <p>Lihat ruang yang kosong</p>
        </a>

        <!-- RIWAYAT -->
        <a href="riwayat.php" class="box">
            <i class="fas fa-history icon"></i>
            <h3>Riwayat</h3>
            <p>Booking kamu</p>
        </a>

    </section>


    <!-- PENDAHULUAN -->
    <section class="intro">
        <h2>Pendahuluan</h2>
        <p>
            Dikalangan Mahasiswa UIN Saizu terdapat 4 ruang laboratorium komputer.
            Untuk memudahkan mahasiswa, dosen, dan admin dalam memantau serta melakukan
            booking laboratorium, sistem ini hadir sebagai solusi online yang terstruktur,
            cepat, dan transparan.
        </p>

        <a href="booking.php" class="btn-primary">Buat Booking</a>
    </section>


    <!-- MAIN CONTENT -->
    <div class="main-card">

        <!-- KALENDER -->
        <div class="calendar-box">
            <h3>Kalender Ketersediaan</h3>

            <iframe 
                src="https://calendar.google.com/calendar/embed?src=id.indonesian%23holiday%40group.v.calendar.google.com&ctz=Asia%2FJakarta"
                width="100%"
                height="420"
                frameborder="0"
                scrolling="no"
                style="border:0; border-radius:10px;">
            </iframe>
        </div>

        <!-- INFO RUANG -->
            <!-- Status Ruangan -->
        <div class="room-info-box">
            <h3>Status Ruangan Hari Ini (<?= htmlspecialchars($today) ?>)</h3>
            <div class="room-grid">
                <?php foreach ($labs as $namaLab => $info): 
                    // tentukan kelas CSS: busy kalau tidak Kosong
                    $isBusy = ($info['status'] !== 'Kosong');
                ?>
                    <div class="room-card <?= $isBusy ? 'busy' : 'free'; ?>">
                        <h4><?= htmlspecialchars($namaLab) ?></h4>
                        <p><strong><?= htmlspecialchars($info['jam']) ?></strong></p>
                        <p><?= htmlspecialchars($info['kelas']) ?></p>
                        <span class="status"><?= htmlspecialchars($info['status']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
 

    </div>

</div>

</body>
</html>
