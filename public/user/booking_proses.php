<?php
session_start();
include "../../config/config.php";

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    echo "error: not logged in";
    exit;
}

$user_id = $_SESSION['id']; // <--- TAMBAHKAN INI

$nama        = $_POST['nama'];
$kelas       = $_POST['kelas'];
$nim         = $_POST['nim'];
$nohp        = $_POST['nohp'];
$lab         = $_POST['lab'];
$tanggal     = $_POST['tanggal'];
$jam_mulai   = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$keperluan   = $_POST['keperluan'];
$status      = "pending";

// --- Generate kode booking unik ---
$random = strtoupper(bin2hex(random_bytes(3)));
$kode_booking = "BK-" . date("Ymd") . "-" . $random;

// --- Data untuk QR (berbentuk text) ---
$qr_content = "Kode Booking: $kode_booking\nNama: $nama\nNIM: $nim\nLab: $lab\nTanggal: $tanggal\nWaktu: $jam_mulai - $jam_selesai";

// --- Simpan ke database ---
$q = $conn->prepare("INSERT INTO booking_lab
(id, nama, kelas, nim, nohp, lab, tanggal, jam_mulai, jam_selesai, keperluan, kode_booking, qr_code, status)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)
");

$q->bind_param(
"sssssssssssss",
$user_id, $nama, $kelas, $nim, $nohp, $lab,
$tanggal, $jam_mulai, $jam_selesai,
$keperluan, $kode_booking, $qr_content, $status
);

if ($q->execute()) {
    echo "success";
} else {
    echo "error: " . $conn->error;
}
