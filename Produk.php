<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Produk</title>
  <link rel="stylesheet" href="Produk.css">
</head>
<body>

<div class="topbar">
    <div class="inner">
      <span>Bukit Blotongan Astetic No.1 Blok H, Kota Salatiga</span>
      <span>Hotline: 0812-3456-7890</span>
    </div>
</div>

<header>
    <?php include 'nav/nav.php'; ?>
</header>

<section class="room-list">

    <div class="room">
        <img src="StandardRoom.webp">
        <div class="room-info">
            <h2>Kamar Standard</h2>
            <p>Kamar nyaman dengan fasilitas standar.</p>

            <ul>
                <li>Kasur Queen Size</li>
                <li>AC</li>
                <li>TV LED 32"</li>
                <li>Kamar mandi dalam</li>
                <li>Wi-Fi Gratis</li>
            </ul>

            <div class="price-box">
                <span class="price">Rp 300.000 / malam</span>
                <a href="pemesanan.php?tipe=Standard Room">
                    <button class="book-btn">Pesan Sekarang</button>
                </a>
            </div>
        </div>
    </div>


    <div class="room">
        <img src="DeluxeRoom.webp">
        <div class="room-info">
            <h2>Kamar Deluxe</h2>
            <p>Kamar modern dengan fasilitas lengkap.</p>

            <ul>
                <li>Kasur King Size</li>
                <li>AC & Air Purifier</li>
                <li>TV LED 42"</li>
                <li>Water Heater</li>
                <li>Wi-Fi Gratis</li>
            </ul>

            <div class="price-box">
                <span class="price">Rp 450.000 / malam</span>
                <a href="pemesanan.php?tipe=Deluxe Room">
                    <button class="book-btn">Pesan Sekarang</button>
                </a>
            </div>
        </div>
    </div>


    <div class="room">
        <img src="SuiteRoom.webp">
        <div class="room-info">
            <h2>Suite Room</h2>
            <p>Kamar luas dengan fasilitas premium.</p>

            <ul>
                <li>Kasur Super King</li>
                <li>Smart TV 55"</li>
                <li>Bathtub + Shower</li>
                <li>Mini Bar</li>
                <li>Wi-Fi Gratis</li>
            </ul>

            <div class="price-box">
                <span class="price">Rp 750.000 / malam</span>
                <a href="pemesanan.php?tipe=Suite Room">
                    <button class="book-btn">Pesan Sekarang</button>
                </a>
            </div>
        </div>
    </div>

</section>

</body>
</html>
