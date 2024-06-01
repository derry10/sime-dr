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

$id = $_GET['id'];

$query = "UPDATE tb_anggota SET ekskul_id = NULL WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: anggotaNilai.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$stmt->close();
$koneksi->close();
?>
