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

// Proses pembaruan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['namaLengkap'];
    $email = $_POST['email'];

    // Update data pengguna di database
    $update_query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $koneksi->prepare($update_query);
    $stmt->bind_param("ssi", $nama_lengkap, $email, $user_id); // Ubah "ssssi" menjadi "ssi"
    if ($stmt->execute()) {
        // Jika berhasil, refresh halaman untuk memuat data terbaru
        header("Location: profil.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }
}


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
  <div class="container justify-content-center">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="profile-card">
          
          <div class="form-label mb-2 mx-3" style="color: black;">
            Nama Lengkap
            <div class="card mb-3 p-2">
              <p class="card-text"><?= htmlspecialchars($user['name']) ?></p>
            </div>
          </div>
          <div class="form-label mb-2 mx-3" style="color: black;">
            Email
            <div class="card mb-3 p-2">
              <p class="card-text"><?= htmlspecialchars($user['email']) ?></p>
            </div>
          </div>
          <div class="card border-0 mb-2 mx-3">
            <button class="btn btn-secondary border-0" type="button" style="background-color: #FFC700;" data-bs-toggle="modal" data-bs-target="#ubahDataPopup">
            UBAH DATA</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Finish Content -->

<!-- Start Popup Ubah Data -->
<div id="ubahDataPopup" class="modal fade" tabindex="-1" aria-labelledby="ubahDataPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title justify-content-center fw-bold">UBAH DATA PROFIL</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" value="<?= htmlspecialchars($user['name']) ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
<!-- Finish Popup Ubah Data -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($koneksi);
?>
