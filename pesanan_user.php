<?php
$conn = mysqli_connect("localhost","root","","hotel_bhlilz");
$data = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC");
?>

<h2>Daftar Pesanan Kamar</h2>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Tipe Kamar</th>
    <th>Check-in</th>
    <th>Check-out</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['tipe_kamar'] ?></td>
    <td><?= $row['checkin'] ?></td>
    <td><?= $row['checkout'] ?></td>

    <td>
        <a href="edit_pesanan.php?id=<?= $row['id'] ?>">Edit</a>
    </td>
</tr>
<?php } ?>

</table>
