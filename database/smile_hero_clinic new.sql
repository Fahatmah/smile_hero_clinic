-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 03:44 PM
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
(3, 'ADMIN5376', 'Leon', 'Manansala', 'admin@gmail.com', 9131231233, '$2y$10$.C8lSH7PEI47gBhCNCovf.vKD6wuexaB.ebXIL.v9FhkhsPI2bOTS', '2024-10-13 23:17:37');

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
('SHC786fTCU', NULL, 'SHC0395', '', 'Cj dela cruz', 'lems.christianjakedelacruz@gmail.com', '9989878778', '', '2024-10-14, Monday', '11:00 AM', 'filling', 'Bayani Road, Taguig City', 'canceled', '2024-10-13 15:42:28'),
('SHC786fTCU', NULL, 'SHC2522', 'new', 'Cj dela cruz', 'lems.christianjakedelacruz@gmail.com', '9989878778', '', '2024-10-15, Tuesday', '10:00 AM', 'whitening', 'Bayani Road, Taguig City', 'accepted', '2024-10-13 15:48:27'),
('Walk-in', NULL, 'SHC27ed', 'Walk-in', 'Test', 'test@gmail.com', '09312312331', '', '2024-10-14, Monday', '11:00 AM', 'whitening', 'Bayani Road, Taguig City', 'rejected', '2024-10-13 15:12:10'),
('SHC9d72TCU', NULL, 'SHC3753', 'new', 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', '9070050140', '', '2024-10-16, Wednesday', '11:00 AM', 'cleaning', 'Bayani Road, Taguig City', 'canceled', '2024-10-11 13:20:30'),
('SHC1677TCU', NULL, 'SHC5ba0', 'new', 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', '9070050140', '', '2024-10-21, Monday', '10:00 AM', 'whitening', 'Bayani Road, Taguig City', 'accepted', '2024-10-17 17:07:03'),
('SHC9d72TCU', NULL, 'SHC77f6', 'new', 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', '9070050140', '', '2024-10-14, Monday', '9:00 AM', 'extraction', 'Bayani Road, Taguig City', 'accepted', '2024-10-13 15:09:24'),
('Walk-in', NULL, 'SHC79d6', 'Walk-in', 'Jop', 'jp@gmail.om', '091823354555', '', '2024-10-17, Thursday', '9:00 AM', 'extraction', 'Bayani Road, Taguig City', 'request', '2024-10-14 10:49:19'),
('SHC0141TCU', NULL, 'SHC846e', '', 'Dave pesco', 'pdavemarc@gmail.com', '12354678911', '', '2024-10-15, Tuesday', '1:00 PM', 'cleaning', 'Bayani Road, Taguig City', 'accepted', '2024-10-14 10:32:18'),
('Walk-in', NULL, 'SHC8a31', 'Walk-in', 'Test', 'test@gmail.com', '09314234546', '', '2024-10-15, Tuesday', '11:00 AM', 'extraction', 'Bayani Road, Taguig City', 'rejected', '2024-10-13 15:49:39'),
('Walk-in', NULL, 'SHCbde4', 'Walk-in', 'Test3', 'test3@gmail.com', '09859454343', '', '2024-10-14, Monday', '9:00 AM', 'extraction', 'Bayani Road, Taguig City', 'accepted', '2024-10-13 15:27:01'),
('Walk-in', NULL, 'SHCc293', 'Walk-in', 'Test2', 'tes2@gmail.com', '09031349434', '', '2024-10-16, Wednesday', '10:00 AM', 'whitening', 'Bayani Road, Taguig City', 'rejected', '2024-10-13 15:26:32'),
('SHC786fTCU', NULL, 'SHCc618', '', 'Cj dela cruz', 'lems.christianjakedelacruz@gmail.com', '9989878778', '', '2024-10-16, Wednesday', '9:00 AM', 'whitening', 'Bayani Road, Taguig City', 'rejected', '2024-10-13 15:41:10');

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
('DOCdc43', 'Pablo', 'Escobar', '09454741547', 'Pab@gmail.com', '2024-10-11 05:15:49'),
('DOCe86d', 'Louise', 'Manzano', '09987873454', 'DocLMan@gmail.com', '2024-10-13 07:46:58');

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

INSERT INTO `feedback` (`id`, `user_id`, `doctor_id`, `name`, `email`, `feedback`, `rating`, `created_at`) VALUES
(4, 'SHC9d72TCU', NULL, 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', 'testing to\r\n', '4', '2024-10-12 16:08:51'),
(5, 'SHC786fTCU', NULL, 'Cj dela cruz', 'lems.christianjakedelacruz@gmail.com', 'Great Services', '5', '2024-10-13 15:40:33'),
(6, 'SHC0141TCU', NULL, 'Dave pesco', 'pdavemarc@gmail.com', 'good ', '5', '2024-10-14 10:26:19'),
(7, 'SHC1677TCU', NULL, 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', 'greate service', '5', '2024-10-17 17:05:04'),
(8, 'SHC1677TCU', NULL, 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', '', '4', '2024-10-17 21:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` set('male','female') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `label` varchar(100) NOT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `birthdate`, `gender`, `email`, `contact`, `address`, `pass`, `label`, `account_activation_hash`, `created_at`) VALUES
('SHC1677TCU', 'John Paul', 'Villaruel', 'Dela Cruz', '', '2002-02-18', 'male', 'jpvillaruel02@gmail.com', 9070050140, '10 everlasting st. zone 6 south signal village taguig city', '$2y$10$RsQe/6qv2NIG6dq2IUb5neDgyVAEw/PTLsQHr4wcOxTFWrnfvex8.', 'new', NULL, '2024-10-17 08:54:36'),
('SHCd4d9TCU', 'Test', 'Test', 'Test', '', '0000-00-00', NULL, 'test@gmail.com', 9412312311, NULL, '$2y$12$I1YMOttbDu8PYju.Gs98tuEjzhnkF2qzmGL0T3.IF0oG9g3kPU.La', '', '0bb02a979fb80e09a26b8994ec5181ab4b08c59c56769d156096daba1029ac83', '2024-10-17 12:26:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
