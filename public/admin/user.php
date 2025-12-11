<?php
include "../../config/config.php";

// Ambil data user
$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
if (isset($_POST['Hapus'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <link rel="stylesheet" href="../../public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../public/assets/plugins/bootstrap/css/bootstrap.min.css">

    <style>
        .card { border-radius: 10px; }
        .table th { font-weight: bold; }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <div class="content-wrapper p-4">

        <div class="card">
            <div class="card-header bg-black text-white">
                <h4 class="mb-0">Kelola User</h4>
            </div>

            <div class="card-body">

                <a href="user_tambah.php" class="btn btn-success mb-3">+ Tambah User</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if(mysqli_num_rows($query) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= ucfirst($row['role']) ?></td>
                                    <td><?= ucfirst($row['status']) ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                    <td>
                                        <a href="edituser.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm btn-block">Edit</a>
                                        <form method="POST" style="display:inline-block;" 
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="Hapus" class="btn btn-danger btn-sm btn-block mt-1">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data user</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<script src="../public/assets/plugins/jquery/jquery.min.js"></script>
<script src="../public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/adminlte.min.js"></script>

</body>
</html>
