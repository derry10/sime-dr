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
$nama_kegiatan = $_POST['nama_kegiatan'];
$minggu = $_POST['minggu'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];

// Update data kegiatan di tabel tb_kegiatan
$query_update = "
    UPDATE tb_kegiatan 
    SET nama_kegiatan = ?, minggu_ke = ?, tanggal = ?, deskripsi = ? 
    WHERE id = ?";
$stmt_update = $koneksi->prepare($query_update);
$stmt_update->bind_param("ssssi", $nama_kegiatan, $minggu, $tanggal, $deskripsi, $id);

if ($stmt_update->execute()) {
    echo "Data kegiatan berhasil diubah.";
} else {
    echo "Gagal mengubah data kegiatan: " . $stmt_update->error;
}

$stmt_update->close();
$koneksi->close();

header("Location: kegiatanEkskul.php");
exit();
?>
