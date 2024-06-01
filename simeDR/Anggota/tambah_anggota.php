<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $ekstrakulikuler = $_POST['ekstrakulikuler'];

    $sql = "INSERT INTO tb_ekstrakulikuler (nama, kelas, jurusan, jenis_kelamin, ekstrakulikuler)
            VALUES ('$nama', '$kelas', '$jurusan', '$jenis_kelamin', '$ekstrakulikuler')";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
