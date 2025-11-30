<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

$tipe = isset($_GET['tipe']) ? $_GET['tipe'] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Kamar</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Klien.css">
    <link rel="stylesheet" href="nav/nav.css">
</head>
<body>

<header>
    <?php include 'nav/nav.php'; ?>
</header>

<section class="klien-box">

    <h2>Form Pemesanan Kamar</h2>

    <form action="proses_pemesanan.php" method="POST" style="margin-bottom: 25px;">

        <label>Tipe Kamar</label><br>
        <input 
            type="text" 
            name="tipe_kamar" 
            value="<?= $tipe ?>" 
            readonly
            style="padding:10px; width:300px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <label>Nama Pemesan</label><br>
        <input 
            type="text" 
            name="nama" 
            required
            style="padding:10px; width:300px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <label>Tanggal Check-in</label><br>
        <input 
            type="date" 
            name="checkin" 
            required
            style="padding:10px; width:200px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <label>Tanggal Check-out</label><br>
        <input 
            type="date" 
            name="checkout" 
            required
            style="padding:10px; width:200px; margin:6px 0; border:1px solid #ccc; border-radius:6px;"
        ><br><br>

        <button type="submit" class="btn-add">Simpan Pesanan</button>
    </form>

    <h2>Daftar Pesanan Saya</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tipe Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Edit</th>
            </tr>
        </thead>

        <tbody>

        <?php  
        $data = mysqli_query($conn, 
            "SELECT * FROM pesanan WHERE username='$user' ORDER BY id DESC"
        );

        if (mysqli_num_rows($data) == 0) {
            echo "<tr><td colspan='6'>Belum ada pesanan.</td></tr>";
        }

        while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['tipe_kamar'] ?></td>
                <td><?= $row['checkin'] ?></td>
                <td><?= $row['checkout'] ?></td>
                <td>
                    <a href="edit_pesanan.php?id=<?= $row['id'] ?>">
                        <button class="btn-edit">Edit</button>
                    </a>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

</section>

</body>
</html>
