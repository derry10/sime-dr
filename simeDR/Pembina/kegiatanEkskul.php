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

// Ambil data nama ekskul berdasarkan pembina_id
$query = "
    SELECT tb_ekstrakulikuler.nama 
    FROM tb_ekstrakulikuler 
    JOIN tb_pembina ON tb_ekstrakulikuler.pembina_id = tb_pembina.id 
    WHERE tb_pembina.user_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$ekskul = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kegiatan Ekskul</title>
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
            <!-- Start Tabel kegiatan -->
            <div class="container p-4">
              <h2 class="modal-title justify-content-center fw-bold">JADWAL KEGIATAN EKSTRAKULIKULER</h2>
              <p class="modal-title justify-content-center fw-bold mb-4"><?= htmlspecialchars($ekskul['nama']) ?></p>
              <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Kegiatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Deskripsi Kegiatan</th>
                    <th scope="col">Detail Absen</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Ambil data kegiatan dari tabel berdasarkan ekskul_id
                  $query_kegiatan = "
                      SELECT * FROM tb_kegiatan 
                      WHERE ekskul_id IN (
                          SELECT id FROM tb_ekstrakulikuler 
                          WHERE pembina_id IN (
                              SELECT id FROM tb_pembina 
                              WHERE user_id = ?
                          )
                      )";
                  $stmt_kegiatan = $koneksi->prepare($query_kegiatan);
                  $stmt_kegiatan->bind_param("i", $user_id);
                  $stmt_kegiatan->execute();
                  $result_kegiatan = $stmt_kegiatan->get_result();
                  $kegiatan = $result_kegiatan->fetch_all(MYSQLI_ASSOC);

                  foreach ($kegiatan as $index => $item):
                  ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($item['nama_kegiatan']) ?></td>
                      <td><?= htmlspecialchars($item['tanggal']) ?></td>
                      <td><?= htmlspecialchars($item['hadir']) ?></td>
                      <td><?= htmlspecialchars($item['deskripsi']) ?></td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="absensi.php" type="button" class="btn btn-primary px-4 mx-3" style="background-color: #0094FF;">Detail</a>
                        </div>
                      </td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="#" class="btn" style="background-color: #FFC700; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#ubahKegiatanModal" data-id="<?= $item['id'] ?>" data-nama="<?= htmlspecialchars($item['nama_kegiatan']) ?>" data-minggu="<?= htmlspecialchars($item['minggu_ke']) ?>" data-tanggal="<?= htmlspecialchars($item['tanggal']) ?>" data-deskripsi="<?= htmlspecialchars($item['deskripsi']) ?>">
                            <img src="../img/editPutih.png" alt="img-edit" width="18" height="20">
                          </a>
                        </div>
                      </td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="hapus_kegiatan.php?id=<?= $item['id'] ?>" class="btn" style="background-color: #AF0B00; color: #ffffff; border-radius: 7px;">
                            <img src="../img/hapus.png" alt="img-edit" width="18" height="20">
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- Finish Tabel kegiatan -->
            <div class="modal-footer">
              <button class="btn btn-primary border-0 px-4 m-3" style="background-color: #009521; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#tambahkan">
                <b>Tambahkan</b>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Start Popup Tambahkan -->
<div id="tambahkan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-lg-8 text-center">TAMBAHKAN KEGIATAN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="tambah_kegiatan.php" method="post">
          <div class="mb-3">
            <label for="namaEkskul" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" id="namaEkskul" name="nama_kegiatan">
          </div>
          <div class="mb-3">
            <label for="minggu" class="form-label">Minggu Ke-</label>
            <input type="text" class="form-control" id="minggu" name="minggu">
          </div>
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" placeholder="ketik deskripsi kegiatan disini" id="deskripsi" name="deskripsi" style="height: 200px"></textarea>
          </div>
          <div class="modal-footer d-flex">
            <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Tambahkan -->

<!-- Start Popup Ubah -->
<div id="ubahKegiatanModal" class="modal fade" tabindex="-1" aria-labelledby="ubahData" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content px-4">
      <div class="modal-header">
        <div class="col-md-3"></div>
        <h5 class="modal-title justify-content-between fw-bold col-lg-8 text-center">UBAH DATA KEGIATAN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ubah_kegiatan.php" method="post">
          <input type="hidden" name="id" id="ubahId">
          <div class="mb-3">
            <label for="ubahNama" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" id="ubahNama" name="nama_kegiatan">
          </div>
          <div class="mb-3">
              <label for="ubahMinggu" class="form-label">Minggu Ke-</label>
              <input type="text" class="form-control" id="ubahMinggu" name="minggu">
          </div>
          <div class="mb-3">
            <label for="ubahTanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="ubahTanggal" name="tanggal">
          </div>
          <div class="mb-3">
            <label for="ubahDeskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" placeholder="ketik deskripsi kegiatan disini" id="ubahDeskripsi" name="deskripsi" style="height: 200px"></textarea>
          </div>
          <div class="modal-footer d-flex">
            <button type="button" class="btn btn-danger me-3" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Ubah -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ubahKegiatanModal = document.getElementById('ubahKegiatanModal');
    ubahKegiatanModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        var minggu = button.getAttribute('data-minggu'); // Ambil nilai data-minggu
        var tanggal = button.getAttribute('data-tanggal');
        var deskripsi = button.getAttribute('data-deskripsi');

        var ubahId = ubahKegiatanModal.querySelector('#ubahId');
        var ubahNama = ubahKegiatanModal.querySelector('#ubahNama');
        var ubahMinggu = ubahKegiatanModal.querySelector('#ubahMinggu'); // Update input minggu
        var ubahTanggal = ubahKegiatanModal.querySelector('#ubahTanggal');
        var ubahDeskripsi = ubahKegiatanModal.querySelector('#ubahDeskripsi');

        ubahId.value = id;
        ubahNama.value = nama;
        ubahMinggu.value = minggu; // Set nilai minggu ke input
        ubahTanggal.value = tanggal;
        ubahDeskripsi.value = deskripsi;
    });
});

</script>
</body>
</html>
