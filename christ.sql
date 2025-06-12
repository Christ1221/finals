-- phpMyAdmin SQL Dump
-- version 5.2.2deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2025 at 02:50 PM
-- Server version: 11.8.1-MariaDB-4
-- PHP Version: 8.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `christ`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_tbl`
--

CREATE TABLE `books_tbl` (
  `id` int(9) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `issueDate` varchar(50) NOT NULL,
  `expiryDate` varchar(50) NOT NULL,
  `books_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `books_tbl`
--

INSERT INTO `books_tbl` (`id`, `book_title`, `author`, `category`, `issueDate`, `expiryDate`, `books_status`) VALUES
(1, 'Samples', 'Cordy', 'History', '2025-06-12', '2025-06-23', 'Available'),
(2, 'Samples2', 'Christian ', 'History', '2025-06-12', '2025-06-30', 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `username`, `email`, `passwd`, `fname`) VALUES
(20, 'admin', 'mglgain@gmail.com', '$2y$12$GY5w2BGUYE.SFLcpfmMuDOHczAZjk6300l4i7wYS5p5rnPC2aJJ3u', 'Marc Giestin Louis Cordova ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_tbl`
--
ALTER TABLE `books_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uni_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_tbl`
--
ALTER TABLE `books_tbl`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
