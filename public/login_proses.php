<?php 
session_start();
require_once "../app/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $query = $conn->query("SELECT * FROM user WHERE user='$username'");
    $data = $query->fetch_assoc();

    if ($data) {

        // Cek password
        if (password_verify($password, $data['password'])) {

            // Simpan session
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['user'];   // nama kolomnya 'user'
            $_SESSION['role'] = $data['role'];

            // Redirect sesuai role
            if ($data['role'] === "admin") {
                header("Location: admin/index.php");
                exit;
            } else {
                header("Location: dashboard.php");
                exit;
            }

        } else {
            echo "<script>alert('Password salah'); window.location='login.php';</script>";
        }

    } else {
        echo "<script>alert('Username tidak ditemukan'); window.location='login.php';</script>";
    }
}
?>
