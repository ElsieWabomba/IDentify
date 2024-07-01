-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 07:36 AM
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
(1, 1, 1, 4890403, '2024-06-30 22:53:28', NULL, 1, '1');

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
  `agency` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `phone`, `email`, `dob`, `pob`, `password`, `clan`, `village`, `role`, `agency`) VALUES
(1, 'J', 'k', 'm', 283939, 'mmattajulius815@gmail.com', '2024-06-25', 'Mvita', '$2y$10$ja7q.CB.XoYTpQBIU/2bkuxTCFGS6E2lV7pGjQzVyt4rUWFrwrEyq', 'Mwiguithania', 'Chemilil', 1, 1);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
