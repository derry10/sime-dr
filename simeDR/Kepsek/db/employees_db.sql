-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2024 pada 06.39
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
  `user_id` int(11) NOT NULL,
  `kelas` varchar(19) DEFAULT NULL,
  `jurusan` varchar(55) DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `ekskul_id` varchar(5) DEFAULT NULL,
  `nilai` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id`, `nama`, `email`, `nohp`, `jabatan_ekskul`, `user_id`, `kelas`, `jurusan`, `jenis_kelamin`, `ekskul_id`, `nilai`) VALUES
(1, 'Andriana', 'andriana@example.com', '081234567890', 'Ketua', 5, '11', 'TBSM', 'Pria', '1', NULL),
(2, 'Diana', 'diana@example.com', '081234567891', 'Sekretaris', 6, '10', 'APAT', 'Wanita', '1', NULL),
(3, 'Rizki', 'rizki@example.com', '081234567892', 'Bendahara', 7, '12', 'TKJ', 'Pria', '2', '90'),
(4, 'Siti', 'siti@example.com', '081234567893', 'Anggota', 8, '11', 'RPL', 'Wanita', '4', NULL),
(5, 'kiki', 'kiki@example', NULL, NULL, 10, '11', 'APAT', 'Pria', '4', '85'),
(7, 'anggota1', '1@dot.com', '0979898989', 'Anggota', 11, '11', 'APAT', 'Pria', '2', NULL),
(15, 'gogon', 'gogon@k.com', NULL, NULL, 13, NULL, NULL, 'Pria', '2', NULL),
(16, 'baru', 'baru@baru.com', NULL, NULL, 14, NULL, NULL, 'Pria', '2', NULL),
(17, '123', '123@jak.com', NULL, NULL, 15, NULL, NULL, 'Pria', NULL, NULL),
(18, 'Dona', 'dona@example.com', NULL, NULL, 16, NULL, NULL, 'Pria', NULL, NULL),
(19, 'testRole', 'testrole@example.com', NULL, NULL, 18, NULL, NULL, 'Pria', NULL, NULL),
(20, 'testRole2', 'testrole2@example.com', NULL, NULL, 19, NULL, NULL, 'Pria', NULL, NULL),
(21, 'testRole3', 'testrole3@example.com', NULL, NULL, 20, NULL, NULL, 'Wanita', '2', NULL),
(52, 'testRole6', 'testrole6@example.com', NULL, NULL, 23, NULL, NULL, 'Wanita', NULL, NULL);

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
  `hari` varchar(50) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_ekstrakulikuler`
--

