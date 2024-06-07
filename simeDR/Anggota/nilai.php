<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Parameter koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mendapatkan ID pengguna yang login
$user_id = $_SESSION['user_id'];

// Query untuk mengambil nilai dari tabel tb_anggota berdasarkan ID pengguna yang login
$query = "SELECT nilai FROM tb_anggota WHERE user_id = $user_id";

$result = $conn->query($query);

// Memeriksa apakah query berhasil dieksekusi
if (!$result) {
    echo "Error: " . $conn->error;
}

// Kueri SQL untuk mendapatkan semua kegiatan ekstrakurikuler yang diikuti oleh pengguna yang sedang login
$query_ekskul = "SELECT tb_ekstrakulikuler.* FROM tb_ekstrakulikuler
                INNER JOIN tb_anggota ON tb_ekstrakulikuler.id = tb_anggota.ekskul_id
                WHERE tb_anggota.user_id = $user_id";
$result_ekskul = $conn->query($query_ekskul);

// Memeriksa apakah query berhasil dieksekusi
if (!$result_ekskul) {
    echo "Error: " . $conn->error;
}

// Ambil array asosiatif dari hasil kueri
$ekskul = $result_ekskul->fetch_all(MYSQLI_ASSOC);

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nilai</title>
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
          <div class="p-3" style="background-color: #D9D9D9;">
            <!-- Tabel kegiatan -->
            <h2 class="justify-content-between text-center m-3">PENILAIAN SELAMA DI EKSTRAKULIKULER</h2>
            <div class="row">
              <?php foreach($ekskul as $index => $item): ?>
              <div class="col-md-6">
                <div class="card m-4" style="background-color: #FFC700;">
                  <div class="row g-0">
                    <div class="col-md-8 m-2">
                      <h5 class="card-title">Ekstrakulikuler <?= $item['nama'] ?></h5>
                      <small class="t ext-body-secondary"><?= $item['deskripsi'] ?></small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <button class="btn px-4" style="background-color: #0094FF; color: #ffffff; border-radius: 7px;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup">
                        Lihat Nilai</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->


<!-- Start Popup 1 -->
<div id="ubahDataPopup" class="modal fade" tabindex="-1" aria-labelledby="ubahDataPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content p-3">
        <div class="modal-header">
          <div class="col-md-3"></div>
          <h5 class="modal-title justify-content-between fw-bold col-md-6">NILAI ANDA ADALAH</h5>
          <button type="button" class="btn-close col-md-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="card-content">
          <div class="justify-content-center text-center" style="background-color: yellow; border:50 50;">
          <?php
          // Menampilkan nilai pada halaman web
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<h1>" . $row['nilai'] . "</h1>";
          } else {
              echo "<p>Nilai belum ada.</p>";
          }
          ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="background-color: #007F73;" data-bs-dismiss="modal">Selesai</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Finish Popup -->

<!-- script -->
<?php include 'script.php'; ?>

</body>
</html>
