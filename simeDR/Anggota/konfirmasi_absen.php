<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'employees_db';

    $koneksi = mysqli_connect($host, $username, $password, $database);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];
    $kegiatan_id = $_POST['kegiatan_id'];
    $status = $_POST['status'];

    // Perbarui atau tambahkan data absensi kehadiran ke database
    $query_absensi = "INSERT INTO tb_absensi (anggota_id, kegiatan_id, status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = ?";
    $stmt_absensi = $koneksi->prepare($query_absensi);
    $stmt_absensi->bind_param("iiii", $user_id, $kegiatan_id, $status_kehadiran, $status_kehadiran);
    $stmt_absensi->execute();

    mysqli_close($koneksi);
    header("Location: detailabsen.php?kegiatan_id=$kegiatan_id");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
