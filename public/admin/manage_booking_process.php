<?php
require_once "../../config/config.php";

$id  = $_GET['id'] ?? null;
$sts = $_GET['s'] ?? null;

if(!$id || !$sts){
    die("Akses tidak valid.");
}

if(!in_array($sts, ['approve','reject','pending'])){
    die("Status tidak valid.");
}

$query = $conn->prepare("UPDATE booking_lab SET status = ? WHERE id = ?");
$query->bind_param("si", $sts, $id);

if($query->execute()){
    header("Location: manage_booking.php?msg=success");
} else {
    header("Location: manage_booking.php?msg=error");
}
exit;
