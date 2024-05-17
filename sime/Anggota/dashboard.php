<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Selesai</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background-color: #007F73;
    font-family: 'Poppins', sans-serif;
    color: #fff;
  }
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  .login-container {
    background-color: #FFF455;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    width: 500px;
    align-items: center;
  }
  .form-container {
    background-color: #FFC700;
    padding: 20px;
    border-radius: 10px;
    margin-left: 30px;
    margin-right: 30px;
    align-items: center;
  }
  .centered-text {
    text-align: center;
  }
  .my-6 {
    margin-top: 3rem;
    margin-bottom: 3rem;
  }
</style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link logout-btn" href="#">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <div>
    <h2 class="rounded-end p-2 me-5" style="background-color:#FFF455; color: #007F73;">SIMe</h2>
  </div>
  <ul class="nav flex-column mt-3">
    <li class="nav-item d-flex align-items-center mx-2">
      <a class=" btn btn-outline-secondary border-0 mx-3" style="color:white;" menu-item " href="dashboard.php">
      <img src="../img/home.png" alt="Logo" width="28" height="28">
      Dashboard</a>
    </li>
    <li class="nav-item d-flex align-items-center mx-2">
      <a class=" btn btn-outline-secondary border-0 mx-3" style="color:white;" menu-item " href="profil.php">
      <img src="../img/profil.png" alt="Logo" width="28" height="38">
      Lihat Profil</a>
    </li>
    <li class="nav-item d-flex align-items-center mx-2">
      
      <a class="btn btn-outline-secondary border-0 mx-3 dropdown-toggle menu-item" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="../img/ekskul.png" alt="Logo" width="28" height="28">   Ekstrakulikuler
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="pilihEkskul.php">Memilih Ekskul</a></li>
        <li><a class="dropdown-item" href="absensi.php">Absensi</a></li>
        <li><a class="dropdown-item" href="nilai.php">Lihat Nilai</a></li>
        <li><a class="dropdown-item" href="prestasi.php">Lihat Prestasi</a></li>
      </ul>
    </li>
  </ul>
</div>
<!-- finish sidebar -->
<div class="container">
  <h3 class="">Register</h3>
  <div class="login-container px-5">
    <div class="form-container mx-8">
      <form action="/login" method="post">
        <h2 class="centered-text" style="color: black;">SELAMAT</h2>
        <div class="form-label mb-2 centered-text" style="color: black;">
          Anda telah berhasil<br> melakukan Registrasi!
        </div>
        <div class="my-6 centered-text">
        <img src="../img/sucsess.png" alt="Checklist Image" style="width: 160px; height: 160px;">
        </div>
        <div class="card border-0 my-2">
          <button class="btn btn-secondary border-0" type="submit" style="background-color: #4CCD99;" id="registerButton">Selesai</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript untuk mengatur pilihan level -->
<script>
  const registerButton = document.getElementById('registerButton');

  // Menambahkan event listener untuk tombol register
  registerButton.addEventListener('click', function() {
    // Menonaktifkan tombol register
    registerButton.disabled = true;

    // Menambahkan animasi loading
    registerButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';

    // Menunggu selama 0.5 detik sebelum mengarahkan ke halaman lain
    setTimeout(function() {
      // Mengganti URL dengan halaman tujuan
      window.location.href = 'login.php';
    }, 500);
  });
</script>
</body>
</html>
