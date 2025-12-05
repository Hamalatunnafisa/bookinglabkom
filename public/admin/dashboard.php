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
        <a class="login-btn btn btn-danger" href="../logout.php">Logout</a>
    </div>
</header>

<div class="container">

    <!-- ====== MENU ADMIN ====== -->
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

        <a href="riwayat.php" class="box box5">
            <i class="fas fa-history icon"></i>
            <h3>Riwayat</h3>
            <p>Riwayat pemakaian lab</p>
        </a>

    </section>

    <!-- ====== INTRO ====== -->
    <section class="intro">
        <h2>Selamat Datang Admin</h2>
        <p>
            Gunakan panel ini untuk memantau dan mengelola seluruh aktivitas 
            booking dan penggunaan laboratorium komputer UIN Saizu.
        </p>
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
            <h3>Status Ruangan Hari Ini</h3>

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

</body>
</html>
