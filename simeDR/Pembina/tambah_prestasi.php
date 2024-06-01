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

$anggota_id = $_POST['anggota_id'];
$kegiatan = $_POST['kegiatan'];
$tanggal = $_POST['tanggal'];
$tingkat = $_POST['tingkat'];
$deskripsi = $_POST['deskripsi'];

$query = "INSERT INTO tb_prestasi (anggota_id, kegiatan_prestasi, tanggal_prestasi, tingkat, deskripsi_prestasi) VALUES (?, ?, ?, ?, ?)";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("issss", $anggota_id, $kegiatan, $tanggal, $tingkat, $deskripsi);

if ($stmt->execute()) {
    header("Location: prestasi.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$stmt->close();
$koneksi->close();
?>
