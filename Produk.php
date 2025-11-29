<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Produk.css" />
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

  <!-- LIST PRODUK -->
  <section class="room-list">

    <!-- STANDARD ROOM -->
    <div class="room">
      <img src="StandardRoom.webp" alt="Standard Room" />
      <div class="room-info">
        <h2>Kamar Standard</h2>
        <p>Nikmati kamar sederhana namun nyaman dengan fasilitas standar untuk istirahat Anda.</p>

        <ul>
          <li>Kasur Queen Size</li>
          <li>AC</li>
          <li>TV LED 32"</li>
          <li>Kamar mandi dalam</li>
          <li>Wi-Fi Gratis</li>
        </ul>

        <div class="price-box">
          <span class="price">Rp 300.000 / malam</span>
          <button class="book-btn">Pesan Sekarang</button>
        </div>
      </div>
    </div>

    <!-- DELUXE ROOM -->
    <div class="room">
      <img src="DeluxeRoom.webp" alt="Deluxe Room" />
      <div class="room-info">
        <h2>Kamar Deluxe</h2>
        <p>Nikmati pengalaman menginap modern dengan fasilitas lebih lengkap dan nyaman.</p>

        <ul>
          <li>Kasur King Size</li>
          <li>AC & Air Purifier</li>
          <li>TV LED 42"</li>
          <li>Kamar mandi + Water Heater</li>
          <li>Wi-Fi Gratis</li>
        </ul>

        <div class="price-box">
          <span class="price">Rp 450.000 / malam</span>
          <button class="book-btn">Pesan Sekarang</button>
        </div>
      </div>
    </div>

    <!-- SUITE ROOM -->
    <div class="room">
      <img src="SuiteRoom.webp" alt="Suite Room" />
      <div class="room-info">
        <h2>Suite Room</h2>
        <p>Kamar luas dengan living room terpisah dan fasilitas premium untuk kenyamanan maksimal.</p>

        <ul>
          <li>Kasur Super King</li>
          <li>Smart TV 55"</li>
          <li>Bathtub + Shower</li>
          <li>Mini Bar</li>
          <li>Wi-Fi Gratis</li>
        </ul>

        <div class="price-box">
          <span class="price">Rp 750.000 / malam</span>
          <button class="book-btn">Pesan Sekarang</button>
        </div>
      </div>
    </div>

  </section>

</body>
</html>
