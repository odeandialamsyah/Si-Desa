-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2025 at 09:50 PM
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
(6, 'Konghucu', '2024-12-24 06:18:06', '2024-12-24 06:18:06'),
(7, 'islam', '2025-01-24 03:14:07', '2025-01-24 03:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `bantuan_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nama_bantuan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_bantuan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `foto_bukti` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penduduk_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`bantuan_id`, `user_id`, `nama_bantuan`, `jenis_bantuan`, `created_at`, `updated_at`, `status`, `foto_bukti`, `penduduk_id`) VALUES
(13, 7, 'kapal', 'Uang Tunai', '2025-01-24 14:31:59', '2025-01-27 21:27:34', 'approved', '1738013254_DSC00966.JPG', 6),
(14, 6, 'pupuk', 'Uang Tunai', '2025-01-27 21:32:33', '2025-01-27 21:46:54', 'approved', '1738014414_WhatsApp Image 2025-01-16 at 08.46.16_a1f7c1ac.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int NOT NULL,
  `Judul` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `greeting` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  `laporan_id` int NOT NULL,
  `nama_pelapor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `daerah_id` int NOT NULL,
  `laporan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_desa`
--

CREATE TABLE `pendapatan_desa` (
  `pendapatan_id` int NOT NULL,
  `nama_pendapatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `gambar_pendapatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
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
  `penduduk_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
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
  `foto_diri` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_kk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `user_id`, `daerah_id`, `agama_id`, `kk`, `nik`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `pekerjaan`, `gaji`, `jumlah_keluarga`, `foto_diri`, `created_at`, `updated_at`, `file_nik`, `file_kk`) VALUES
(4, 6, 12, 1, '1321091111234566', '1321091111234467', 'ode andi', 'Laki-laki', '2005-03-02', 'bandung', 'petani', '1000000.00', 2, 'ode_andi.jpg', '2025-01-21 06:38:47', '2025-01-27 21:31:35', 'ode_andi_nik.pdf', 'ode_andi_kk.pdf'),
(6, 7, 10, 2, '2187349832174837', '2187349832174838', 'ode andi alamsyah', 'Laki-laki', '2005-03-02', 'busoa', 'programmer', '4000000.00', 2, 'ode_andi_alamsyah.jpg', '2025-01-24 03:15:58', '2025-01-24 23:20:59', 'ode_andi_alamsyah_nik.pdf', 'ode_andi_alamsyah_kk.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `potensi_desa`
--

CREATE TABLE `potensi_desa` (
  `potensi_id` int NOT NULL,
  `nama_pariwisata` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` date NOT NULL,
  `gambar_pariwisata` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
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
  `user_id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$10$ozbFsYG6YPCGI/oqrHFjSuDZZCQwLS..1Ubq6rEj/wKxV3wTI6XX2', '2025-01-20 04:17:37', '2025-01-20 04:17:58', 'admin'),
(6, 'ode@gmail.com', '$2y$10$T.Xl0W8NBfFVrntgmMvqVeq1g1h/.cNIFJ5YazumXDdVEx7jP7TvO', '2025-01-20 04:35:58', '2025-01-20 04:35:58', 'user'),
(7, 'dila@gmail.com', '$2y$10$OADV3LKHYts2SVbZx1chduDdleymKKOt0ERgE/V3bgH8sDlCgegS.', '2025-01-24 02:29:07', '2025-01-24 02:29:07', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`bantuan_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `fk_user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `bantuan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `daerah_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `laporan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendapatan_desa`
--
ALTER TABLE `pendapatan_desa`
  MODIFY `pendapatan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `penduduk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  MODIFY `potensi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD CONSTRAINT `bantuan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`daerah_id`) REFERENCES `daerah` (`daerah_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
