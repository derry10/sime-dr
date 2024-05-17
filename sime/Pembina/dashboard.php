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
  <title>Profil</title>
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
  <div class="container m-3">
          <div class="card" style="background-color: #D9D9D9;"> 
                  <!--Start Tabel prestasi -->
            <div class="container p-4 table-responsive" >
              <h5 style="color: #373737">Selamat datang, user</h5>
            </div>
            <!--Finish Tabel prestasi -->
    </div> 
  </div>      
</div>      
<!-- Finish Content -->
<!-- script -->
<?php include 'script.php'; ?>

</body>
</html>
