<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pembina') {
    header("Location: ../login.php");
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

// Query untuk mendapatkan data ekstrakurikuler berdasarkan user_id
$query = "SELECT e.nama, e.deskripsi, e.hari, e.jam 
          FROM tb_ekstrakulikuler e
          JOIN tb_pembina p ON e.pembina_id = p.id
          WHERE p.user_id = " . $_SESSION['user_id'];

$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <div class="col-md-10">
        <div class="profile-card">
          <div class="container"> 
            <h2 class="justify-content-between text-center" >KATEGORI EKSTRAKULIKULER</h2>
            <div class="row">
              <div class="col-md-6 ">
                <div class="card-container">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="card">';
                            echo '<h1>' . $row['nama'] . '</h1>';
                            echo '<h3>Hari: ' . $row['hari'] . '</h3>';
                            echo '<h3>Jam: ' . $row['jam'] . '</h3>';
                            echo '<p>' . $row['deskripsi'] . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">Tidak ada ekstrakurikuler yang ditemukan.</p>';
                    }
                    mysqli_close($koneksi);
                    ?>
                </div>
                
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
