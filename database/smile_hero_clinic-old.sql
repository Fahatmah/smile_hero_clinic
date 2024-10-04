-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2024 at 03:29 AM
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
  `email` varchar(255) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

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
  `status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`user_id`, `appointment_id`, `name`, `email`, `contact`, `message`, `date`, `time`, `location`, `status`, `created_at`) VALUES
('SHC5d4aTCU', 'SHC5f4c', 'jp', 'jpvillaruel02@gmail.com', '9070050140', '', 'Monday, 08/12/2024', '5:00 PM', 'Central Avenue, Quezon City', 'accepted', '2024-08-08 19:09:35'),
('SHCc601TCU', 'SHCbf45', 'Fahatmah Mabang', 'fahatmahmabang9@gmail.com', '9265369733', '', 'Thursday, 09/19/2024', '12:00 PM', 'Bayani Road, Taguig City', 'request', '2024-09-11 09:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `phone_number`, `email`, `created_at`) VALUES
(1, 'Michael', 'Smith', '91234567890', 'michael.smith@dentalclinic.com', '2024-09-11 00:33:15'),
(2, 'Emily', 'Johnson', '92345678901', 'emily.johnson@dentalclinic.com', '2024-09-11 00:33:15'),
(3, 'David', 'Brown', '93456789012', 'david.brown@dentalclinic.com', '2024-09-11 00:33:15'),
(4, 'Sarah', 'Davis', '94567890123', 'sarah.davis@dentalclinic.com', '2024-09-11 00:33:15'),
(5, 'James', 'Wilson', '95678901234', 'james.wilson@dentalclinic.com', '2024-09-11 00:33:15'),
(6, 'Anna', 'White', '91234567891', 'annawhite@dentalclinic.com', '2024-09-11 01:04:34'),
(7, 'Mark', 'Taylor', '91234567892', 'marktaylor@dentalclinic.com', '2024-09-11 01:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(299) NOT NULL,
  `email` varchar(299) NOT NULL,
  `feedback_type` varchar(100) NOT NULL,
  `feedback` varchar(399) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback_type`, `feedback`) VALUES
(8, 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', 'compliment', 'Good clinic will make an appointment again in this clinic so good i think this will gonna be my clinic now and i will recommend this clinic to my freinds and family. The service is very Fantastic hope it will last longer.');

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
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `fullname`, `email`, `contact`, `address`, `pass`, `account_activation_hash`, `created_at`) VALUES
(31, 'SHC9516TCU', 'christian jake dela cruz', 'lems.christianjakedelacruz@gmail.com', 9289403281, NULL, '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQyf8KbfHcg2', NULL, '2024-05-27 18:20:47'),
(33, 'SHCc601TCU', 'Fahatmah Mabang', 'fahatmahmabang9@gmail.com', 9265369733, NULL, '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.zmZCxVXUUXy', NULL, '2024-05-28 18:27:03'),
(34, 'SHCf23fTCU', 'Calderon', 'joevilzonc@gmail.com', 91324123122, NULL, '$2y$12$fxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpCbt0HMGs9mO', NULL, '2024-05-28 18:53:23'),
(42, 'SHC5d4aTCU', 'jp', 'jpvillaruel02@gmail.com', 9070050140, NULL, '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1GcKKtRYZD.', NULL, '2024-08-08 19:02:13');

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
  ADD UNIQUE KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_activation_hash` (`account_activation_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
