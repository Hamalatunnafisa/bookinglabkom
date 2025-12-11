<html>
<head>
  <title>Edit Data User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
$id = $_GET["id"];
include "../../config/config.php";

$data = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$d = mysqli_fetch_array($data);

$id       = $d["id"];
$nama     = $d["nama"];
$nim      = $d["nim"];
$username = $d["username"];
$role     = $d["role"];
$status   = $d["status"];
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $nim = $_POST['nim'];
    $role = $_POST['role'];
if (isset($_POST['status'])) {
        $status = $_POST['status'];
    } else {
        $status = 'inactive';
    }

    $update = mysqli_query($conn, "UPDATE users SET 
        nama='$nama',
        username='$username',
        nim='$nim',
        role='$role'
        WHERE id='$id'
    ");
    if ($update) {
        echo "<script>alert('Yeyyy data diperbaharui');</script>";
    } else {
        echo "<script>alert('yahh gagal');</script>";
    }
}
?>

<div class="container" style="margin-top:40px">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow">
        <div class="card-header bg-warning text-white text-center">
          <h4>EDIT ADMIN DATA</h4>
        </div>

        <div class="card-body">

          <form method="post">

            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group">
              <label>Nama</label>
              <input type="text" value="<?php echo $nama ?>" name="nama" class="form-control">
            </div>

            <div class="form-group">
              <label>Username</label>
              <input type="text" value="<?php echo $username ?>" name="username" class="form-control">
            </div>

            <div class="form-group">
              <label>NIM</label>
              <input type="text" value="<?php echo $nim ?>" name="nim" class="form-control">
            </div>

            <div class="form-group">
              <label>Role</label><br>

              <input type="radio" name="role" value="admin" 
              <?php if ($role == 'admin') echo 'checked'; ?>>
              Admin <br>

              <input type="radio" name="role" value="user" 
              <?php if ($role == 'user') echo 'checked'; ?>>
              User
            </div>

            <div class="form-group">
              <label>status</label><br>
              <input type="checkbox" name="status" value="active"
              <?php if ($status == 'active') echo 'checked'; ?>> Active <br>
              <input type="checkbox" name="status" value="inactive"
              <?php if ($status == 'inactive') echo 'checked'; ?>> inactive <br>

            </div>

            <button type="submit" name="submit" class="btn btn-warning btn-block">SUBMIT</button>
            <a href="dashboard.php"><button type="button">Kembali</button></a>

          </forms>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
