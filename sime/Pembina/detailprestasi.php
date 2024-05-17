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

// Ambil data kegiatan dari tabel berdasarkan ekskul_id
$query_kegiatan = "
    SELECT nama_kegiatan, tanggal_prestasi, tingkat, deskripsi_prestasi
    FROM tb_kegiatan 
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
<!-- Include Navbar -->
<?php include 'navbar.php'; ?>

<!-- Include Sidebar -->
<?php include 'sidebar.php'; ?>
<body>
<!-- Start Content -->
<div class="content">
  <div class="container justify-content-center ">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="profile-card" style="background-color: #A6A6A6;">
          <div class="container" style="background-color: #D9D9D9;"> 
                  <!--Start Tabel prestasi -->
            <div class="container p-4 table-responsive" >
            <h2 class="justify-content-center text-center fw-bold mb-4" >DETAIL PRESTASI</h2>
                <table class="table table-bordered border-2" style="background-color: #FFF455; border: 2px;">
                <thead>
                    <tr>
                        <!-- Kolom Header -->
                    </tr>
                </thead>
                <tbody>
                <?php
                  // Menampilkan data kegiatan dalam tabel
                  foreach ($kegiatan as $index => $item):
                  ?>
                    <tr>
                        <!-- Menampilkan data kegiatan -->
                    </tr>
                 <?php endforeach; ?>
                 </tbody>
                
                </table>
                <div class="modal-footer">
                    <!-- Tombol Tambahkan -->
                </div>       
             </div>
      <!--Finish Tabel prestasi -->
          </div>
          <div class="modal-footer">
            <!-- Tombol Kembali -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->
<!-- Start Popup Tambahkan -->
<div id="tambahkan" class="modal fade" tabindex="-1" aria-labelledby="dataDisimpan" aria-hidden="true">
  <!-- Konten Popup Tambahkan -->
</div>
<!-- Finish Popup Tambahkan -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Script untuk menangani event modal
});
</script>
</body>
</html> 
