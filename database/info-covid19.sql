-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2021 at 07:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info-covid19`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_pasien` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `usia` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_pasien`, `tanggal`, `usia`, `id_status`) VALUES
('NO_001', '2021-01-30', 42, 2),
('NO_002', '2021-01-30', 55, 3),
('NO_003', '2021-01-30', 30, 2),
('NO_004', '2021-01-30', 23, 2),
('NO_005', '2021-01-31', 17, 2),
('NO_006', '2021-01-31', 16, 4),
('NO_007', '2021-01-30', 45, 2),
('NO_008', '2021-01-31', 60, 1),
('NO_009', '2021-01-31', 13, 2),
('NO_011', '2021-01-31', 60, 1),
('NO_012', '2021-01-31', 60, 1),
('NO_014', '2021-01-31', 60, 3),
('NO_015', '2021-01-31', 45, 1),
('NO_017', '2021-01-31', 70, 3),
('NO_018', '2021-01-31', 70, 3),
('NO_019', '2021-02-01', 45, 1),
('NO_020', '2021-02-02', 23, 4),
('NO_021', '2021-02-02', 33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nm_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nm_status`) VALUES
(1, 'Sembuh'),
(2, 'Dirawat'),
(3, 'Meninggal'),
(4, 'Positif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_pasien`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
