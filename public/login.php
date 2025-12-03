<?php // login.php ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login - Booking Lab</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="auth-page">

  <div class="auth-card">
    <h2>Login</h2>
    <form id="loginForm">
      <input type="text" id="username" placeholder="Username" required>
      <input type="password" id="password" placeholder="Password" required>
      <button type="submit" class="btn btn-primary">Masuk</button>

      <p class="muted">Belum punya akun? <a href="register.php">Daftar</a></p>
      <div id="loginMsg" class="muted"></div>
    </form>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      const form = document.getElementById('loginForm');

      form.addEventListener('submit', function(e){
        e.preventDefault();

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        const msg = document.getElementById('loginMsg');

        const users = JSON.parse(localStorage.getItem('bl_users') || '[]');

        const found = users.find(u => u.username === username && u.password === password);

        if(found){
          localStorage.setItem('bl_session', JSON.stringify({
            username: found.username,
            name: found.name,
            role: found.role || 'user'
          }));

          window.location.href = 'dashboard.php';
        } else {
          msg.textContent = 'Username atau password salah.';
        }
      });

    });
  </script>

</body>
</html>
