<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

$id = $_GET['id'];

$query = mysqli_query($conn, 
    "SELECT * FROM pesanan 
     WHERE id='$id' AND username='$user'"
);

if (mysqli_num_rows($query) == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='pesanan.php';</script>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan Kamar</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Klien.css">
    <link rel="stylesheet" href="nav/nav.css">
</head>
<body>

<header>
    <?php include 'nav/nav.php'; ?>
</header>

<section class="klien-box">

    <h2>Edit Pesanan Kamar</h2>

    <form action="update_pesanan.php" method="POST" style="margin-bottom: 25px;">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        
        <label>Tipe Kamar</label><br>
        <select 
            name="tipe_kamar"
            required
            style="padding:10px; width:320px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        >
            <option value="Standard" <?= ($data['tipe_kamar'] == "Standard") ? "selected" : "" ?>>Standard</option>
            <option value="Deluxe" <?= ($data['tipe_kamar'] == "Deluxe") ? "selected" : "" ?>>Deluxe</option>
            <option value="Suite" <?= ($data['tipe_kamar'] == "Suite") ? "selected" : "" ?>>Suite</option>
        </select>
        <br><br>

        <label>Nama Pemesan</label><br>
        <input 
            type="text" 
            name="nama" 
            value="<?= $data['nama'] ?>" 
            required
            style="padding:10px; width:300px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <label>Tanggal Check-in</label><br>
        <input 
            type="date" 
            name="checkin"
            value="<?= $data['checkin'] ?>"
            required
            style="padding:10px; width:200px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <label>Tanggal Check-out</label><br>
        <input 
            type="date" 
            name="checkout"
            value="<?= $data['checkout'] ?>"
            required
            style="padding:10px; width:200px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <button type="submit" class="btn-add">Perbarui Pesanan</button>
    </form>

</section>

</body>
</html>
