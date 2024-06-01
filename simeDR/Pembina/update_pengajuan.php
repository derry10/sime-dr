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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $pengajuan_id = $data['pengajuan_id'];
    $status = $data['status'];

    // Dapatkan data pengajuan
    $query_pengajuan = "SELECT * FROM tb_pengajuan WHERE id = ?";
    $stmt_pengajuan = $koneksi->prepare($query_pengajuan);
    $stmt_pengajuan->bind_param("i", $pengajuan_id);
    $stmt_pengajuan->execute();
    $result_pengajuan = $stmt_pengajuan->get_result();
    $pengajuan = $result_pengajuan->fetch_assoc();

    if ($pengajuan) {
        // Perbarui status pengajuan
        $update_query = "UPDATE tb_pengajuan SET status = ? WHERE id = ?";
        $stmt_update = $koneksi->prepare($update_query);
        $stmt_update->bind_param("si", $status, $pengajuan_id);
        if ($stmt_update->execute()) {
            if ($status == 'approved') {
                // Masukkan data ke tabel tb_anggota
                $anggota_query = "INSERT INTO tb_anggota (user_id, nama, email, jenis_kelamin, ekskul_id) VALUES (?, ?, ?, ?, ?)";
                $stmt_anggota = $koneksi->prepare($anggota_query);
                $stmt_anggota->bind_param("isssi", $pengajuan['user_id'], $pengajuan['nama'], $pengajuan['email'], $pengajuan['jenis_kelamin'], $pengajuan['ekskul_id']);
                if ($stmt_anggota->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan ke tabel anggota.']);
                }
            } else {
                echo json_encode(['success' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status pengajuan.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Pengajuan tidak ditemukan.']);
    }

    $stmt_pengajuan->close();
}

$koneksi->close();
?>
