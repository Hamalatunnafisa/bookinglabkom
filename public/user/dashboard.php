
<?php
session_start();
include 'chek_login.php';
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Booking Lab – UIN Saizu</title>

    <!-- ICON -->
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">

    <!-- STYLE -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header class="top-header">
    <div>
        <h1 class="title">Booking Laboratorium</h1>
        <p class="subtitle">Sistem pemantauan & booking lab komputer — UIN Saizu</p>
    </div>

    <div class="header-right">
        <a class="login-btn btn btn-danger" href="../logout.php">Logout</a>
    </div>
</header>

<div class="container">

    <!-- ====== GRID FITUR 2 BARIS (6 MENU) ====== -->
    <section class="grid-box">

        <a href="booking.php" class="box box1">
            <i class="fas fa-calendar-plus icon"></i>
            <h3>Booking</h3>
            <p>Buat booking lab</p>
        </a>

        <a href="cek.php" class="box box2">
            <i class="fas fa-door-open icon"></i>
            <h3>Cek Ketersediaan</h3>
            <p>Lihat ruang yang kosong</p>
        </a>

        <a href="riwayat.php" class="box box3">
            <i class="fas fa-history icon"></i>
            <h3>Riwayat</h3>
            <p>Booking kamu</p>
        </a>

        <a href="laporan.php" class="box box4">
            <i class="fas fa-file-alt icon"></i>
            <h3>Laporan</h3>
            <p>Laporan penggunaan</p>
        </a>
        <a href="admin_jadwal.php" class="box box5">
            <i class="fas fa-user-shield icon"></i>
            <h3>Admin Jadwal</h3>
            <p>Kelola jadwal</p>
        </a>

    </section>

    <!-- ====== PENGANTAR (TETAP ADA) ====== -->
    <section class="intro">
        <h2>Pendahuluan</h2>
        <p>
            Dikalangan Mahasiswa UIN Saizu terdapat 4 ruang laboratorium komputer. 
            Untuk memudahkan mahasiswa, dosen dan admin dalam memantau dan melakukan 
            booking laboratorium, sistem ini hadir sebagai solusi online yang 
            terstruktur, cepat, dan transparan.
        </p>

        <a href="booking.php" class="btn-primary">Buat Booking</a>
    </section>

<div class="main-card">

    <!-- KIRI: Kalender -->
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

    <!-- KANAN: Info Ruangan -->
    <div class="room-info-box">
        <h3>Informasi Ruangan Hari Ini</h3>

        <div class="room-grid">

            <div class="room-card busy">
                <h4>Lab 1</h4>
                <p><strong>08:00 - 10:00</strong></p>
                <p>TI - 3C</p>
                <span class="status">Dipakai</span>
            </div>

            <div class="room-card free">
                <h4>Lab 2</h4>
                <p><strong>-</strong></p>
                <p>—</p>
                <span class="status">Kosong</span>
            </div>

            <div class="room-card busy">
                <h4>Lab 3</h4>
                <p><strong>13:00 - 15:00</strong></p>
                <p>Akuntansi - 2B</p>
                <span class="status">Dipakai</span>
            </div>

            <div class="room-card free">
                <h4>Lab 4</h4>
                <p><strong>-</strong></p>
                <p>—</p>
                <span class="status">Kosong</span>
            </div>

        </div>
    </div>

</div>
</div>
</div>
</body>
</html>
