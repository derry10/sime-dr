<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kegiatan_id = $_POST['kegiatan_id'];
    $status = 'hadir';

    // Lakukan pembaruan status absensi ke hadir
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'employees_db';

    $koneksi = mysqli_connect($host, $username, $password, $database);

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Update status absensi ke hadir hanya untuk anggota yang sedang login
    $query_update = "UPDATE tb_absensi SET status = ? WHERE kegiatan_id = ? AND anggota_id = ?";
    $stmt_update = $koneksi->prepare($query_update);
    $stmt_update->bind_param("sii", $status, $kegiatan_id, $user_id);

    if ($stmt_update->execute()) {
        // Jika berhasil, kirim parameter 'success' ke halaman detailabsen.php
        header("Location: detailabsen.php?success=true");
        exit();
    } else {
        // Jika gagal, kirim parameter 'success' ke halaman detailabsen.php
        header("Location: detailabsen.php?success=false");
        exit();
    }

    $stmt_update->close();
    mysqli_close($koneksi);

} else {
    header("Location: kegiatanEkskul.php");
    exit();
}
?>
