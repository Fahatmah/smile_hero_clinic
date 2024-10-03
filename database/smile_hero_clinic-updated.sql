-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2024 at 02:32 PM
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
  `location` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`user_id`, `appointment_id`, `name`, `email`, `contact`, `message`, `date`, `time`, `location`, `status`, `created_at`) VALUES
('SHC308cTCU', 'SHC1bf2', 'Fahatmah Mabang', 'fahatmahmabang9@gmail.com', '9265369733', '', '2024-10-03, Thursday', '9:00 AM', 'Bayani Road, Taguig City', 'accepted', '2024-10-03 15:43:51'),
('SHC5d4aTCU', 'SHC5f4c', 'jp', 'jpvillaruel02@gmail.com', '9070050140', '', 'Monday, 08/12/2024', '5:00 PM', 'Central Avenue, Quezon City', 'accepted', '2024-08-08 19:09:35'),
('SHCc603TCU', 'SHCbf47', 'Marie Santos', 'mariesantos@gmail.com', '9175678920', 'appointment for consultation', '2024-09-25', '10:00 AM', 'Rizal Avenue, Manila', 'request', '2024-09-11 10:30:45'),
('SHCc604TCU', 'SHCbf48', 'Carlos Cruz', 'carloscruz@yahoo.com', '9182345671', 'routine check-up', '2024-09-30', '03:30 PM', 'Ayala Avenue, Makati', 'rescheduled', '2024-09-11 11:15:52'),
('SHCc605TCU', 'SHCbf49', 'Ana Reyes', 'anareyes@gmail.com', '9271234567', 'general consultation', '2024-09-20', '09:00 AM', 'Ortigas Center, Pasig', 'accepted', '2024-09-12 08:40:23'),
('SHCc606TCU', 'SHCbf50', 'Mark Tolentino', 'marktolentino@yahoo.com', '9269876543', 'follow-up check-up', '2024-09-23', '11:00 AM', 'Fort Bonifacio, Taguig', 'rejected', '2024-09-12 09:45:12'),
('SHCc607TCU', 'SHCbf51', 'Sofia Cruz', 'sofiacruz@hotmail.com', '9152233445', 'consultation for flu symptoms', '2024-10-02', '02:00 PM', 'E. Rodriguez Sr. Avenue, Quezon City', 'accepted', '2024-09-12 11:30:40'),
('SHCc608TCU', 'SHCbf52', 'Juan dela Cruz', 'juandelacruz@gmail.com', '9145566778', 'regular physical exam', '2024-09-18', '04:00 PM', 'Alabang, Muntinlupa', 'canceled', '2024-09-11 09:55:33'),
('SHCc609TCU', 'SHCbf53', 'Luis Enriquez', 'luiseenriquez@yahoo.com', '9129876543', 'health assessment', '2024-09-17', '12:30 PM', 'Las Piñas City', 'request', '2024-09-10 08:40:17'),
('SHCc610TCU', 'SHCbf54', 'Liza Ramos', 'lizaramos@hotmail.com', '9176654321', 'dental consultation', '2024-09-21', '09:30 AM', 'Binondo, Manila', 'rescheduled', '2024-09-09 07:55:46'),
('SHCc611TCU', 'SHCbf55', 'Alex Santos', 'alexsantos@gmail.com', '9102345678', 'wellness consultation', '2024-09-24', '01:00 PM', 'Greenhills, San Juan', 'accepted', '2024-09-11 10:10:55'),
('SHCc612TCU', 'SHCbf56', 'Betty Cruz', 'bettycruz@yahoo.com', '9112233445', 'check-up for allergy symptoms', '2024-09-26', '10:30 AM', 'Cubao, Quezon City', 'request', '2024-09-12 08:05:14'),
('SHCc613TCU', 'SHCbf57', 'Ricky Tan', 'ricky.tan@gmail.com', '9186655443', 'post-surgery follow-up', '2024-09-22', '11:00 AM', 'Tomas Morato, Quezon City', 'request', '2024-09-11 09:15:22'),
('SHCc614TCU', 'SHCbf58', 'Grace Lim', 'gracelim@yahoo.com', '9179988776', 'medical consultation for flu symptoms', '2024-09-28', '12:00 PM', 'Commonwealth Avenue, Quezon City', 'rescheduled', '2024-09-13 10:20:35'),
('SHCc615TCU', 'SHCbf59', 'Maya Mendoza', 'maya.mendoza@gmail.com', '9213344556', 'child vaccination', '2024-10-01', '03:00 PM', 'Makati City', 'accepted', '2024-09-13 11:45:19'),
('SHCc616TCU', 'SHCbf60', 'Jose Maria', 'jose.maria@gmail.com', '9132344567', 'annual health check', '2024-09-27', '02:00 PM', 'Parañaque City', 'rescheduled', '2024-09-12 07:45:50'),
('SHCc617TCU', 'SHCbf61', 'Dianne Reyes', 'diannereyes@hotmail.com', '9154433221', 'consultation for high blood pressure', '2024-09-16', '01:30 PM', 'Mandaluyong City', 'accepted', '2024-09-11 08:35:47'),
('SHCc618TCU', 'SHCbf62', 'Oliver Cruz', 'oliver.cruz@gmail.com', '9141234567', 'consultation for skin rash', '2024-09-29', '09:00 AM', 'Pasay City', 'request', '2024-09-13 07:30:28'),
('SHCc619TCU', 'SHCbf63', 'Elena Perez', 'elena.perez@gmail.com', '9127766554', 'vaccination for flu', '2024-09-15', '04:30 PM', 'Bacoor, Cavite', 'request', '2024-09-12 10:15:38'),
('SHCc620TCU', 'SHCbf64', 'Raul Gutierrez', 'raul.gutierrez@yahoo.com', '9165544332', 'follow-up for hypertension', '2024-10-03', '02:00 PM', 'Caloocan City', 'rescheduled', '2024-09-11 09:50:45');

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
  `feedback` varchar(399) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `feedback`, `rating`, `created_at`) VALUES
