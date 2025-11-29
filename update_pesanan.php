<?php
$conn = mysqli_connect("localhost","root","","hotel_bhlilz");

$id       = $_POST['id'];
$nama     = $_POST['nama'];
$tipe     = $_POST['tipe_kamar'];
$checkin  = $_POST['checkin'];
$checkout = $_POST['checkout'];

mysqli_query($conn, "UPDATE pesanan SET
    nama='$nama',
    tipe_kamar='$tipe',
    checkin='$checkin',
    checkout='$checkout'
    WHERE id=$id");

echo "<script>alert('Pesanan berhasil diupdate!');
window.location='pesanan_user.php';</script>";
?>
