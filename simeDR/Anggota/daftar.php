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

// Periksa apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data ekskul_id dari form
    $ekskul_id = $_POST['ekskul_id'];

    // Ambil user_id dari sesi pengguna
    $user_id = $_SESSION['user_id'];

    // Kueri SQL untuk memperbarui ekskul_id di tb_anggota berdasarkan user_id
    $query_update_anggota = "UPDATE tb_anggota SET ekskul_id = '$ekskul_id' WHERE user_id = '$user_id'";

    // Eksekusi kueri untuk memperbarui ekskul_id di tb_anggota
    if ($koneksi->query($query_update_anggota) === TRUE) {
        // Jika berhasil memperbarui tb_anggota, tambahkan data ke tb_pengajuan
        // Periksa apakah user_id ada di tabel tb_anggota
        $query_check_anggota = "SELECT id FROM tb_anggota WHERE user_id = '$user_id'";
        $result_check_anggota = $koneksi->query($query_check_anggota);

        if ($result_check_anggota->num_rows == 1) {
            $row = $result_check_anggota->fetch_assoc();
            $anggota_id = $row['id'];

            // Insert data ke tb_pengajuan
            $query_insert_pengajuan = "INSERT INTO tb_pengajuan (anggota_id, ekskul_id, status, created_at, updated_at) VALUES ('$anggota_id', '$ekskul_id', 'pending', NOW(), NOW())";

            if ($koneksi->query($query_insert_pengajuan) === TRUE) {
                echo "<script>alert('Pendaftaran berhasil!'); window.location='pilihEkskul.php';</script>";
            } else {
                echo "Gagal menambahkan data ke tb_pengajuan: " . $koneksi->error;
            }
        } else {
            echo "User tidak ditemukan di tabel anggota.";
        }
    } else {
        echo "Gagal memperbarui tb_anggota: " . $koneksi->error;
    }
} else {
    // Redirect jika tidak ada data yang dikirimkan melalui metode POST
    header("Location: index.php");
    exit();
}

$koneksi->close();
?>
