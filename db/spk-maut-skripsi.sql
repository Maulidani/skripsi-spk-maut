-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2023 at 09:03 PM
-- Server version: 10.9.4-MariaDB
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-maut-skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bantuans`
--

CREATE TABLE `bantuans` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bantuans`
--

INSERT INTO `bantuans` (`id`, `name`, `detail`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 'blender', 'blender ini boss', 1, '2023-05-29 10:43:20', '2023-05-29 10:43:20'),
(5, 'jahitan', 'jahitan ini boss', 2, '2023-05-29 10:43:34', '2023-05-29 10:44:09'),
(6, 'Apaji bosku', 'asfa', 2, '2023-05-31 04:22:25', '2023-05-31 04:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `category_kwbs`
--

CREATE TABLE `category_kwbs` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_kwbs`
--

INSERT INTO `category_kwbs` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'makanan', 'makanan enak sekali', '2023-05-21 13:04:21', '2023-05-21 13:04:21'),
(2, 'jahitan', 'detail', '2023-05-28 08:14:04', '2023-05-28 08:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `kwbs`
--

CREATE TABLE `kwbs` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `name_leader` varchar(100) NOT NULL,
  `member` int(11) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kwbs`
--

INSERT INTO `kwbs` (`id`, `name`, `category_id`, `kecamatan`, `kelurahan`, `address`, `name_leader`, `member`, `checked`, `created_at`, `updated_at`) VALUES
(1, 'halo', 1, 'biringkanaya', 'laikang', 'jln goa ria', 'budi', 120, 0, '2023-05-21 13:04:47', '2023-05-28 00:42:40'),
(2, 'hi', 1, 'aefae', 'sefse', 'afaefa', 'oioi', 12, 0, '2023-05-25 00:13:33', '2023-05-28 00:42:40'),
(4, 'zdf', 2, 'dfg', 'dfb', 'dd', 'sfg', 2, 0, '2023-05-25 00:14:59', '2023-05-29 10:45:16'),
(7, 'bukbdr', 2, '2', '1', 'bmzdf', 'ksdfnes', 89, 0, '2023-05-25 00:38:47', '2023-05-28 00:44:24'),
(8, 'test', 1, 'af', 'zedf', 'zdf', 'zdf', 12, 0, '2023-05-29 12:57:06', '2023-05-29 12:57:06'),
(9, 'nama ku bento', 2, 'fsersff', 'xgfsrgs', 'xdgserukesh', 'bentoooo', 12, 0, '2023-05-31 04:35:45', '2023-05-31 04:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) NOT NULL,
  `bantuan_id` bigint(20) NOT NULL,
  `kwb_id` bigint(20) NOT NULL,
  `rank` int(11) NOT NULL,
  `version` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `bantuan_id`, `kwb_id`, `rank`, `version`, `created_at`, `updated_at`) VALUES
(136, 5, 9, 1, 'iyQUIAoZ55_1685538049', '2023-05-31 05:00:49', '2023-05-31 05:00:49'),
(138, 6, 9, 1, '7Ydia17HXu_1685538134', '2023-05-31 05:02:14', '2023-05-31 05:02:14'),
(139, 6, 7, 2, '7Ydia17HXu_1685538134', '2023-05-31 05:02:15', '2023-05-31 05:02:15'),
(140, 6, 9, 1, 'KDNmPVrHJU_1685538186', '2023-05-31 05:03:06', '2023-05-31 05:03:06'),
(141, 6, 4, 2, 'KDNmPVrHJU_1685538186', '2023-05-31 05:03:06', '2023-05-31 05:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bantuans`
--
ALTER TABLE `bantuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category_kwbs`
--
ALTER TABLE `category_kwbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kwbs`
--
ALTER TABLE `kwbs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bantuan_id` (`bantuan_id`),
  ADD KEY `kwb_id` (`kwb_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bantuans`
--
ALTER TABLE `bantuans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_kwbs`
--
ALTER TABLE `category_kwbs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kwbs`
--
ALTER TABLE `kwbs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bantuans`
--
ALTER TABLE `bantuans`
  ADD CONSTRAINT `bantuans_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_kwbs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kwbs`
--
ALTER TABLE `kwbs`
  ADD CONSTRAINT `kwbs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_kwbs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`bantuan_id`) REFERENCES `bantuans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`kwb_id`) REFERENCES `kwbs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
