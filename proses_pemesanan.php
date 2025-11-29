<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipe   = $_POST['tipe_kamar'];
    $nama   = $_POST['nama'];
    $check1 = $_POST['checkin'];
    $check2 = $_POST['checkout'];
    $user   = $_SESSION['username'];

    $query = "INSERT INTO pesanan (tipe_kamar, nama, checkin, checkout, username)
              VALUES ('$tipe', '$nama', '$check1', '$check2', '$user')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Pesanan berhasil disimpan!');
                window.location='pemesanan.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
