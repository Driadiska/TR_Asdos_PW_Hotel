<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Hotel Bhlilz</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Login.css">
</head>
<body>

  <div class="topbar">
    <div class="inner">
      <div>Bukit Blotongan Astetic No.1 Blok H, Kota Salatiga</div>
      <div>+62 212 41491 &nbsp; | &nbsp; HotelBhlilz</div>
    </div>
  </div>

  <header>
    <div class="nav">
      <div class="logo">
        <img src="Logo UKSW.png" alt="logo" style="height:50px;"> <div>
          <h1>BHLILZ</h1>
          <p>Hotel Terjangkau Dan Aman</p>
        </div>
      </div>

      <nav>
      
      </nav>

      <div>
        
      </div>
    </div>
  </header>

  <div class="container">
    <div id="auth-area" class="card">

      <form id="login-form" class="auth-form">
        <h3>Login</h3>
        <input type="text" id="login-username" name="username" placeholder="Username" required>
        <input type="password" id="login-password" name="password" placeholder="Password" required>
        
        <button type="submit" class="btn" >Masuk</button>

        <p>Belum punya akun? <span id="show-register" class="link" style="cursor:pointer; color:blue;">Daftar</span></p>
      </form>

      <form id="register-form" class="auth-form" style="display:none;">
        <h3>Register</h3>
        <input type="text" id="reg-username" name="username" placeholder="Username" required>
        <input type="password" id="reg-password" name="password" placeholder="Password" required>

        <button type="submit" class="btn">Daftar</button>

        <p>Sudah punya akun? <span id="show-login" class="link" style="cursor:pointer; color:blue;">Login</span></p>
      </form>

    </div>
  </div>

<script>

  document.getElementById("login-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("action", "login"); 

    fetch("auth.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === "success") {
    alert("Login Berhasil!");
    window.location.href = "Menu.php"; 
}
 else {
        alert(data.message);
      }
    })
    .catch(error => console.error("Error:", error));
  });

  document.getElementById("register-form").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("action", "register"); 

    fetch("auth.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === "success") {
        alert(data.message);
        document.getElementById("register-form").reset();
        document.getElementById("register-form").style.display = "none";
        document.getElementById("login-form").style.display = "block";
      } else {
        alert(data.message);
      }
    })
    .catch(error => console.error("Error:", error));
  });

  document.getElementById("show-register").onclick = () => {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("register-form").style.display = "block";
  };

  document.getElementById("show-login").onclick = () => {
    document.getElementById("register-form").style.display = "none";
    document.getElementById("login-form").style.display = "block";
  };
</script>

</body>
</html>