(8, 'John Paul Dela Cruz', 'jpvillaruel02@gmail.com', 'Good clinic will make an appointment again in this clinic so good i think this will gonna be my clinic now and i will recommend this clinic to my freinds and family. The service is very Fantastic hope it will last longer.', '1', '2024-10-01 15:05:10'),
(9, 'Maria Santos', 'marias@gmail.com', 'The staff was friendly and helpful.', '5', '2024-10-03 12:05:00'),
(10, 'Jake Peralta', 'jakep@brooklyn.com', 'Nice place, will come again.', '4', '2024-10-03 12:10:00'),
(11, 'Rosa Diaz', 'rosadiaz@99.com', 'Quick service, no complaints.', '3', '2024-10-03 12:15:00'),
(12, 'Terry Jeffords', 'terryj@nycpd.com', 'Everything was handled professionally.', '5', '2024-10-03 12:20:00'),
(13, 'Amy Santiago', 'amysantiago@99.com', 'Efficient and courteous staff.', '4', '2024-10-03 12:25:00'),
(14, 'Charles Boyle', 'charlesb@foodie.com', 'Clean clinic, satisfied with the service.', '4', '2024-10-03 12:30:00'),
(15, 'Raymond Holt', 'rayholtm@nycpd.com', 'Very professional service.', '5', '2024-10-03 12:35:00'),
(16, 'Gina Linetti', 'ginal@nycpd.com', 'Clinic ambiance was great, highly recommend.', '5', '2024-10-03 12:40:00'),
(17, 'Adrian Pimento', 'adrianp@weirdmail.com', 'Wild experience, but I enjoyed it.', '4', '2024-10-03 12:45:00'),
(18, 'Kevin Cozner', 'kevinc@columbia.edu', 'Everything was perfect, no issues at all.', '5', '2024-10-03 12:50:00'),
(19, 'Hitchcock Scully', 'hscully@gmail.com', 'Not bad, but could be better.', '3', '2024-10-03 12:55:00'),
(20, 'David Ginsberg', 'davidg@school.com', 'Staff was patient and professional.', '5', '2024-10-03 13:00:00'),
(21, 'Hannibal Lecter', 'hanniball@prison.com', 'Service was great but found it a bit slow.', '3', '2024-10-03 13:05:00'),
(22, 'Michael Scott', 'mscott@dundermifflin.com', 'Best clinic experience ever.', '5', '2024-10-03 13:10:00'),
(23, 'Dwight Schrute', 'dwight.s@dundermifflin.com', 'Good service, efficient staff.', '4', '2024-10-03 13:15:00'),
(24, 'Jim Halpert', 'jim.h@dundermifflin.com', 'Decent experience, but could improve waiting times.', '3', '2024-10-03 13:20:00'),
(25, 'Pam Beesly', 'pbeesly@dundermifflin.com', 'Happy with the service, will come again.', '5', '2024-10-03 13:25:00'),
(26, 'Ryan Howard', 'rhoward@dundermifflin.com', 'Good service but parking was an issue.', '4', '2024-10-03 13:30:00'),
(27, 'Kelly Kapoor', 'kkapoor@dundermifflin.com', 'Everything was great, no issues.', '5', '2024-10-03 13:35:00');

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
(1, 'SHC9516TCU', 'Christian Jake Dela Cruz', 'lems.christianjakedelacruz@gmail.com', 9289403281, '123 Elm Street, Cityville', '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.z...', NULL, '2024-05-27 18:20:47'),
(3, 'SHCf23fTCU', 'Calderon', 'joevilzonc@gmail.com', 91324123122, '12 Oak Road, Village City', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-05-28 18:53:23'),
(4, 'SHC5d4aTCU', 'JP Villaruel', 'jpvillaruel02@gmail.com', 9070050140, '9 Pine Street, Capital Town', '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.z...', NULL, '2024-08-08 19:02:13'),
(5, 'SHC871bTCU', 'Monica Reyes', 'monicareyes@gmail.com', 9123456789, '67 Birch Lane, Metro City', '$2y$12$fxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-06-15 14:15:23'),
(6, 'SHC3202TCU', 'Carlos Dela Rosa', 'carlosd@gmail.com', 9134678910, '89 Cedar Drive, Uptown', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-06-15 14:30:10'),
(7, 'SHCd912TCU', 'Jenny Santos', 'jenny.santos@yahoo.com', 9172349820, '23 Redwood Avenue, Lakeside', '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.z...', NULL, '2024-06-16 09:45:11'),
(8, 'SHC1826TCU', 'Louise Manzano', 'louise.manzano@hotmail.com', 9256432781, '34 Palm Street, Beach Town', '$2y$12$fxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-06-18 11:30:50'),
(9, 'SHC71e5TCU', 'Danilo Perez', 'danilo.perez@gmail.com', 9135672233, '77 Willow Crescent, Hilltop', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-06-20 10:00:00'),
(10, 'SHC438aTCU', 'Alfredo Yulo', 'alfredo.yulo@gmail.com', 9245681234, '19 Cypress Boulevard, Riverside', '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.z...', NULL, '2024-06-21 16:42:07'),
(11, 'SHC9e2cTCU', 'Natalie Cruz', 'natalie.cruz@outlook.com', 9178945623, '56 Spruce Way, Downtown', '$2y$12$fxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-07-05 09:10:15'),
(12, 'SHC0a4eTCU', 'Mark Espinosa', 'mark.espinosa@gmail.com', 9185623432, '13 Fir Street, Suburbia', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-07-07 13:20:12'),
(13, 'SHCb5f9TCU', 'Lucia Gomez', 'lucia.gomez@gmail.com', 9246347521, '40 Poplar Avenue, Greentown', '$2y$12$l9s.LxfTZUZ8ZdqutSZJVuQInKzFsfEWkvZbSQtaf.z...', NULL, '2024-07-10 15:47:32'),
(14, 'SHCfa30TCU', 'Victor Mendoza', 'victor.mendoza@yahoo.com', 9172389471, '78 Chestnut Street, Midtown', '$2y$12$fxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-07-15 18:20:48'),
(15, 'SHCd923TCU', 'Rosa Santos', 'rosa.santos@hotmail.com', 9263479822, '22 Juniper Road, Bay City', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-07-20 20:10:55'),
(16, 'SHC0123TCU', 'Janelle Flores', 'janelle.flores@gmail.com', 9256341234, '101 Redwood Drive, Cityville', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-07-22 09:10:32'),
(17, 'SHC0234TCU', 'Mario Delgado', 'mario.delgado@yahoo.com', 9246389471, '55 Cedar Lane, Forest Town', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-07-23 11:45:20'),
(18, 'SHC0345TCU', 'Cecilia Torres', 'cecilia.torres@hotmail.com', 9173246578, '34 Birch Road, Uptown', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-07-25 08:30:45'),
(19, 'SHC0456TCU', 'Lina Hernandez', 'lina.hernandez@gmail.com', 9264523741, '78 Pine Street, Lakeside', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-07-26 12:55:12'),
(20, 'SHC0567TCU', 'George Bautista', 'george.bautista@gmail.com', 9123457689, '19 Cypress Avenue, Hilltop', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-07-27 14:20:33'),
(21, 'SHC0678TCU', 'Tina Castillo', 'tina.castillo@yahoo.com', 9178236456, '67 Maple Avenue, Riverside', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-07-29 10:00:22'),
(22, 'SHC0789TCU', 'Juan Rodriguez', 'juan.rodriguez@gmail.com', 9246378921, '45 Spruce Boulevard, Beach Town', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-07-30 15:42:10'),
(23, 'SHC0890TCU', 'Carlos Rivera', 'carlos.rivera@hotmail.com', 9156478391, '101 Oak Lane, Capital City', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-01 12:18:05'),
(24, 'SHC0901TCU', 'Ramon Suarez', 'ramon.suarez@gmail.com', 9268397452, '34 Palm Street, Greentown', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-02 09:30:56'),
(25, 'SHC1012TCU', 'Mariana Flores', 'mariana.flores@yahoo.com', 9134765234, '56 Chestnut Road, Suburbia', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-03 13:45:25'),
(26, 'SHC1123TCU', 'Luis Ramos', 'luis.ramos@gmail.com', 9263485732, '12 Elm Drive, Cityville', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-04 11:10:12'),
(27, 'SHC1234TCU', 'Anita Mendoza', 'anita.mendoza@gmail.com', 9248374561, '89 Fir Avenue, Metro City', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-05 09:05:30'),
(28, 'SHC1345TCU', 'Enrique Perez', 'enrique.perez@hotmail.com', 9139482374, '23 Willow Crescent, Village City', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-06 15:25:18'),
(29, 'SHC1456TCU', 'Sara Cruz', 'sara.cruz@gmail.com', 9174563721, '77 Birch Boulevard, Riverside', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-07 10:50:40'),
(30, 'SHC1567TCU', 'Mia Garcia', 'mia.garcia@gmail.com', 9253647812, '45 Palm Street, Uptown', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-08 18:12:29'),
(31, 'SHC1678TCU', 'Alex Santiago', 'alex.santiago@hotmail.com', 9168236452, '101 Oak Drive, Greentown', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-09 08:30:14'),
(32, 'SHC1789TCU', 'Emma Morales', 'emma.morales@gmail.com', 9146478231, '34 Spruce Street, Hilltop', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-10 09:42:38'),
(33, 'SHC1900TCU', 'Paulo Alvarez', 'paulo.alvarez@gmail.com', 9172375641, '67 Redwood Lane, Bay City', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-11 12:20:50'),
(34, 'SHC2011TCU', 'Victor Hernandez', 'victor.hernandez@gmail.com', 9268345721, '78 Elm Street, Cityville', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-12 11:05:45'),
(35, 'SHC2122TCU', 'Elena Flores', 'elena.flores@hotmail.com', 9128473912, '56 Pine Avenue, Lakeside', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-13 14:30:27'),
(36, 'SHC2233TCU', 'Raul Gomez', 'raul.gomez@gmail.com', 9139456723, '34 Cedar Road, Capital City', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-14 17:55:12'),
(37, 'SHC2344TCU', 'Teresa Mendoza', 'teresa.mendoza@gmail.com', 9178934612, '101 Maple Lane, Forest Town', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-15 13:15:00'),
(38, 'SHC2455TCU', 'Alberto Garcia', 'alberto.garcia@hotmail.com', 9267345821, '12 Palm Street, Riverside', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-16 12:30:33'),
(39, 'SHC2566TCU', 'Rosa Ruiz', 'rosa.ruiz@gmail.com', 9164837452, '77 Oak Boulevard, Suburbia', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-17 11:45:27'),
(40, 'SHC2677TCU', 'Isabel Martinez', 'isabel.martinez@yahoo.com', 9128736452, '45 Pine Drive, Uptown', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-18 14:22:44'),
(41, 'SHC2788TCU', 'Esteban Rivera', 'esteban.rivera@gmail.com', 9246738952, '34 Birch Street, Bay City', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-19 16:45:50'),
(42, 'SHC2899TCU', 'Sofia Torres', 'sofia.torres@gmail.com', 9156478234, '78 Fir Avenue, Greentown', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-20 09:35:12'),
(43, 'SHC3010TCU', 'Miguel Santiago', 'miguel.santiago@yahoo.com', 9174382971, '56 Cedar Boulevard, Cityville', '$2y$12$zcDf4JbV2m4mFa.vQrD2JOlr1XL11pxl2JG9MvVR/VQ...', NULL, '2024-08-21 13:45:23'),
(44, 'SHC3121TCU', 'Julia Ramirez', 'julia.ramirez@gmail.com', 9168236471, '67 Redwood Drive, Lakeside', '$2y$12$pxiDU3Wnr67bGuRaP.EFF.bU47cnOAf0MHtXi80IPpC...', NULL, '2024-08-22 12:20:10'),
(45, 'SHC3232TCU', 'Hector Lopez', 'hector.lopez@gmail.com', 9129476374, '12 Elm Lane, Riverside', '$2y$12$DCLdvO7TQ6kjcw9gyygvMOr5v7g6/LJhidEDhoEwlx1...', NULL, '2024-08-23 08:55:05'),
(46, 'SHC308cTCU', 'Fahatmah Mabang', 'fahatmahmabang9@gmail.com', 9265369733, NULL, '$2y$12$jgiK9uH1GxoEq.BPKloCyeeGdcwC0WinH9yd7Jt9SsbbVrTOInk/G', NULL, '2024-09-26 13:28:47');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
