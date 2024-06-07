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

$anggota_id = $_GET['anggota_id'];

$query = "SELECT id, kegiatan_prestasi AS kegiatan, tanggal_prestasi AS tanggal, tingkat, deskripsi_prestasi AS deskripsi FROM tb_prestasi WHERE anggota_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $anggota_id);
$stmt->execute();
$result = $stmt->get_result();
$prestasi = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($prestasi);

$stmt->close();
$koneksi->close();
?>
