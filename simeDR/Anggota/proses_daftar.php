<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Parameter koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

// Koneksi ke database MySQL
$koneksi = new mysqli($host, $username, $password, $database);

// Periksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil ID pengguna dari sesi
$user_id = $_SESSION['user_id'];

// Ambil ekskul_id dari request POST
$ekskul_id = $_POST['ekskul_id'];

// Masukkan data ke tabel tb_pengajuan
$sql = "INSERT INTO tb_pengajuan (ekskul_id, user_id) VALUES (?, ?)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $ekskul_id, $user_id);

if ($stmt->execute()) {
    echo "Pendaftaran berhasil!";
} else {
    echo "Pendaftaran gagal: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>
