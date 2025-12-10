<?php

$nama     = $_GET['nama'] ?? '';
$nim      = $_GET['nim'] ?? '';
$lab      = $_GET['lab'] ?? '';
$tanggal  = $_GET['tanggal'] ?? '';
$waktu    = $_GET['waktu'] ?? '';

$qr_text = "Nama: $nama\nNIM: $nim\nLab: $lab\nTanggal: $tanggal\nWaktu: $waktu";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kode Booking</title>

    <!-- Gaya global -->
    <link rel="stylesheet" href="../../public/assets/css/style.css">

    <style>
        /* Kartu QR dibuat matching style.css (putih, shadow, rounded, clean) */
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 20px;
            min-height: 100vh;
            background: linear-gradient(135deg, #87CEEB 0%, #B0E0E6 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .qr-card {
            background: white;
            width: 380px;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease-out;
        }

        .qr-card h2 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .info {
            font-size: 1rem;
            color: #2d3748;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        #qrcode img {
            width: 200px !important;
            margin: 0 auto;
            display: block;
        }

        .btn-back {
            background: linear-gradient(135deg, #87CEEB 0%, #B0E0E6 100%);
            color: #2d3748;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            width: 100%;
            cursor: pointer;
            margin-top: 1.5rem;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(135, 206, 235, 0.4);
        }
    </style>
</head>

<body>

<div class="qr-card">

    <h2>Kode Booking</h2>

    <div class="info">
        <b>Nama:</b> <?= $nama ?><br>
        <b>NIM:</b> <?= $nim ?><br>
        <b>Lab:</b> <?= $lab ?><br>
        <b>Tanggal:</b> <?= $tanggal ?><br>
        <b>Waktu:</b> <?= $waktu ?><br>
    </div>

    <div id="qrcode"></div>

    <button class="btn-back" onclick="window.history.back()">Kembali</button>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    new QRCode(document.getElementById("qrcode"), {
        text: `<?= $qr_text ?>`,
        width: 200,
        height: 200
    });
</script>

</body>
</html>
