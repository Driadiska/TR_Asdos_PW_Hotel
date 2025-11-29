<?php include 'koneksi.php'; ?>

<h2>Tambah Klien</h2>

<form method="POST">
    <label>Nama Klien</label><br>
    <input type="text" name="nama" required><br><br>

    <label>No Telepon</label><br>
    <input type="text" name="telepon" required><br><br>

    <label>Alamat</label><br>
    <input type="text" name="alamat" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat  = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO klien VALUES('', '$nama', '$telepon', '$alamat')");

    echo "<script>alert('Data klien berhasil ditambahkan!'); window.location='Klien.php';</script>";
}
?>
