-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 03:51 AM
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
  `contact` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(299) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `first_name`, `last_name`, `email`, `contact`, `password`, `profile_image`, `created_at`) VALUES
(3, 'ADMIN5376', 'Lance', 'Pagaras', 'admin@gmail.com', '09887876645', '$2y$10$BC.SEPClr46MmplY5jSUzulM8sf9lKcIATa2bu81pd4Kd8w1zidLu', '', '2024-12-10 04:27:20');

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
('SHCb9caTCU', 'DOC7069', 'SHC859e', 'regular', 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', '09070050140', '', '2024-12-17', '1:00 PM', 'Dental Filling, Braces Consultation', 'Bayani Road, Taguig City', 'completed', '2024-12-13 23:11:08'),
('SHCb9caTCU', 'DOC30ca', 'SHC8791', 'regular', 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', '09070050140', '', '2024-12-17', '9:00 AM', 'Dental Filling, Braces Consultation', 'Bayani Road, Taguig City', 'accepted', '2024-12-14 01:10:36'),
('SHC94d0TCU', 'DOC7069', 'SHCd1fc', 'walk-in', 'Testwalkin Testwalkin Testwalkin ', 'jpvillaruel02@gmail.com', '09412151251', '', '2024-12-14', '2:00 PM', 'Teeth Whitening, Dental Filling', 'Bayani Road, Taguig City', 'accepted', '2024-12-14 00:47:47'),
('SHCd55bTCU', 'DOC30ca', 'SHCedaf', 'regular', 'Limuel Morales Tagumpay ', 'test@gmail.com', '09532542223', '', '2024-12-18', '3:00 PM', 'Dental Filling, Braces Consultation', 'Bayani Road, Taguig City', 'accepted', '2024-12-10 17:14:15'),
('SHCVP16TCU', 'DOCZR33', 'SHCTY84', 'regular', 'Mason Allen', 'mason.allen@example.com', '09182345678', 'I would like a root canal treatment', '2024-12-12', '11:00 am', 'Root Canal Treatment', 'Bayani Road, Taguig City', 'completed', '2024-11-05 15:15:00'),
('SHCAG23TCU', 'DOCMD67', 'SHCUI53', 'new', 'Olivia Davis', 'olivia.davis@example.com', '09215678901', 'I need braces consultation', '2024-11-22', '4:00 pm', 'Braces Consultation', 'Bayani Road, Taguig City', 'missed', '2024-11-08 11:21:48'),
('SHCWB38TCU', 'DOCPX94', 'SHCUM61', 'walk-in', 'Lucas Martinez', 'lucas.martinez@example.com', '09234567890', 'I would like a teeth cleaning', '2024-11-21', '2:00 am', 'Teeth Cleaning', 'Bayani Road, Taguig City', 'missed', '2024-11-21 14:32:11');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_dates`
--

CREATE TABLE `appointment_dates` (
  `id` int(11) NOT NULL,
  `available_dates` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_dates`
--

INSERT INTO `appointment_dates` (`id`, `available_dates`, `created_at`) VALUES
(13, '2024-12-18', '2024-11-12 23:45:23'),
(14, '2024-12-17', '2024-11-12 23:45:23'),
(15, '2024-12-26', '2024-11-12 23:45:23'),
(16, '2024-12-19', '2024-11-12 23:45:23'),
(17, '2024-12-20', '2024-11-12 23:45:23'),
(18, '2024-12-27', '2024-11-12 23:45:23'),
(27, '2024-12-16', '2024-11-15 11:48:34'),
(36, '2024-12-23', '2024-11-15 23:25:21'),
(37, '2024-12-24', '2024-11-15 23:25:21'),
(38, '2024-12-25', '2024-11-15 23:25:21'),
(39, '2024-12-30', '2024-11-15 23:25:21'),
(40, '2024-12-31', '2024-11-15 23:25:21'),
(127, '2024-12-14', '2024-11-29 22:32:39'),
(128, '2024-12-21', '2024-11-29 22:32:39'),
(129, '2024-12-28', '2024-11-29 22:32:39'),
(130, '2025-01-08', '2024-11-30 15:22:09'),
(131, '2025-01-09', '2024-11-30 15:22:09'),
(132, '2025-01-07', '2024-11-30 15:22:09'),
(133, '2025-01-13', '2024-11-30 15:22:09'),
(134, '2025-01-14', '2024-11-30 15:22:09'),
(135, '2025-01-15', '2024-11-30 15:22:09'),
(136, '2025-01-16', '2024-11-30 15:22:09'),
(137, '2025-01-17', '2024-11-30 15:22:09'),
(138, '2025-01-20', '2024-11-30 16:02:01'),
(139, '2025-01-21', '2024-11-30 16:02:01'),
(140, '2025-01-23', '2024-11-30 16:02:01'),
(141, '2025-01-22', '2024-11-30 16:02:01'),
(142, '2025-01-30', '2024-11-30 16:02:01'),
(143, '2025-01-29', '2024-11-30 16:02:01'),
(144, '2025-01-28', '2024-11-30 16:02:01'),
(145, '2025-01-06', '2024-12-05 08:57:14'),
(146, '2025-01-27', '2024-12-05 08:57:14'),
(147, '2025-01-05', '2024-12-05 08:57:14'),
(148, '2025-01-12', '2024-12-05 08:57:14'),
(149, '2025-01-19', '2024-12-05 08:57:14'),
(150, '2025-01-26', '2024-12-05 08:57:14'),
(151, '2025-01-10', '2024-12-05 00:51:06'),
(152, '2025-01-03', '2024-12-05 00:51:06'),
(153, '2025-01-02', '2024-12-05 00:51:06'),
(154, '2025-01-01', '2024-12-05 00:51:06'),
(155, '2025-01-24', '2024-12-05 00:51:06'),
(156, '2025-01-31', '2024-12-05 00:51:06'),
(158, '2024-12-15', '2024-12-06 02:47:35'),
(159, '2024-12-22', '2024-12-06 02:47:35'),
(160, '2024-12-29', '2024-12-06 02:47:35');

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
  `availability` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `phone_number`, `email`, `availability`, `created_at`) VALUES
('DOC30ca', 'Marlon', 'Quezon', '09745647456', 'MArQ2003@gmail.com', 'On Duty', '2024-11-29 14:37:45'),
('DOC577e', 'Mark', 'Josefa', '09412131312', 'DcJose@gmail.com', 'On Duty', '2024-11-24 07:18:24'),
('DOC7069', 'Allan ', 'Cayetano', '09412131312', 'Allcayo@gmail.com', 'Off Duty', '2024-11-24 12:04:13'),
('DOCca26', 'Juan', 'Dela Cruz', '09581241242', 'JuanD@gmail.com', 'On Duty', '2024-11-30 07:26:00');

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
(25, 'SHCd55bTCU', NULL, 'Limuel Morales Tagumpay ', 'test@gmail.com', 'Awesome!! Will be back again to you clinic the service is great and the staff is very good', '5', '2024-12-05 00:50:15'),
(26, 'SHCf08fTCU', NULL, 'Dave Llaneta Pesco ', 'pdavemarc@gmail.com', 'ill rate this appointment system 9/11 ðŸ¥°ðŸ¥°ðŸ¥°', '5', '2024-12-05 01:23:48'),
(27, 'SHCb9caTCU', NULL, 'John Paul Villaruel Dela Cruz ', 'jpvillaruel02@gmail.com', 'Awesome Service aesthetic place', '5', '2024-12-06 02:44:05'),
(28, 'SHCfbdaTCU', NULL, 'DAV L PESCO JR', 'pdavemarc@gmail.com', 'wao linis pati gilagid', '5', '2024-12-06 06:22:54'),
(29, 'SHCed7fTCU', NULL, 'Ray-Daniel Loquias Pelonia ', 'pelonia122@gmail.com', '\"Exceptional service and professionalism! The staff is incredibly friendly, and the clinic is spotless and welcoming. They truly prioritize patient comfort and provide top qualithy care. Highly recommend for anyone looking for a trustworthy dental clinic!\"', '5', '2024-12-07 02:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(10) NOT NULL,
  `service_name` varchar(299) NOT NULL,
  `service_price` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_price`, `created_at`) VALUES
(26, 'Teeth Cleaning', '500', '2024-12-13 22:42:42'),
(27, 'Teeth Whitening', '700', '2024-12-13 22:42:57'),
(28, 'Tooth Extraction', '1,500', '2024-12-13 22:43:19'),
(29, 'Dental Filling', '300', '2024-12-13 22:43:43'),
(31, 'Braces Consultation', '400', '2024-12-13 22:44:12'),
(32, 'Root Canal Treatment', '2,100', '2024-12-13 22:44:27');

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
  `birthdate` date DEFAULT NULL,
  `gender` set('male','female') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `label` varchar(100) DEFAULT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `birthdate`, `gender`, `email`, `contact`, `address`, `pass`, `label`, `account_activation_hash`, `reset_token_hash`, `reset_token_expires_at`, `created_at`) VALUES
('SHC5136TCU', 'Fahatmah', 'Takulanga', 'Mabang', '', NULL, NULL, 'fahatmahmabang9@gmail.com', '09265369733', NULL, '$2y$12$iQXlGmM2RSw..gSfw2goFe9m2obcEsXtVs3R3/Q2oNeRMvnhUqHeq', 'regular', NULL, NULL, NULL, '2024-12-06 14:31:59'),
('SHCA1B2CTCU', 'Sophia', 'L.', 'Wilson', '', '1990-07-15', 'female', 'sophia.wilson@example.com', '09191234567', '456 Maple St, Taguig City', 'password123', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCAG12TCU', 'Jane', 'Marie', 'Smith', '', '1995-08-20', 'female', 'jane.smith@example.com', '09181234567', '56 Oak Road, Makati, Philippines', 'hashedpassword456', 'regular', NULL, '0e4e415b13549ee5e5f6dbff983c08e16233f727e96244a48913cd5089d15b01', '2024-11-19 09:08:28', '2024-11-19 09:15:34'),
('SHCAY99TCU', 'Henry', 'Isaac', 'Clark', '', '1990-01-17', 'male', 'henry.clark@example.com', '09161234567', '888 Birch Lane, Manila, Philippines', '$2y$12$Q6BQHPqxUCMvWNm5TXh1xuiM9gi5hS0ROZEhK9NKPVBUl0GrHZyVm', 'new', NULL, NULL, NULL, '2024-11-30 04:24:08'),
('SHCB2C3DTCU', 'Liam', '', 'Taylor', '', '1991-09-12', 'male', 'liam.taylor@example.com', '09193456789', '789 Pine St, Taguig City', '$2y$12$A5muJF.7Ol329Jm3.lHUZudB7SM6Ix222ZNmYstBL1P1oH.ur0Rly', 'regular', NULL, NULL, NULL, '2024-12-01 15:03:18'),
('SHCb65fTCU', 'Joevilzon', 'Macuja', 'Calderon', '', NULL, NULL, 'joevilzon.calderon@deped.gov.ph', '09177067955', NULL, '$2y$12$Ai59hU1ftCTuWv3XFeKVG.e91dDZvgDKTSwMoR15QroIwEvVej4gC', 'new', NULL, NULL, NULL, '2024-11-27 12:36:11'),
('SHCb9caTCU', 'John Paul', 'Villaruel', 'Dela Cruz', '', '2002-08-18', 'male', 'jpvillaruel02@gmail.com', '09070050140', '10 Everlasting St. Zone 6 South Signal Village Taguig City', '$2y$10$9eJ9bJXBelirvBY0YEUWx.RuwoIejsP9CPYjCrvcV8TWXt8jfVgCe', 'regular', NULL, NULL, NULL, '2024-12-06 10:38:56'),
('SHCBE87TCU', 'Jacob', 'Samuel', 'Scott', '', '1995-09-14', 'male', 'jacob.scott@example.com', '09201234567', '78 Cedar Avenue, Mandaluyong, Philippines', '$2y$12$sBdXzP8iuc1pWGX1Ui3lKeJ1YM8SJxlJKDCgJdq32BMctre.jOwHW', 'new', NULL, NULL, NULL, '2024-12-01 15:08:43'),
('SHCBX89TCU', 'John', 'Michael', 'Doe', 'Jr.', '1990-05-15', 'male', 'john.doe@example.com', '09171234567', '1234 Elm Street, Quezon City, Philippines', '$2y$12$I.s8z3rAkKGvfgA.QRu5RuJNN1bDzzH94QPDulvilt5c6PHxUCTxS', 'regular', NULL, NULL, NULL, '2024-12-01 15:13:07'),
('SHCC3D4ETCU', 'Olivia', 'A.', 'Garcia', '', '1993-03-22', 'female', 'olivia.garcia@example.com', '09195678901', '123 Oak St, Taguig City', 'password789', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCD4E5FTCU', 'Noah', 'T.', 'Harris', '', '1987-10-05', 'male', 'noah.harris@example.com', '09197890123', '654 Birch St, Taguig City', 'password101', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCDB04TCU', 'Matthew', 'Jacob', 'Martinez', '', '1999-04-16', 'male', 'matthew.martinez@example.com', '09184920234', '567 Birch Lane, Pasig, Philippines', '$2y$12$qVSg//Y1sIPEd7BZ3n5xeeg49v7lk6o6PCx/xZd.9y/HZJKhNCm2C', 'regular', NULL, NULL, NULL, '2024-11-30 06:09:25'),
('SHCDP90TCU', 'Ethan', 'Jacob', 'Mitchell', '', '2001-08-30', 'male', 'ethan.mitchell@example.com', '09123456789', '64 Birch Road, Taguig, Philippines', '$2y$12$ed/7WjbF44fcXVYREn9SFuGjy04FITttqrBRjeqsHgEmWSUOSDoh6', 'new', NULL, NULL, NULL, '2024-11-20 06:08:48'),
('SHCDR57TCU', 'Carlos', 'Eduardo', 'Lopez', '', '1987-03-25', 'male', 'carlos.lopez@example.com', '09221234567', '789 Pine Avenue, Pasig, Philippines', 'hashedpassword789', 'new', NULL, 'ab51989b2917bde3befa5c3ac762f2c3293b3e5c820302ac06f460afc3bdf179', '2024-11-30 07:23:10', '2024-11-30 05:53:10'),
('SHCE5F6GTCU', 'Emma', '', 'Martinez', 'Jr.', '1995-05-10', 'female', 'emma.martinez@example.com', '09192347890', '321 Main St, Taguig City', 'password202', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCed7fTCU', 'Ray-Daniel', 'Loquias', 'Pelonia', '', '2002-12-11', 'male', 'pelonia122@gmail.com', '09403904293', 'Block 63 Lot 3 Durian St. Brgy. North Signal Village, Taguig City, Metro Manila', '$2y$12$ZX8xAeqimWvETjOL7Xaqpu0PxAu0Cu3HOwuO/nPumHhSX/rJJC2S6', 'regular', NULL, NULL, NULL, '2024-12-07 09:06:35'),
('SHCF6G7HTCU', 'James', 'L.', 'Lee', '', '1992-02-28', 'male', 'james.lee@example.com', '09194561234', '432 Elm St, Taguig City', 'password303', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCfbdaTCU', 'DAV', 'L', 'PESCO', 'JR', NULL, NULL, 'pdavemarc@gmail.com', '09262029197', NULL, '$2y$12$kgytbHX2MzLtRXmMjK299uuMTi.l9CW6SKem/9DHIRLwXrsZ5D1oO', 'regular', NULL, NULL, NULL, '2024-12-06 11:56:01'),
('SHCFN29TCU', 'Eli', 'Maxwell', 'Foster', '', '1990-05-28', 'male', 'eli.foster@example.com', '09215554321', '345 Pine Road, Manila, Philippines', 'hashedpassword737', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCFN34TCU', 'Maria', 'Lucia', 'Garcia', '', '1992-07-10', 'female', 'maria.garcia@example.com', '09321234567', '12 Maple Street, Taguig, Philippines', '$2y$12$dimymBCbQv9n2w2bQGmeheLtAQovAjh7HUYYPz7dL4NZBNo50GCeK', 'new', NULL, NULL, NULL, '2024-11-20 06:17:39'),
('SHCFT63TCU', 'Henry', 'Leo', 'Hughes', '', '1995-01-04', 'male', 'henry.hughes@example.com', '09197654321', '111 Pine Street, Pasig, Philippines', 'hashedpassword525', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCFU30TCU', 'William', 'Lucas', 'Young', '', '1993-07-22', 'male', 'william.young@example.com', '09174856321', '302 Pine Avenue, Cebu, Philippines', 'hashedpassword414', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCG7H8ITCU', 'Amelia', 'D.', 'Brown', '', '1990-06-18', 'female', 'amelia.brown@example.com', '09195671234', '213 Pine St, Taguig City', 'password404', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCGA03TCU', 'Benjamin', 'David', 'Evans', '', '1991-08-29', 'male', 'benjamin.evans@example.com', '09199876543', '650 Birch Road, Taguig, Philippines', 'hashedpassword545', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCGX15TCU', 'Ella', 'Madeline', 'King', '', '2000-02-12', 'female', 'ella.king@example.com', '09183324567', '222 Birch Lane, Taguig, Philippines', 'hashedpassword515', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCH8I9JTCU', 'Lucas', '', 'White', '', '1993-11-23', 'male', 'lucas.white@example.com', '09197892345', '654 Maple St, Taguig City', 'password505', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCHJ48TCU', 'Samantha', 'Lily', 'Baker', '', '1993-05-05', 'female', 'samantha.baker@example.com', '09224657890', '67 Maple Street, Taguig, Philippines', 'hashedpassword222', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCI9J0KTCU', 'Isabella', '', 'Perez', '', '1991-01-12', 'female', 'isabella.perez@example.com', '09198904567', '876 Birch St, Taguig City', 'password606', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCIR45TCU', 'Maya', 'Victoria', 'Taylor', '', '1992-01-14', 'female', 'maya.taylor@example.com', '09152467890', '230 Birch Avenue, Taguig, Philippines', 'hashedpassword636', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCJ0K1LTCU', 'Ethan', 'C.', 'Adams', '', '1988-04-09', 'male', 'ethan.adams@example.com', '09194560123', '987 Elm St, Taguig City', 'password707', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCJE43TCU', 'Daniel', 'Alberto', 'Martinez', 'Sr.', '1985-12-05', 'male', 'daniel.martinez@example.com', '09131567890', '34 Birch Lane, Mandaluyong, Philippines', 'hashedpassword202', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCJE58TCU', 'Sophia', 'Lilian', 'Roberts', '', '2000-03-13', 'female', 'sophia.roberts@example.com', '09185673245', '159 Maple Road, Quezon City, Philippines', 'hashedpassword040', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCJI71TCU', 'Zoe', 'Violet', 'Gonzalez', '', '1999-03-22', 'female', 'zoe.gonzalez@example.com', '09226789012', '543 Cedar Avenue, Cebu, Philippines', 'hashedpassword424', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCJX41TCU', 'Lucas', 'Oliver', 'Taylor', '', '1997-03-02', 'male', 'lucas.taylor@example.com', '09175345678', '253 Pine Street, Manila, Philippines', 'hashedpassword919', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCK1L2MTCU', 'Mia', '', 'Carter', '', '1995-12-01', 'female', 'mia.carter@example.com', '09192347890', '432 Oak St, Taguig City', 'password808', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCKJ64TCU', 'Ava', 'Grace', 'Simmons', '', '1994-12-18', 'female', 'ava.simmons@example.com', '09231234567', '102 Birch Avenue, Quezon City, Philippines', 'hashedpassword828', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCKM22TCU', 'Elijah', 'Daniel', 'Perez', '', '1992-09-10', 'male', 'elijah.perez@example.com', '09165543210', '100 Oak Road, Mandaluyong, Philippines', 'hashedpassword323', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCKT24TCU', 'Sophia', 'Zoe', 'Davis', '', '1996-06-17', 'female', 'sophia.davis@example.com', '09238912345', '89 Cedar Street, Quezon City, Philippines', 'hashedpassword727', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCL2M3NTCU', 'Benjamin', 'K.', 'Davis', '', '1989-09-17', 'male', 'benjamin.davis@example.com', '09194563478', '123 Birch St, Taguig City', 'password909', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCLD55TCU', 'Isabella', 'Sophia', 'Morris', '', '1994-10-30', 'female', 'isabella.morris@example.com', '09193456789', '19 Oak Road, Quezon City, Philippines', 'hashedpassword909', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCLZ99TCU', 'Lily', 'Irene', 'Martinez', '', '1992-06-08', 'female', 'lily.martinez@example.com', '09189654321', '38 Maple Road, Makati, Philippines', 'hashedpassword929', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCM3N4OTCU', 'Ella', '', 'Rodriguez', '', '1994-03-13', 'female', 'ella.rodriguez@example.com', '09197890134', '765 Maple St, Taguig City', 'password010', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCN4O5PTCU', 'Jack', 'P.', 'Morgan', '', '1992-07-20', 'male', 'jack.morgan@example.com', '09194567890', '987 Main St, Taguig City', 'password111', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCNR57TCU', 'Isabella', 'Maya', 'Moore', '', '1995-07-02', 'female', 'isabella.moore@example.com', '09178901234', '532 Birch Road, Pasig, Philippines', 'hashedpassword333', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCO5P6QTCU', 'Harper', '', 'King', '', '1987-06-09', 'female', 'harper.king@example.com', '09192345678', '543 Elm St, Taguig City', 'password212', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCQN83TCU', 'Jackson', 'Bryce', 'Thomas', '', '1996-09-22', 'male', 'jackson.thomas@example.com', '09156789012', '231 Cedar Avenue, Davao, Philippines', 'hashedpassword030', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCQR82TCU', 'Amelia', 'Sophia', 'Clark', '', '1996-04-06', 'female', 'amelia.clark@example.com', '09234567890', '330 Cedar Avenue, Makati, Philippines', 'hashedpassword646', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCRY67TCU', 'Amelia', 'Grace', 'Rodriguez', '', '2001-01-22', 'female', 'amelia.rodriguez@example.com', '09211234567', '45 Maple Avenue, Makati, Philippines', 'hashedpassword707', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCTF82TCU', 'James', 'Alexander', 'White', '', '1991-06-14', 'male', 'james.white@example.com', '09212567890', '31 Pine Street, Makati, Philippines', 'hashedpassword010', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCUP60TCU', 'Liam', 'Eli', 'Scott', '', '1993-03-19', 'male', 'liam.scott@example.com', '09230123456', '409 Oak Avenue, Quezon City, Philippines', 'hashedpassword535', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCUP76TCU', 'Benjamin', 'Charles', 'Nelson', '', '1992-04-19', 'male', 'benjamin.nelson@example.com', '09214567890', '134 Birch Lane, Makati, Philippines', 'hashedpassword818', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCVI12TCU', 'Oliver', 'Ethan', 'Hernandez', '', '1996-10-02', 'male', 'oliver.hernandez@example.com', '09146789012', '92 Birch Street, Mandaluyong, Philippines', 'hashedpassword141', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCVO56TCU', 'Sophia', 'Charlotte', 'Lee', '', '1997-05-11', 'female', 'sophia.lee@example.com', '09213657890', '540 Maple Street, Pasig, Philippines', 'hashedpassword313', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCVP28TCU', 'Sophia', 'Isabella', 'Brown', '', '1993-09-18', 'female', 'sophia.brown@example.com', '09142678901', '456 Cedar Road, Quezon City, Philippines', 'hashedpassword303', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCWB15TCU', 'Lucas', 'Gabriel', 'Miller', '', '1997-06-09', 'male', 'lucas.miller@example.com', '09173456789', '120 Oak Road, Davao, Philippines', 'hashedpassword606', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCWI66TCU', 'Amos', 'Phillip', 'Williams', '', '1989-10-15', 'male', 'amos.williams@example.com', '09215678901', '401 Pine Lane, Mandaluyong, Philippines', 'hashedpassword232', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCWL53TCU', 'Charlotte', 'Evelyn', 'Adams', '', '1998-12-28', 'female', 'charlotte.adams@example.com', '09192034567', '389 Oak Road, Quezon City, Philippines', 'hashedpassword717', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCWL79TCU', 'Emily', 'Nora', 'Evans', '', '1994-11-16', 'female', 'emily.evans@example.com', '09223456789', '180 Oak Road, Davao, Philippines', 'hashedpassword020', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCWL82TCU', 'James', 'Samuel', 'Walker', '', '1994-11-11', 'male', 'james.walker@example.com', '09165912345', '120 Maple Street, Cebu, Philippines', 'hashedpassword434', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCXP63TCU', 'Mia', 'Emma', 'Harris', '', '1996-08-24', 'female', 'mia.harris@example.com', '09181234567', '250 Cedar Avenue, Taguig, Philippines', 'hashedpassword111', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCXP94TCU', 'Oliver', 'Quinn', 'Nelson', '', '1994-07-30', 'male', 'oliver.nelson@example.com', '09213456789', '812 Cedar Avenue, Pasig, Philippines', 'hashedpassword939', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCXQ91TCU', 'Olivia', 'Chloe', 'Davis', 'III', '1998-02-28', 'female', 'olivia.davis@example.com', '09162345678', '789 Cedar Avenue, Cebu, Philippines', 'hashedpassword505', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCYA51TCU', 'Chloe', 'Grace', 'Reed', '', '1999-02-28', 'female', 'chloe.reed@example.com', '09125678901', '87 Cedar Avenue, Cebu, Philippines', 'hashedpassword242', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCYF04TCU', 'Ethan', 'John', 'Collins', '', '1997-12-10', 'male', 'ethan.collins@example.com', '09254567890', '233 Oak Road, Pasig, Philippines', 'hashedpassword343', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCZB11TCU', 'Charlotte', 'Bella', 'Garcia', '', '1997-04-25', 'female', 'charlotte.garcia@example.com', '09223456789', '53 Oak Street, Taguig, Philippines', 'hashedpassword131', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCZG34TCU', 'Liam', 'Christopher', 'Green', '', '1996-07-25', 'male', 'liam.green@example.com', '09182534678', '25 Birch Avenue, Quezon City, Philippines', 'hashedpassword121', 'regular', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCZN21TCU', 'Ethan', 'Matthew', 'Wilson', '', '2000-11-05', 'male', 'ethan.wilson@example.com', '09151234567', '21 Pine Street, Manila, Philippines', 'hashedpassword404', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCZT66TCU', 'Lila', 'Emma', 'Morris', '', '1998-11-15', 'female', 'lila.morris@example.com', '09287654321', '454 Pine Street, Davao, Philippines', 'hashedpassword444', 'new', NULL, NULL, NULL, '2024-11-19 09:16:17'),
('SHCZT77TCU', 'Zara', 'Rose', 'Bennett', '', '1998-08-06', 'female', 'zara.bennett@example.com', '09175432109', '67 Oak Road, Makati, Philippines', 'hashedpassword838', 'new', NULL, NULL, NULL, '2024-11-15 14:43:03');

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
-- Indexes for table `appointment_dates`
--
ALTER TABLE `appointment_dates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_dates`
--
ALTER TABLE `appointment_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
