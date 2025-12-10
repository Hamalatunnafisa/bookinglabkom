<?php
require "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $lab        = $_POST["lab"];
    $tanggal    = $_POST["tanggal"];
    $jam        = $_POST["jam"];
    $matakuliah = $_POST["matakuliah"];
    $pengampu   = $_POST["pengampu"];

    $query = $conn->prepare("
        INSERT INTO jadwal (lab, tanggal, jam, matakuliah, pengampu)
        VALUES (?, ?, ?, ?, ?)
    ");

    $query->bind_param("sssss", $lab, $tanggal, $jam, $matakuliah, $pengampu);

    if ($query->execute()) {
        echo "<script>alert('Jadwal berhasil ditambahkan!'); window.location='kelola_jadwal.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan jadwal!'); window.history.back();</script>";
    }
}
?>
