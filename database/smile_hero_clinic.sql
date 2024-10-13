-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 10:07 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `first_name`, `last_name`, `email`, `contact`, `password`, `created_at`) VALUES
(3, 'ADMIN5376', 'Victor', 'Andress', 'admin@gmail.com', 9089132321, '$2y$10$.BH.IQUOpn80URHlA7rNTOwwxx/FQU6J3NHzHHb9efcVqdiAhKeZS', '2024-10-12 08:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `user_id` varchar(100) NOT NULL,
  `doctor_id` varchar(100) DEFAULT NULL,
  `appointment_id` varchar(20) NOT NULL,
  `label` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `service` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`user_id`, `doctor_id`, `appointment_id`, `label`, `name`, `email`, `contact`, `message`, `date`, `time`, `service`, `location`, `status`, `created_at`) VALUES
('SHC9d72TCU', NULL, 'SHC3753', 'new', 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', '9070050140', '', '2024-10-16, Wednesday', '11:00 AM', 'cleaning', 'Bayani Road, Taguig City', 'canceled', '2024-10-11 13:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `phone_number`, `email`, `created_at`) VALUES
('DOCcab8', 'April', 'Gonzales', '09332244634', 'DocAprilG@gmail.com', '2024-10-12 06:38:18'),
('DOCdc43', 'Pablo', 'Escobar', '09454741547', 'Pab@gmail.com', '2024-10-11 05:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `doctor_id` varchar(100) DEFAULT NULL,
  `name` varchar(299) NOT NULL,
  `email` varchar(299) NOT NULL,
  `feedback` text NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` set('male','female') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `label` varchar(100) NOT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `birthdate`, `gender`, `email`, `contact`, `address`, `pass`, `label`, `account_activation_hash`, `created_at`) VALUES
('SHC9d72TCU', 'John Paul Dela Cruz', '2002-08-18', '', 'jpvillaruel02@gmail.com', 9070050140, '10 everlasting st. zone 6 south signal village taguig city', '$2y$12$Eq.pBctIxUZoztGSHJcH/eYVPTguRsT3qPDdVbctDoU4BV0lNMu9e', 'new', NULL, '2024-10-11 13:12:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
