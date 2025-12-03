<?php // register.php ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Register - Booking Lab</title>

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="auth-page">

  <div class="auth-card">
    <h2>Daftar Akun</h2>

    <form id="regForm">
      <input type="text" id="nama" placeholder="Nama Lengkap" required>
      <input type="text" id="username" placeholder="Username" required>
      <input type="password" id="password" placeholder="Password" required>

      <select id="role">
        <option value="user">Mahasiswa / Dosen</option>
        <option value="admin">Admin</option>
      </select>

      <button class="btn btn-primary" type="submit">Daftar</button>

      <p class="muted">Sudah punya akun? <a href="login.php">Login</a></p>
      <div id="regMsg" class="muted"></div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {

      const form = document.getElementById('regForm');

      form.addEventListener('submit', function(e){
        e.preventDefault();

        const nama = document.getElementById('nama').value.trim();
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;
        const msg = document.getElementById('regMsg');

        let users = JSON.parse(localStorage.getItem('bl_users') || '[]');

        if(users.find(x => x.username === username)){
          msg.textContent = 'Username sudah dipakai.';
          return;
        }

        users.push({
          name: nama,
          username: username,
          password: password,
          role: role
        });

        localStorage.setItem('bl_users', JSON.stringify(users));

        msg.textContent = 'Registrasi berhasil. Mengalihkan...';

        setTimeout(() => {
          window.location.href = 'login.php';
        }, 1200);
      });

    });
  </script>

</body>
</html>