INSERT INTO `tb_ekstrakulikuler` (`id`, `nilai`, `nama`, `deskripsi`, `pembina_id`, `created_at`, `updated_at`, `jam`, `hari`, `image`) VALUES
(2, NULL, 'Kayak', 'dadsadaddads', 1, '2024-05-15 02:51:43', '2024-05-20 03:52:56', '10:53:00', 'Rabu', 'pramuka1.png'),
(3, NULL, 'Pramuka', 'Praja Muda Karana', 2, '2024-05-15 11:51:52', '2024-05-20 03:52:56', '15:00:00', 'Rabu', 'pramuka1.png'),
(4, NULL, 'PASKIBRA', 'Pasukan Pengibar Bendera', 3, '2024-05-17 23:53:48', '2024-05-20 03:52:56', '15:00:00', 'Kamis', 'paskibra.png'),
(5, NULL, 'Pramuka', 'Praja Muda Karana', 4, '2024-05-20 03:15:44', '2024-05-20 03:52:56', '14:18:00', 'Rabu', 'pramuka1.png');

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
(4, 'sadadsaddd', '2024-05-30', 0, 'dasadsda', 2, '2024-05-15 03:44:34', '2024-05-17 12:24:41', '2'),
(7, 'Pionering', '2024-05-25', 0, 'dgdgdddgvkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjgsl', 3, '2024-05-15 12:29:04', '2024-05-15 12:29:04', '1'),
(9, 'Pionering 2', '2024-05-10', 0, 'makanan', 3, '2024-05-15 12:38:54', '2024-05-17 02:35:49', '2'),
(10, 'Pionering', '2024-05-20', 0, 'jwnjwn', 5, '2024-05-20 03:16:34', '2024-05-20 03:16:34', '3'),
(11, 'Penerapan Dasar', '2024-05-25', 0, 'Penerapan dasar dasar Paskibra terhadap PBB ', 4, '2024-05-24 22:30:12', '2024-05-24 22:30:12', '1'),
(12, 'Pionering', '2024-06-01', 0, 'fgfhthtjhthjt', 2, '2024-06-01 07:31:24', '2024-06-01 07:31:24', '1');

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
  `user_id` int(11) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pembina`
--

INSERT INTO `tb_pembina` (`id`, `nama`, `email`, `nohp`, `jabatan`, `user_id`, `jenis_kelamin`) VALUES
(1, 'Jaki', 'jaki@jak.com', NULL, NULL, 3, ''),
(2, 'jbt', 'jmb@example', NULL, NULL, 4, ''),
(3, 'DR DR', 'dr@example', NULL, NULL, 9, ''),
(4, 'heri', 'heri@jak.com', NULL, NULL, 12, ''),
(5, 'testRole4', 'testrole4@example.com', NULL, NULL, 21, 'pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id` int(11) NOT NULL,
  `ekskul_id` int(11) DEFAULT NULL,
  `anggota_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id`, `ekskul_id`, `anggota_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 'approved', '2024-05-19 23:12:01', '2024-05-24 22:17:08'),
(4, 2, 3, 'approved', '2024-05-27 16:23:52', '2024-05-27 16:24:14'),
(6, 2, 3, 'approved', '2024-05-27 16:34:44', '2024-05-27 16:35:06'),
(8, 2, 15, 'approved', '2024-05-27 16:37:10', '2024-05-27 16:37:45'),
(9, 2, 3, 'approved', '2024-05-27 16:41:56', '2024-05-28 11:43:06'),
(10, 2, 3, 'approved', '2024-05-27 16:42:19', '2024-06-01 05:34:10'),
(30, 2, 16, 'approved', '2024-05-29 10:25:07', '2024-06-01 05:32:43'),
(31, 2, 21, 'approved', '2024-06-01 05:19:05', '2024-06-01 05:32:12'),
(32, 2, 21, 'approved', '2024-06-01 07:28:06', '2024-06-01 07:49:20');

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
  `deskripsi_prestasi` text DEFAULT NULL,
  `ekskul_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_prestasi`
--

INSERT INTO `tb_prestasi` (`id`, `anggota_id`, `kegiatan_prestasi`, `tanggal_prestasi`, `tingkat`, `deskripsi_prestasi`, `ekskul_id`) VALUES
(2, 3, 'dsadsadsad', '2024-08-22', 'Provasva', 'sdadadad', NULL),
(3, 3, 'adasdsd', '2042-08-04', 'doksdad', 'doskaod', NULL),
(4, 0, 'apa aja', '2024-05-09', 'propinsi', 'juara 1 lomba apa aja', NULL),
(5, 0, 'apa aja', '2024-05-25', 'propinsi', 'q', NULL);

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
(3, 'Jaki', '$2y$10$pMe4VBAVOVg2qR7Oqk8lnuR6OBKBSffkVWsKNKTs3n9sAczcDNZdq', 'jakiss@jak.com', 1, '2024-05-15 02:41:48', '2024-05-29 10:28:22', 'pembina', 'Jakisd'),
(4, 'jbt', '$2y$10$aYI7JhKghtD96lwGhmrRae01/PP.DQ9h7MmaREkKuEcC3OjcSphjC', 'jmb@example', NULL, '2024-05-15 11:50:44', '2024-05-15 11:50:44', 'pembina', 'jbt'),
(5, 'user1', 'password1', 'user1@example.com', 3, '2024-05-17 10:55:36', '2024-05-17 10:55:36', 'anggota', 'User One'),
(6, 'user2', 'password2', 'user2@example.com', 3, '2024-05-17 10:55:36', '2024-05-17 10:55:36', 'anggota', 'User Two'),
(7, 'user3', 'password3', 'user3@example.com', 3, '2024-05-17 10:55:36', '2024-05-17 10:55:36', 'anggota', 'User Three'),
(8, 'user4', 'password4', 'user4@example.com', 3, '2024-05-17 10:55:36', '2024-05-17 10:55:36', 'anggota', 'User Four'),
(9, 'DR DR', '$2y$10$VBMCsD.mfVA9GGtT.meFrel7De6PBlLHUfJpdxk5KoMgy.UXKlEV6', 'dr@example', NULL, '2024-05-17 22:45:23', '2024-05-17 22:45:23', 'pembina', 'DR DR'),
(10, 'kiki', '$2y$10$MCLqTj5CUQPgydurkNKhbuPftYEHQeU46vSyR/SbDRouxG7iY5RHq', 'kiki@example', NULL, '2024-05-18 13:57:57', '2024-05-23 02:29:43', 'anggota', 'kiko'),
(11, 'anggota1', '$2y$10$FyIXy1gb8EkUGkVY6SV.YOIHd/f3XrL0bYwaRyvuUg8gCvFWKsLDC', '1@dot.com', NULL, '2024-05-19 23:12:01', '2024-05-19 23:12:01', 'anggota', 'anggota1'),
(12, 'heri', '$2y$10$V4wWpzvcoKhZ1O0FqJUFieQpcTJ1ttvxdGRH1mUHXQ7wErawuVTy.', 'heri@jak.com', NULL, '2024-05-20 03:14:42', '2024-05-20 03:14:42', 'pembina', 'heri'),
(13, 'gogon', '$2y$10$q5wmhzqUSmc081pG/jP6gOYDeRsHHo0s4bdW7gHlfFRJpdI/2B8Uu', 'gogon@k.com', NULL, '2024-05-24 14:50:50', '2024-05-24 14:50:50', 'anggota', 'gogon'),
(14, 'baru', '$2y$10$c2yaSYX.MsBawa86CygdzuT5beHIYgMC3Aw.OA7m4w2DIGjnOr4jy', 'baru@baru.com', 3, '2024-05-27 16:25:13', '2024-05-29 10:28:04', 'anggota', 'baru'),
(15, '123', '$2y$10$lVvhtp3X3Ju2RK6a0ylIAeZUoEbQYfCah8BLdWc8rxcGhV6kDueSC', '123@jak.com', NULL, '2024-05-27 16:37:01', '2024-05-27 16:37:01', 'anggota', '123'),
(16, 'Dona', '$2y$10$vXr6fO4x1SsSf1OMKHgQPe3fISBCeXOz1Mzg9W1v3Ne2Bx5N7lFEm', 'dona@example.com', NULL, '2024-05-31 15:18:00', '2024-05-31 15:18:00', 'anggota', 'Dona'),
(18, 'testRole', '$2y$10$YHP772eyAHjL3BbBZFeIquc843Fd/bjMZmjNpzN2cH6aSC75rmTia', 'testrole@example.com', 3, '2024-06-01 03:44:41', '2024-06-01 03:44:41', '', 'testRole'),
(19, 'testRole2', '$2y$10$dsZImcUHfu4riV6jFco9QOun2z5O/JwrMxP/aCsNOAEaoeZKDQEdW', 'testrole2@example.com', 3, '2024-06-01 04:02:56', '2024-06-01 04:02:56', 'anggota', 'testRole2'),
(20, 'testRole3', '$2y$10$JHM2xiwdYQ0C4v5LBMy/8.r.9erWnrFXUTOTI/gaHa26OQF18YJoa', 'testrole3@example.com', 3, '2024-06-01 04:49:39', '2024-06-01 04:49:39', 'anggota', 'testRole3'),
(21, 'testRole4', '$2y$10$N2WB9dnCENevipsWZtpXeuiHyWbFxdErGEIJE4naEPPPzuYorNzIe', 'testrole4@example.com', 1, '2024-06-01 05:14:04', '2024-06-01 05:14:04', 'pembina', 'testRole4'),
(22, 'testRole5', '$2y$10$rqsGtC/BuxlWArCZ29tDaeSXHzoB5o53fEUgM0E3gGN0tOjraRhWa', 'testrole5@example.com', 1, '2024-06-01 07:47:24', '2024-06-01 07:47:24', 'pembina', 'testRole5'),
(23, 'testRole6', '$2y$10$WN.UmgFvki4cBvVLXcBp8u7vLo.lW6LpvqVUjbbi.qTe8UDLez6yu', 'testrole6@example.com', 3, '2024-06-01 07:52:35', '2024-06-01 07:52:35', 'anggota', 'testRole6');

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
-- Indeks untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekskul_id` (`ekskul_id`),
  ADD KEY `anggota_id` (`anggota_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tb_ekstrakulikuler`
--
ALTER TABLE `tb_ekstrakulikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_kepalasekolah`
--
ALTER TABLE `tb_kepalasekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pembina`
--
ALTER TABLE `tb_pembina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Ketidakleluasaan untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD CONSTRAINT `tb_pengajuan_ibfk_1` FOREIGN KEY (`ekskul_id`) REFERENCES `tb_ekstrakulikuler` (`id`),
  ADD CONSTRAINT `tb_pengajuan_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `tb_anggota` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
