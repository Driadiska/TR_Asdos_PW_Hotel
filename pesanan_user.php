<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

$data = mysqli_query($conn, 
    "SELECT * FROM pesanan WHERE username='$user' ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan Kamar</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Klien.css">
    <link rel="stylesheet" href="nav/nav.css">
</head>
<body>

<header>
    <?php include 'nav/nav.php'; ?>
</header>

<section class="klien-box">
    
    <h2>Daftar Pesanan Kamar Saya</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemesan</th>
                <th>Tipe Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php if (mysqli_num_rows($data) == 0) { ?>
            <tr>
                <td colspan="6" style="text-align:center;">Belum ada pesanan.</td>
            </tr>
        <?php } ?>

        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
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
