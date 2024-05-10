-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 05:42 PM
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
('SHC98d267771fTCU', 'SHC614f', 'testing', 'test@gmail.com', '09482342532', 'hello', 'Wednesday, 05/15/2024', '2:00 PM', 'Central Avenue, Quezon City', '2024-05-10 22:45:31'),
('SHCae7eTCU', 'SHC84fb', 'pablo escobar', 'pabs@gmail.com', '0952738214', 'See you in my Appoitnment', 'Friday, 05/17/2024', '12:00 PM', 'Main Street, Makati City', '2024-05-10 15:40:51'),
('SHCc00aTCU', 'SHC8e99', 'davemarc Pesco', 'dave@gmail.com', '09314123252', 'hello', 'Monday, 05/13/2024', '8:00 AM', 'Bayani Road, Taguig City', '2024-05-10 15:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `fullname`, `email`, `username`, `pass`, `created_at`) VALUES
(1, 'SHC98d267771fTCU', 'testing', 'test@gmail.com', 'test', '$2y$12$/lDD.GKg1IWa9afu999fH.qtU1KPXkYH9OQhQgprGbwxSECtmWh8C', '2024-05-02 13:50:30'),
(2, 'SHCf54dTCU', 'john paul', 'johnpaul@gmail.com', 'jp', '$2y$12$07y94SroE0VxeNQHl2h1Tu3Kt7ihQ4cac/lBpzcC04JwVoTSvmipK', '2024-05-02 13:53:39'),
(3, 'SHC4853TCU', 'kaye dela cruz', 'kaye@gmail.com', 'kaye', '$2y$12$s5wgxBrew5dR1hyeThRAfOGP/RBITUmhO84GPHuh9gqQhkEFayTtu', '2024-05-02 14:40:11'),
(4, 'SHC069aTCU', 'juan pablo', 'juan@gmail.com', 'juan', '$2y$12$GXkDaXgrpUF44kkZSSvwpOM8TNUX.UT.pzdVXTlZUuFYqTBrUL0EC', '2024-05-03 21:22:34'),
(5, 'SHC2906TCU', 'leo puldo', 'leo@gmail.com', 'leo', '$2y$12$G31ln4TQZa8HQ6x4PTt0weJdq9uYolVKAkzqaKA14GMVRh8olo0YG', '2024-05-03 22:02:53'),
(6, 'SHC2c5eTCU', 'irene dela cruz', 'irene@gmail.com', 'irene', '$2y$12$D8pANo2Jh1e279diy41O3u6GRzilP99LJMrfu9UVyHNwpPcu7vtm.', '2024-05-04 00:37:10'),
(7, 'SHCb7adTCU', 'coco martin', 'coco@gmail.com', 'coco', '$2y$12$Lo03DVf4mUIxlzRPk5IOses0.8Ab/jxJW/WOdcJkBJ6rXnNZ5EHrm', '2024-05-04 00:47:06'),
(8, 'SHCae7eTCU', 'pablo escobar', 'pabs@gmail.com', 'pabs', '$2y$12$d3N9EPhUcxH4J7zMR.sV.OVotL1VcNG8JGK3ngyhaaEbJ9SS4Kk8i', '2024-05-07 16:15:13'),
(9, 'SHCc00aTCU', 'davemarc Pesco', 'dave@gmail.com', 'dave', '$2y$12$Oi1mRmSoqq8PKNVAr8F6QeAnezIR5BXqRmg673BNXJvjTpJAfbv6W', '2024-05-10 14:59:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
