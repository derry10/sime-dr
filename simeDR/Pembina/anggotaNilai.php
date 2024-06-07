<?php
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Ambil ekskul_id pembina
$query_ekskul = "
    SELECT e.id AS ekskul_id, e.nama AS nama_ekskul 
    FROM tb_ekstrakulikuler e
    JOIN tb_pembina p ON e.pembina_id = p.id
    WHERE p.user_id = ?";
$stmt_ekskul = $koneksi->prepare($query_ekskul);
$stmt_ekskul->bind_param("i", $user_id);
$stmt_ekskul->execute();
$result_ekskul = $stmt_ekskul->get_result();
$ekskul = $result_ekskul->fetch_assoc();

$ekskul_id = $ekskul['ekskul_id'];

// Ambil data anggota dari tabel berdasarkan ekskul_id
$query_anggota = "
    SELECT a.id, a.nama, a.kelas, a.jurusan, a.jenis_kelamin, a.email, a.nilai 
    FROM tb_anggota a
    WHERE a.ekskul_id = ?";
$stmt_anggota = $koneksi->prepare($query_anggota);
$stmt_anggota->bind_param("i", $ekskul_id);
$stmt_anggota->execute();
$result_anggota = $stmt_anggota->get_result();
$anggota = $result_anggota->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anggota dan Nilai</title>
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
            <!-- Start Tabel anggota -->
            <div class="container p-4">
              <h2 class="modal-title justify-content-center fw-bold mb-4">NAMA ANGGOTA DAN NILAI</h2>
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
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($anggota as $index => $item): ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($ekskul['nama_ekskul']) ?></td>
                      <td><?= htmlspecialchars($item['nama']) ?></td>
                      <td><?= htmlspecialchars($item['kelas']) ?></td>
                      <td><?= htmlspecialchars($item['jurusan']) ?></td>
                      <td><?= htmlspecialchars($item['jenis_kelamin']) ?></td>
                      <td><?= htmlspecialchars($item['nilai']) ?></td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="#" class="btn" style="background-color: #FFC700; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan" data-id="<?= $item['id'] ?>" data-nama="<?= htmlspecialchars($item['nama']) ?>" data-kelas="<?= htmlspecialchars($item['kelas']) ?>" data-jurusan="<?= htmlspecialchars($item['jurusan']) ?>" data-jenis-kelamin="<?= htmlspecialchars($item['jenis_kelamin']) ?>" data-nilai="<?= htmlspecialchars($item['nilai']) ?>">
                            <img src="../img/editPutih.png" alt="img-edit" width="18" height="20">
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="hapus_anggota.php?id=<?= $item['id'] ?>" class="btn" style="background-color: #AF0B00; color: #ffffff; border-radius: 7px;">
                            <img src="../img/hapus.png" alt="img-hapus" width="18" height="20">
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- Finish Tabel anggota -->
          </div>
          <div class="modal-footer">
            <a href="export_excel.php" class="btn btn-success px-4 mt-4"  target="_blank">
              <b>Cetak</b>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Start Popup Edit -->
<div id="opsiPengajuan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-lg-6 text-center">UBAH DATA ANGGOTA DAN NILAI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditAnggota" action="update_anggota.php" method="post">
          <input type="hidden" name="id" id="editId">
          <div class="mb-3">
            <label for="editNamaEkskul" class="form-label">Nama Ekskul</label>
            <input type="text" class="form-control" id="editNamaEkskul" value="<?= htmlspecialchars($ekskul['nama_ekskul']) ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Anggota</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="editKelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="editKelas" name="kelas" required>
          </div>
          <div class="mb-3">
            <label for="editJurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="editJurusan" name="jurusan" required>
          </div>
          <div class="mb-3">
            <label for="editJenisKelamin" class="form-label">Jenis Kelamin</label>
            <div class="form-control">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="editPria" value="Pria">
                <label class="form-check-label" for="editPria">Pria</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="editWanita" value="Wanita">
                <label class="form-check-label" for="editWanita">Wanita</label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="editNilai" class="form-label">Nilai (0-100)</label>
            <input type="number" class="form-control" id="editNilai" name="nilai" min="0" max="100" required>
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" form="formEditAnggota" class="btn btn-primary px-4 mx-3" style="background-color: #0094FF;">Simpan</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Edit -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var opsiPengajuan = document.getElementById('opsiPengajuan');
    opsiPengajuan.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var id = button.getAttribute('data-id');
      var nama = button.getAttribute('data-nama');
      var kelas = button.getAttribute('data-kelas');
      var jurusan = button.getAttribute('data-jurusan');
      var jenisKelamin = button.getAttribute('data-jenis-kelamin');
      var nilai = button.getAttribute('data-nilai');
      
      var modalTitle = opsiPengajuan.querySelector('.modal-title');
      var editId = opsiPengajuan.querySelector('#editId');
      var editNama = opsiPengajuan.querySelector('#editNama');
      var editKelas = opsiPengajuan.querySelector('#editKelas');
      var editJurusan = opsiPengajuan.querySelector('#editJurusan');
      var editPria = opsiPengajuan.querySelector('#editPria');
      var editWanita = opsiPengajuan.querySelector('#editWanita');
      var editNilai = opsiPengajuan.querySelector('#editNilai');
      
      editId.value = id;
      editNama.value = nama;
      editKelas.value = kelas;
      editJurusan.value = jurusan;
      if (jenisKelamin === 'Pria') {
        editPria.checked = true;
      } else {
        editWanita.checked = true;
      }
      editNilai.value = nilai;
    });
  });
</script>
</body>
</html>
