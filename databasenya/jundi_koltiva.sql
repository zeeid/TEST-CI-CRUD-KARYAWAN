-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2022 at 03:42 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jundi_koltiva`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `fotonya` text NOT NULL,
  `nama` varchar(75) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gaji` int(10) NOT NULL,
  `status_karyawan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = false\r\nelse true',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `email`, `password`, `fotonya`, `nama`, `tanggal_lahir`, `gaji`, `status_karyawan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'aaa@gmail.com', '123', '1657374059_437ad725069bc6161805.jpg', 'qasdsad', '2022-07-12', 2321, 1, '2022-07-09 17:12:32', '2022-07-09 20:40:59', '0000-00-00 00:00:00'),
(5, 'test@gmail.com', 'test', '1657374037_db8128473766d8a6014a.png', 'TEST 12', '2022-07-20', 10000000, 1, '2022-07-09 20:03:37', '2022-07-09 20:40:37', '0000-00-00 00:00:00'),
(6, 'COBA@ddd.com', 'coba', '1657373584_420aed7fbc4dc1827bb8.png', 'COBA 111', '2022-06-28', 1111111, 0, '2022-07-09 20:33:04', '2022-07-09 20:33:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `sandi` varchar(55) NOT NULL,
  `wa` varchar(55) NOT NULL,
  `kode_pasangan` varchar(55) NOT NULL,
  `role` int(6) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `nama_user` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `sandi`, `wa`, `kode_pasangan`, `role`, `created_at`, `updated_at`, `deleted_at`, `is_active`, `nama_user`) VALUES
(1, 'jundi', 'jundi', 'jundi', '', 'MASTER99', 911, NULL, NULL, NULL, 1, 'JUNDI HUSNI ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
