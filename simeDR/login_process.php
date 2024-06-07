<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Validasi form
    if (empty($email) || empty($password)) {
        echo "Email dan password harus diisi.";
        exit();
    }

    // Cek email di database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect ke dashboard berdasarkan role
            if ($user['role'] == 'anggota') {
                header("Location: Anggota/dashboard.php");
            } elseif ($user['role'] == 'pembina') {
                header("Location: Pembina/dashboard.php");
            }
            exit();
        } else {
            echo "Password salah.";
            exit();
        }
    } else {
        echo "Email tidak terdaftar.";
        exit();
    }

    mysqli_close($koneksi);
}
?>
