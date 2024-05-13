<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Include</title>
  <!-- Include Style -->
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
      <div class="col-md-12">
            <!-- Start Tabel prestasi -->
            <div class="container justify-content-center my-3">
        <div class="row justify-content-center">
          <div class="profile-card" style="background-color: #A6A6A6;">
            <div class="container" style="background-color: #D9D9D9;"> 
              <!--Start Tabel prestasi -->
              <div class="container p-4 " >
                <div class="container border-1 d-flex p-4" style="background-color: #797EFF; ">
                  <div class="col fw-bold">
                    <h2><u>LAPORAN PESERTA DAN NILAI </u></h2>
                    <h6>Ekstrakulikuler Pramuka <br> Pembina: Aisyah, S.Pd</h6>
                  </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Ekskul</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nilai</th>
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
                    <td>85</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Pramuka</td>
                    <td>Diana</td>
                    <td>10</td>
                    <td>APAT</td>
                    <td>Wanita</td>
                    <td>85</td>
                  </tr>
                </tbody>
              </table> 
              </div>
              </div>
            <!-- Finish Tabel prestasi -->
            <div class="modal-footer">
              <button onclick="window.print()" class="btn px-4 m-4" style="background-color: #FFC700; color: #373737; border-radius: 7px;">
                <b>Cetak</b>
              </button>
            </div> 
          </div>
        </div>
      </div>
    </div> 
  </div>      
</div>      
<!-- Finish Content -->

<!-- Start Popup 1 -->
<div id="opsiPengajuan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <!-- Start Content -->
      <div class="container justify-content-center my-3">
        <div class="row justify-content-center">
          <div class="profile-card" style="background-color: #A6A6A6;">
            <div class="container" style="background-color: #D9D9D9;"> 
              <!--Start Tabel prestasi -->
              <div class="container p-4" >
                <div class="container border-1 d-flex p-4" style="background-color: #FFC700; ">
                  <div class="col-md-6 fw-bold">
                    <h2><u>ABSEN MINGGU KE - 2 </u></h2>
                    <h6>Ekstrakulikuler Pramuka</h6>
                  </div>
                  <div class="col-md-6" style="font-size: 14px;">
                    <b>Deskripsi Kegiatan:</b>
                    Menyelenggarakan acara pertunjukan bakat di antara anggota pramuka untuk memperlihatkan bakat-bakat yang dimiliki.
                  </div>
                </div>
                <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                  <thead>
                    <tr style="background-color: #FFF455; text-align: center;">
                      <th scope="col">No</th>
                      <th scope="col">Nama anggota</th>
                      <th scope="col">Status Kehadiran</th>
                      <th scope="col">Waktu Submit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Andriana</td>
                      <td>Hadir</td>
                      <td>2024-04-24 15:20:05</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Diana</td>
                      <td>Hadir</td>
                      <td>2024-04-24 15:20:05</td>
                    </tr>
                  </tbody>
                </table>      
              </div>
              <!--Finish Tabel prestasi -->
            </div>
            <div class="modal-footer">
              <button onclick="window.print()" class="btn px-4 m-4" style="background-color: #FFC700; color: #373737; border-radius: 7px;">
                <b>Cetak</b>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Finish Content -->
    </div>
  </div>      
</div>      
<!-- Finish Popup 1 -->

<!-- Start Popup 2 -->
<div id="konfirmasiModal" class="modal fade" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="konfirmasiModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center my-5">
        Apakah Anda yakin ingin mencetak laporan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
        <a href="#" type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;">Ya</a>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup 2 -->


<!-- Include Script -->
<?php include 'script.php'; ?>

</body>
</html>