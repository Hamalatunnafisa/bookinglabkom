<?php
session_start();
include "../app/config/config.php  ";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek username di database
$query = mysqli_query($conn, "SELECT * FROM user WHERE user='$username'");
$data = mysqli_fetch_assoc($query);

// Jika username tidak ditemukan
if (!$data) {
    echo "<script>
        alert('Username tidak ditemukan');
        window.location='login.php';
    </script>";
    exit;
}

// Cek password: bisa bcrypt atau MD5
$password_db = $data['password'];

$valid_password = false;

// Cek bcrypt
if (password_verify($password, $password_db)) {
    $valid_password = true;
}

// Cek MD5 lama
if ($password_db === md5($password)) {
    $valid_password = true;
}

// Jika password salah
if (!$valid_password) {
    echo "<script>
        alert('Password salah');
        window.location='login.php';
    </script>";
    exit;
}

// Jika login berhasil → simpan session
$_SESSION['id']      = $data['id'];
$_SESSION['nim']     = $data['nim'];
$_SESSION['username']= $data['user'];
$_SESSION['role']    = $data['role'];

// Arahkan sesuai role
if ($data['role'] == 'admin') {
    header("Location: admin/index.php");
    exit;
} else {
    header("Location: user/index.php");
    exit;
}
?>
