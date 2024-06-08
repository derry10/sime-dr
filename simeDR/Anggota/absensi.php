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
    SELECT id, ekskul_id 
    FROM tb_anggota 
    WHERE user_id = ?";
$stmt_anggota = $koneksi->prepare($query_anggota);
$stmt_anggota->bind_param("i", $user_id);
$stmt_anggota->execute();
$result_anggota = $stmt_anggota->get_result();
$anggota = $result_anggota->fetch_assoc();
$anggota_id = $anggota['id'];
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

// Ambil data kegiatan yang memiliki kegiatan_id yang valid
$query_kegiatan = "
    SELECT k.id, k.nama_kegiatan, k.tanggal, COUNT(a.status) AS jumlah_hadir, k.deskripsi
    FROM tb_kegiatan k
    LEFT JOIN tb_absensi a ON k.id = a.kegiatan_id
    WHERE k.ekskul_id = ? AND k.id IS NOT NULL
    GROUP BY k.id";
$stmt_kegiatan = $koneksi->prepare($query_kegiatan);
$stmt_kegiatan->bind_param("i", $ekskul_id);
$stmt_kegiatan->execute();
$result_kegiatan = $stmt_kegiatan->get_result();
$kegiatan = $result_kegiatan->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absen</title>
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
  <!-- Content -->
  <div class="content">
    <div class=" justify-content-center">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="profile-card" style="background-color: #A6A6A6;">
            <div style="background-color: #D9D9D9;">
              <!-- Tabel kegiatan -->
              <div class="p-4 table-responsive">
                <h2 class="modal-title justify-content-center fw-bold">ABSENSI KEGIATAN EKSTRAKULIKULER</h2>
                <p class="modal-title justify-content-center fw-bold mb-4"><?= htmlspecialchars($ekskul['nama']) ?></p>
                <table class="table table-bordered" style="background-color: #FFFFFF; border: 2px;">
                  <thead>
                    <tr style="background-color: #FFF455; text-align: center;">
                      <th scope="col">No</th>
                      <th scope="col">Nama Kegiatan</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Jumlah Hadir</th>
                      <th scope="col">Deskripsi Kegiatan</th>
                      <th scope="col">Detail Absen</th>
                      <th scope="col">Konfirmasi Kehadiran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Loop through each kegiatan to display in the table
                    foreach ($kegiatan as $index => $item) :
                    ?>
                      <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= htmlspecialchars($item['nama_kegiatan']) ?></td>
                        <td><?= htmlspecialchars($item['tanggal']) ?></td>
                        <td><?= htmlspecialchars($item['jumlah_hadir']) ?></td>
                        <td><?= htmlspecialchars($item['deskripsi']) ?></td>
                        <td>
                          <div class="container d-flex justify-content-center align-items-center">
                            <a href="detailabsen.php?kegiatan_id=<?= $item['id'] ?>" class="btn btn-primary px-4 mx-3" style="background-color: #0094FF;">Detail</a>
                          </div>
                        </td>
                        <td>
                          <div class="container d-flex justify-content-center align-items-center">
                            <button class="btn btn-success px-4 mx-3 confirm-attendance" data-anggota-id="<?= $anggota_id ?>" data-kegiatan-id="<?= $item['id'] ?>">Konfirmasi Kehadiran</button>
                          </div>
                        </td>
                      </tr>
                    <?php
                    endforeach;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Finish Content -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.confirm-attendance').click(function() {
        var button = $(this); // Memilih tombol yang diklik
        var anggota_id = button.data('anggota-id');
        var kegiatan_id = button.data('kegiatan-id');
        var sudahAbsen = button.data('sudah-absen'); // Mengecek apakah tombol sudah diklik sebelumnya

        // Jika tombol sudah diklik sebelumnya, maka tidak lakukan apa-apa
        if (sudahAbsen) {
          return;
        }

        $.ajax({
          url: 'update_absensi.php', // PHP script to handle the update
          method: 'POST',
          data: {
            anggota_id: anggota_id,
            kegiatan_id: kegiatan_id
          },
          success: function(response) {
            // Handle success, show a success message
            alert('Kehadiran berhasil dikonfirmasi!');
            // Mengubah teks tombol menjadi "Sudah Absen"
            button.text('Sudah Absen');
            // Menonaktifkan tombol dengan mengubah kelas dan properti
            button.removeClass('btn-success').addClass('btn-secondary').prop('disabled', true);
            // Mengatur atribut data bahwa tombol sudah diklik
            button.data('sudah-absen', true);
          },
          error: function(xhr, status, error) {
            // Handle error, show an error message
            alert('Gagal mengkonfirmasi kehadiran. Silakan coba lagi.');
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>




</body>

</html>

<?php
$stmt_anggota->close();
$stmt_ekskul->close();
$stmt_kegiatan->close();
mysqli_close($koneksi);
?>