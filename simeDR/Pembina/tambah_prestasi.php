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

$nama_anggota = $_POST['anggota_id']; // Mengambil nama anggota dari formulir
$kegiatan = $_POST['kegiatan'];
$tanggal = $_POST['tanggal'];
$tingkat = $_POST['tingkat'];
$deskripsi = $_POST['deskripsi'];

// Dapatkan ekskul_id dan pastikan nama anggota yang dikirimkan tidak kosong
$query_ekskul = "SELECT ekskul_id FROM tb_anggota WHERE nama = ?";
$stmt_ekskul = $koneksi->prepare($query_ekskul);
$stmt_ekskul->bind_param("s", $nama_anggota);
$stmt_ekskul->execute();
$result_ekskul = $stmt_ekskul->get_result();

if ($result_ekskul->num_rows > 0) {
    $row = $result_ekskul->fetch_assoc();
    $ekskul_id = $row['ekskul_id'];

    // Dapatkan anggota_id berdasarkan nama anggota
    $query_anggota_id = "SELECT id FROM tb_anggota WHERE nama = ?";
    $stmt_anggota_id = $koneksi->prepare($query_anggota_id);
    $stmt_anggota_id->bind_param("s", $nama_anggota);
    $stmt_anggota_id->execute();
    $result_anggota_id = $stmt_anggota_id->get_result();
    $row_anggota_id = $result_anggota_id->fetch_assoc();
    $anggota_id = $row_anggota_id['id'];

    $query = "INSERT INTO tb_prestasi (anggota_id, kegiatan_prestasi, tanggal_prestasi, tingkat, deskripsi_prestasi, ekskul_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("issssi", $anggota_id, $kegiatan, $tanggal, $tingkat, $deskripsi, $ekskul_id);

    if ($stmt->execute()) {
        // Prestasi berhasil ditambahkan
        echo "<script>alert('Prestasi berhasil ditambahkan!');</script>";
        echo "<script>window.location.href='prestasi.php';</script>";
    } else {
        // Prestasi gagal ditambahkan
        echo "<script>alert('Prestasi gagal ditambahkan!');</script>";
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }

    $stmt->close();
} else {
    echo "Error: Anggota tidak ditemukan untuk nama = $nama_anggota.";
}

$stmt_ekskul->close();
$koneksi->close();
?>
