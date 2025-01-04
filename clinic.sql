-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 01:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) NOT NULL,
  `pasien_id` int(255) NOT NULL,
  `poli_poli` int(11) NOT NULL,
  `jadwal_dokter_id` int(255) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `keluhan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `pasien_id`, `poli_poli`, `jadwal_dokter_id`, `no_antrian`, `tanggal_daftar`, `keluhan`) VALUES
(12, 1, 5, 25, 2, '2024-12-09', 'nKCLnsakcnsklncklsan'),
(13, 1, 5, 25, 3, '2024-12-09', 'sjdljsaldjsaldjlsa'),
(14, 1, 5, 25, 4, '2024-12-09', 'jasflkjaskfnsaklfnsakl'),
(16, 1, 5, 25, 1, '2024-12-10', 'dksjadksajkdjsakdjsalk'),
(18, 1, 5, 25, 2, '2024-12-10', 'aowdhoahwodhaodh'),
(19, 1, 5, 25, 20241213, '2024-12-13', 'djsdjsabdjbsajdsaksa'),
(20, 1, 5, 25, 20241213, '2024-12-13', 'sndjasdsandklsanklsankl'),
(21, 1, 5, 27, 20241213, '2024-12-13', 'nlnfklasnfklasnfksdfl'),
(22, 1, 5, 27, 2024, '2024-12-14', 'asjklsanfklsanfklas'),
(23, 1, 5, 27, 20241214, '2024-12-14', 'afksanfklsanfklsanfl'),
(24, 11, 8, 25, 20241220, '2024-12-20', 'nakcnsacnsajn'),
(25, 11, 8, 30, 20241223, '2024-12-23', 'bsdajkasbdkjsabdkj'),
(26, 11, 8, 30, 20241223, '2024-12-23', 'test kenapa akuu'),
(27, 11, 8, 30, 20241223, '2024-12-23', 'sdsadsadsadsadsa'),
(28, 14, 8, 32, 20241227, '2024-12-27', 'sakit pusing');

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) NOT NULL,
  `periksa_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `periksa_id`, `obat_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 9, 1),
(4, 9, 4),
(5, 10, 1),
(6, 11, 4),
(7, 12, 4),
(8, 13, 1),
(9, 14, 1),
(10, 15, 1),
(11, 16, 1),
(12, 17, 1),
(13, 18, 8),
(14, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `his_admin`
--

CREATE TABLE `his_admin` (
  `ad_id` int(20) NOT NULL,
  `ad_fname` varchar(200) DEFAULT NULL,
  `ad_lname` varchar(200) DEFAULT NULL,
  `ad_email` varchar(200) DEFAULT NULL,
  `ad_pwd` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_admin`
--

INSERT INTO `his_admin` (`ad_id`, `ad_fname`, `ad_lname`, `ad_email`, `ad_pwd`) VALUES
(1, 'System', 'Administrator', 'admin@mail.com', '4c7f5919e957f354d57243d37f223cf31e9e7181'),
(2, 'System', 'Administrator', 'admin@gmail.com', 'admin'),
(3, 'Cahyo', 'tri', 'admin4@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad'),
(4, 'Buckminster', 'Renee', 'tycuzehuj@mailinator.com', '92432e7c66519c4e404d347718ffe641a658ac7e'),
(5, 'Sheila', 'Alma', 'muvitokury@mailinator.com', '92432e7c66519c4e404d347718ffe641a658ac7e');

-- --------------------------------------------------------

--
-- Table structure for table `his_docs`
--

