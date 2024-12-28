-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2024 at 03:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

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
  `agama_id` int NOT NULL,
  `nama_agama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `bantuan_id` int NOT NULL,
  `nama_bantuan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bantuan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `penduduk_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`bantuan_id`, `nama_bantuan`, `jenis_bantuan`, `created_at`, `updated_at`, `penduduk_id`) VALUES
(7, 'sembako', 'Uang Tunai', '2024-12-28 02:54:37', '2024-12-28 02:54:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `daerah_id` int NOT NULL,
  `nama_daerah` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_daerah` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`daerah_id`, `nama_daerah`, `jenis_daerah`, `created_at`, `updated_at`) VALUES
(1, 'Desa Ugar', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55'),
(2, 'Desa Arguni', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55'),
(3, 'Desa Werpigan', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55'),
(4, 'Desa Kinam', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55'),
(5, 'Desa Tomage', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55'),
(6, 'Desa Otoweri', 'desa', '2024-12-26 14:56:55', '2024-12-26 14:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `penduduk_id` int NOT NULL,
  `daerah_id` int DEFAULT NULL,
  `agama_id` int DEFAULT NULL,
  `kk` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pekerjaan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gaji` decimal(15,2) DEFAULT NULL,
  `jumlah_keluarga` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `daerah_id`, `agama_id`, `kk`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `pekerjaan`, `gaji`, `jumlah_keluarga`, `created_at`, `updated_at`) VALUES
(1, 6, NULL, '3201011234567890', '3201012345678901', 'Budi Santoso', 'Laki-laki', '1989-11-13', 'Bandung', 'Petani', '5000000.00', 4, '2024-12-26 16:00:15', '2024-12-26 16:05:59'),
(2, 6, NULL, '3201011234567890', '3201012345678902', 'Siti Aminah', 'Perempuan', '1994-12-15', 'Jakarta', 'Guru', '4500000.00', 4, '2024-12-26 16:01:33', '2024-12-26 16:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '2024-12-22 18:24:12', '2024-12-22 18:30:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`bantuan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `bantuan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
