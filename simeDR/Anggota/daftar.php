<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$koneksi = new mysqli('localhost', 'root', '', 'employees_db');

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan sesi
    $user_id = $_SESSION['user_id'];
    $ekskul_id = $_POST['ekskul_id'];

    // Validasi ekskul_id
    if (empty($ekskul_id)) {
        echo "Ekskul ID harus diisi.";
        exit();
    }

    // Periksa apakah user_id ada di tabel tb_anggota
    $query_check_anggota = "SELECT id FROM tb_anggota WHERE user_id = ?";
    $stmt_check_anggota = $koneksi->prepare($query_check_anggota);
    $stmt_check_anggota->bind_param("i", $user_id);
    $stmt_check_anggota->execute();
    $result_check_anggota = $stmt_check_anggota->get_result();

    if ($result_check_anggota->num_rows == 0) {
        echo "User tidak ditemukan di tabel anggota.";
        exit();
    }

    $anggota = $result_check_anggota->fetch_assoc();
    $anggota_id = $anggota['id'];

    // Insert data ke tb_pengajuan
    $query = "INSERT INTO tb_pengajuan (ekskul_id, anggota_id, status, created_at, updated_at) VALUES (?, ?, 'pending', NOW(), NOW())";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ii", $ekskul_id, $anggota_id);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location='pilihEkskul.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location='pilihEkskul.php';</script>";
    }

    $stmt->close();
}

$koneksi->close();
?>
