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
    SELECT a.id, a.nama, a.kelas, a.jurusan, a.jenis_kelamin, a.email 
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
  <title>Prestasi</title>
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
      <div class="col-md-12">
        <div class="profile-card" style="background-color: #A6A6A6;">
          <div class="container" style="background-color: #D9D9D9;">
            <!-- Start Tabel anggota -->
            <div class="container p-4">
              <h2 class="modal-title justify-content-center fw-bold mb-4">ANGGOTA EKSKUL <?= htmlspecialchars($ekskul['nama_ekskul']) ?></h2>
              <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Email</th>
                    <th scope="col">Prestasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($anggota as $index => $item): ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($item['nama']) ?></td>
                      <td><?= htmlspecialchars($item['kelas']) ?></td>
                      <td><?= htmlspecialchars($item['jurusan']) ?></td>
                      <td><?= htmlspecialchars($item['jenis_kelamin']) ?></td>
                      <td><?= htmlspecialchars($item['email']) ?></td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="#" class="btn" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup" data-anggota-id="<?= $item['id'] ?>" data-nama="<?= $item['nama'] ?>" data-jenis-kelamin="<?= $item['jenis_kelamin'] ?>" data-jurusan="<?= $item['jurusan'] ?>" data-ekskul="<?= $ekskul['nama_ekskul'] ?>">
                            LIHAT PRESTASI
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!--Finish Tabel anggota -->
          </div>
          <div class="modal-footer">
            <a href="anggotaNilai.php" class="btn px-4 mt-4" style="background-color: #007F73; color: #ffffff; border-radius: 7px;">Lihat Anggota</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Start Popup Prestasi -->
<div id="ubahDataPopup" class="modal fade" tabindex="-1" aria-labelledby="ubahDataPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title justify-content-center fw-bold">PRESTASI</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
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
                <td id="detailNama"></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td id="detailJenisKelamin"></td>
              </tr>
              <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td id="detailJurusan"></td>
              </tr>
              <tr>
                <td>Ekstrakurikuler</td>
                <td>:</td>
                <td id="detailEkskul"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Start Tabel prestasi -->
      <div class="container p-4">
        <table class="table table-bordered border-2" style="background-color: #FFF455; border: 2px;">
          <thead>
            <tr style="background-color: #0094FF; text-align: center;">
              <th scope="col">#</th>
              <th scope="col">Kegiatan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Tingkat</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Edit</th>
              <th scope="col">Hapus</th>
            </tr>
          </thead>
          <tbody id="prestasiTableBody">
          </tbody>
        </table>
      </div>
      <!-- Finish Tabel prestasi -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="background-color: #009521;" data-bs-toggle="modal" data-bs-target="#tambahkanPrestasiModal">Tambahkan Prestasi</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Prestasi -->

<!-- Start Popup Tambahkan Prestasi -->
<div id="tambahkanPrestasiModal" class="modal fade" tabindex="-1" aria-labelledby="tambahkanPrestasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Tambahkan Prestasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formTambahPrestasi" action="tambah_prestasi.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="anggota_id" id="tambahAnggotaId">
          <div class="mb-3">
            <label for="kegiatan" class="form-label">Kegiatan</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" required>
          </div>
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
          </div>
          <div class="mb-3">
            <label for="tingkat" class="form-label">Tingkat</label>
            <input type="text" class="form-control" name="tingkat" id="tingkat" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Finish Popup Tambahkan Prestasi -->

<!-- Start Popup Edit Prestasi -->
<div id="editPrestasiModal" class="modal fade" tabindex="-1" aria-labelledby="editPrestasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Edit Prestasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEditPrestasi" action="update_prestasi.php" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="editPrestasiId">
          <div class="mb-3">
            <label for="editKegiatan" class="form-label">Kegiatan</label>
            <input type="text" class="form-control" name="kegiatan" id="editKegiatan" required>
          </div>
          <div class="mb-3">
            <label for="editTanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="editTanggal" required>
          </div>
          <div class="mb-3">
            <label for="editTingkat" class="form-label">Tingkat</label>
            <input type="text" class="form-control" name="tingkat" id="editTingkat" required>
          </div>
          <div class="mb-3">
            <label for="editDeskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="editDeskripsi" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Finish Popup Edit Prestasi -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#ubahDataPopup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var anggotaId = button.data('anggota-id');
        var nama = button.data('nama');
        var jenisKelamin = button.data('jenis-kelamin');
        var jurusan = button.data('jurusan');
        var ekskul = button.data('ekskul');

        var modal = $(this);
        modal.find('#detailNama').text(nama);
        modal.find('#detailJenisKelamin').text(jenisKelamin);
        modal.find('#detailJurusan').text(jurusan);
        modal.find('#detailEkskul').text(ekskul);

        $.ajax({
            url: 'ambil_prestasi.php',
            type: 'GET',
            data: { anggota_id: anggotaId },
            dataType: 'json',
            success: function(data) {
                var prestasiTableBody = $('#prestasiTableBody');
                prestasiTableBody.empty();

                $.each(data, function(index, prestasi) {
                    var row = '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + prestasi.kegiatan + '</td>' +
                        '<td>' + prestasi.tanggal + '</td>' +
                        '<td>' + prestasi.tingkat + '</td>' +
                        '<td>' + prestasi.deskripsi + '</td>' +
                        '<td><button class="btn btn-warning edit-prestasi" data-id="' + prestasi.id + '" data-kegiatan="' + prestasi.kegiatan + '" data-tanggal="' + prestasi.tanggal + '" data-tingkat="' + prestasi.tingkat + '" data-deskripsi="' + prestasi.deskripsi + '">Edit</button></td>' +
                        '<td><button class="btn btn-danger delete-prestasi" data-id="' + prestasi.id + '">Hapus</button></td>' +
                    '</tr>';
                    prestasiTableBody.append(row);
                });
            }
        });
    });

    $('#prestasiTableBody').on('click', '.edit-prestasi', function() {
        var id = $(this).data('id');
        var kegiatan = $(this).data('kegiatan');
        var tanggal = $(this).data('tanggal');
        var tingkat = $(this).data('tingkat');
        var deskripsi = $(this).data('deskripsi');

        $('#editPrestasiId').val(id);
        $('#editKegiatan').val(kegiatan);
        $('#editTanggal').val(tanggal);
        $('#editTingkat').val(tingkat);
        $('#editDeskripsi').val(deskripsi);

        $('#editPrestasiModal').modal('show');
    });

    $('#prestasiTableBody').on('click', '.delete-prestasi', function() {
        var id = $(this).data('id');
        if (confirm('Apakah anda yakin ingin menghapus prestasi ini?')) {
            window.location.href = 'delete_prestasi.php?id=' + id;
        }
    });

    $('#ubahDataPopup').on('hidden.bs.modal', function () {
        $('#prestasiTableBody').empty();
    });

    $('#tambahkanPrestasiModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var anggotaId = button.closest('#ubahDataPopup').find('#detailNama').text();
        $('#tambahAnggotaId').val(anggotaId);
    });
});
</script>
</body>
</html>
