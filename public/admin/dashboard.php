<?php
include '../../app/config/config.php';

$today = date('Y-m-d');
$now_time = date('H:i:s');

// Nama lab harus sesuai yang ada di database
$labs = [
    'Lab Komputer 1' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 2' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 3' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
    'Lab Komputer 4' => ['status' => 'Kosong', 'jam' => '-', 'kelas' => '—'],
];

// Ambil booking hari ini dengan status approve, urut dari jam_mulai paling awal
$query = "
    SELECT lab, jam_mulai, jam_selesai, kelas
    FROM booking_lab
    WHERE tanggal = '$today'
    AND LOWER(status) = 'approve'
    ORDER BY jam_mulai ASC
";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $lab = $row['lab'];

        // kalau nama lab di DB tidak ada di array $labs, skip (menghindari undefined index)
        if (!isset($labs[$lab])) continue;

        $jam_mulai  = $row['jam_mulai'];
        $jam_selesai = $row['jam_selesai'];
        $kelas      = $row['kelas'];

        // jika sekarang berada di rentang jam_mulai <= now < jam_selesai => Sedang Dipakai
        if ($now_time >= $jam_mulai && $now_time < $jam_selesai) {
            // prioritas: sedang dipakai (jika sudah terisi jangan timpa)
            $labs[$lab] = [
                'status' => 'Sedang Dipakai',
                'jam'    => $jam_mulai . ' - ' . $jam_selesai,
                'kelas'  => $kelas
            ];
        } 
        // jika belum mulai tapi masih kosong (upcoming booking), isi kalau sebelumnya masih 'Kosong'
        elseif ($now_time < $jam_mulai && $labs[$lab]['status'] === 'Kosong') {
            $labs[$lab] = [
                'status' => 'Dipesan',
                'jam'    => $jam_mulai . ' - ' . $jam_selesai,
                'kelas'  => $kelas
            ];
        }
        // jika sudah lewat jam_selesai kita tidak perlu melakukan apa-apa (tetap Kosong)
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
