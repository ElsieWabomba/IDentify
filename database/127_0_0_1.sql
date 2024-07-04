-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 08:29 AM
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
-- Database: `vipande`
--
CREATE DATABASE IF NOT EXISTS `vipande` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vipande`;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `county` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `name`, `email`, `phone`, `location`, `county`) VALUES
(2, 'Kwa Chege', 'alpha@email.com', 839403, 'Tudor', 47),
(4, 'Jemo', 'jem@email.com', 233030, 'Juja', 23);

-- --------------------------------------------------------

--
-- Table structure for table `card_request`
--

CREATE TABLE `card_request` (
  `id` int(10) NOT NULL,
  `agency_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `phone` int(15) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_issued` datetime DEFAULT NULL,
  `type` int(10) NOT NULL DEFAULT 1,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_request`
--

INSERT INTO `card_request` (`id`, `agency_id`, `user_id`, `phone`, `request_date`, `date_issued`, `type`, `status`) VALUES
(2, 1, 1, 28384930, '2024-07-03 15:17:06', NULL, 1, 'new'),
(3, 2, 6, 28384930, '2024-07-03 16:03:51', NULL, 2, 'Complete'),
(4, 4, 7, 28384930, '2024-07-04 08:49:45', NULL, 1, 'Issued');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `clan` varchar(50) NOT NULL,
  `village` varchar(50) NOT NULL,
  `role` int(10) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `fathers_id` varchar(255) NOT NULL,
  `mothers_id` varchar(255) NOT NULL,
  `birth_cert` varchar(255) NOT NULL,
  `agency` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `phone`, `email`, `dob`, `pob`, `password`, `clan`, `village`, `role`, `profile_pic`, `fathers_id`, `mothers_id`, `birth_cert`, `agency`) VALUES
(6, 'Martin', 'wq', 'qq', 8393902, 'mattajulius815@gmail.com', '2024-07-02', 'CBD', '$2y$10$awU2OLOo32vJqu9Y./f7eO6rEnoJTWgvTNUjqmbs/0jdZmrypmr0C', 'mkwwo', 'kkdoa', 2, '2024-07-03-14-15-41-profile_pic.png', '2024-07-03-14-15-42-dadId.jpg', '2024-07-03-14-15-42-momId.jpg', '2024-07-03-14-15-42-birth_cert.jpg', 2),
(7, 'Keff', 'Joinyambe', 'Minagu', 92738923, 'mmattajulius815@gmail.com', '2024-07-03', 'Juja', '$2y$10$zBU53jLVOb4u9DOf09X02eAtYfF608Apv7T46ubT1c9GJF8Ehe.LK', 'Aduruma', 'Kiambu', 1, '2024-07-04-07-48-22-profile_pic.jpg', '2024-07-04-07-48-22-dadId.jpg', '2024-07-04-07-48-22-momId.jpg', '2024-07-04-07-48-22-birth_cert.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_request`
--
ALTER TABLE `card_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `card_request`
--
ALTER TABLE `card_request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
