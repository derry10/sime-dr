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
    $kegiatan_prestasi = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $tanggal_prestasi = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $tingkat = mysqli_real_escape_string($koneksi, $_POST['tingkat']);
    $deskripsi_prestasi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $user_id = $_SESSION['user_id'];

    // Masukkan data ke database
    $query = "INSERT INTO tb_kegiatan (kegiatan_prestasi, tanggal_prestasi, tingkat, deskripsi_prestasi, ekskul_id) VALUES (?, ?, ?, ?, (SELECT id FROM tb_ekstrakulikuler WHERE pembina_id IN (SELECT id FROM tb_pembina WHERE user_id = ?)))";
    
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ssssi", $kegiatan_prestasi, $tanggal_prestasi, $tingkat, $deskripsi_prestasi, $user_id);
    
    if ($stmt->execute()) {
        header("Location: detailprestasi.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
