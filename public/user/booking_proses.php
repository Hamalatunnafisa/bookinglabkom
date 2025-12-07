<?php
include "../../app/config/config.php";

$nama       = $_POST['nama'];
$kelas      = $_POST['kelas'];
$nim        = $_POST['nim'];
$nohp       = $_POST['nohp'];
$lab        = $_POST['lab'];
$tanggal    = $_POST['tanggal'];
$jam_mulai  = $_POST['jam_mulai'];
$jam_selesai= $_POST['jam_selesai'];
$keperluan  = $_POST['keperluan'];

$q = $conn->prepare("INSERT INTO booking_lab 
    (nama, kelas, nim, nohp, lab, tanggal, jam_mulai, jam_selesai, keperluan, status)
    VALUES (?,?,?,?,?,?,?,?,?, 'pending')
");

$q->bind_param(
    "sssssssss",
    $nama, $kelas, $nim, $nohp, $lab,
    $tanggal, $jam_mulai, $jam_selesai, $keperluan
);

if ($q->execute()) {
    echo "success";
} else {
    echo $conn->error;
}
