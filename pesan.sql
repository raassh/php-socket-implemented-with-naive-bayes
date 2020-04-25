-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 04:33 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masukan`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` varchar(14) NOT NULL,
  `pesan` varchar(100) NOT NULL,
  `pesan2` varchar(100) NOT NULL,
  `pesan3` varchar(100) NOT NULL,
  `pesan4` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `pesan`, `pesan2`, `pesan3`, `pesan4`, `tanggal`) VALUES
('KDP0001', '60', '18000', '11000', '110', '2020-04-24 12:18:46'),
('KDP0002', '60', '12000', '11000', '110', '2020-04-24 13:56:47'),
('KDP0003', '60', '12000', '11000', '600', '2020-04-24 14:01:33'),
('KDP0004', '70', '15678', '', '', '2020-04-24 14:04:07'),
('KDP0005', '60', '14567', '13685', '456', '2020-04-24 14:04:32'),
('KDP0006', '60', '18000', '11000', '110', '2020-04-24 14:15:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
