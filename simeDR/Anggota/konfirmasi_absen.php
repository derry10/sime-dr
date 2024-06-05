<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$koneksi = new mysqli('localhost', 'root', '', 'employees_db');

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $kegiatan_id = $_POST['kegiatan_id'];

    if (empty($kegiatan_id)) {
        echo "Kegiatan ID harus diisi.";
        exit();
    }

    // Perbarui status kehadiran di tb_absensi dari NULL menjadi "hadir"
    $query = "UPDATE tb_absensi SET status = 'hadir' WHERE anggota_id = ? AND kegiatan_id = ? AND status IS NULL";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ii", $user_id, $kegiatan_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Kehadiran berhasil dikonfirmasi.'); window.location='absensi.php';</script>";
        } else {
            echo "<script>alert('Anda sudah mengkonfirmasi kehadiran untuk kegiatan ini.'); window.location='absensi.php';</script>";
        }
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location='absensi.php';</script>";
    }

    $stmt->close();
}

$koneksi->close();
?>
