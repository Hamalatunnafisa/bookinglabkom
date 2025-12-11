<?php
include '../../config/config.php';

$id     = isset($_POST['id']) ? $_POST['id'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

if ($id != '' && $status != '') {
    $stmt = $conn->prepare("UPDATE booking_lab SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

header('Location: manage_boking.php');
exit;
?>
