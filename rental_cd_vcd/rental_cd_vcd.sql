-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 08:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_cd_vcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `cd`
--

CREATE TABLE `cd` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cd`
--

INSERT INTO `cd` (`id`, `judul`, `genre`, `stok`) VALUES
(3, 'Fast & Furious 9', 'Action', 100),
(4, 'The Avengers', 'Action', 100),
(5, 'Inception', 'Sci-Fi', 100),
(6, 'Interstellar', 'Sci-Fi', 100),
(7, 'Joker', 'Drama', 100),
(8, 'Parasite', 'Thriller', 100),
(9, 'Toy Story 4', 'Animation', 100),
(10, 'Coco', 'Animation', 100),
(11, 'Avengers: Endgame', 'Action', 100),
(12, 'John Wick', 'Action', 100),
(13, 'La La Land', 'Musical', 100),
(14, 'The Lion King', 'Animation', 100),
(15, 'Titanic', 'Romance', 100),
(16, 'Frozen II', 'Animation', 100),
(17, 'Deadpool', 'Action', 100),
(18, 'Black Panther', 'Action', 100),
(19, 'Doctor Strange', 'Sci-Fi', 100),
(20, 'Guardians of the Galaxy', 'Sci-Fi', 100),
(21, 'The Martian', 'Sci-Fi', 100),
(22, 'Bohemian Rhapsody', 'Drama', 100),
(23, 'A Star is Born', 'Drama', 100),
(24, 'Shrek', 'Animation', 100),
(25, 'Zootopia', 'Animation', 100),
(26, 'Aladdin', 'Musical', 100),
(27, 'Beauty and the Beast', 'Musical', 100),
(28, 'The Matrix', 'Sci-Fi', 100),
(29, 'Iron Man', 'Action', 100),
(30, 'Spider-Man: Homecoming', 'Action', 100),
(31, 'Wonder Woman', 'Action', 100),
(32, 'The Dark Knight', 'Action', 100);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_cd` int(11) DEFAULT NULL,
  `kode_sewa` varchar(20) DEFAULT NULL,
  `tanggal_sewa` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('disewa','kembali') DEFAULT 'disewa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pelanggan') DEFAULT 'pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(999, 'Kosasih', '$2y$10$PuZF0uCgkHo/MveKHKjXBuBDMglBHCIg4i5OYb6Pv.peNswXu03a2', 'pelanggan'),
(1000, 'admin', '$2y$10$ISrk7zNy1imahtZaXsU7j.cuP0pP40KtjoFc.aT0keCbLXTgI/9Se', 'admin'),
(1001, 'Muhamad fazrian', '$2y$10$ISrk7zNy1imahtZaXsU7j.cuP0pP40KtjoFc.aT0keCbLXTgI/9Se', 'admin'),
(1002, 'andi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1003, 'budi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1004, 'charlie', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1005, 'dina', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1006, 'edi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1007, 'fina', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1008, 'gina', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1009, 'haris', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1010, 'irwan', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1011, 'joko', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1012, 'kiki', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1013, 'lina', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1014, 'maya', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1015, 'nina', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1016, 'oki', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1017, 'peter', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1018, 'qila', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1019, 'raka', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1020, 'sari', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1021, 'tomi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1022, 'ucup', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1023, 'vian', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1024, 'wati', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1025, 'xena', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1026, 'yanu', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1027, 'zaki', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1028, 'amri', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1029, 'ben', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1030, 'cici', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1031, 'dodo', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1032, 'endi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1033, 'ferry', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1034, 'galih', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1035, 'hilda', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1036, 'indra', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1037, 'joni', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1038, 'kelly', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1039, 'lucky', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1040, 'mike', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1041, 'niko', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1042, 'oscar', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1043, 'putri', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1044, 'qori', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1045, 'rahmat', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1046, 'salma', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1047, 'tari', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1048, 'ucok', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1049, 'vivi', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1050, 'wawan', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1051, 'xenia', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1052, 'yusuf', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan'),
(1053, 'zara', '$2y$10$tOu4e6rZXkWnHknzz1pEBuzENcy9XUG6u.ZYIY7M1bRnwZ0w.zAVC', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cd`
--
ALTER TABLE `cd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_cd` (`id_cd`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cd`
--
ALTER TABLE `cd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1054;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_cd`) REFERENCES `cd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
