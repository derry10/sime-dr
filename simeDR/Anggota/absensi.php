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

// Ambil data ekskul_id berdasarkan user_id dari anggota yang sedang login
$query_anggota = "
    SELECT ekskul_id 
    FROM tb_anggota 
    WHERE user_id = ?";
$stmt_anggota = $koneksi->prepare($query_anggota);
$stmt_anggota->bind_param("i", $user_id);
$stmt_anggota->execute();
$result_anggota = $stmt_anggota->get_result();
$anggota = $result_anggota->fetch_assoc();
$ekskul_id = $anggota['ekskul_id'];

// Ambil data nama ekskul berdasarkan ekskul_id
$query_ekskul = "
    SELECT nama 
    FROM tb_ekstrakulikuler 
    WHERE id = ?";
$stmt_ekskul = $koneksi->prepare($query_ekskul);
$stmt_ekskul->bind_param("i", $ekskul_id);
$stmt_ekskul->execute();
$result_ekskul = $stmt_ekskul->get_result();
$ekskul = $result_ekskul->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi</title>
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
              <h2 class="modal-title justify-content-center fw-bold">ABSENSI KEGIATAN EKSTRAKULIKULER</h2>
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
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Ambil data kegiatan dari tabel berdasarkan ekskul_id
                  $query_kegiatan = "
                      SELECT k.id, k.nama_kegiatan, k.tanggal, a.status as hadir, k.deskripsi 
                      FROM tb_kegiatan k
                      LEFT JOIN tb_absensi a ON k.id = a.kegiatan_id AND a.anggota_id = ?
                      WHERE k.ekskul_id = ?";
                  $stmt_kegiatan = $koneksi->prepare($query_kegiatan);
                  $stmt_kegiatan->bind_param("ii", $user_id, $ekskul_id);
                  $stmt_kegiatan->execute();
                  $result_kegiatan = $stmt_kegiatan->get_result();
                  $kegiatan = $result_kegiatan->fetch_all(MYSQLI_ASSOC);

                  if (!empty($kegiatan)) {
                      foreach ($kegiatan as $index => $item):
                  ?>
                    <tr>
                      <th scope="row"><?= $index + 1 ?></th>
                      <td><?= htmlspecialchars($item['nama_kegiatan']) ?></td>
                      <td><?= htmlspecialchars($item['tanggal']) ?></td>
                      <td><?= htmlspecialchars($item['hadir'] == 'present' ? 'Ya' : 'Tidak') ?></td>
                      <td><?= htmlspecialchars($item['deskripsi']) ?></td>
                      <td>
                        <div class="container d-flex justify-content-center align-items-center">
                          <a href="detailabsen.php?kegiatan_id=<?= $item['id'] ?>" class="btn btn-primary px-4 mx-3" style="background-color: #0094FF;">Detail</a>
                          <!-- Tombol hadir -->
                          <?php if ($item['hadir'] == null): ?>
                            <form action="update_absensi.php" method="post">
                              <input type="hidden" name="kegiatan_id" value="<?= $item['id'] ?>">
                              <button type="submit" class="btn btn-success px-4 mx-3" name="hadir" value="hadir">Hadir</button>
                            </form>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php 
                      endforeach;
                  } else {
                      echo "<tr><td colspan='6'>Tidak ada data kegiatan yang ditemukan.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Finish Tabel kegiatan -->
            <div class="modal-footer"></div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn px-4 mt-4" style="background-color: #FFC700; color: #373737; border-radius: 7px;">
              <b>Laporkan</b>
            </a>
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
$stmt_anggota->close();
$stmt_ekskul->close();
$stmt_kegiatan->close();
mysqli_close($koneksi);
?>
