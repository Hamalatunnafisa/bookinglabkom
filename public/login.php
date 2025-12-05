<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Laboratorium | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/assets/css/adminlte.min.css?v=3.2.0">

  <!-- Style tambahan untuk menghilangkan underline -->
  <style>
      .login-box a {
        text-decoration: none !important;
      }
      .login-box a:hover {
        color: #0d6efd;
      }
  </style>
</head>

<body class="hold-transition login-page">
<div class="login-box">

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h2"><b>Booking Laboratorium</b></a>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <!-- FORM LOGIN -->
      <form action="login_proses.php" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <hr>

      <p class="mb-1">
        <a href="forgot-password.php">Forgot password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register new member</a>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../public/assets/js/adminlte.min.js?v=3.2.0"></script>

</body>
</html>