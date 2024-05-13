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
  <div class="container justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="profile-card" style="background-color: #A6A6A6;">
          <div class="container" style="background-color: #D9D9D9;"> 
                  <!--Start Tabel prestasi -->
            <div class="container p-4" >
              <h5 class="modal-title justify-content-center fw-bold mb-4" >NAMA Peserta DAN NILAI</h5>
              <div class="table-responsive">              
                <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                  <thead>
                    <tr style="background-color: #FFF455; text-align: center;">
                      <th scope="col">No</th>
                      <th scope="col">Nama Ekskul</th>
                      <th scope="col">Nama Peserta</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Jurusan</th>
                      <th scope="col">Jenis Kelamin</th>
                      <th scope="col">Nilai</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Hapus</th>
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
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">           
                          <a href="#" class="btn" style="background-color: #FFC700; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan">
                          <img src="../img/editPutih.png" alt="img-edit" width="18" height="20"></a>
                        </div>
                      </td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">            
                          <a href="#" class="btn" style="background-color: #AF0B00; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan">
                          <img src="../img/hapus.png" alt="img-edit" width="18" height="20"></a>
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
                      <td>85</td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">            
                          <a href="#" class="btn" style="background-color: #FFC700; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan">
                          <img src="../img/editPutih.png" alt="img-edit" width="18" height="20"></a>
                        </div>
                      </td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">            
                          <a href="#" class="btn" style="background-color: #AF0B00; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan">
                          <img src="../img/hapus.png" alt="img-edit" width="18" height="20"></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>  
              </div>    
            </div>
            <!--Finish Tabel prestasi -->
          </div>
          <div class="modal-footer">
            <a href="anggotaNilai.php" class="btn px-4 mt-4" style="background-color: #FFC700; color: #373737; border-radius: 7px;">
               <b>Laporkan</b></a>
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
    <div class="modal-content px-4">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-lg-6 text-center">UBAH DATA ANGGOTA DAN NILAI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="namaEkskul" class="form-label">Nama Ekskul</label>
            <input type="text" class="form-control" id="namaEkskul">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Anggota</label>
            <input type="nama" class="form-control" id="anggota">
          </div>
          <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="kelas">
          </div>
          <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan">
          </div>
          <div class="mb-3">
              <label for="ekstrakulikuler" class="form-label">Jenis Kelamin</label>
                <div class="form-control">
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="jenisKelamin" id="pria" value="pria">
                     <label class="form-check-label" for="priaRadio">
                      PRIA
                     </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenisKelamin" id="wanita" value="pria">
                    <label class="form-check-label" for="wanitaRadio">
                      WANITA
                    </label>
                  </div> 
                </div>
          </div>
          <div class="my-3">
            <label for="nilai" class="form-label">Nilai (0-100)</label>
            <input type="nilai" class="form-control" id="nilai">
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary px-4 mx-3" style="background-color: #0094FF;" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Simpan</button>
      </div>
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
        Apakah Anda yakin ingin menyimpan perubahan?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
        <a href="anggotaNilai.php" type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;">Ya</a>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup 2 -->

<!-- Include Script -->
<?php include 'script.php'; ?>

</body>
</html>
