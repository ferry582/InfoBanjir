-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 06:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banjir`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) UNSIGNED NOT NULL,
  `userid` int(6) UNSIGNED NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(300) NOT NULL,
  `location_status` tinyint(1) DEFAULT 0,
  `waktu` datetime NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `userid`, `lat`, `lng`, `description`, `location_status`, `waktu`, `lokasi`, `foto`) VALUES
(4, 2, 0.000000, 0.000000, 'test', 1, '0000-00-00 00:00:00', NULL, NULL),
(10, 4, -8.727153, 116.400337, 'test\r\n          ', 1, '2021-12-07 01:40:00', NULL, NULL),
(12, 3, -8.168616, 113.641350, 'telah terjadi banjir disini\r\n          ', 1, '2021-12-07 23:55:00', NULL, NULL),
(13, 2, -8.546410, 114.999870, 'test\r\n          ', 1, '2021-12-03 01:52:00', NULL, NULL),
(14, 3, -8.544141, 116.233276, 'telah terjadi banjir di lombok\r\n          ', 1, '2021-12-07 01:32:00', 'lombok', NULL),
(19, 14, -7.659618, 109.543854, 'Banjir terjadi karena luapan sungai yang memiliki kedalaman yang dangkal ditambah lagi hujan deras yang terjadi selama 5 jam lebih.', 0, '2021-12-08 12:26:00', 'Gombong, Kebumen, Jawa Tengah', 'banjir.jpg'),
(22, 14, 3.601369, 98.653458, 'Telah terjadi banjir di kota medan, dengan ketinggian 1 meter', 0, '2021-12-08 12:05:00', 'Medan', 'download (1).jpg'),
(23, 22, -6.230057, 106.847359, 'telah terjadi banjir di jakarta          ', 1, '2021-12-11 11:08:00', 'Jakarta', 'office.jpg'),
(24, 23, -7.772070, 110.390366, 'tes          ', 0, '2022-05-25 04:39:00', 'jogja', 'Banda_Aceh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(6) UNSIGNED NOT NULL,
  `nama` varchar(40) NOT NULL,
  `nik` char(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(256) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `user_level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `nama`, `nik`, `username`, `email`, `password`, `alamat`, `user_level`) VALUES
(2, 'ferry dwi', '12345678', 'ferry123', 'ferry123@gmail.com', 'ferry123', 'medan', 1),
(4, 'Danar Ghulamsyah', '18292183888929', 'danar', 'danargh86@gmail.com', 'danar', 'Kebumen', 0),
(6, 'Anjuan', 'juan', 'juan', 'juan@gmail.com', '12345678', '1234', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_idUser` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
