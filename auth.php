<?php
session_start();
include "koneksi.php";

if (!isset($_POST['action'])) {
    echo json_encode(["status" => "error", "message" => "Aksi tidak ditemukan"]);
    exit;
}

$action = $_POST['action'];


if ($action === "register") {

    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo json_encode(["status" => "error", "message" => "Username sudah digunakan!"]);
        exit;
    }

    $insert = mysqli_query($conn, "INSERT INTO users (username, password, role)
                                   VALUES ('$username', '$password', '$role')");

    if ($insert) {
        echo json_encode(["status" => "success", "message" => "Registrasi berhasil! Silakan login."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal mendaftar!"]);
    }
    exit;
}



if ($action === "login") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($query) === 0) {
        echo json_encode(["status" => "error", "message" => "Username tidak ditemukan!"]);
        exit;
    }

    $user = mysqli_fetch_assoc($query);

    if (!password_verify($password, $user['password'])) {
        echo json_encode(["status" => "error", "message" => "Password salah!"]);
        exit;
    }

    $_SESSION['user_id']  = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];

    echo json_encode(["status" => "success"]);
    exit;
}
?>
