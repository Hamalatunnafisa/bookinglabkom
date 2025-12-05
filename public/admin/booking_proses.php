<?php
// Koneksi ke database
include "../../app/config/config.php";

// Pastikan form di-submit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil semua data dari form
    $nama       = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas      = mysqli_real_escape_string($conn, $_POST['kelas']);
    $nim        = mysqli_real_escape_string($conn, $_POST['nim']);
    $nohp       = mysqli_real_escape_string($conn, $_POST['nohp']);
    $lab        = mysqli_real_escape_string($conn, $_POST['lab']);
    $tanggal    = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $jam        = mysqli_real_escape_string($conn, $_POST['jam']);
    $keperluan  = mysqli_real_escape_string($conn, $_POST['keperluan']);
    $status     = mysqli_real_escape_string($conn, $_POST['status']);

    // Query simpan data
    $query = "INSERT INTO booking_lab 
            (nama, kelas, nim, nohp, lab, tanggal, jam, keperluan, status)
            VALUES 
            ('$nama', '$kelas', '$nim', '$nohp', '$lab', '$tanggal', '$jam', '$keperluan', '$status')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "
        <script>
            alert('Booking berhasil disimpan.');
            window.location.href = 'booking.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal menyimpan booking: ".mysqli_error($conn)."');
            window.location.href = 'booking.php';
        </script>
        ";
    }

} else {
    // Jika akses langsung tanpa POST
    header("Location: booking.php");
    exit;
}
?>
