<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$anggota_id = $_POST['anggota_id'];

$query = "SELECT * FROM tb_prestasi WHERE anggota_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $anggota_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Kegiatan:</strong> " . htmlspecialchars($row['kegiatan_prestasi']) . "</p>";
        echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($row['tanggal_prestasi']) . "</p>";
        echo "<p><strong>Tingkat:</strong> " . htmlspecialchars($row['tingkat']) . "</p>";
        echo "<p><strong>Deskripsi:</strong> " . htmlspecialchars($row['deskripsi_prestasi']) . "</p>";
        echo "<hr>";
    }
} else {
    echo "<p>Belum ada prestasi yang tercatat.</p>";
}

$stmt->close();
$koneksi->close();
?>
