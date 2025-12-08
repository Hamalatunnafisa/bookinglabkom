<?php
include "../../app/config/config.php";

$id     = $_GET['id'];
$status = $_GET['s'];

$conn->query("UPDATE booking_lab SET status='$status' WHERE id='$id'");

echo "<script>alert('Status booking diperbarui'); window.location='kelola_booking.php';</script>";
?>
