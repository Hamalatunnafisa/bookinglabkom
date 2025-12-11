<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
<div class="container py-5">
  <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
    <h3 class="mb-4">Edit User</h3>

    <form id="bookingForm">

    <input type="hidden" name="status" value="pending">

    <input type="text" name="nim" class="form-control mb-3" placeholder="NIM" required> 
    <input type="text" name="nama" class="form-control mb-3" placeholder="Nama" required>
    <input type="text" name="username" class="form-control mb-3" placeholder="username" required>
      <input type="radio" name="role" class="form-control" value="admin" required> Admin
      <input type="radio" name="role" class="form-control" value="user" required> User
      <input type="radio" name="status" class="form-control" value="active" required> Active
      <input type="radio" name="status" class="form-control" value="inactive" required> Inactive

      <button class="btn btn-primary w-100">Submit</button>
    </form>

  </div>
</div>
</body>
</html>