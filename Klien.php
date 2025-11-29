<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Klien</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Klien.css" />
  <link rel="stylesheet" href="nav/nav.css">
</head>
<body>

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="inner">
      <span>Bukit Blotongan Astetic No.1 Blok H, Kota Salatiga</span>
      <span>Hotline: 0812-3456-7890</span>
    </div>
  </div>
  <!-- NAVBAR -->
  
  <header>
    <?php include 'nav/nav.php'; ?>
  </header>


  <!-- DATA KLIEN CONTENT -->
  <section class="klien-box">

    <h2>Daftar Klien</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Klien</th>
          <th>No. Telepon</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>01</td>
          <td>Budi Santoso</td>
          <td>08123456789</td>
          <td>Bandung</td>
          <td>
            <button class="btn-edit">Edit</button>
            <button class="btn-delete">Hapus</button>
          </td>
        </tr>

        <tr>
          <td>02</td>
          <td>Siti Aminah</td>
          <td>08220098765</td>
          <td>Surabaya</td>
          <td>
            <button class="btn-edit">Edit</button>
            <button class="btn-delete">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <button class="btn-add">+ Tambah Klien</button>

  </section>

</body>
</html>
