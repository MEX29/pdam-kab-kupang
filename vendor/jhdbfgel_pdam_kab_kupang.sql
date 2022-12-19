-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Des 2022 pada 19.04
-- Versi server: 10.3.37-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhdbfgel_pdam_kab_kupang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `id_user`, `rank`, `total`, `created_at`, `updated_at`) VALUES
(1, 'A1', 19, 2, 71, '2022-11-02 16:43:05', '2022-11-02 16:43:05'),
(2, 'A2', 20, 3, 61, '2022-11-02 16:43:08', '2022-11-02 16:43:08'),
(3, 'A3', 24, 1, 75, '2022-11-04 14:13:15', '2022-11-04 14:13:15'),
(4, 'A4', 26, 5, 58, '2022-11-24 09:23:29', '2022-11-24 09:23:29'),
(5, 'A5', 27, 4, 61, '2022-12-13 23:31:39', '2022-12-13 23:31:39'),
(6, 'A6', 29, 6, 46, '2022-12-14 16:51:52', '2022-12-14 16:51:52'),
(7, 'A7', 30, 7, 5, '2022-12-14 20:14:17', '2022-12-14 20:14:17'),
(8, 'A8', 28, 7, 45, '2022-12-15 07:55:59', '2022-12-15 07:55:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(15) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Ketaatan', 70, '2022-10-13 05:02:06', '2022-11-01 14:21:58'),
(2, 'C2', 'Disiplin', 95, '2022-10-13 05:02:30', '2022-11-01 14:19:24'),
(3, 'C3', 'Tanggung Jawab', 85, '2022-10-13 05:02:46', '2022-11-01 14:21:09'),
(4, 'C4', 'Prestasi Kerja', 75, '2022-10-13 05:02:59', '2022-11-01 14:20:19'),
(5, 'C5', 'Kesehatan', 80, '2022-10-13 05:03:12', '2022-11-01 14:17:48'),
(6, 'C6', 'Kecakapan', 75, '2022-10-13 05:03:26', '2022-11-01 14:16:49'),
(7, 'C7', 'Loyalitas', 80, '2022-10-13 05:03:31', '2022-11-01 14:18:00'),
(11, 'C8', 'Kejujuran', 80, '2022-11-01 14:22:29', '2022-11-01 14:22:29'),
(12, 'C9', 'Kerja Sama', 70, '2022-11-01 14:23:00', '2022-11-01 14:23:00'),
(13, 'C10', 'Prakarsa', 65, '2022-11-01 14:23:17', '2022-12-14 21:12:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id_nilai_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id_nilai_alternatif`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(78, 1, 1, 50),
(79, 2, 1, 50),
(80, 3, 1, 100),
(81, 4, 1, 20),
(82, 5, 1, 100),
(83, 6, 1, 80),
(84, 7, 1, 80),
(85, 11, 1, 80),
(86, 12, 1, 100),
(87, 13, 1, 50),
(88, 1, 2, 100),
(89, 2, 2, 80),
(90, 3, 2, 50),
(91, 4, 2, 20),
(92, 5, 2, 50),
(93, 6, 2, 80),
(94, 7, 2, 80),
(95, 11, 2, 50),
(96, 12, 2, 50),
(97, 13, 2, 50),
(98, 1, 3, 100),
(99, 2, 3, 100),
(100, 3, 3, 20),
(101, 4, 3, 80),
(102, 5, 3, 80),
(103, 6, 3, 80),
(104, 7, 3, 80),
(105, 11, 3, 80),
(106, 12, 3, 80),
(107, 13, 3, 50),
(128, 1, 4, 100),
(129, 2, 4, 20),
(130, 3, 4, 100),
(131, 4, 4, 100),
(132, 5, 4, 80),
(133, 6, 4, 20),
(134, 7, 4, 50),
(135, 11, 4, 80),
(136, 12, 4, 20),
(137, 13, 4, 5),
(138, 1, 5, 80),
(139, 2, 5, 50),
(140, 3, 5, 20),
(141, 4, 5, 80),
(142, 5, 5, 80),
(143, 6, 5, 80),
(144, 7, 5, 80),
(145, 11, 5, 20),
(146, 12, 5, 50),
(147, 13, 5, 80),
(148, 1, 6, 50),
(149, 2, 6, 20),
(150, 3, 6, 80),
(151, 4, 6, 50),
(152, 5, 6, 80),
(153, 6, 6, 20),
(154, 7, 6, 20),
(155, 11, 6, 5),
(156, 12, 6, 50),
(157, 13, 6, 100),
(158, 1, 7, 50),
(159, 2, 7, 0),
(160, 3, 7, 0),
(161, 4, 7, 0),
(162, 5, 7, 0),
(163, 6, 7, 0),
(164, 7, 7, 0),
(165, 11, 7, 0),
(166, 12, 7, 0),
(167, 13, 7, 0),
(168, 1, 8, 80),
(169, 2, 8, 80),
(170, 3, 8, 80),
(171, 4, 8, 20),
(172, 5, 8, 5),
(173, 6, 8, 20),
(174, 7, 8, 80),
(175, 11, 8, 20),
(176, 12, 8, 50),
(177, 13, 8, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL DEFAULT '-',
  `pangkat` varchar(50) NOT NULL DEFAULT '-',
  `telp` varchar(12) NOT NULL DEFAULT '+62',
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `jabatan`, `pangkat`, `telp`, `id_status`) VALUES
(2, 19, '-', '-', '+62', 1),
(3, 20, '-', '-', '+62', 1),
(12, 24, '-', '-', '+62', 2),
(19, 26, 'pelaksana keuangan', 'B3', '12345678', 1),
(20, 27, 'pelaksana keuangan', 'B3', '012235171810', 1),
(25, 28, '-', '-', '+62', 1),
(26, 29, 'pelaksana keuangan', 'B3', '081237375597', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `id_status` int(11) NOT NULL,
  `status_pegawai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_pegawai`
--

INSERT INTO `status_pegawai` (`id_status`, `status_pegawai`) VALUES
(1, 'Pegawai Tidak Tetap'),
(2, 'Pegawai Tetap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 3,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2022-09-26 06:32:37', '2022-09-26 06:32:37'),
(18, 2, 'pimpinan', 'pimpinan@gmail.com', '$2y$10$KYxoi15JRXGOKWh63P/ikejfR0utUQcXXelztPWeYreW1M4q4NAOO', '2022-10-04 06:26:35', '2022-10-12 07:33:17'),
(19, 3, 'Arlan', 'arlan270899@gmail.com', '$2y$10$Oa1sI7Q6qcAec6zvfYFu.ekq0vDX5NhZAtKY6.b.N7JN9U6I7TX6G', '2022-10-12 07:35:15', '2022-12-15 10:16:15'),
(20, 3, 'Rehan', 'rehan@gmail.com', '$2y$10$DMlYv2Kfy4b3d0Fcj4G8M.qzKjSyYUbq9tQgN.MzL8EpYueYgiLM.', '2022-10-13 14:36:50', '2022-12-15 10:16:15'),
(24, 3, 'sinta', 'sinta@gmail.com', '$2y$10$v3M/vw3W8LjV1CscP2nlAO7BrJUvAMDmf/q5jduYCup9CzLi1t/Qi', '2022-11-04 14:11:20', '2022-12-15 10:16:15'),
(26, 3, 'tari', 'tari@gmail.com', '$2y$10$p4.C428LmZ.yewMRqrKHBOzVr3A7ziYU5nB/MpTU/nesV94lSV/d2', '2022-11-24 09:17:26', '2022-12-15 10:16:15'),
(27, 3, 'randy', 'randy@gmail.com', '$2y$10$Ds7UXtRuFfhS30aBa/OwlOf79m/37azVOR7yAvAMBde657dI.sb2.', '2022-12-13 23:22:32', '2022-12-15 10:16:15'),
(28, 3, 'tara', 'tara@gmail.com', '$2y$10$TIT4fQx092sSVZQv2plWt.ImzyEg/WlaQTUjhQdIL1duNJ4C.hGTC', '2022-12-15 08:18:34', '2022-12-15 10:16:15'),
(29, 1, 'asil', 'asil@gmailcom', '$2y$10$s5fvkWxXlTZUrdy5Rk4RleXDy4pcrBUN/KsUd/JKbZfno58UF1WQq', '2022-12-15 08:40:43', '2022-12-15 10:16:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `roles`) VALUES
(1, 'Administrator'),
(2, 'Pimpinan'),
(3, 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id_nilai_alternatif`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id_nilai_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
