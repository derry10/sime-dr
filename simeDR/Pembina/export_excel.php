<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-excel.xlsx"); 

?>
<?php
require 'path/to/vendor/autoload.php'; // Sesuaikan dengan path ke autoload.php PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Tambahkan data header
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama Ekskul');
$sheet->setCellValue('C1', 'Nama Anggota');
$sheet->setCellValue('D1', 'Kelas');
$sheet->setCellValue('E1', 'Jurusan');
$sheet->setCellValue('F1', 'Jenis Kelamin');
$sheet->setCellValue('G1', 'Nilai');

// Tambahkan data dari database
foreach ($anggota as $index => $item) {
    $row = $index + 2; // Mulai dari baris kedua
    $sheet->setCellValue('A' . $row, $index + 1);
    $sheet->setCellValue('B' . $row, $ekskul['nama_ekskul']);
    $sheet->setCellValue('C' . $row, $item['nama']);
    $sheet->setCellValue('D' . $row, $item['kelas']);
    $sheet->setCellValue('E' . $row, $item['jurusan']);
    $sheet->setCellValue('F' . $row, $item['jenis_kelamin']);
    $sheet->setCellValue('G' . $row, $item['nilai']);
}

// Set judul file
$filename = 'Data_Anggota_Nilai.xlsx';

// Redirect output ke file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit();
