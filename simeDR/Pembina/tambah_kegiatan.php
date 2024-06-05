<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

$user_id = $_SESSION['user_id'];

// Ambil ekskul_id dari user yang sedang login
$query_ekskul = "
    SELECT tb_ekstrakulikuler.id 
    FROM tb_ekstrakulikuler 
    JOIN tb_pembina ON tb_ekstrakulikuler.pembina_id = tb_pembina.id 
    WHERE tb_pembina.user_id = ?";
$stmt_ekskul = $koneksi->prepare($query_ekskul);
$stmt_ekskul->bind_param("i", $user_id);
$stmt_ekskul->execute();
$result_ekskul = $stmt_ekskul->get_result();
$ekskul = $result_ekskul->fetch_assoc();
$ekskul_id = $ekskul['id'];

$nama_kegiatan = $_POST['nama_kegiatan'];
$minggu = $_POST['minggu'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];

// Insert data ke tabel tb_kegiatan
$query_insert = "
    INSERT INTO tb_kegiatan (nama_kegiatan, minggu_ke, tanggal, deskripsi, ekskul_id) 
    VALUES (?, ?, ?, ?, ?)";
$stmt_insert = $koneksi->prepare($query_insert);
$stmt_insert->bind_param("ssssi", $nama_kegiatan, $minggu, $tanggal, $deskripsi, $ekskul_id);

if ($stmt_insert->execute()) {
    $kegiatan_id = $stmt_insert->insert_id; // Ambil id dari kegiatan yang baru ditambahkan
    
    // Ambil daftar anggota dari ekskul_id yang bersangkutan
    $query_anggota = "
        SELECT id 
        FROM tb_anggota 
        WHERE ekskul_id = ?";
    $stmt_anggota = $koneksi->prepare($query_anggota);
    $stmt_anggota->bind_param("i", $ekskul_id);
    $stmt_anggota->execute();
    $result_anggota = $stmt_anggota->get_result();
    $anggota = $result_anggota->fetch_all(MYSQLI_ASSOC);
    
    // Insert data ke tabel tb_absensi untuk setiap anggota dengan status null
    foreach ($anggota as $item) {
        $anggota_id = $item['id'];
        $status = null; // Status awal null
        $keterangan = ''; // Default keterangan bisa disesuaikan
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        $query_absensi = "
            INSERT INTO tb_absensi (anggota_id, ekstrakulikuler_id, tanggal, status, keterangan, created_at, updated_at, kegiatan_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_absensi = $koneksi->prepare($query_absensi);
        $stmt_absensi->bind_param("iisssssi", $anggota_id, $ekskul_id, $tanggal, $status, $keterangan, $created_at, $updated_at, $kegiatan_id);
        $stmt_absensi->execute();
    }
    
    echo "Data kegiatan berhasil ditambahkan dan data absensi berhasil diisi.";
} else {
    echo "Gagal menambahkan data kegiatan: " . $stmt_insert->error;
}

$stmt_insert->close();
$stmt_anggota->close(); // Tambahkan baris ini untuk menutup statement anggota
// Tidak perlu menutup statement absensi karena statement tersebut akan ditutup dalam loop foreach
$koneksi->close();

header("Location: kegiatanEkskul.php");
exit();
?>
