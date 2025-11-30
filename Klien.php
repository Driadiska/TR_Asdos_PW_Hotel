<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "hotel_bhlilz";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}



if (isset($_POST['tambah']) && $_SESSION['role'] === 'admin') {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO klien (nama, telepon, alamat) VALUES ('$nama', '$telepon', '$alamat')");
    echo "<script>window.location='klien.php';</script>";
}



if (isset($_POST['edit']) && $_SESSION['role'] === 'admin') {
    $id   = $_POST['id_edit'];
    $nama = $_POST['nama_edit'];
    $telepon = $_POST['telepon_edit'];
    $alamat = $_POST['alamat_edit'];

    mysqli_query($conn, "UPDATE klien SET 
        nama='$nama',
        telepon='$telepon',
        alamat='$alamat'
        WHERE id=$id");

    echo "<script>window.location='klien.php';</script>";
}



if (isset($_POST['hapus']) && $_SESSION['role'] === 'admin') {
    $id = $_POST['id_hapus'];

    mysqli_query($conn, "DELETE FROM klien WHERE id=$id");

    mysqli_query($conn, "SET @num := 0");
    mysqli_query($conn, "UPDATE klien SET id = (@num := @num + 1) ORDER BY id");
    mysqli_query($conn, "ALTER TABLE klien AUTO_INCREMENT = 1");

    echo "<script>window.location='klien.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Klien</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Klien.css">
    <link rel="stylesheet" href="nav/nav.css">

    <style>
        .modal-bg {
            display:none;
            position:fixed;
            top:0; left:0;
            width:100%; height:100%;
            background:rgba(0,0,0,.5);
            justify-content:center;
            align-items:center;
        }
        .modal-box {
            background:white;
            padding:20px;
            width:350px;
            border-radius:10px;
        }
        .modal-box input, .modal-box textarea {
            width:100%;
            padding:8px;
            margin:5px 0 10px;
        }
        .btn-red { background:red; color:white; padding:8px 12px; border:none; border-radius:5px; cursor:pointer; }
        .btn-green { background:green; color:white; padding:8px 12px; border:none; border-radius:5px; cursor:pointer; }
        .btn-yellow { background:orange; color:white; padding:8px 12px; border:none; border-radius:5px; cursor:pointer; }
    </style>

</head>
<body>

<header>
    <?php include 'nav/nav.php'; ?>
</header>

<section class="klien-box">
<h2>Daftar Klien</h2>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Nama Klien</th>
    <th>No. Telepon</th>
    <th>Alamat</th>

    <?php if ($_SESSION['role'] === 'admin') { ?>
        <th>Aksi</th>
    <?php } ?>
</tr>
</thead>

<tbody>

<?php
$result = mysqli_query($conn, "SELECT * FROM klien ORDER BY id ASC");

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>".$row['id']."</td>
        <td>".$row['nama']."</td>
        <td>".$row['telepon']."</td>
        <td>".$row['alamat']."</td>";

    if ($_SESSION['role'] === 'admin') {
        echo "
        <td>
            <button class='btn-yellow' onclick='openEditModal(".$row['id'].", 
                    \"".$row['nama']."\", 
                    \"".$row['telepon']."\", 
                    \"".$row['alamat']."\")'>Edit</button>

            <button class='btn-red' onclick='openDeleteModal(".$row['id'].")'>Hapus</button>
        </td>";
    }

    echo "</tr>";
}
?>

</tbody>
</table>

<br>

<?php if ($_SESSION['role'] === 'admin') { ?>
<button class="btn-green" onclick="openTambahModal()">+ Tambah Klien</button>
<?php } ?>

</section>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalTambah">
    <div class="modal-box">
        <h3>Tambah Klien</h3>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="telepon" placeholder="Telepon" required>
            <textarea name="alamat" placeholder="Alamat" required></textarea>

            <button type="submit" name="tambah" class="btn-green">Simpan</button>
            <button type="button" class="btn-red" onclick="closeTambahModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <h3>Edit Klien</h3>

        <form method="POST">
            <input type="hidden" name="id_edit" id="id_edit">

            <label>Nama:</label>
            <input type="text" name="nama_edit" id="nama_edit" required>

            <label>Telepon:</label>
            <input type="text" name="telepon_edit" id="telepon_edit" required>

            <label>Alamat:</label>
            <textarea name="alamat_edit" id="alamat_edit" required></textarea>

            <button type="submit" name="edit" class="btn-yellow">Update</button>
            <button type="button" class="btn-red" onclick="closeEditModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalDelete">
    <div class="modal-box">
        <h3>Hapus Klien</h3>
        <p>Yakin ingin menghapus klien ini?</p>

        <form method="POST">
            <input type="hidden" name="id_hapus" id="id_hapus">

            <button type="submit" name="hapus" class="btn-red">Hapus</button>
            <button type="button" class="btn-green" onclick="closeDeleteModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<script>

function openTambahModal(){ document.getElementById("modalTambah").style.display = "flex"; }
function closeTambahModal(){ document.getElementById("modalTambah").style.display = "none"; }


function openEditModal(id, nama, telepon, alamat){
    document.getElementById("modalEdit").style.display = "flex";
    document.getElementById("id_edit").value = id;
    document.getElementById("nama_edit").value = nama;
    document.getElementById("telepon_edit").value = telepon;
    document.getElementById("alamat_edit").value = alamat;
}
function closeEditModal(){ document.getElementById("modalEdit").style.display = "none"; }


function openDeleteModal(id){
    document.getElementById("modalDelete").style.display = "flex";
    document.getElementById("id_hapus").value = id;
}
function closeDeleteModal(){ document.getElementById("modalDelete").style.display = "none"; }

</script>

</body>
</html>
