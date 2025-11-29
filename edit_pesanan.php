<?php
$conn = mysqli_connect("localhost","root","","hotel_bhlilz");
$id = $_GET['id'];

$q = mysqli_query($conn, "SELECT * FROM pesanan WHERE id=$id");
$d = mysqli_fetch_assoc($q);
?>

<h2>Edit Pesanan Kamar</h2>

<form action="update_pesanan.php" method="POST">

    <input type="hidden" name="id" value="<?= $d['id'] ?>">

    Nama:
    <input type="text" name="nama" value="<?= $d['nama'] ?>" required><br><br>

    Tipe Kamar:
    <select name="tipe_kamar">
        <option <?= $d['tipe_kamar']=="Standard Room" ? "selected":"" ?>>Standard Room</option>
        <option <?= $d['tipe_kamar']=="Deluxe Room"   ? "selected":"" ?>>Deluxe Room</option>
        <option <?= $d['tipe_kamar']=="Suite Room"    ? "selected":"" ?>>Suite Room</option>
    </select><br><br>

    Check-in:
    <input type="date" name="checkin" value="<?= $d['checkin'] ?>" required><br><br>

    Check-out:
    <input type="date" name="checkout" value="<?= $d['checkout'] ?>" required><br><br>

    <button type="submit">Update</button>

</form>
