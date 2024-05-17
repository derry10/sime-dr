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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anggota_id = mysqli_real_escape_string($koneksi, $_POST['anggota_id']);
    $kegiatan_prestasi = mysqli_real_escape_string($koneksi, $_POST['kegiatan_prestasi']);
    $tanggal_prestasi = mysqli_real_escape_string($koneksi, $_POST['tanggal_prestasi']);    
    $tingkat = mysqli_real_escape_string($koneksi, $_POST['tingkat']);
    $deskripsi_prestasi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_prestasi']);
    $user_id = $_SESSION['user_id'];

    // Ambil user_id dari tabel tb_pembina berdasarkan pembina_id
    $query_prestasi = "SELECT id FROM tb_pembina WHERE user_id = (SELECT id FROM tb_pembina WHERE nama = ?)";
    $stmt_prestasi = $koneksi->prepare($query_prestasi);
    $stmt_prestasi->bind_param("i", $user_id);
    $stmt_prestasi->execute();
    $result_prestasi = $stmt_prestasi->get_result();
    
    if ($result_prestasi->num_rows > 0) {
        $row_prestasi = $result_prestasi->fetch_assoc();
        $anggota_id = $row_prestasi['id'];

        // Validasi form
        if (empty($kegiatan_prestasi) || empty($tanggal_prestasi) || empty($tingkat) || empty($deskripsi_prestasi)) {
            echo "Semua field harus diisi.";
            exit();
        }

        // Masukkan data ke database
        $query = "INSERT INTO tb_prestasi (kegiatan_prestasi, tanggal_prestasi, deskripsi, tingkat, deskripsi_prestasi ekskul_id,) VALUES ('$kegiatan_prestasi', '$tanggal_prestasi', '$tingkat', '$deskripsi_prestasi', 0,)";
        if (mysqli_query($koneksi, $query)) {
            header("Location: detailprestasi.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "ID Ekskul tidak ditemukan untuk pembina ini.";
    }

    mysqli_close($koneksi);
}
?>
