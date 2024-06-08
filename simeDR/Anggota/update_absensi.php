<?php
// update_absensi.php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Handle unauthorized access
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'employees_db';

    $koneksi = mysqli_connect($host, $username, $password, $database);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id']; // ini var buat apa? dibuat tapi tidak digunakan??
    $kegiatan_id = $_POST['kegiatan_id'];
    $anggota_id = $_POST['anggota_id'];

    // Update tb_absensi for the given kegiatan_id
    $update_query = "UPDATE tb_absensi SET status = 'hadir' WHERE kegiatan_id = ? AND anggota_id = ?";
    $stmt_update = $koneksi->prepare($update_query);
    $stmt_update->bind_param("ii", $kegiatan_id, $anggota_id);

    if ($stmt_update->execute()) {
        echo "Update berhasil!";
    } else {
        echo "Update gagal: " . mysqli_error($koneksi);
    }

    $stmt_update->close();
    mysqli_close($koneksi);
}
