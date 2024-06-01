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
    $nama_kegiatan = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $minggu = mysqli_real_escape_string($koneksi, $_POST['minggu']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $user_id = $_SESSION['user_id'];

    // Ambil ekskul_id dari tabel tb_ekstrakulikuler berdasarkan pembina_id
    $query_ekskul = "SELECT id FROM tb_ekstrakulikuler WHERE pembina_id = (SELECT id FROM tb_pembina WHERE user_id = ?)";
    $stmt_ekskul = $koneksi->prepare($query_ekskul);
    $stmt_ekskul->bind_param("i", $user_id);
    $stmt_ekskul->execute();
    $result_ekskul = $stmt_ekskul->get_result();
    
    if ($result_ekskul->num_rows > 0) {
        $row_ekskul = $result_ekskul->fetch_assoc();
        $ekskul_id = $row_ekskul['id'];

        // Validasi form
        if (empty($nama_kegiatan) || empty($tanggal) || empty($deskripsi)) {
            echo "Semua field harus diisi.";
            exit();
        }

        // Masukkan data ke database
        $query = "INSERT INTO tb_kegiatan (nama_kegiatan, tanggal, deskripsi, ekskul_id, hadir,minggu_ke) VALUES ('$nama_kegiatan', '$tanggal', '$deskripsi', '$ekskul_id', 0,'$minggu')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: kegiatanEkskul.php");
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
