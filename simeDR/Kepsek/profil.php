
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

<!-- Include Script -->
<?php include 'script.php'; ?>

</body>
</html>

