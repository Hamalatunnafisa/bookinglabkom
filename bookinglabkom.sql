-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20251005.967007883e
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2025 at 01:19 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookinglabkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_lab`
--

CREATE TABLE `booking_lab` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `lab` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `kode_booking` varchar(50) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','reject') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `format` enum('sedang','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking_lab`
--

INSERT INTO `booking_lab` (`id`, `nama`, `kelas`, `nim`, `nohp`, `lab`, `tanggal`, `jam_mulai`, `jam_selesai`, `keperluan`, `kode_booking`, `qr_code`, `status`, `created_at`, `format`) VALUES
(3, 'Hamalatun Nafisa', '3 Informatika A', '244110601024', '0889 6754 3421', 'Lab Komputer 1', '2025-12-05', '00:00:00', '00:00:00', 'Gabut pengen masuk lab', '', NULL, 'approve', '2025-12-05 15:34:00', 'selesai'),
(8, 'Rio Alwi Syahputra ', '12', '776688', '085848188786', 'Lab Komputer 1', '2025-12-11', '12:15:00', '14:55:00', 'matkul', 'BK-20251211-192025', 'Kode Booking: BK-20251211-192025\nNama: Rio Alwi Syahputra \nNIM: 776688\nLab: Lab Komputer 1\nTanggal: 2025-12-11\nWaktu: 12:15 - 14:55', 'approve', '2025-12-11 13:51:17', 'selesai'),
(9, 'cahyo aji', 'inf x', '665544', '0876546', 'Lab Komputer 2', '2025-12-11', '01:04:00', '01:02:00', 'tes', 'BK-20251211-47A70A', 'Kode Booking: BK-20251211-47A70A\nNama: cahyo aji\nNIM: 665544\nLab: Lab Komputer 2\nTanggal: 2025-12-11\nWaktu: 01:04 - 01:02', 'approve', '2025-12-11 16:00:05', 'selesai'),
(10, 'a', '1211', '111111', '11', 'Lab Komputer 1', '2025-12-25', '01:12:00', '06:17:00', 'matkul', 'BK-20251211-0A2D90', 'Kode Booking: BK-20251211-0A2D90\nNama: a\nNIM: 111111\nLab: Lab Komputer 1\nTanggal: 2025-12-25\nWaktu: 01:12 - 06:17', 'approve', '2025-12-11 17:12:07', 'selesai'),
(11, 'Rio Alwi Syahputra ', 'inf x', '4444', '4444', 'Lab Komputer 3', '2025-12-25', '00:44:00', '00:43:00', 'matkul', 'BK-20251211-0BB771', 'Kode Booking: BK-20251211-0BB771\nNama: Rio Alwi Syahputra \nNIM: 4444\nLab: Lab Komputer 3\nTanggal: 2025-12-25\nWaktu: 00:44 - 00:43', 'pending', '2025-12-11 17:43:38', 'sedang');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int NOT NULL,
  `lab` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `matakuliah` varchar(150) DEFAULT NULL,
  `pengampu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `lab`, `tanggal`, `jam`, `matakuliah`, `pengampu`) VALUES
(1, 'Lab Komputer 3', '2025-12-19', '21:01:00', 'Matkul', 'Pak yusuf'),
(2, 'Lab Komputer 1', '2025-12-06', '12:02:00', 'Sistem informasi', 'Pak anas'),
(3, 'Lab Komputer 2', '2025-12-28', '15:10:00', 'sistem basis data', 'pak edy');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int NOT NULL,
  `nama_lab` varchar(100) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `nama_lab`, `lokasi`, `kapasitas`, `status`) VALUES
(1, 'labkom1', 'lantai 2 gedung saintek', 25, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_penggunaan_lab`
--

CREATE TABLE `laporan_penggunaan_lab` (
  `id` int NOT NULL,
  `lab_id` int NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_penggunaan_lab`
--

INSERT INTO `laporan_penggunaan_lab` (`id`, `lab_id`, `peminjam`, `keperluan`, `tanggal`, `jam_mulai`, `jam_selesai`, `created_at`) VALUES
(2, 1, 'komputer', 'praktikum', '2025-12-11', '10:35:25', '15:35:25', '2025-12-06 10:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `isi_laporan` text NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `username`, `isi_laporan`, `tanggal`) VALUES
(1, 'ss', 'bagusbanget\r\n', '2025-12-11 17:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nim`, `user`, `password`, `role`, `created`) VALUES
(1, '123', 'alwi', 'cb485f19540f79486ba38f300e3740cb', 'user', '2025-12-04 07:49:33'),
(2, '12345', 'cahyo', '111', 'admin', '2025-12-04 07:59:07'),
(3, '122', 'alwee', '$2y$10$mRANEBQj7teiVOlkpfbqgeQ8ryWVJFmbJXLLN1EqEC.fd9TuaRK6e', 'user', '2025-12-04 08:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `nama`, `username`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(7, '2441', 'nafisa', 'nafisa24', 'bd273e238dc03056fff93c0e1e8de576', 'admin', 'active', '2025-12-08 06:33:45', '2025-12-11 13:49:07'),
(8, '23311', 'alwi', 'alwi12', '86df28556e29bfe0ab2431a6b07c3b01', 'admin', 'active', '2025-12-08 06:39:29', '2025-12-11 17:13:40'),
(9, '2441106', 'alviatus', 'alvi123', '5570b82c4533bcc41ca1655cfcfa811a', 'admin', 'active', '2025-12-09 07:58:04', '2025-12-09 07:58:04'),
(10, 'a111', 'apa', 'ss', '698d51a19d8a121ce581499d7b701668', 'user', 'active', '2025-12-11 17:10:45', '2025-12-11 17:10:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_lab`
--
ALTER TABLE `booking_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_penggunaan_lab`
--
ALTER TABLE `laporan_penggunaan_lab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_id` (`lab_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_lab`
--
ALTER TABLE `booking_lab`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan_penggunaan_lab`
--
ALTER TABLE `laporan_penggunaan_lab`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_penggunaan_lab`
--
ALTER TABLE `laporan_penggunaan_lab`
  ADD CONSTRAINT `laporan_penggunaan_lab_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
