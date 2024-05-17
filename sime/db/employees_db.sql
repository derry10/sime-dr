-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2024 pada 05.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employees_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `name`, `role`, `salary`) VALUES
(1, 'elangmra', 'CEO', 10),
(2, 'Ayu Utami', 'COO', 5),
(3, 'Orhan Pamuk', 'Marketing  Director', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'pembina'),
(2, 'kepalasekolah'),
(3, 'anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `anggota_id` int(11) DEFAULT NULL,
  `ekstrakulikuler_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `nohp` varchar(13) DEFAULT NULL,
  `jabatan_ekskul` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ekstrakulikuler`
--

CREATE TABLE `tb_ekstrakulikuler` (
  `id` int(11) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `nama` varchar(55) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `pembina_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jam` time NOT NULL,
  `hari` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_ekstrakulikuler`
--

INSERT INTO `tb_ekstrakulikuler` (`id`, `nilai`, `nama`, `deskripsi`, `pembina_id`, `created_at`, `updated_at`, `jam`, `hari`) VALUES
(2, NULL, 'Kayak', 'dadsadaddads', 1, '2024-05-15 02:51:43', '2024-05-15 02:51:43', '10:53:00', 'Rabu'),
(3, NULL, 'Pramuka', 'Praja Muda Karana', 2, '2024-05-15 11:51:52', '2024-05-15 11:51:52', '15:00:00', 'Rabu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `hadir` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `ekskul_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `minggu_ke` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `nama_kegiatan`, `tanggal`, `hadir`, `deskripsi`, `ekskul_id`, `created_at`, `updated_at`, `minggu_ke`) VALUES
(1, 'Perkenalana', '2024-05-16', 0, 'adsdadda', 1, '2024-05-15 03:06:45', '2024-05-15 03:06:45', NULL),
(3, 'Perkenalans', '2024-05-25', 0, 'sdsadad', 2, '2024-05-15 03:13:29', '2024-05-15 03:39:48', '1'),
(4, 'sadadsad', '2024-05-30', 0, 'dasad', 2, '2024-05-15 03:44:34', '2024-05-15 03:44:34', '2'),
(5, 'hgjgjhghjl', '2024-05-17', 0, 'jjkihiuhiu', 2, '2024-05-15 03:53:25', '2024-05-15 03:53:34', '3'),
(7, 'Pionering', '2024-05-25', 0, 'dgdgdddgvkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjgsl', 3, '2024-05-15 12:29:04', '2024-05-15 12:29:04', '1'),
(9, 'Pionering 2', '2024-05-10', 0, 'makanan', 3, '2024-05-15 12:38:54', '2024-05-17 02:35:49', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepalasekolah`
--

CREATE TABLE `tb_kepalasekolah` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `nohp` varchar(13) DEFAULT NULL,
  `jabatan` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembina`
--

CREATE TABLE `tb_pembina` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `nohp` varchar(13) DEFAULT NULL,
  `jabatan` varchar(55) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pembina`
--

INSERT INTO `tb_pembina` (`id`, `nama`, `email`, `nohp`, `jabatan`, `user_id`) VALUES
(1, 'Jaki', 'jaki@jak.com', NULL, NULL, 3),
(2, 'jbt', 'jmb@example', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prestasi`
--

CREATE TABLE `tb_prestasi` (
  `id` int(11) NOT NULL,
  `anggota_id` int(11) DEFAULT NULL,
  `kegiatan_prestasi` varchar(255) DEFAULT NULL,
  `tanggal_prestasi` date DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `deskripsi_prestasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `created_at`, `updated_at`, `role`, `name`) VALUES
(1, 'Elang', '$2y$10$c6dKMx0Pnow3htk.HtsviuVT6ClZ1ex32WfFtfXdjnz4c4btVOd/u', 'elangmra@gmail.com', NULL, '2024-05-15 02:10:39', '2024-05-15 02:10:39', 'anggota', 'Elang'),
(2, 'El', '$2y$10$ZYtPo7su734JFUz/M4J8weUIeZmg50OJObRj7tVhWuKQHfxSeMYCm', 'customer@example.com', NULL, '2024-05-15 02:23:47', '2024-05-15 02:23:47', 'pembina', 'El'),
(3, 'Jaki', '$2y$10$pMe4VBAVOVg2qR7Oqk8lnuR6OBKBSffkVWsKNKTs3n9sAczcDNZdq', 'jaki@jak.com', NULL, '2024-05-15 02:41:48', '2024-05-15 02:41:48', 'pembina', 'Jaki'),
(4, 'jbt', '$2y$10$aYI7JhKghtD96lwGhmrRae01/PP.DQ9h7MmaREkKuEcC3OjcSphjC', 'jmb@example', NULL, '2024-05-15 11:50:44', '2024-05-15 11:50:44', 'pembina', 'jbt');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekstrakulikuler_id` (`ekstrakulikuler_id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`),
  ADD KEY `anggota_id` (`anggota_id`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_ekstrakulikuler`
--
ALTER TABLE `tb_ekstrakulikuler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembina_id` (`pembina_id`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kepalasekolah`
--
ALTER TABLE `tb_kepalasekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_ekstrakulikuler`
--
ALTER TABLE `tb_ekstrakulikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_kepalasekolah`
--
ALTER TABLE `tb_kepalasekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`anggota_id`) REFERENCES `tb_anggota` (`id`),
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`ekstrakulikuler_id`) REFERENCES `tb_ekstrakulikuler` (`id`),
  ADD CONSTRAINT `tb_absensi_ibfk_3` FOREIGN KEY (`kegiatan_id`) REFERENCES `tb_kegiatan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_absensi_ibfk_4` FOREIGN KEY (`anggota_id`) REFERENCES `tb_anggota` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ekstrakulikuler`
--
ALTER TABLE `tb_ekstrakulikuler`
  ADD CONSTRAINT `tb_ekstrakulikuler_ibfk_1` FOREIGN KEY (`pembina_id`) REFERENCES `tb_pembina` (`id`),
  ADD CONSTRAINT `tb_ekstrakulikuler_ibfk_2` FOREIGN KEY (`pembina_id`) REFERENCES `tb_pembina` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  ADD CONSTRAINT `tb_pembina_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
