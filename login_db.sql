-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 07:39 AM
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
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `category_docs` varchar(255) NOT NULL,
  `year` varchar(100) NOT NULL,
  `upload_docs` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `category_docs`, `year`, `upload_docs`, `is_active`, `user_id`) VALUES
(1, 'Photo', '2023', 'assets/docs/670910f110682-contact-banner.jpg', 1, 2),
(2, 'Aadhaar Card', '2022', 'assets/docs/6709110c41be7-importance of physical fitness in daily life.pdf', 1, 3),
(3, 'PAN Card', '2023', 'assets/docs/670911288b7bf-importance of physical fitness in daily life.pdf', 1, 4),
(4, 'Photo', '2024', 'assets/docs/6709117197202-logo.jpg', 1, 3),
(5, 'Photo', '2024', 'assets/docs/6709117198116-Screenshot 2024-09-04 132722.png', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(255) NOT NULL,
  `download_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id`, `user_id`, `document_id`, `download_time`) VALUES
(1, 2, 1, '2024-10-11 13:54:02'),
(2, 3, 4, '2024-10-11 13:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `is_admin`, `name`) VALUES
(1, 'admin@123', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Admin'),
(2, 'jack@11', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Jack'),
(3, 'tom@22', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Tom'),
(4, 'jerry@33', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Jerry'),
(5, 'john@55', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'John');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `download_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`),
  ADD CONSTRAINT `download_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
