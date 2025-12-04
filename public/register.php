<?php
session_start();
require_once "../app/config/config.php";// file koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $nim = $_POST['NIM'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password
    if ($password !== $confirm_password) {
        echo "<script>alert('Password dan Confirm Password tidak sama!'); window.history.back();</script>";
        exit;
    }

    // Cek apakah username atau NIM sudah ada
    $cek = $conn->prepare("SELECT * FROM user WHERE user=? OR NIM=?");
    $cek->bind_param("ss", $user, $nim);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username atau NIM sudah terdaftar!'); window.history.back();</script>";
        exit;
    }

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database, role default = 'user'
    $stmt = $conn->prepare("INSERT INTO user (user, NIM, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $user, $nim, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silahkan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan, coba lagi!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Laboratorium | Register</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/css/adminlte.min.css?v=3.2.0">
  <style>
      .login-box a { text-decoration: none !important; }
      .login-box a:hover { color: #0d6efd; }
  </style>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h2"><b>Booking Laboratorium</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>
      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Username" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="NIM" class="form-control" placeholder="NIM" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-check"></span></div></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-3">Register</button>
      </form>
      <hr>
      <p class="mb-0"><a href="login.php" class="text-center">Already have an account? Login</a></p>
    </div>
  </div>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
