-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2018 at 10:31 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `arsip_id` int(4) NOT NULL,
  `berita_id` int(4) NOT NULL,
  `rak_id` int(4) NOT NULL,
  `arsip_dok` text NOT NULL,
  `arsip_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `arsip_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`arsip_id`, `berita_id`, `rak_id`, `arsip_dok`, `arsip_created`, `arsip_updated`) VALUES
(1, 2, 2, '583f30e326cd1bc4e0d69fabe7b23f14.pdf', '2018-07-03 09:57:55', '2018-07-03 09:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `berita_id` int(4) NOT NULL,
  `berita_namabagian` varchar(10) NOT NULL DEFAULT 'HH',
  `berita_bulan` varchar(2) NOT NULL,
  `berita_tahun` int(4) NOT NULL,
  `berita_koran` varchar(100) NOT NULL,
  `berita_hari` varchar(30) NOT NULL,
  `berita_halaman` int(10) NOT NULL,
  `berita_kolom` varchar(20) NOT NULL,
  `berita_kejadian` varchar(50) NOT NULL,
  `berita_judul` varchar(100) NOT NULL,
  `berita_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berita_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `berita_namabagian`, `berita_bulan`, `berita_tahun`, `berita_koran`, `berita_hari`, `berita_halaman`, `berita_kolom`, `berita_kejadian`, `berita_judul`, `berita_created`, `berita_updated`) VALUES
(1, 'HH', '01', 2018, 'Galamedia', 'Kamis', 1, '2-3', 'bandung', 'Un lancar', '2018-05-16 15:18:47', '2018-05-16 15:18:47'),
(2, 'HH', '01', 2000, 'Kompas', 'Kamis', 2, '4', 'Bandung', 'Sekolah ', '2018-07-03 09:54:35', '2018-07-03 09:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(11) NOT NULL,
  `identitas_website` varchar(100) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_favicon` varchar(200) NOT NULL,
  `identitas_author` varchar(50) NOT NULL,
  `identitas_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `identitas_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_favicon`, `identitas_author`, `identitas_created`, `identitas_updated`) VALUES
(1, 'Humas Disdik', 'Sistem Informasi Pengarsipan Kliping Berita Pendidikan Humas Disdik Jabar', 'arsip', 'logo.png', 'Lailin Azizah', '2018-04-26 19:33:44', '2018-04-27 21:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `rak_id` int(114) NOT NULL,
  `rak_nama` varchar(100) NOT NULL,
  `rak_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rak_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`rak_id`, `rak_nama`, `rak_created`, `rak_updated`) VALUES
(1, 'Januari 2018', '2018-07-03 09:55:09', '2018-07-03 09:55:09'),
(2, 'Februari 2018', '2018-07-03 09:55:27', '2018-07-03 09:55:27'),
(3, 'Januari 2017', '2018-07-03 09:56:33', '2018-07-03 09:56:33'),
(4, 'Maret 2018', '2018-07-16 17:42:22', '2018-07-16 17:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `user_nama`, `user_role`, `user_created`, `user_updated`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2018-04-26 20:48:31', '2018-04-26 20:48:41'),
('erika', 'f7f7591403c6c431053920223069550a', 'erika', 'user', '2018-07-16 17:33:32', '2018-07-16 17:33:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`arsip_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_id`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`rak_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `arsip_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `identitas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `rak_id` int(114) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
