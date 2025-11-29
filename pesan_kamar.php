<?php
$conn = mysqli_connect("localhost", "root", "", "hotel_bhlilz");
$tipe = $_GET['tipe'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pesan Kamar</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>

<h2>Form Pemesanan Kamar: <?= $tipe ?></h2>

<form action="simpan_pesanan.php" method="POST">

    <input type="hidden" name="tipe_kamar" value="<?= $tipe ?>">

    Nama Pemesan:
    <input type="text" name="nama" required><br><br>

    Tanggal Check-in:
    <input type="date" name="checkin" required><br><br>

    Tanggal Check-out:
    <input type="date" name="checkout" required><br><br>

    <button type="submit" name="pesan">Simpan Pesanan</button>

</form>

</body>
</html>
