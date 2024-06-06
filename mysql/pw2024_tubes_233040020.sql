-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2024 at 07:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040020`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID` int NOT NULL,
  `NAMA` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID`, `NAMA`) VALUES
(1, 'Komputer'),
(2, 'Laptop'),
(3, 'Handphone'),
(4, 'Xbox');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID` int NOT NULL,
  `KATEGORI_ID` int NOT NULL,
  `NAMA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `HARGA` double NOT NULL,
  `FOTO` varchar(255) DEFAULT NULL,
  `DETAIL` text,
  `KETERSEDIAAN_STOK` enum('HABIS','TERSEDIA') DEFAULT 'TERSEDIA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID`, `KATEGORI_ID`, `NAMA`, `HARGA`, `FOTO`, `DETAIL`, `KETERSEDIAAN_STOK`) VALUES
(1, 1, 'monitor', 300000, 'xIvGzcF7PZ.jpg', 'monitor komputer canggih', 'TERSEDIA'),
(3, 3, 'idone 15', 200000, '5mjLs3biAt.jpg', 'hp paling canggih', 'TERSEDIA'),
(4, 4, 'xbox seri 7', 600000, 'WNi3ca9XYU.jpg', 'xbox terbaru', 'TERSEDIA'),
(5, 2, 'mikbek m11', 700000, 'JiTiNaZHws.jpg', 'mikbek dengan spek paling tinggi', 'HABIS'),
(6, 3, 'samsul s44', 900000, 'b0VoZZj7Ky.jpg', 'samsul seri paling baru', 'HABIS'),
(8, 1, 'pc gaming', 100000, 'SScObnowAe.jpg', 'pc gaming tahun 90an', 'TERSEDIA'),
(9, 2, 'laptop rgb', 8900000, '7fLGsrNtZW.jpg', 'laptop rgb', 'TERSEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'admin', '$2y$10$d9W.Ha5r1mzQFaUD65JnhOCf0YbfwyW.R7PssunKYb/4T6TBvPiiG'),
(3, 'admin2', '$2y$10$konWjVfRe.Z.HcLqAK5zmO1vyTtvRRYFf65JNR56UZ62Sg8tEZdhK'),
(4, 'Hilman', '$2y$10$yKrt5QcGHqpWAuckh3JI2uEbNe4O8CxOXljASUe.vDoT.LiUkda/m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NAMA` (`NAMA`),
  ADD KEY `KATEGORI_PRODUK` (`KATEGORI_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `KATEGORI_PRODUK` FOREIGN KEY (`KATEGORI_ID`) REFERENCES `kategori` (`ID`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
