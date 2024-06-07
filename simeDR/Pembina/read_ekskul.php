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

// Query untuk mendapatkan data ekstrakurikuler
$query = "SELECT e.nama, e.deskripsi, e.hari, e.jam FROM tb_ekstrakulikuler e
          JOIN tb_pembina p ON e.pembina_id = p.id
          WHERE p.user_id = " . $_SESSION['user_id'];

$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ekskul</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #007F73;
        font-family: 'Poppins', sans-serif;
        color: #fff;
        margin: 0;
        padding: 20px;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .card {
        background-color: #FFC700;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 300px;
        color: black;
    }
    </style>
</head>
<body>

<h3 class="text-center">Daftar Ekskul</h3>
<div class="card-container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<h1>' . $row['nama'] . '</h1>';
            echo '<h3>Hari: ' . $row['hari'] . '</h3>';
            echo '<h3>Jam: ' . $row['jam'] . '</h3>';
            echo '<p>' . $row['deskripsi'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">Tidak ada ekstrakurikuler yang ditemukan.</p>';
    }
    mysqli_close($koneksi);
    ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
