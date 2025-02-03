-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `bantuan_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_bantuan` varchar(100) NOT NULL,
  `jenis_bantuan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `penduduk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`bantuan_id`, `user_id`, `nama_bantuan`, `jenis_bantuan`, `created_at`, `updated_at`, `status`, `penduduk_id`) VALUES
(9, NULL, 'mobil', 'Uang Tunai', '2025-01-23 11:38:51', '2025-01-23 11:42:16', 'approved', 5),
(14, 7, 'semabko 2', 'Barang', '2025-01-28 01:18:55', '2025-01-28 01:18:55', 'pending', 8),
(15, 9, 'Buah Pala', 'Barang', '2025-01-28 13:15:12', '2025-01-28 13:15:12', 'pending', 9),
(16, 6, 'Makanan', 'Uang Tunai', '2025-01-29 01:13:44', '2025-01-29 01:13:44', 'pending', 5);

-- --------------------------------------------------------

--
-- Table structure for table `bantuan_kelompok`
--

CREATE TABLE `bantuan_kelompok` (
  `bantuan_kelompok_id` int(11) NOT NULL,
  `nama_bantuan` varchar(100) NOT NULL,
  `jenis_bantuan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','approved','rejected','') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bantuan_kelompok`
--

INSERT INTO `bantuan_kelompok` (`bantuan_kelompok_id`, `nama_bantuan`, `jenis_bantuan`, `created_at`, `updated_at`, `status`) VALUES
(12, 'kelapa update 1', 'Barang', '2025-01-28 11:20:46', '2025-01-29 01:00:19', 'approved'),
(13, 'kelapa', 'Uang Tunai', '2025-01-28 11:21:48', '2025-01-28 11:21:48', 'pending'),
(15, 'Perahu', 'Barang', '2025-01-28 13:15:57', '2025-01-28 13:15:57', 'pending'),
(16, 'Perahu', 'Barang', '2025-01-29 01:15:05', '2025-01-29 01:15:05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `batch_users`
--

CREATE TABLE `batch_users` (
  `batch_user_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_users`
--

INSERT INTO `batch_users` (`batch_user_id`, `user_id`, `batch_id`) VALUES
(9, 6, 12),
(10, 6, 13),
(11, 7, 13),
(14, 9, 15),
(15, 7, 15),
(16, 6, 15),
(17, 6, 16),
(18, 7, 16),
(19, 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `Judul` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `greeting` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `Judul`, `photo`, `greeting`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(6, 'Muhamad Tahir, Kepala Desa Kampung Ugar', 'ftKplDesa.jpeg', 'Selamat datang di Kampung Ugar, tempat di mana tradisi bertemu dengan inovasi. Sebagai Kepala Desa, saya berkomitmen untuk terus meningkatkan pelayanan kepada seluruh warga dan memajukan Kampung Ugar dengan semangat kebersamaan. Kami akan menjaga dan melestarikan kearifan lokal yang telah diwariskan oleh leluhur kami, sekaligus memanfaatkan potensi alam yang melimpah untuk kesejahteraan bersama. \r\n\r\nKampung Ugar memiliki kekayaan budaya dan sumber daya alam yang luar biasa, mulai dari wisata bahari hingga keindahan goa-goa yang menyimpan sejarah panjang peradaban desa ini. Dengan dukungan dari seluruh masyarakat, kita akan menciptakan lingkungan yang harmonis dan sejahtera. Mari bersama-sama kita wujudkan Kampung Ugar yang lebih maju, aman, dan menjadi teladan bagi desa-desa lainnya di Indonesia. \r\n\r\nSaya mengajak seluruh warga untuk terus bersatu dalam upaya membangun desa kita tercinta ini. Dengan kerja keras dan doa, saya yakin bahwa Kampung Ugar akan terus berkembang dan memberikan kehidupan yang lebih baik bagi seluruh warganya. Terima kasih atas kepercayaan dan dukungan yang telah diberikan. Semoga kita semua selalu diberkahi dan dilindungi oleh Tuhan Yang Maha Esa.', 'Menjadikan Kampung Ugar sebagai desa wisata unggulan yang berkelanjutan dengan mengedepankan pelestarian budaya dan lingkungan.', '•	Meningkatkan kesejahteraan masyarakat melalui pengelolaan sumber daya alam yang bijaksana.\r\n•	Mendorong partisipasi aktif masyarakat dalam pelestarian budaya dan lingkungan.\r\n•	Meningkatkan kualitas infrastruktur untuk mendukung pariwisata dan ekonomi lokal.', '2025-01-23 07:33:36', '2025-01-23 07:40:41');

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
(8, 'Kriawaswas', 'Kampung', '2025-01-21 05:29:31', '2025-01-21 05:29:31'),
(9, 'Kampung Baru', 'Kampung', '2025-01-21 05:30:01', '2025-01-21 05:31:56'),
(10, 'Kinam', 'Kampung', '2025-01-21 05:30:29', '2025-01-21 05:30:29'),
(11, 'Mambuni Buni', 'Kampung', '2025-01-21 05:30:48', '2025-01-21 05:30:48'),
(12, 'Mandoni', 'Kampung', '2025-01-21 05:31:02', '2025-01-21 05:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `laporan_id` int(11) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `daerah_id` int(11) NOT NULL,
  `laporan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_desa`
--

CREATE TABLE `pendapatan_desa` (
  `pendapatan_id` int(11) NOT NULL,
  `nama_pendapatan` varchar(255) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `gambar_pendapatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendapatan_desa`
--

INSERT INTO `pendapatan_desa` (`pendapatan_id`, `nama_pendapatan`, `tanggal_dibuat`, `gambar_pendapatan`) VALUES
(2, 'batbat', '2024-03-02', 'Uploads/gambar_pendapatan/kopra.jpg'),
(3, 'pantai', '2007-03-02', 'Uploads/gambar_pendapatan/pantai.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `penduduk_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `daerah_id` int(11) DEFAULT NULL,
  `agama_id` int(11) DEFAULT NULL,
  `kk` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `gaji` decimal(15,2) DEFAULT NULL,
  `jumlah_keluarga` int(11) DEFAULT 0,
  `foto_diri` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_nik` varchar(255) DEFAULT NULL,
  `file_kk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `user_id`, `daerah_id`, `agama_id`, `kk`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `pekerjaan`, `gaji`, `jumlah_keluarga`, `foto_diri`, `created_at`, `updated_at`, `file_nik`, `file_kk`) VALUES
(5, 6, 12, 1, '1432689703184923', '1432689703184924', 'ode andi alamsyah', 'Laki-laki', '2007-03-02', 'busoa', 'backend', 1000000.00, 2, 'ode_andi_alamsyah.jpg', '2025-01-21 12:21:39', '2025-01-23 12:48:16', 'ode_andi_alamsyah_nik.pdf', 'ode_andi_alamsyah_kk.pdf'),
(8, 7, 8, 1, '1234567891234567', '2234567891234567', 'test01', 'Laki-laki', '2025-01-01', 'kulonprogo', 'petani', 1200000.00, 2, 'test01.jpg', '2025-01-28 00:14:36', '2025-01-28 00:14:36', 'test01_nik.pdf', 'test01_kk.pdf'),
(9, 9, 10, 1, '1234567891234567', '2234567891234577', 'test 03', 'Laki-laki', '2014-02-05', 'halu oleo', 'petani', 1200000.00, 4, 'test_03.jpg', '2025-01-28 13:14:01', '2025-01-28 13:14:01', 'test_03_nik.pdf', 'test_03_kk.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `potensi_desa`
--

CREATE TABLE `potensi_desa` (
  `potensi_id` int(11) NOT NULL,
  `nama_pariwisata` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `gambar_pariwisata` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potensi_desa`
--

INSERT INTO `potensi_desa` (`potensi_id`, `nama_pariwisata`, `create_at`, `gambar_pariwisata`) VALUES
(2, 'taman bunga anggrek', '2024-03-02', 'Uploads/gambar_pariwisata/taman_bunga.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$ozbFsYG6YPCGI/oqrHFjSuDZZCQwLS..1Ubq6rEj/wKxV3wTI6XX2', '2025-01-20 04:17:37', '2025-01-20 04:17:58', 'admin'),
(6, 'ode@gmail.com', '$2y$10$ozbFsYG6YPCGI/oqrHFjSuDZZCQwLS..1Ubq6rEj/wKxV3wTI6XX2', '2025-01-20 04:35:58', '2025-01-27 21:30:03', 'user'),
(7, 'test01@gmail.com', '$2y$10$ozbFsYG6YPCGI/oqrHFjSuDZZCQwLS..1Ubq6rEj/wKxV3wTI6XX2', '2025-01-27 21:39:15', '2025-01-28 07:48:48', 'user'),
(8, 'test02@gmail.com', '$2y$10$nlMs4W42wmG0X0LTP8zZBuM33/sVv7.UE9ZwqijmniL2bCFA.W/Gu', '2025-01-27 22:06:22', '2025-01-27 22:06:22', 'user'),
(9, 'test03@gmail.com', '$2y$10$YRf9YXqM8SNFMkjJSOkAa.ZQgm0d3nT4ON8Ymewsw6n56DDk.ECUK', '2025-01-28 13:11:05', '2025-01-28 13:11:05', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`agama_id`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`bantuan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bantuan_kelompok`
--
ALTER TABLE `bantuan_kelompok`
  ADD PRIMARY KEY (`bantuan_kelompok_id`);

--
-- Indexes for table `batch_users`
--
ALTER TABLE `batch_users`
  ADD PRIMARY KEY (`batch_user_id`),
  ADD KEY `fk_batch_id` (`batch_id`),
  ADD KEY `fk_user_id_in_batch` (`user_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`daerah_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`laporan_id`),
  ADD KEY `daerah_id` (`daerah_id`);

--
-- Indexes for table `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  ADD PRIMARY KEY (`pendapatan_id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`penduduk_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_daerah_id` (`daerah_id`),
  ADD KEY `fk_agama_id` (`agama_id`);

--
-- Indexes for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  ADD PRIMARY KEY (`potensi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `agama_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `bantuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bantuan_kelompok`
--
ALTER TABLE `bantuan_kelompok`
  MODIFY `bantuan_kelompok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `batch_users`
--
ALTER TABLE `batch_users`
  MODIFY `batch_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `daerah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `laporan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  MODIFY `pendapatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `penduduk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  MODIFY `potensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD CONSTRAINT `bantuan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `batch_users`
--
ALTER TABLE `batch_users`
  ADD CONSTRAINT `fk_batch_id` FOREIGN KEY (`batch_id`) REFERENCES `bantuan_kelompok` (`bantuan_kelompok_id`),
  ADD CONSTRAINT `fk_user_id_in_batch` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`daerah_id`) REFERENCES `daerah` (`daerah_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `fk_agama_id` FOREIGN KEY (`agama_id`) REFERENCES `agama` (`agama_id`),
  ADD CONSTRAINT `fk_daerah_id` FOREIGN KEY (`daerah_id`) REFERENCES `daerah` (`daerah_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
