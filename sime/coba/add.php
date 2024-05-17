<?php
include 'config.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai dari form
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kota = $_POST['kota'];

    // Menyimpan data ke dalam database
    $sql = "INSERT INTO anggota (nama, tanggal_lahir, kota) VALUES ('$nama', '$tanggal_lahir', '$kota')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
