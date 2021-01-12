-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 11:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symf4`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`) VALUES
(1, NULL, 'Electronic'),
(2, NULL, 'Toys'),
(3, NULL, 'Books'),
(4, NULL, 'Movies'),
(5, 1, 'Cameras'),
(6, 1, 'Computers'),
(7, 1, 'Cell Phones'),
(8, 6, 'Laptops'),
(9, 6, 'Desktops');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210111135649', '2021-01-11 14:56:49', 243);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vimeo_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `name`, `last_name`, `vimeo_api_key`) VALUES
(1, 'sh3rkan21@yahoo.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$eEs2bmdwc2FHMHJSOXl4cw$8fRTQbfhY+Z/34/W5A2QBoG2B9W2WpyIb7mP/eycA/A', 'Alex', 'Petrescu', 'hjfdgs6n'),
(2, 'sh3rkan21doi@yahoo.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$MDZlLnl4aGozS0ZVbTFTdQ$LnaCTmrtpsviObIzqKMjemS6ChV560EK03iSWMW60GY', 'Alex', 'Petrescu2', NULL),
(3, 'sh3rkan2121@yahoo.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$YVk4b1E0b3pLUTlZUlIvcg$WF8O9ccSEUFPX/BG6WwAgCZjAOaKKmflXqs/kDvBglY', 'Alex', 'Popescu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `category_id`, `title`, `path`, `duration`) VALUES
(1, 1, 'Electronic 1', 'https://player.vimeo.com/video/289729765', 250),
(2, 1, 'Electronic 2', 'https://player.vimeo.com/video/238902809', 208),
(3, 1, 'Electronic 3', 'https://player.vimeo.com/video/150870038', 190),
(4, 1, 'Electronic 4', 'https://player.vimeo.com/video/219727723', 38),
(5, 1, 'Electronic 5', 'https://player.vimeo.com/video/289879647', 124),
(6, 1, 'Electronic 6', 'https://player.vimeo.com/video/261379936', 58),
(7, 1, 'Electronic 7', 'https://player.vimeo.com/video/289029793', 209),
(8, 1, 'Electronic 8', 'https://player.vimeo.com/video/60594348', 53),
(9, 1, 'Electronic 9', 'https://player.vimeo.com/video/290253648', 149),
(10, 2, 'Toys  1', 'https://player.vimeo.com/video/289729765', 41),
(11, 2, 'Toys  2', 'https://player.vimeo.com/video/289729765', 280),
(12, 2, 'Toys  3', 'https://player.vimeo.com/video/289729765', 48),
(13, 2, 'Toys  4', 'https://player.vimeo.com/video/289729765', 63),
(14, 2, 'Toys  5', 'https://player.vimeo.com/video/289729765', 75),
(15, 2, 'Toys  6', 'https://player.vimeo.com/video/289729765', 231),
(16, 3, 'Books 1', 'https://player.vimeo.com/video/289729765', 12),
(17, 3, 'Books 2', 'https://player.vimeo.com/video/289729765', 36),
(18, 3, 'Books 3', 'https://player.vimeo.com/video/289729765', 239),
(19, 4, 'Movies 1', 'https://player.vimeo.com/video/289729765', 83),
(20, 4, 'Movies 2', 'https://player.vimeo.com/video/289729765', 140),
(21, 4, 'Movies 3', 'https://player.vimeo.com/video/289729765', 248);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3AF346685E237E06` (`name`),
  ADD KEY `IDX_3AF34668727ACA70` (`parent_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29AA643212469DE2` (`category_id`),
  ADD KEY `title_idx` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_3AF34668727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `FK_29AA643212469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
