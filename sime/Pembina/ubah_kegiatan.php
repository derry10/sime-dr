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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_kegiatan = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $minggu = mysqli_real_escape_string($koneksi, $_POST['minggu']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Validasi form
    if (empty($nama_kegiatan) || empty($tanggal) || empty($deskripsi)) {
        echo "Semua field harus diisi.";
        exit();
    }

    // Update data ke database
    $query = "UPDATE tb_kegiatan SET nama_kegiatan='$nama_kegiatan', tanggal='$tanggal', deskripsi='$deskripsi', minggu_ke='$minggu' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: kegiatanEkskul.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
