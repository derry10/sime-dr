<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS */
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .navbar {
      background-color: #A6A6A6;
    }
    .nav-link{
        background-color: #FF0000;
        color: white;
        border-radius: 8px;
    }
    .nav-link a{
        color: white;
    }
    .sidebar {
      background-color: #007F73;
      height: 100vh;
      width: 20%;
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 3rem;
    }
    .content {
      margin-left: 20%; /* Sesuaikan dengan lebar sidebar */
      padding: 2rem;
    }
    .profile-card {
      background-color: #D9D9D9;
      padding: 1rem;
      border-radius: 10px;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    .logout-btn {
      margin-right: 1rem;
    }
    .menu-item {
      color: #fff;
      text-decoration: none;
    }
    .square-column {
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .square-column img {
        max-width: 100%;
        max-height: 100%;
        margin-right: 20px; 
    }
    .modal-title{
        display: flex;
        align-items: center;
        justify-content: center;
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
        <li class="nav-item d-flex">
          <a class="nav-link logout-btn" href="#"> <img src="../img/Logout.png" alt="Logo" width="28" height="28">
            LOGOUT</a>
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
      <a class="btn btn-outline-secondary border-0 mx-3 menu-item" href="dashboard.php">
        <img src="../img/home.png" alt="Logo" width="28" height="28">
        Dashboard</a>
    </li>
    <li class="nav-item d-flex align-items-center mx-2">
      <a class="btn btn-outline-secondary border-0 mx-3 menu-item" href="profil.php">
        <img src="../img/profil.png" alt="Logo" width="28" height="38">
        Lihat Profil</a>
    </li>
    <li class="nav-item d-flex align-items-center mx-2">
      <a class="btn btn-outline-secondary border-0 mx-3 dropdown-toggle menu-item" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../img/ekskul.png" alt="Logo" width="28" height="28">   Lihat Nilai
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

<!-- Start Content -->
<div class="content">
  <div class="container justify-content-center">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="profile-card">
          <div class="container"> 
            <h2 class="justify-content-between text-center">PRESTASI YANG DIRAIH</h2>
            <div class="row">
              <div class="col-md-6">
                <div class="card m-4" style="background-color: #FFC700;">
                  <div class="row g-0">
                    <img src="../img/pramuka1.png" class="img-fluid rounded" alt="pramuka">
                    <div class="col-md-8 m-2">
                      <h5 class="card-title" style="margin:0 auto">PRAMUKA</h5>
                      <small class="text-body-secondary">Praja Muda Karana</small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <a href="#" class="btn px-4" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup">
                        Prestasi</a>
                      </div>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Start Popup 1 -->
<div id="ubahDataPopup" class="modal fade" tabindex="-1" aria-labelledby="ubahDataPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-center fw-bold col-md-6">PRESTASI</h5>
        <button type="button" class="btn-close col-md-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- start content -->
      <div class="d-flex justify-content-center">
        <div class="col-md-4 m-2 p-6">
          <div class="container">
            <div class="row">
              <div class="square-column">
                <img src="../img/userprofil.png" alt="image profile" style="width: 70%; height:98%;">
              </div>
            </div>
          </div>
        </div>
        <!-- tabel -->
        <div class="square-column" style="font-size: 136%;">
          <table>
            <tbody>
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td>Andriana</td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>Pria</td>
              </tr>
              <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>TBSM</td>
              </tr>
              <tr>
                <td>Ekstrakulikuler</td>
                <td>:</td>
                <td>Pramuka</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!--Start Tabel prestasi -->
      <div class="container p-4">
        <table class="table table-bordered border-2" style="background-color: #FFF455; border: 2px;">
          <thead>
            <tr style="background-color: #0094FF; text-align: center;">
              <th scope="col">#</th>
              <th scope="col">Kegiatan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Tingkat</th>
              <th scope="col">Dskripsi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Pionering</td>
              <td>27/4/2024</td>
              <td>Kabupaten</td>
              <td>Meraih juara 1 dalam Lomba Pionering Tingkat Kabupaten dengan membangun jembatan gantung yang kuat dan inovatif menggunakan bahan-bahan alami. </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Pionering</td>
              <td>27/5/2024</td>
              <td>Kecamatan</td>
              <td>Meraih juara 1 dalam Lomba Pionering Tingkat Kecamatan dengan membangun menara bendera yang kokoh dan kreatif menggunakan bahan-bahan sederhana.</td>
            </tr>
          </tbody>
        </table>      
      </div>
      <!--Finish Tabel prestasi -->
      <!-- finish content -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="background-color: #007F73;" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script -->
<script>
  // Ambil semua elemen dropdown item
  const dropdownItems = document.querySelectorAll('.dropdown-item');

  // Loop melalui setiap item dropdown
  dropdownItems.forEach(item => {
    // Tambahkan event listener ketika item dropdown diklik
    item.addEventListener('click', function() {
      // Ambil teks dari item dropdown yang dipilih
      const selectedText = this.textContent;
      
      // Ubah teks dropdown Ekstrakulikuler sesuai dengan teks yang dipilih
      document.querySelector('.dropdown-toggle').textContent = selectedText;
    });
  });
</script>

</body>
</html>
