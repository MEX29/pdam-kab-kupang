-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Mar 2019 pada 03.04
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL,
  `level` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`, `level`) VALUES
('admin', 'admin', 'admin'),
('pimpinan', 'pimpinan', 'pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` varchar(255) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `rank`, `total`) VALUES
('A01', 'Alternatif 1', 1, 81.410256410256),
('A02', 'Alternatif 2', 2, 79.615384615385),
('A03', 'Alternatif 3', 3, 78.846153846154),
('A04', 'Alternatif 4', 4, 66.025641025641);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) NOT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`) VALUES
('C01', 'Kriteria 1', 100),
('C02', 'Kriteria 2', 80),
('C03', 'Kriteria 3', 90),
('C04', 'Kriteria 4', 50),
('C05', 'Kriteria 5', 70),
('C06', 'dasfa', 20),
('C07', 'sfds', 0),
('C08', 'sdfsf', 40),
('C09', 'Aldi', 40),
('C10', 'test', 20),
('C11', 'BAIK', 100),
('C12', 'tttttt', 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`ID`, `kode_alternatif`, `kode_kriteria`, `nilai`) VALUES
(1, 'A01', 'C01', 75),
(2, 'A01', 'C02', 100),
(3, 'A01', 'C03', 80),
(4, 'A01', 'C04', 90),
(5, 'A01', 'C05', 65),
(6, 'A02', 'C01', 90),
(7, 'A02', 'C02', 100),
(8, 'A02', 'C03', 60),
(9, 'A02', 'C04', 75),
(10, 'A02', 'C05', 70),
(11, 'A03', 'C01', 80),
(12, 'A03', 'C02', 90),
(13, 'A03', 'C03', 85),
(14, 'A03', 'C04', 60),
(15, 'A03', 'C05', 70),
(48, 'A04', 'C01', 70),
(47, 'A04', 'C02', 80),
(46, 'A04', 'C03', 50),
(45, 'A04', 'C04', 45),
(44, 'A04', 'C05', 80),
(60, 'A04', 'C06', -1),
(59, 'A03', 'C06', -1),
(58, 'A02', 'C06', -1),
(57, 'A01', 'C06', -1),
(61, 'A01', 'C07', -1),
(62, 'A02', 'C07', -1),
(63, 'A03', 'C07', -1),
(64, 'A04', 'C07', -1),
(65, 'A01', 'C08', -1),
(66, 'A02', 'C08', -1),
(67, 'A03', 'C08', -1),
(68, 'A04', 'C08', -1),
(69, 'A01', 'C09', -1),
(70, 'A02', 'C09', -1),
(71, 'A03', 'C09', -1),
(72, 'A04', 'C09', -1),
(73, 'A01', 'C10', -1),
(74, 'A02', 'C10', -1),
(75, 'A03', 'C10', -1),
(76, 'A04', 'C10', -1),
(77, 'A01', 'C11', -1),
(78, 'A02', 'C11', -1),
(79, 'A03', 'C11', -1),
(80, 'A04', 'C11', -1),
(81, 'A01', 'C12', -1),
(82, 'A02', 'C12', -1),
(83, 'A03', 'C12', -1),
(84, 'A04', 'C12', -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
