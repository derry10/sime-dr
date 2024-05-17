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
        margin: 0; /* Menghilangkan margin default */
    }
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        padding: 0 20px; /* Menambahkan padding agar konten tidak terlalu dekat dengan tepi layar */
    }
    .login-container {
        background-color: #FFF455;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        width: 90%; /* Mengubah lebar container agar responsif */
        max-width: 500px; /* Batasi lebar maksimum agar tidak terlalu lebar pada layar besar */
        align-items: center;
    }
    .form-container {
        background-color: #FFC700;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px; /* Menambahkan margin atas agar tidak terlalu dekat dengan container di atasnya */
        margin-left: auto; /* Meletakkan form ke tengah */
        margin-right: auto; /* Meletakkan form ke tengah */
        width: 100%; /* Mengisi lebar container parent */
    }
    .centered-text {
        text-align: center;
    }
    .my-6 {
        margin-top: 3rem;
        margin-bottom: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .my-6 img {
        width: 100%; /* Mengubah lebar gambar agar responsif */
        max-width: 200px; /* Batasi lebar maksimum gambar */
        height: auto; /* Biarkan tinggi mengikuti rasio aspek */
    }
    /* Responsif */
    @media (max-width: 576px) {
        .login-container {
            width: 100%; /* Mengubah lebar container menjadi 100% pada layar yang lebih kecil dari 576px */
            max-width: none; /* Menghapus batasan lebar maksimum */
        }
        
    }
</style>
</head>
<body>

<div class="container">
  <h3 class="">Register</h3>
  <div class="login-container px-5">
    <div class="form-container mx-8">
      <form action="/login" method="post">
        <h2 class="centered-text" style="color: black; font-size:160%;">SELAMAT</h2>
        <div class="form-label mb-2 centered-text" style="color: black;">
          Anda telah berhasil<br> melakukan Registrasi!
        </div>
        <div class="my-6 centered-text">
          <img src="img/sucsess.png" alt="Checklist Image" style="width: 40%; height: 40%;">
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
