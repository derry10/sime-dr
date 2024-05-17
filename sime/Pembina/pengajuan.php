<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengajuan</title>
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
  <div class="container justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="profile-card" style="background-color: #A6A6A6;">
          <div class="container" style="background-color: #D9D9D9;"> 
                  <!--Start Tabel prestasi -->
            <div class="container p-4 table-responsive" >
              <h2 class="modal-title justify-content-center fw-bold mb-4" >PENGAJUAN</h2>
              <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Ekskul</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Persetujuan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Pramuka</td>
                    <td>Andriana</td>
                    <td>11</td>
                    <td>TBSM</td>
                    <td>Pria</td>
                    <td>
                      <div class="container d-flex justify-content-center align-items-center">            
                         <a class="btn" style="background-color: #A6A6A6; color: #ffffff; border-radius: 7px;">
                          Disetujui</a>
                      </div>
                    </td>
                    
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Pramuka</td>
                    <td>Diana</td>
                    <td>10</td>
                    <td>APAT</td>
                    <td>Wanita</td>
                    <td>
                      <div class="container d-flex justify-content-center align-items-center">            
                         <a href="#" class="btn" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan">
                          Tanggapi</a>
                      </div>
                    
                  </tr>
                  
                </tbody>
              </table>      
              </div>
            <!--Finish Tabel prestasi -->
          </div>
            <div class="modal-footer">
              <a href="anggotaNilai.php" class="btn px-4 mt-4" style="background-color: #007F73; color: #ffffff; border-radius: 7px;">
               Lihat Anggota</a>
            </div>
           
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
<!-- script -->
<?php include 'script.php'; ?>

</body>
</html>
