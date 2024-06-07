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

$anggota_id = $_POST['anggota_id'];

// Query untuk mengambil prestasi anggota berdasarkan anggota_id
$query_prestasi = "
    SELECT * 
    FROM tb_prestasi 
    WHERE anggota_id = ?";
$stmt_prestasi = $koneksi->prepare($query_prestasi);
$stmt_prestasi->bind_param("i", $anggota_id);
$stmt_prestasi->execute();
$result_prestasi = $stmt_prestasi->get_result();

if ($result_prestasi->num_rows > 0) {
    while ($row = $result_prestasi->fetch_assoc()) {
        echo '
        <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['kegiatan'] . '</td>
            <td>' . $row['tanggal'] . '</td>
            <td>' . $row['tingkat'] . '</td>
            <td>' . $row['deskripsi'] . '</td>
            <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPrestasiModal" 
                data-prestasi-id="' . $row['id'] . '" 
                data-kegiatan="' . $row['kegiatan'] . '" 
                data-tanggal="' . $row['tanggal'] . '" 
                data-tingkat="' . $row['tingkat'] . '" 
                data-deskripsi="' . $row['deskripsi'] . '">Edit</button>
            </td>
            <td>
                <form action="hapus_prestasi.php" method="post">
                    <input type="hidden" name="id" value="' . $row['id'] . '">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        ';
    }
} else {
    echo '<tr><td colspan="7" class="text-center">Tidak ada data prestasi</td></tr>';
}

$stmt_prestasi->close();
$koneksi->close();
?>
