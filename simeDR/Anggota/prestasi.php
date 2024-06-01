<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include Navbar -->
<?php include 'style.php'; ?>

</head>
<body>
<!-- Include Navbar -->
<?php include 'navbar.php'; ?>

<!-- Include Sidebar -->
<?php include 'sidebar.php'; ?>

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

<!-- script -->

<!-- script -->
<?php include 'script.php'; ?>

</body>
</html>