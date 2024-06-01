<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pembina') {
    header("Location: ../login.php");
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
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $hari = mysqli_real_escape_string($koneksi, $_POST['hari']);
    $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);
    $user_id = $_SESSION['user_id'];

    //Process gambar , simpan di folder image
    $image = $_POST['image']; 
    // Dapatkan ID pembina dari tabel tb_pembina
    $pembina_query = "SELECT id FROM tb_pembina WHERE user_id = '$user_id'";
    $pembina_result = mysqli_query($koneksi, $pembina_query);

    if (mysqli_num_rows($pembina_result) > 0) {
        $pembina_row = mysqli_fetch_assoc($pembina_result);
        $pembina_id = $pembina_row['id'];

        // Validasi form
        if (empty($nama) || empty($deskripsi) || empty($hari) || empty($jam)) {
            echo "Semua field harus diisi.";
            exit();
        }

        // Masukkan data ke database
        $query = "INSERT INTO tb_ekstrakulikuler (nama, deskripsi, pembina_id, hari, jam,) VALUES ('$nama', '$deskripsi', '$pembina_id', '$hari', '$jam')";
        if (mysqli_query($koneksi, $query)) {
            echo "Ekskul baru berhasil dibuat.";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Pembina tidak ditemukan.";
    }

    mysqli_close($koneksi);
}
?>
