-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 09:21 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam_kab_kupang`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `id_user`, `rank`, `total`, `created_at`, `updated_at`) VALUES
(1, 'A1', 19, 1, 60, '2022-10-13 15:08:10', '2022-10-13 15:08:10'),
(2, 'A2', 20, 4, 57, '2022-10-13 15:08:47', '2022-10-13 15:08:47'),
(4, 'A4', 22, 2, 59, '2022-10-13 15:09:58', '2022-10-13 15:09:58'),
(5, 'A5', 23, 1, 58, '2022-10-13 15:10:01', '2022-10-13 15:10:01'),
(6, 'A6', 24, 8, 53, '2022-10-13 15:10:06', '2022-10-13 15:10:06'),
(7, 'A7', 21, 7, 55, '2022-10-13 15:23:45', '2022-10-13 15:23:45'),
(8, 'A8', 26, 4, 51, '2022-10-18 11:09:49', '2022-10-18 11:09:49'),
(9, 'A9', 27, 3, 56, '2022-10-18 11:18:31', '2022-10-18 11:18:31'),
(10, 'A10', 28, 2, 57, '2022-11-01 14:01:18', '2022-11-01 14:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(15) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
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
(13, 'C10', 'Prakarsa', 65, '2022-11-01 14:23:17', '2022-11-01 14:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id_nilai_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id_nilai_alternatif`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(1, 1, 1, 100),
(2, 2, 1, 75),
(3, 3, 1, 90),
(4, 4, 1, 79),
(5, 5, 1, 70),
(6, 6, 1, 90),
(7, 7, 1, 80),
(8, 1, 2, 75),
(9, 2, 2, 80),
(10, 3, 2, 87),
(11, 4, 2, 80),
(12, 5, 2, 67),
(13, 6, 2, 88),
(14, 7, 2, 78),
(22, 1, 4, 77),
(23, 2, 4, 95),
(24, 3, 4, 76),
(25, 4, 4, 82),
(26, 5, 4, 80),
(27, 6, 4, 90),
(28, 7, 4, 70),
(29, 1, 5, 85),
(30, 2, 5, 76),
(31, 3, 5, 78),
(32, 4, 5, 77),
(33, 5, 5, 73),
(34, 6, 5, 87),
(35, 7, 5, 85),
(36, 1, 6, 90),
(37, 2, 6, 68),
(38, 3, 6, 66),
(39, 4, 6, 79),
(40, 5, 6, 80),
(41, 6, 6, 76),
(42, 7, 6, 60),
(50, 1, 7, 88),
(51, 2, 7, 66),
(52, 3, 7, 89),
(53, 4, 7, 78),
(54, 5, 7, 67),
(55, 6, 7, 80),
(56, 7, 7, 70),
(57, 1, 8, 67),
(58, 2, 8, 70),
(59, 3, 8, 60),
(60, 4, 8, 75),
(61, 5, 8, 70),
(62, 6, 8, 80),
(63, 7, 8, 75),
(64, 1, 9, 80),
(65, 2, 9, 75),
(66, 3, 9, 75),
(67, 4, 9, 76),
(68, 5, 9, 78),
(69, 6, 9, 80),
(70, 7, 9, 80),
(71, 1, 10, 75),
(72, 2, 10, 80),
(73, 3, 10, 90),
(74, 4, 10, 70),
(75, 5, 10, 85),
(76, 6, 10, 70),
(77, 7, 10, 80);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL DEFAULT '-',
  `pangkat` varchar(50) NOT NULL DEFAULT '-',
  `telp` varchar(12) NOT NULL DEFAULT '+62',
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `jabatan`, `pangkat`, `telp`, `id_status`) VALUES
(2, 19, '-', '-', '+62', 2),
(3, 20, '-', '-', '+62', 2),
(4, 21, '-', '-', '+62', 2),
(5, 22, '-', '-', '+62', 2),
(6, 23, '-', '-', '+62', 2),
(7, 24, '-', '-', '+62', 1),
(10, 27, '-', '-', '+62', 2),
(11, 28, 'pelaksana pendapatan', 'B3', '081237890765', 2);

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `id_status` int(11) NOT NULL,
  `status_pegawai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id_status`, `status_pegawai`) VALUES
(1, 'Pegawai Tidak Tetap'),
(2, 'Pegawai Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT 3,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2022-09-26 06:32:37', '2022-09-26 06:32:37'),
(18, 2, 'pimpinan', 'pimpinan@gmail.com', '$2y$10$KYxoi15JRXGOKWh63P/ikejfR0utUQcXXelztPWeYreW1M4q4NAOO', '2022-10-04 06:26:35', '2022-10-12 07:33:17'),
(19, 3, 'Arlan', 'arlan270899@gmail.com', '$2y$10$Oa1sI7Q6qcAec6zvfYFu.ekq0vDX5NhZAtKY6.b.N7JN9U6I7TX6G', '2022-10-12 07:35:15', '2022-11-01 14:08:26'),
(20, 3, 'Rehan', 'rehan@gmail.com', '$2y$10$DMlYv2Kfy4b3d0Fcj4G8M.qzKjSyYUbq9tQgN.MzL8EpYueYgiLM.', '2022-10-13 14:36:50', '2022-11-01 14:08:26'),
(21, 3, 'Aji', 'aji@gmail.com', '$2y$10$yNGZhGDIDav0UINOGgIHAOW/ascHLW.42a1/e1LS8Pu2s.19YVRoi', '2022-10-13 14:37:08', '2022-11-01 14:08:26'),
(22, 3, 'Soekanti', 'soekanti@gmail.com', '$2y$10$Sg3lWovZHJnbeeMlbNWv5.OkU3GV8K63bSauxgwELbQPxBLz.AiSW', '2022-10-13 14:37:34', '2022-11-01 14:08:26'),
(23, 3, 'putri', 'putri@gmail.com', '$2y$10$e7QujBMYdUQEHcFdHfDFweW/Nd.NzbCsUvIwI.WIyKDuX5bifLSGK', '2022-10-13 14:37:55', '2022-11-01 14:08:26'),
(24, 3, 'Rendy', 'rendy@gmail.com', '$2y$10$19OvIdLOcDWYoI5gb34rzeU5XUl7DuvIfJzbKm.6oiLjnvJsXzpkS', '2022-10-13 14:38:15', '2022-10-13 14:38:15'),
(26, 3, 'hety', 'hety@gmail.com', '$2y$10$xs9aZF.bax8aO8.YT1yU7uB8qUVZNTD8yBrljpvbUhdd9o0k3rzpC', '2022-10-18 11:06:24', '2022-10-18 11:06:24'),
(27, 3, 'melan', 'melan@gmail.com', '$2y$10$5NImBVZxZsJU7dWvnPqV5OTnvAu5kuJgqduKlrtnLN5pNQZF453Qy', '2022-10-18 11:17:57', '2022-11-01 14:09:10'),
(28, 3, 'iren pasu', 'iren@gmail.com', '$2y$10$WEt7GofId719LHzS.KAikugXapTcS/IZWMYObh2sqN1gP4/Valh92', '2022-11-01 13:40:32', '2022-11-01 14:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `roles`) VALUES
(1, 'Administrator'),
(2, 'Pimpinan'),
(3, 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id_nilai_alternatif`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id_nilai_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status_pegawai` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
