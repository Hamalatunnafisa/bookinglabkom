<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jadwal – Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="container py-5">

    <div class="card shadow p-4 mb-4">
        <h3 class="mb-3">Tambah Jadwal Laboratorium</h3>

        <form action="kelola_jadwal_proses.php" method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Ruang / Lab</label>
                    <select name="lab" class="form-select" required>
                        <option value="">-- Pilih Lab --</option>
                        <option>Lab Komputer 1</option>
                        <option>Lab Komputer 2</option>
                        <option>Lab Komputer 3</option>
                        <option>Lab Komputer 4</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Jam</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>
            </div>

            <input type="text" name="matakuliah" class="form-control mb-3" placeholder="Mata Kuliah / Keperluan" required>
            <input type="text" name="pengampu" class="form-control mb-3" placeholder="Dosen Pengampu" required>

            <button class="btn btn-primary w-100">Simpan Jadwal</button>
        </form>
    </div>

    <!-- TABEL DAFTAR JADWAL -->
    <div class="card shadow p-4">
        <h3 class="mb-3">Daftar Jadwal</h3>

        <?php
        require "../../app/config/config.php";

        $data = $conn->query("SELECT * FROM jadwal ORDER BY tanggal, jam");
        ?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Lab</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = $data->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['lab'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['jam'] ?></td>
                    <td><?= $row['matakuliah'] ?></td>
                    <td><?= $row['pengampu'] ?></td>

                    <td>
                        <a href="kelola_jadwal_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="kelola_jadwal_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus jadwal?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
