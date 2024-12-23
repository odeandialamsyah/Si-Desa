-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 07:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-desa-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `agama_id` int(11) NOT NULL,
  `nama_agama` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`agama_id`, `nama_agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(2, 'Kristen', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(3, 'Katolik', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(4, 'Hindu', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(5, 'Buddha', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(6, 'Konghucu', '2024-12-24 06:18:06', '2024-12-24 06:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `daerah_id` int(11) NOT NULL,
  `nama_daerah` varchar(100) NOT NULL,
  `jenis_daerah` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`daerah_id`, `nama_daerah`, `jenis_daerah`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', 'Kota', '2024-12-24 06:17:57', '2024-12-24 06:17:57'),
(2, 'Bandung', 'Kota', '2024-12-24 06:17:57', '2024-12-24 06:17:57'),
(3, 'Bekasi', 'Kabupaten', '2024-12-24 06:17:57', '2024-12-24 06:17:57'),
(4, 'Bogor', 'Kota', '2024-12-24 06:17:57', '2024-12-24 06:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `penduduk_id` int(11) NOT NULL,
  `daerah_id` int(11) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `gaji` decimal(15,2) DEFAULT NULL,
  `rt` int(11) DEFAULT NULL,
  `rw` int(11) DEFAULT NULL,
  `jumlah_keluarga` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `daerah_id`, `agama_id`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `pekerjaan`, `gaji`, `rt`, `rw`, `jumlah_keluarga`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '1234567891234522', 'Asep sudarseo', 'Laki-laki', '2024-12-24', 'Bandung', 'Pengusaha', '10000000.00', 1, 10, 4, '2024-12-24 06:41:32', '2024-12-24 06:41:32'),
(2, NULL, NULL, '7786237846236434', 'Dimas Mabar', 'Perempuan', '2024-12-04', 'Bandung', 'Pengusaha', '20000000.00', 2, 12, 5, '2024-12-24 06:49:09', '2024-12-24 06:49:09'),
(3, NULL, NULL, '546883638282937', 'Ucup botol', 'Perempuan', '2002-07-24', 'Cimahi', 'PNS', '7000000.00', 8, 8, 2, '2024-12-24 06:53:14', '2024-12-24 06:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '2024-12-23 01:24:12', '2024-12-23 01:30:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`agama_id`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`daerah_id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`penduduk_id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `daerah_id` (`daerah_id`),
  ADD KEY `agama_id` (`agama_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `agama_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `daerah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `penduduk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`daerah_id`) REFERENCES `daerah` (`daerah_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`agama_id`) REFERENCES `agama` (`agama_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
