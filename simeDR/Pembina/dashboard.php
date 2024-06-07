<?php
session_start();

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil ID pengguna dari sesi (sesuaikan dengan implementasi Anda)
$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body text-center">
            <h1 class="card-title">Selamat datang, <?= htmlspecialchars($user['name']) ?>!</h1>
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
