-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 01:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-tutorial-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserRole` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserPassword`, `UserEmail`, `UserRole`) VALUES
(1, 'admin', '$2y$10$aSZgRkzKKDJYgsB1OVu1S.z0VyC3/wRkxc8aYI6UDaMcaMB9alzJy', 'admin@gmail.com', 0),
(3, 'staff', '$2y$10$qc7ZmVzIMTmwDVNbp34rLO8HoKPYkhiSQfBQkb8mWehEMwvxy48ZW', 'staff@gmail.com', 1),
(6, 'user', '$2y$10$kriHcrUi9EOKB1a0zSFaUOKzRp51XiacrUhpzCjpCFQEOxtE16rQ2', 'user@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
