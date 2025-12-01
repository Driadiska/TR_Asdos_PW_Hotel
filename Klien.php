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

if (isset($_POST['tambah_user']) && $_SESSION['role'] === 'admin') {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    if (!in_array($role, ['user', 'admin'])) { $role = 'user'; }

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) == 0) {
        mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    }

    echo "<script>window.location='klien.php';</script>";
}

if (isset($_POST['edit_user']) && $_SESSION['role'] === 'admin') {
    $id = (int)$_POST['id_edit'];
    $username = mysqli_real_escape_string($conn, trim($_POST['username_edit']));
    $password = $_POST['password_edit'];
    $role = mysqli_real_escape_string($conn, $_POST['role_edit']);
    if (!in_array($role, ['user', 'admin'])) { $role = 'user'; }

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET username='$username', password='$hashed', role='$role' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET username='$username', role='$role' WHERE id=$id");
    }

    echo "<script>window.location='klien.php';</script>";
}

if (isset($_POST['hapus_user']) && $_SESSION['role'] === 'admin') {
    $id = (int)$_POST['id_hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");

    mysqli_query($conn, "SET @num := 0");
    mysqli_query($conn, "UPDATE users SET id = (@num := @num + 1) ORDER BY id");
    mysqli_query($conn, "ALTER TABLE users AUTO_INCREMENT = 1");
    echo "<script>window.location='klien.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>

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
<h2>Daftar User</h2>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Role</th>

    <?php if ($_SESSION['role'] === 'admin') { ?>
        <th>Aksi</th>
    <?php } ?>
</tr>
</thead>

<tbody>

<?php
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id ASC");

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>".$row['id']."</td>
        <td>".$row['username']."</td>
        <td>".$row['role']."</td>";

    if ($_SESSION['role'] === 'admin') {
        $js_username = json_encode($row['username']);
        $js_role = json_encode($row['role']);
        echo "
        <td>
                <button class='btn-yellow' onclick='openEditModal(".$row['id'].", $js_username, $js_role)'>Edit</button>

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
<button class="btn-green" onclick="openTambahModal()">+ Tambah User/Admin</button>
<?php } ?>

</section>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalTambah">
    <div class="modal-box">
        <h3>Tambah User / Admin</h3>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User Biasa</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" name="tambah_user" class="btn-green">Simpan</button>
            <button type="button" class="btn-red" onclick="closeTambahModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <h3>Edit User</h3>

        <form method="POST">
            <input type="hidden" name="id_edit" id="id_edit">

            <label>Username:</label>
            <input type="text" name="username_edit" id="username_edit" required>

            <label>Password (kosongkan jika tidak ingin mengubah):</label>
            <input type="password" name="password_edit" id="password_edit">

            <label>Role:</label>
            <select name="role_edit" id="role_edit" required>
                <option value="user">User Biasa</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" name="edit_user" class="btn-yellow">Update</button>
            <button type="button" class="btn-red" onclick="closeEditModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<?php if ($_SESSION['role'] === 'admin') { ?>
<div class="modal-bg" id="modalDelete">
    <div class="modal-box">
        <h3>Hapus User</h3>
        <p>Yakin ingin menghapus user ini?</p>

        <form method="POST">
            <input type="hidden" name="id_hapus" id="id_hapus">

            <button type="submit" name="hapus_user" class="btn-red">Hapus</button>
            <button type="button" class="btn-green" onclick="closeDeleteModal()">Batal</button>
        </form>
    </div>
</div>
<?php } ?>


<script>

function openTambahModal(){ document.getElementById("modalTambah").style.display = "flex"; }
function closeTambahModal(){ document.getElementById("modalTambah").style.display = "none"; }


function openEditModal(id, username, role){
    document.getElementById("modalEdit").style.display = "flex";
    document.getElementById("id_edit").value = id;
    document.getElementById("username_edit").value = username;
    document.getElementById("password_edit").value = ""; // clears password field
    document.getElementById("role_edit").value = role;
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
