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

if (!isset($_GET['kegiatan_id'])) {
    die("Kegiatan ID tidak ditemukan.");
}

$kegiatan_id = $_GET['kegiatan_id'];

// Ambil data kegiatan beserta data ekstrakulikuler dan minggu ke-berapa
$query_kegiatan = "
    SELECT tb_kegiatan.*, tb_ekstrakulikuler.nama AS nama_ekskul, tb_kegiatan.minggu_ke
    FROM tb_kegiatan
    JOIN tb_ekstrakulikuler ON tb_kegiatan.ekskul_id = tb_ekstrakulikuler.id
    WHERE tb_kegiatan.id = ?";
$stmt_kegiatan = $koneksi->prepare($query_kegiatan);
$stmt_kegiatan->bind_param("i", $kegiatan_id);
$stmt_kegiatan->execute();
$result_kegiatan = $stmt_kegiatan->get_result();
$kegiatan = $result_kegiatan->fetch_assoc();

// Ambil data absensi terbaru setelah melakukan absensi
$query_absensi = "
    SELECT tb_absensi.*, tb_anggota.nama AS nama_anggota 
    FROM tb_absensi 
    JOIN tb_anggota ON tb_absensi.anggota_id = tb_anggota.id 
    WHERE tb_absensi.kegiatan_id = ?";
$stmt_absensi = $koneksi->prepare($query_absensi);
$stmt_absensi->bind_param("i", $kegiatan_id);
$stmt_absensi->execute();
$result_absensi = $stmt_absensi->get_result();
$absensi = [];
if ($result_absensi->num_rows > 0) {
    while ($row = $result_absensi->fetch_assoc()) {
        $absensi[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Absen</title>
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
  <div class=" justify-content-center">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="profile-card" style="background-color: #A6A6A6;">
          <div style="background-color: #D9D9D9;">
            <!-- Tabel kegiatan -->
            <div class="p-4 table-responsive">
              <div class="border-1 d-flex p-4" style="background-color: #FFC700;">
                <div class="col-md-6 fw-bold">
                  <h2><u>ABSEN MINGGU KE - <?= htmlspecialchars($kegiatan['minggu_ke']) ?></u></h2>
                  <h6><?= htmlspecialchars($kegiatan['nama_ekskul']) ?></h6>
                </div>
                <div class="col-md-6">
                  <b>Deskripsi Kegiatan:</b>
                  <?= htmlspecialchars($kegiatan['deskripsi']) ?>
                </div>
              </div>
              <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                <thead>
                  <tr style="background-color: #FFF455; text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">Status Kehadiran</th>
                    <th scope="col">Waktu Submit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($absensi as $index => $item): ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($item['nama_anggota']) ?></td>
                      <td><?= htmlspecialchars($item['status']) ?></td>
                      <td><?= htmlspecialchars($item['created_at']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>      
            </div>
            <!-- Finish Tabel absensi -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
