<?php
include '../../app/config/config.php';

$tanggal = $_GET['tanggal'] ?? null;

if (!$tanggal) {
    echo json_encode([]);
    exit;
}

$q = $conn->prepare("SELECT * FROM booking_lab WHERE tanggal = ?");
$q->bind_param("s", $tanggal);
$q->execute();
$res = $q->get_result();

$data = [];

while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