CREATE TABLE `his_docs` (
  `doc_id` int(20) NOT NULL,
  `doc_fname` varchar(200) DEFAULT NULL,
  `doc_email` varchar(200) DEFAULT NULL,
  `doc_pwd` varchar(200) DEFAULT NULL,
  `doc_number` varchar(200) DEFAULT NULL,
  `doc_dpic` varchar(200) DEFAULT NULL,
  `poli_id` int(11) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_docs`
--

INSERT INTO `his_docs` (`doc_id`, `doc_fname`, `doc_email`, `doc_pwd`, `doc_number`, `doc_dpic`, `poli_id`, `deleted_at`) VALUES
(20, 'dr akuu', 'doktor@gmail.com', 'da50200efff69566ac8ac4221e1a2615b40a2afe', '12345', 'Logo Udinus - Official 02.png', 8, NULL),
(23, 'doktor a', 'ds@gmail.com', '$2y$10$hWWvJxTX.8Sf3s34YMGzzemm7C1DewXTEwR6GO/F6mpTihEvItnNq', '3233227897', 'sertipatra.png', 5, '2024-12-27'),
(27, 'Cahyo', 'doktor1@gmail.com', '06ec0074bc54c137dabbe29c55e9cbba31da4955', '323322', NULL, 8, '2024-12-20'),
(28, 'Cahyo', 'doktor1@gmail.com', '06ec0074bc54c137dabbe29c55e9cbba31da4955', '323322', NULL, 8, '2024-12-20'),
(29, 'Chancellor', 'dok@gmail.com', 'da50200efff69566ac8ac4221e1a2615b40a2afe', '234832482', '', 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `his_pwdresets`
--

CREATE TABLE `his_pwdresets` (
  `id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `token` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `his_pwdresets`
--

INSERT INTO `his_pwdresets` (`id`, `email`, `token`, `status`, `pwd`) VALUES
(1, 'admin@mail.com', '298359011fb7d0753dc9ddf3929d3596c7f12f23', 'Pending', 'yiep6rjSUA'),
(2, 'admin@mail.com', '5a12cc89041471b0fbf5c9d7382d9c3bc0eda65e', 'Pending', 'M9WnPs6pZF'),
(3, 'admin@mail.com', 'c1e3a51edfa179db1266ae216326c386d96d5c30', 'Pending', 'mQaVrTZgEY'),
(5, 'admin@gmail.com', '79b9c127116c3f990fac9313796aa52f5d4b6b34', 'Pending', '2EnM9qYvbB'),
(6, 'admin@gmail.com', '79b9c127116c3f990fac9313796aa52f5d4b6b34', 'Pending', '2EnM9qYvbB'),
(7, 'admin@gmail.com', '79b9c127116c3f990fac9313796aa52f5d4b6b34', 'Pending', '2EnM9qYvbB'),
(8, 'admin@gmail.com', 'd05160ec5e4b776c7d799d4aad3637ec7643e6ce', 'Pending', 'KgijkxWCnv'),
(9, 'admin@gmail.com', 'd05160ec5e4b776c7d799d4aad3637ec7643e6ce', 'Pending', 'KgijkxWCnv'),
(10, 'admin@gmail.com', '8c85190e477d1efc34e6902565770f030848cd21', 'Pending', 'D9Wbt8SRIJ'),
(11, 'admin@gmail.com', '8c85190e477d1efc34e6902565770f030848cd21', 'Pending', 'D9Wbt8SRIJ'),
(12, 'admin@gmail.com', 'LoclJstTbQC4DjufRBAdq60G1MOeES', 'Pending', 'ce35253a6e6f0b352aeb022bbb2a9e'),
(13, 'admin@gmail.com', 'GdPptux2LhisOFS6VKn4Rzg7fNDckA', 'Pending', '9fdd4e0b4d78502ad0889a30953c6a'),
(14, 'admin@mail.com', 'WrL3HPkoeSP8OwEjf1BY2y7gCaRTQb', 'Pending', 'e959a7d8d00ea870be4cea4780eb74'),
(15, 'assdaadj@gmail.com', 't2Dc09yjfU3nTIeMukW4pmQqhdZ8FC', 'Pending', '76952fe509856e7817bd2b5f2e5225'),
(16, 'admin@mail.com', 'f856a8b33103a4658bded54e3d8bc1ca3d9992d4', 'Pending', 'vOT6ihu0jP'),
(17, 'admin@mail.com', 'f856a8b33103a4658bded54e3d8bc1ca3d9992d4', 'Pending', 'vOT6ihu0jP'),
(18, 'admin@gmail.com', '5c8d4148af86d4352bee25fb421caeed31165b6a', 'Pending', 'RpHg5NqkAw'),
(19, 'admin@gmail.com', '5c8d4148af86d4352bee25fb421caeed31165b6a', 'Pending', 'RpHg5NqkAw'),
(20, 'admin@mail.com', 'c74255d0a21980a3de697dfdc870f92411751879', 'Pending', 'genl4kbPzJ'),
(21, 'admin@mail.com', 'c74255d0a21980a3de697dfdc870f92411751879', 'Pending', 'genl4kbPzJ'),
(22, 'admin@mail.com', '74e35dbf46b54e9a98490faef65f66d0e45e020a', 'Pending', 'MWr5znlofu'),
(23, 'admin@mail.com', '74e35dbf46b54e9a98490faef65f66d0e45e020a', 'Pending', 'MWr5znlofu'),
(24, 'admin@gmail.com', '1df2c844803d803520f3d175cf965a438048c50c', 'Pending', '3IzqTpnRCy');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `dokter_id`, `hari`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(25, 20, 'senin', '23:38:08', '23:41:08', 'nonaktif'),
(26, 23, 'Jumat', '18:44:00', '20:48:00', 'nonaktif'),
(27, 23, 'Jumat', '13:03:00', '17:58:00', 'aktif'),
(28, 23, 'Jumat', '13:03:00', '17:58:00', 'nonaktif'),
(29, 20, 'Sabtu', '01:12:00', '04:12:00', 'aktif'),
(30, 20, 'Kamis', '14:14:00', '17:14:00', 'nonaktif'),
(31, 20, 'Selasa', '14:25:00', '01:29:00', 'nonaktif'),
(32, 20, 'Jumat', '10:41:00', '21:41:00', 'nonaktif'),
(33, 20, 'Selasa', '23:59:00', '02:00:00', 'nonaktif'),
(34, 20, 'Kamis', '14:30:00', '20:17:00', 'nonaktif');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `harga`, `deleted_at`) VALUES
(1, 'Paracetamol', 50000, NULL),
(4, 'OBH Kombi', 20000, '2024-12-17 23:52:06'),
(6, 'coba', 341231231, '2024-12-18 00:11:26'),
(7, 'Paracetamoldsdsadsadsa', 498324902, '2024-12-20 23:20:12'),
(8, 'OBH', 15000, '2024-12-27 14:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pas` varchar(255) NOT NULL,
  `no_ktp` int(255) NOT NULL,
  `no_hp` int(30) NOT NULL,
  `join_pas` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pas`, `no_ktp`, `no_hp`, `join_pas`, `deleted_at`) VALUES
(1, 'Joko Kumolo', 890, 12345, '2024-11-29 13:13:42', '2024-12-22'),
(2, 'Coba', 2147483647, 2342, '2024-12-09 15:19:39', NULL),
(11, 'cahyo AKUUU', 123456, 7890, '2024-12-20 16:23:05', NULL),
(12, 'pasienku', 2147483647, 2147483647, '2024-12-22 15:23:23', '2024-12-22'),
(13, 'Cahyo Tri A', 12345, 890, '2024-12-27 07:07:55', '2024-12-27'),
(14, 'cahyo pasien', 456, 890, '2024-12-27 07:12:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `daftar_poli_id` int(11) NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `catatan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `daftar_poli_id`, `tgl_periksa`, `total_biaya`, `catatan`) VALUES
(1, 23, '2024-12-14 00:00:00', 5620223, 'dsakdsnakldnsadlknsalkd'),
(2, 22, '2024-12-18 22:35:00', 155000, 'sjksbadjsabdjask'),
(3, 22, '2024-12-18 22:35:00', 170000, 'jasbdjasbdkjas'),
(4, 22, '2024-12-19 22:38:00', 25000, 'jsbjksabdkja'),
(5, 22, '2024-12-19 22:54:00', 25000, 'asbdjkasbkj'),
(6, 22, '2024-12-19 01:00:00', 25000, 'ndflkasndlksa'),
(7, 22, '2024-12-19 01:00:00', 25000, 'basdjkbsak'),
(8, 22, '2024-12-20 22:00:00', 25000, 'ajsbdkjasbja'),
(9, 22, '2024-12-20 23:09:00', 175000, 'nfksadfkjab'),
(10, 22, '2024-12-18 23:13:00', 155000, 'asbdjsadbjas'),
(11, 22, '2024-12-18 01:16:00', 170000, 'bdjasbdkj'),
(12, 22, '2024-12-18 02:17:00', 170000, 'sabdsadas'),
(13, 24, '2024-12-23 23:00:00', 200000, 'turu ya'),
(14, 19, '2024-12-23 01:25:00', 200000, 'kasdjasbdjasb'),
(15, 25, '2024-12-23 02:36:00', 200000, 'sdjasdkja'),
(16, 26, '2024-12-23 03:00:00', 200000, 'testttttttttttttttttttttttt'),
(17, 27, '2024-12-23 23:51:00', 200000, 'terbaruuuuuuuuuuuuuuuuuuuuuuu'),
(18, 28, '2024-12-30 23:29:00', 215000, 'turu dekkkk');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`, `deleted_at`) VALUES
(5, 'Umum', 'dsdsdsa', '2024-12-18 00:07:54'),
(8, 'Gigi', 'poli bagus dhbsdhja', NULL),
(10, 'hdjsad', 'sndsandsa', '2024-12-20 23:02:02'),
(13, 'AKuu', 'jafbkjasbakj', '2024-12-20 23:04:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`pasien_id`),
  ADD KEY `id_jadwal` (`jadwal_dokter_id`),
  ADD KEY `id_poli` (`poli_poli`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obat_id` (`obat_id`),
  ADD KEY `periksa_id` (`periksa_id`);

--
-- Indexes for table `his_admin`
--
ALTER TABLE `his_admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `his_docs`
--
ALTER TABLE `his_docs`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `poli_id` (`poli_id`);

--
-- Indexes for table `his_pwdresets`
--
ALTER TABLE `his_pwdresets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_docs` (`dokter_id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_poli_id` (`daftar_poli_id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `his_admin`
--
ALTER TABLE `his_admin`
  MODIFY `ad_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `his_docs`
--
ALTER TABLE `his_docs`
  MODIFY `doc_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `his_pwdresets`
--
ALTER TABLE `his_pwdresets`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_periksa` (`id`),
  ADD CONSTRAINT `daftar_poli_ibfk_3` FOREIGN KEY (`poli_poli`) REFERENCES `poli` (`id`);

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`periksa_id`) REFERENCES `periksa` (`id`);

--
-- Constraints for table `his_docs`
--
ALTER TABLE `his_docs`
  ADD CONSTRAINT `his_docs_ibfk_1` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`id`);

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `his_docs` (`doc_id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`daftar_poli_id`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
