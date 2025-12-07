<?php 
include '../../app/config/config.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Booking Lab</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

  <div class="container py-5">
    <h3 class="mb-4">Laporan Booking Laboratorium</h3>

    <table class="table table-bordered table-striped bg-white shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Lab</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Keperluan</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $query = $conn->query("SELECT * FROM booking_lab ORDER BY created_at DESC");

        if ($query->num_rows == 0) {
            echo "<tr><td colspan='7' class='text-center text-muted'>Belum ada data.</td></tr>";
        } else {
            while ($row = $query->fetch_assoc()) {
                echo "
                <tr>
                    <td>$row[nama]</td>
                    <td>$row[kelas]</td>
                    <td>$row[lab]</td>
                    <td>$row[tanggal]</td>
                    <td>$row[jam]</td>
                    <td>$row[keperluan]</td>
                    <td>".ucfirst($row['status'])."</td>
                </tr>
                ";
            }
        }
        ?>
      </tbody>

    </table>
  </div>

</body>
</html>
