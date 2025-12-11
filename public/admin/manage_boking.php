<?php
session_start();
include '../../config/config.php'; 
include 'chek_login.php';


$cari = isset($_GET['cari']) ? $conn->real_escape_string($_GET['cari']) : '';


if ($cari != '') {
    $sql = "
        SELECT *
        FROM booking_lab
        WHERE 
            lab LIKE '%$cari%' OR
            tanggal LIKE '%$cari%' OR
            jam_mulai LIKE '%$cari%' OR
            jam_selesai LIKE '%$cari%' OR
            keperluan LIKE '%$cari%'
        ORDER BY tanggal DESC
    ";
} else {
    $sql = "SELECT * FROM booking_lab ORDER BY tanggal DESC";
}

$data = $conn->query($sql);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Manajemen Booking Laboratorium</title>

 <style>
    :root{
      --bg: #f4fbff;
      --card: #ffffff;
      --accent: #9fd9ff; /* biru muda */
      --accent-strong: #6fc8ff;
      --muted: #6b7280;
      --success: #16a34a;
      --danger: #ef4444;
      --border: #e6eef6;
      --radius: 10px;
      font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }

    body{
      margin:0;
      background: linear-gradient(180deg,var(--bg) 0%, #eaf8ff 100%);
      padding:32px;
      color:#0f172a;
    }

    .container{
      max-width:1100px;
      margin:0 auto;
    }

    header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      margin-bottom:18px;
    }

    h1{font-size:20px; margin:0 0 4px 0}
    p.lead{margin:0; color:var(--muted); font-size:13px}

    .card{
      background:var(--card);
      border-radius:var(--radius);
      box-shadow: 0 6px 20px rgba(19,38,56,0.06);
      padding:18px;
      border:1px solid var(--border);
    }

    .toolbar{
      display:flex; gap:8px; align-items:center; margin-bottom:12px; flex-wrap:wrap;
    }

    .search{
      display:flex; gap:8px; align-items:center;
    }

    input[type="search"]{
      padding:8px 12px; border-radius:8px; border:1px solid var(--border); min-width:220px;
    }

    table{width:100%; border-collapse:collapse; font-size:14px}
    thead th{
      text-align:left; padding:12px 12px; color:var(--muted); font-size:12px; text-transform:uppercase; letter-spacing:0.6px;
      border-bottom:1px solid var(--border);
    }

    tbody td{
      padding:12px; vertical-align:middle; border-bottom:1px dashed #f0f6fb;
    }

    .badge{
      display:inline-block; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:600;
    }

    .badge.pending{ background:#fff7ed; color:#92400e; border:1px solid #ffe4c7 }
    .badge.approve{ background:#ecfdf5; color:var(--success); border:1px solid #c6f6d9 }
    .badge.reject{ background:#fff1f2; color:var(--danger); border:1px solid #ffd6d9 }

    select.status-select{
      padding:6px 8px; border-radius:8px; border:1px solid var(--border); background:#fff; min-width:140px;
    }

    .btn{
      display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:8px; border:0; cursor:pointer; font-weight:600;
    }

    .btn.primary{
      background:var(--accent); color:#fff; box-shadow: 0 6px 18px rgba(111,200,255,0.18); border:1px solid rgba(255,255,255,0.2);
    }

    .btn.ghost{
      background:transparent; color:var(--accent-strong); border:1px solid var(--accent-strong);
    }

    .action-buttons{ display:flex; gap:8px }

    /* responsive */
    @media (max-width:880px){
      thead th:nth-child(3), tbody td:nth-child(3){ display:none } /* hide waktu on small */
    }

    @media (max-width:640px){
      .toolbar{ flex-direction:column; align-items:stretch }
      input[type=search]{ width:100% }
      table{ font-size:13px }
      thead th:nth-child(4), tbody td:nth-child(4){ display:none } /* hide keperluan */
    }
  </style>
</head>
<body>

<div class="container">

<header>
    <div>
        <h1>Manajemen Booking - Laboratorium Komputer</h1>
        <p class="lead">Tabel booking berisi nama lab, tanggal, waktu, keperluan, status, dan aksi.</p>
    </div>

    <div class="toolbar">
        <form method="GET" class="search">
            <input type="search" name="cari" value="<?= htmlspecialchars($cari) ?>" 
                   placeholder="Cari nama lab, tanggal, keperluan..." />
            <button class="btn primary" type="submit">Cari</button>
        </form>
    </div>
</header>

<div class="card">

<table id="bookingTable">
<thead>
<tr>
    <th>Nama Lab</th>
    <th>Tanggal</th>
    <th>Waktu</th>
    <th>Keperluan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php while($row = $data->fetch_assoc()): ?>
<tr>
    <td><?= $row['lab']; ?></td>
    <td><?= $row['tanggal']; ?></td>
    <td><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></td>
    <td><?= $row['keperluan']; ?></td>

    <td>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <select name="status" class="status-select">
                <option value="pending"  <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
                <option value="approve" <?= $row['status']=='approve'?'selected':'' ?>>Approve</option>
                <option value="reject" <?= $row['status']=='reject'?'selected':'' ?>>Reject</option>
            </select>
    </td>

    <td>
        <div class="action-buttons">
            <button class="btn primary" type="submit">Update</button>
        </div>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>
</div>
</div>

</body>
</html>
