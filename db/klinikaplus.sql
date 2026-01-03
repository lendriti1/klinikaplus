-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 09:11 PM
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
-- Database: `klinikaplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE `assistants` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `personal_id` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `clinic_id` int(11) NOT NULL,
  `personal_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assistants`
--

INSERT INTO `assistants` (`id`, `first_name`, `last_name`, `personal_id`, `phone`, `email`, `clinic_id`, `personal_info`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Anna', 'Wilson', 'ID-ANN-001', '+1-555-3001', 'anna.wilson@klinikaplus.com', 1, 'Medical assistant to Dr. Emily Smith – handles scheduling and patient intake.', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1),
(2, 'Mark', 'Davis', 'ID-MAR-002', '+1-555-3002', 'mark.davis@klinikaplus.com', 2, 'Supports Dr. Michael Johnson with pediatric exams and records.', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Klinika Plus Central', '123 Main Street, Capital City', '+1-555-0101', 'central@klinikaplus.com', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1),
(2, 'Klinika Plus North Branch', '456 North Avenue, North City', '+1-555-0102', 'north@klinikaplus.com', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1),
(3, 'Klinika Plus South Branch', '789 South Road, South City', '+1-555-0103', 'south@klinikaplus.com', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `personal_id` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `clinic_id` int(11) NOT NULL,
  `personal_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `first_name`, `last_name`, `license_number`, `specialization`, `personal_id`, `phone`, `email`, `clinic_id`, `personal_info`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Emily', 'Smith', 'LIC-2023-001', 'Cardiology', 'ID-EMP-001', '+1-555-2001', 'dr.smith@klinikaplus.com', 1, 'Senior cardiologist with 15 years experience.', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1),
(2, 'Michael', 'Johnson', 'LIC-2023-002', 'Pediatrics', 'ID-MIC-002', '+1-555-2002', 'dr.johnson@klinikaplus.com', 2, 'Specialized in child healthcare and vaccinations.', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1),
(3, 'Sarah', 'Lee', 'LIC-2023-003', 'Dermatology', 'ID-SAR-003', '+1-555-2003', 'dr.lee@klinikaplus.com', 1, 'Expert in skin conditions and cosmetic dermatology.', '2026-01-03 20:24:51', '2026-01-03 20:24:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `sender_role_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `receiver_role_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `sender_role_id`, `receiver_id`, `receiver_role_id`, `subject`, `body`, `is_read`, `created_at`) VALUES
(1, 1, NULL, 3, NULL, 'Welcome to KlinikaPlus', 'Dear James,\n\nWelcome to our new patient portal. You can now view messages and update your profile.\n\nBest regards,\nSuper Admin', 0, '2026-01-03 20:24:51'),
(2, NULL, 2, NULL, 3, 'System Update Notice', 'Dear Doctors,\n\nThe system will be updated on January 10, 2026. Please save any unsaved work.\n\nAdmin Team', 0, '2026-01-03 20:24:51'),
(3, 4, NULL, 1, NULL, 'Appointment Question', 'Hello,\n\nI would like to book an appointment with Dr. Smith. Is next week available?\n\nThank you,\nMaria Garcia', 0, '2026-01-03 20:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(2, 'Admin', '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(3, 'Doctor', '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(4, 'Assistant', '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(5, 'User', '2026-01-03 20:24:51', '2026-01-03 20:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `role_id`, `email`, `full_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@gmail.com', 'superadmin@gmail.com', 1, 'superadmin@gmail.com', 'Super Administrator', 1, '2026-01-03 20:24:51', '2026-01-03 20:34:50'),
(2, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 'admin@klinikaplus.com', 'Clinic Administrator', 0, '2026-01-03 20:24:51', '2026-01-03 21:09:58'),
(3, 'patient1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'james.brown@email.com', 'James Brown', 1, '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(4, 'patient2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'maria.garcia@email.com', 'Maria Garcia', 1, '2026-01-03 20:24:51', '2026-01-03 20:24:51'),
(5, 'patient3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'david.martinez@email.com', 'David Martinez', 1, '2026-01-03 20:24:51', '2026-01-03 20:24:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_number` (`license_number`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `sender_role_id` (`sender_role_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `receiver_role_id` (`receiver_role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `messages_ibfk_4` FOREIGN KEY (`receiver_role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
