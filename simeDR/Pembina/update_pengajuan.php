<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit();
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'employees_db';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['pengajuan_id'], $input['status'])) {
    $pengajuan_id = $input['pengajuan_id'];
    $status = $input['status'];

    $query_update = "UPDATE tb_pengajuan SET status = ? WHERE id = ?";
    $stmt_update = $koneksi->prepare($query_update);
    $stmt_update->bind_param("si", $status, $pengajuan_id);
    
    if ($stmt_update->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
    $stmt_update->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

mysqli_close($koneksi);
?>
