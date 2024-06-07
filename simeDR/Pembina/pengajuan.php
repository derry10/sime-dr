<?php
session_start();

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

// Ambil data pengajuan dari tabel berdasarkan ekskul_id
$query_pengajuan = "
    SELECT p.id, a.nama, a.kelas, a.jurusan, a.jenis_kelamin, a.email, p.status 
    FROM tb_pengajuan p
    JOIN tb_anggota a ON p.anggota_id = a.id
    WHERE p.ekskul_id = ?";
$stmt_pengajuan = $koneksi->prepare($query_pengajuan);
$stmt_pengajuan->bind_param("i", $ekskul_id);
$stmt_pengajuan->execute();
$result_pengajuan = $stmt_pengajuan->get_result();
$pengajuan = $result_pengajuan->fetch_all(MYSQLI_ASSOC);

?>

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
            <!-- Start Tabel pengajuan -->
            <div class="container p-4">
              <h2 class="modal-title justify-content-center fw-bold mb-4">PENGAJUAN</h2>
              <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Email</th>
                    <th scope="col">Persetujuan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pengajuan as $index => $item): ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($item['nama']) ?></td>
                      <td><?= htmlspecialchars($item['kelas']) ?></td>
                      <td><?= htmlspecialchars($item['jurusan']) ?></td>
                      <td><?= htmlspecialchars($item['jenis_kelamin']) ?></td>
                      <td><?= htmlspecialchars($item['email']) ?></td>
                      <td>
                        <?php if ($item['status'] == 'pending'): ?>
                          <div class="container d-flex justify-content-center align-items-center">
                            <a href="#" class="btn" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#opsiPengajuan" data-id="<?= $item['id'] ?>">Tanggapi</a>
                          </div>
                        <?php elseif ($item['status'] == 'approved'): ?>
                          <div class="container d-flex justify-content-center align-items-center">
                            <a class="btn" style="background-color: #A6A6A6; color: #ffffff; border-radius: 7px;">Disetujui</a>
                          </div>
                        <?php elseif ($item['status'] == 'rejected'): ?>
                          <div class="container d-flex justify-content-center align-items-center">
                            <a class="btn" style="background-color: #AF0B00; color: #ffffff; border-radius: 7px;">Ditolak</a>
                          </div>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- Finish Tabel pengajuan -->
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

<!-- Start Popup Tanggapi -->
<div id="opsiPengajuan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title justify-content-center fw-bold">Tanggapi Pengajuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center my-5">Apakah disetujui sebagai anggota?</p>
      </div>
      <div class="modal-footer d-flex">
        <button type="button" class="btn btn-danger me-3" onclick="updatePengajuanStatus(selectedPengajuanId, 'rejected')">Tidak</button>
        <button type="button" class="btn btn-primary px-4 mx-3" style="background-color: #007F73;" onclick="updatePengajuanStatus(selectedPengajuanId, 'approved')">Ya</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Tanggapi -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
let selectedPengajuanId = null;

document.addEventListener('DOMContentLoaded', function () {
  var opsiPengajuanModal = document.getElementById('opsiPengajuan');
  opsiPengajuanModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    selectedPengajuanId = button.getAttribute('data-id');
  });
});

function updatePengajuanStatus(pengajuanId, status) {
  fetch('update_pengajuan.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ pengajuan_id: pengajuanId, status: status })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      location.reload();
    } else {
      alert('Gagal memperbarui status pengajuan.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
}
</script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
