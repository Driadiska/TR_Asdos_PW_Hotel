<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipe   = $_POST['tipe_kamar'];
    $nama   = $_POST['nama'];
    $check1 = $_POST['checkin'];
    $check2 = $_POST['checkout'];

    // SIMPAN KE DATABASE
    $query = "INSERT INTO pesanan (tipe_kamar, nama, checkin, checkout)
              VALUES ('$tipe', '$nama', '$check1', '$check2')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pesanan berhasil disimpan!'); 
              window.location='pemesanan.php';</script>";
    } else {
        echo "Error Query: " . mysqli_error($conn);
    }
}
?>
