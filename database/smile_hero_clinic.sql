-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 09:12 PM
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
-- Database: `smile_hero_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `user_id` varchar(20) NOT NULL,
  `appointment_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`user_id`, `appointment_id`, `name`, `email`, `contact`, `message`, `date`, `time`, `location`, `created_at`) VALUES
('SHCfa50TCU', 'SHC904d', 'leo poldo ', 'leo@gmail.com', '9423142352', 'hi', 'Monday, 05/20/2024', '9:00 AM', 'Main Street, Makati City', '2024-05-14 23:49:50'),
('SHC8cb8TCU', 'SHCaa42', 'John Paul Dela Cruz', 'delacruz@gmail.com', '9092141212', 'See you', 'Tuesday, 05/21/2024', '1:00 PM', 'Main Street, Makati City', '2024-05-15 03:07:06'),
('SHC8629TCU', 'SHCe89a', 'kaye paula', 'kayepaula@gmail.com', '9424242424', 'hello', 'Tuesday, 05/21/2024', '11:00 AM', 'Main Street, Makati City', '2024-05-15 01:27:18'),
('SHCc4cdTCU', 'SHCf37a', 'John Paul', 'jp@gmail.com', '2147483647', 'this is a message', 'Tuesday, 05/21/2024', '12:00 PM', 'Main Street, Makati City', '2024-05-14 23:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `fullname`, `email`, `contact`, `address`, `pass`, `created_at`) VALUES
(15, 'SHC61f2TCU', 'Juan Pablo', 'jp@gmail.com', 9141412312, 'Camarines Sur', '$2y$12$.QXA2R4kFrHw6QTsCE0ok.9bjwr0lOvQRZlVwjZnIAgyyk45fBVFa', '2024-05-14 23:44:09'),
(18, 'SHCfc66TCU', 'christian jake', 'cj@gmail.com', 9341221222, 'Daisy St. South Signal, Taguig City', '$2y$12$e.6wxt5.rtDa0TFELUvoceSpXAiENFzZ./PLz2iXhc45wdU0/ta2i', '2024-05-14 23:47:14'),
(19, 'SHCfa50TCU', 'leo poldo ', 'leo@gmail.com', 9423142352, NULL, '$2y$12$SqWDz9sKZ1nnE2dCbWwlHuasVyE/J2lXX/wNW6y1d8B2PcR2uXChy', '2024-05-14 23:47:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD UNIQUE KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
