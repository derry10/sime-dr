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
        color: #007F73;
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

<!-- Start Popup 1 -->
<div id="ubahDataPopup" class="modal fade" tabindex="-1" aria-labelledby="ubahDataPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title justify-content-center fw-bold">UBAH DATA PROFIL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="noHandphone" class="form-label">No Handphone</label>
            <input type="text" class="form-control" id="noHandphone">
          </div>
          <div class="mb-3">
            <label for="ekstrakulikuler" class="form-label">Level/Ekstrakulikuler</label>
            <input type="text" class="form-control" id="ekstrakulikuler">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#dataDisimpan">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Finish Popup -->

<!-- Start Popup 2 -->
<div id="dataDisimpan" class="modal fade" tabindex="-1" aria-labelledby="data DisimpanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">BERHASIL!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">Data anda telah diubah</p>
      </div>
      <div class="modal-footer">
        <a href="profil.php" type="button" class="btn btn-primary" style="background-color: #007F73;">Selesai</a>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup 2 -->


<!-- Start Content -->

<div class="content">
  <div class="container justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="profile-card">
          <div class="text-center">
          <img src="../img/profil.png" alt="Profil" class="profile-img" style="width:120px; height:160px;">
          </div>
          <div class="form-label mb-2 mx-3" style="color: black;">
            Nama Lengkap
            <div class="card mb-3 p-2">
              <p class="card-text">Joni</p>
            </div>
          </div>
          <div class="form-label mb-2 mx-3" style="color: black;">
            Email
            <div class="card mb-3 p-2">
              <p class="card-text">jon@example.com</p>
            </div>
          </div>
          <div class="form-label mb-2 mx-3" style="color: black;">
            No Handphone
            <div class="card mb-3 p-2">
              <p class="card-text">0836265437636</p>
            </div>
          </div>
          <div class="form-label mb-2 mx-3" style="color: black;">
            Jabatan Extrakulikuler
            <div class="card mb-3 p-2">
              <p class="card-text">Anggota Pramuka</p>
            </div>
          </div>
          <div class="card border-0 mb-2 mx-3">
            <button class="btn btn-secondary border-0" type="button" style="background-color: #FFC700;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup">
            UBAH DATA</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Finish Content -->

<!-- Start Popup 1 -->
<div id="opsiPengajuan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-md-6 text-center">Tanggapi Pengajuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="text-center my-5">Apakah disetujui sebagai anggota?</p>
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;" data-bs-toggle="modal" data-bs-target="#dataDisimpan">Ya</button>
      </div>
    </div>
  </div>
</div>

<!-- Finish Popup 1-->



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
