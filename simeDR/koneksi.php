<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    // Mencari pengguna berdasarkan email dan level
    $sql = "SELECT * FROM users WHERE email = '$email' AND role = '$level'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Redirect berdasarkan level
            switch ($level) {
                case 'anggota':
                    header('Location: Anggota/dashboard.php');
                    break;
                case 'pembina':
                    header('Location: Pembina/dashboard.php');
                    break;
                default:
                    header('Location: dashboard.php');
                    break;
            }
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
}
?>
