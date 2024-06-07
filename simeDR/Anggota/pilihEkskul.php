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

// Koneksi ke database MySQL
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Kueri SQL untuk mendapatkan semua kegiatan ekstrakurikuler
$query = "SELECT * FROM tb_ekstrakulikuler";
$result = $koneksi->query($query);

// Ambil array asosiatif dari hasil kueri
$ekskul = $result->fetch_all(MYSQLI_ASSOC);

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Ekskul</title>
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
            <h2 class="justify-content-between text-center">KATEGORI EKSTRAKULIKULER</h2>
            <div class="row">
              <?php foreach($ekskul as $index => $item): ?>
              <div class="col-md-6">
                <div class="card m-4" style="background-color: #FFC700;">
                  <div class="row g-0">
                    
                    <div class="col-md-8 m-2">
                      <h5 class="card-title"><?= $item['nama'] ?></h5>
                      <small class="text-body-secondary"><?= $item['deskripsi'] ?></small>
                    </div>
                    <div class="col-md-3 px-0">
                      <div class="card-body d-flex flex-row-reverse m-1">
                        <form method="POST" action="daftar.php">
                          <input type="hidden" name="ekskul_id" value="<?= $item['id'] ?>">
                          <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>
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
<!-- Finish Content -->

<!-- Include script -->
<?php include 'script.php'; ?>
</body>
</html>
