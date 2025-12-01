<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['username'];

if (!isset($_GET['id'])) {
    header("Location: pesanan_saya.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, 
    "DELETE FROM pesanan WHERE id='$id' AND username='$user'"
);

if ($query) {

    header("Location: menu.php");
    exit;

} else {

    echo "<script>
            alert('Gagal menghapus pesanan.');
            window.location='menu.php';
          </script>";
}
?>
