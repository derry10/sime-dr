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

$id = $_POST['id'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$nilai = $_POST['nilai'];

$query = "UPDATE tb_anggota SET nama = ?, kelas = ?, jurusan = ?, jenis_kelamin = ?, nilai = ? WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ssssii", $nama, $kelas, $jurusan, $jenis_kelamin, $nilai, $id);

if ($stmt->execute()) {
    header("Location: anggotaNilai.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$stmt->close();
$koneksi->close();
?>
