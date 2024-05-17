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
      <img src="../img/ekskul.png" alt="Logo" width="28" height="28">   Memilih Ekskul
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
  <div class="container justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="profile-card">
          <div class="container"> 
            <h2 class="justify-content-between text-center" >KATEGORI EKSTRAKULIKULER</h2>
            <div class="row">
              <div class="col-md-6 ">
                <div class="card m-4" style="background-color: #FFC700;">
                  <div class="row g-0">
                    <img src="../img/pramuka1.png" class="img-fluid rounded" alt="pramuka">
                    <div class="col-md-8 m-2">
                      <h5 class="card-title">PRAMUKA</h5>
                      <small class="text-body-secondary">Praja Muda Karana</small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <a href="#" class="btn px-4" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup">
                        Daftar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 ">
                <div class="card m-4" style="max-width: 540px; background-color: #FFC700;">
                  <div class="row g-0">
                    <img src="../img/pramuka1.png" class="img-fluid rounded " alt="pramuka">
                    <div class="col-md-8 m-2">
                      <h5 class="card-title">PMR</h5>
                      <small class="text-body-secondary">Palang Merah Remaja</small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <a href="#" class="btn px-4 p-2" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;"  data-bs-toggle="modal" data-bs-target="#ubahDataPopup">Daftar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mt-4">
                <div class="card m-4" style="max-width: 540px; background-color: #FFC700;">
                  <div class="row g-0">
                    <img src="../img/pramuka1.png" class="img-fluid rounded " alt="pramuka">
                    <div class="col-md-8 m-2">
                      <h5 class="card-title">PASKIBRA</h5>
                      <small class="text-body-secondary">Pasukan Pengibar Bendera</small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <a href="#" class="btn px-4" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;"  data-bs-toggle="modal" data-bs-target="#ubahDataPopup">Daftar</a>
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
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-md-6" >FORM PENDAFTARAN</h5>
        <button type="button" class="btn-close col-md-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Kelas</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="noHandphone" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="noHandphone">
          </div>
          <div class="mb-3">
            <label for="ekstrakulikuler" class="form-label">Pilih Ekstrakulikuler</label>
            <div class="form-check">
          <input class="form-check-input" type="radio" name="ekstrakulikuler" id="pramukaRadio" value="PRAMUKA">
          <label class="form-check-label" for="pramukaRadio">
            PRAMUKA
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="ekstrakulikuler" id="paskibraRadio" value="PASKIBRA">
          <label class="form-check-label" for="paskibraRadio">
            PASKIBRA
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="ekstrakulikuler" id="pmrRadio" value="PMR">
          <label class="form-check-label" for="pmrRadio">
            PMR
          </label>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#opsiData">Simpan</button>
      </div>
    </div>
  </div>
          
    </div>
  </div>
</div>
<!-- Finish Popup -->

<!-- Start Popup 2 -->
<div id="opsiData" class="modal fade" tabindex="-1" aria-labelledby="data DisimpanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-md-6 text-center">Peringatan!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="text-center my-5">Apakah anda sudah yakin<br> form terisi dengan data yang<br> benar?</p>
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;" data-bs-toggle="modal" data-bs-target="#dataDisimpan">Ya</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup 2 -->

<!-- Start Popup 3 -->
<div id="dataDisimpan" class="modal fade" tabindex="-1" aria-labelledby="data DisimpanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-md-6 text-center" style="color: #007F73;">BERHASIL!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center my-5">Data anda telah dikirim</p>
      </div>
      <div class="modal-footer">
        <a href="pilihEkskul.php" type="button" class="btn btn-primary" style="background-color: #007F73;">Selesai</a>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup 3 -->

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
