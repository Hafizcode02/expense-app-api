-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2023 at 03:37 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_expense_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` bigint NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `id_user`, `type`, `price`, `payment_method`, `date`, `detail`) VALUES
(1, 32091, 'Barang Elektronik', 500000, 'Cash', '2023-07-11 00:00:00', 'Charger HP'),
(2, 32091, 'Bahan Makanan', 50000, 'Cash', '2023-07-11 02:49:57', 'Mie Goreng 1 Dus'),
(3, 32091, 'Kecantikan', 120000, 'Gopay', '2023-07-11 00:00:00', 'Skincare'),
(5, 32091, 'Lainnya', 1200000, 'Debit', '2023-07-11 00:00:00', 'Liburan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `photo_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `work_department` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`, `dob`, `gender`, `photo_url`, `work_department`, `created_at`, `updated_at`) VALUES
(32091, 'hafizcode02@gmail.com', '$2y$10$wuH15yU4U3hdVRQl23JedOu7tonhV2MoQ8SQPZeixyFom4hdE1IsO', 'Hafiz Caniago', '2002-12-31', 'L', 'profile.jpg', 'IT', '2023-07-11 10:58:33', '2023-07-11 10:58:33'),
(923110137, 'ramasinta@gmail.com', '$2y$10$gyYmUf1aMZfg8n1sRgMQzulcnkN1sqDOcfhQMBR2UhBBzNHaZLsHG', 'Rama Sinta', '2023-07-11', 'L', NULL, 'TI', '2023-07-11 12:37:01', '2023-07-11 12:37:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
