<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namalengkap = mysqli_real_escape_string($koneksi, $_POST['namalengkap']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $ulangpassword = mysqli_real_escape_string($koneksi, $_POST['ulangpassword']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    // Validasi form
    if (empty($namalengkap) || empty($email) || empty($password) || empty($ulangpassword) || empty($level)) {
        echo "Semua field harus diisi.";
        exit();
    }

    if ($password !== $ulangpassword) {
        echo "Password tidak sama.";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($koneksi, $checkEmailQuery);
    if (mysqli_num_rows($checkEmailResult) > 0) {
        echo "Email sudah terdaftar.";
        exit();
    }

    // Masukkan data ke database
    $query = "INSERT INTO users (name, email, password, role, username) VALUES ('$namalengkap', '$email', '$hashedPassword', '$level','$namalengkap')";
    if (mysqli_query($koneksi, $query)) {
        // Dapatkan ID pengguna yang baru saja dibuat
        $user_id = mysqli_insert_id($koneksi);

        // Tambahkan ke tabel tb_anggota atau tb_pembina berdasarkan level
        if ($level == 'anggota') {
            $anggota_query = "INSERT INTO tb_anggota (user_id, nama, email) VALUES ('$user_id', '$namalengkap', '$email')";
            if (!mysqli_query($koneksi, $anggota_query)) {
                echo "Error: " . $anggota_query . "<br>" . mysqli_error($koneksi);
                exit();
            }
        } elseif ($level == 'pembina') {
            $pembina_query = "INSERT INTO tb_pembina (user_id, nama, email) VALUES ('$user_id', '$namalengkap', '$email')";
            if (!mysqli_query($koneksi, $pembina_query)) {
                echo "Error: " . $pembina_query . "<br>" . mysqli_error($koneksi);
                exit();
            }
        }

        echo "Registrasi berhasil.";
        header("Location: register_success.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
