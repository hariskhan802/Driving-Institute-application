-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2019 at 12:28 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4926857_driving`
--

-- --------------------------------------------------------

--
-- Table structure for table `examiners`
--

CREATE TABLE `examiners` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examiners`
--

INSERT INTO `examiners` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Ralf Jensen', '2018-06-18 13:53:40', '2018-06-18 13:53:40'),
(10, 'Regitze Ørnfeld', '2018-06-18 13:55:04', '2018-06-18 13:55:04'),
(12, 'Gitte Nielsen', '2018-11-27 08:47:41', '2018-11-27 08:47:41'),
(13, 'Heinrich Mortensen', '2018-11-27 08:48:09', '2018-11-27 08:48:09'),
(14, 'Henrik Raun', '2018-11-27 08:48:18', '2018-11-27 08:48:18'),
(15, 'Benjamin Hansen', '2018-11-27 08:48:27', '2018-11-27 08:48:27'),
(16, 'Carl Viborg', '2018-11-27 08:49:13', '2018-11-27 08:49:13'),
(17, 'Hans Sveigaard', '2018-11-27 08:49:36', '2018-11-27 08:49:36'),
(18, 'Henning Eskild', '2018-11-27 08:49:47', '2018-11-27 08:49:47'),
(19, 'Henrik Nielsen', '2018-11-27 08:49:57', '2018-11-27 08:49:57'),
(20, 'Rene Pedersen', '2018-11-27 08:50:27', '2018-11-27 08:50:27'),
(21, 'Allan Bo Jensen', '2018-11-27 08:50:37', '2018-11-27 08:50:37'),
(22, 'Henrik Søndborg', '2018-11-27 08:50:57', '2018-11-27 08:50:57'),
(23, 'Lars Kofoed', '2018-11-27 08:51:07', '2018-11-27 08:51:07'),
(24, 'Ukendt', '2018-11-27 08:51:14', '2018-11-27 08:51:14'),
(25, 'Thomas Nielsen', '2018-11-27 08:51:27', '2018-11-27 08:51:27'),
(26, 'Michael Christiansen', '2018-11-27 08:52:46', '2018-11-27 08:59:28'),
(27, 'Frank Thorsteinsson', '2018-11-27 08:53:18', '2018-11-27 08:53:18'),
(28, 'Ole Jørgensen', '2018-11-27 08:53:28', '2018-11-27 08:53:28'),
(29, 'Morten Pagh', '2018-11-27 08:53:37', '2018-11-27 08:53:37'),
(30, 'Brian Nielsen', '2018-11-27 08:53:46', '2018-11-27 08:53:46'),
(31, 'Regitze Ørnfeld', '2018-11-27 08:54:03', '2018-11-27 08:54:03'),
(32, 'Ralf Jensen', '2018-11-27 08:54:13', '2018-11-27 08:54:13'),
(33, 'Mark Storm', '2018-11-27 08:54:19', '2018-11-27 08:54:19'),
(34, 'Michel Dubas', '2018-11-27 08:54:58', '2018-11-27 08:54:58'),
(35, 'Peter Steffensen', '2018-11-27 08:56:00', '2018-11-27 08:56:00'),
(36, 'Susanne Laksø', '2018-11-27 08:56:42', '2018-11-27 08:56:42'),
(38, 'Flemming Nielsen', '2018-11-27 08:57:08', '2018-11-27 08:57:08'),
(40, 'Finn Ruby', '2018-11-27 08:57:48', '2018-11-27 08:57:48'),
(41, 'Ib Schleming', '2018-11-27 08:58:06', '2018-11-27 08:58:06'),
(42, 'Dragan Radic', '2018-11-27 08:58:53', '2018-11-27 08:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `examiner_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `theory_no` int(11) NOT NULL,
  `practical_no` int(11) NOT NULL,
  `theory_date` varchar(999) NOT NULL,
  `theory_pass` varchar(999) NOT NULL,
  `practical_date` varchar(999) NOT NULL,
  `town` varchar(999) NOT NULL,
  `distinct` varchar(999) NOT NULL,
  `practical_pass` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `examiner_id`, `student_id`, `theory_no`, `practical_no`, `theory_date`, `theory_pass`, `practical_date`, `town`, `distinct`, `practical_pass`, `created_at`, `updated_at`) VALUES
(63, 9, 10, 1, 0, '07/11/2017', 'pass', '13/11/2018', 'test', 'test', 'pass', '2018-11-13 18:24:36', '2018-11-13 18:19:39'),
(64, 0, 10, 2, 0, '14/11/2018', 'pass', '', '', '', '', '2018-11-13 18:24:36', '2018-11-13 18:19:39'),
(65, 0, 10, 2, 0, '14/11/2018', 'pass', '', '', '', '', '2018-11-13 18:24:36', '2018-11-13 18:19:39'),
(66, 9, 60, 1, 1, '01/10/2018', 'pass', '02/11/2018', 's', 's', 'pass', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(67, 9, 60, 2, 2, '02/10/2018', 'pass', '14/11/2018', 's', 's', 'pass', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(68, 10, 60, 3, 3, '03/10/2018', 'pass', '22/11/2018', 's', 's', 'fail', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(69, 0, 60, 4, 0, '04/10/2018', 'pass', '', '', '', '', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(70, 0, 60, 5, 0, '05/10/2018', 'pass', '', '', '', '', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(71, 0, 60, 6, 0, '06/10/2018', 'fail', '', '', '', '', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(72, 0, 60, 7, 0, '07/10/2018', 'fail', '', '', '', '', '2018-11-22 15:45:56', '2018-11-22 15:40:50'),
(73, 10, 471, 1, 1, '18/11/2018', 'pass', '21/11/2018', 'Hillerød', 'Nordsjælland', 'pass', '2018-11-22 21:56:07', '2018-11-22 21:51:00'),
(74, 10, 472, 1, 1, '09/11/2018', 'pass', '23/11/2018', 'Hillerød', 'Nordsjælland', 'pass', '2018-11-22 18:59:41', '2018-11-22 18:54:34'),
(75, 10, 473, 1, 1, '20/11/2018', 'pass', '28/11/2018', 'Hillerød', 'Nordsjælland', 'pass', '2018-11-27 05:53:46', '2018-11-27 05:48:35'),
(76, 9, 474, 1, 1, '23/03/2018', 'fail', '15/06/2018', 'Hillerød', 'Nordsjælland', 'fail', '2018-11-27 09:07:40', '2018-11-27 09:02:29'),
(77, 29, 474, 2, 2, '13/04/2018', 'fail', '19/06/2018', 'Hillerød', 'Nordsjælland', 'pass', '2018-11-27 09:07:41', '2018-11-27 09:02:29'),
(78, 0, 474, 3, 0, '19/04/2018', 'pass', '', '', '', '', '2018-11-27 09:07:40', '2018-11-27 09:02:29'),
(79, 9, 475, 1, 1, '23/03/2018', 'fail', '15/06/2018', 'Hillerød', 'Nordsjælland', 'fail', '2018-11-27 08:29:16', '2018-11-27 08:24:04'),
(80, 10, 475, 2, 2, '13/04/2018', 'fail', '19/06/2018', 'Hillerød', 'Nordsjælland', 'pass', '2018-11-27 08:29:19', '2018-11-27 08:24:07'),
(81, 0, 475, 3, 0, '19/04/2018', 'pass', '', '', '', '', '2018-11-27 08:24:04', '2018-11-27 08:24:04'),
(82, 9, 476, 1, 1, '23/03/2018', 'fail', '15/06/2018', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:04:30', '2019-02-09 10:04:28'),
(83, 29, 476, 2, 2, '13/04/2018', 'fail', '19/06/2018', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:04:30', '2019-02-09 10:04:28'),
(84, 9, 476, 3, 3, '19/04/2018', 'pass', '05/12/2018', 's', 's', 'pass', '2019-02-09 10:04:30', '2019-02-09 10:04:28'),
(85, 10, 477, 1, 1, '27/09/2018', 'fail', '01/11/2018', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:03:36', '2019-02-09 10:03:35'),
(86, 36, 477, 2, 2, '02/10/2018', 'fail', '23/11/2018', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:03:36', '2019-02-09 10:03:35'),
(87, 9, 477, 3, 3, '11/12/2018', 'pass', '07/12/2018', 's', 's', 'pass', '2019-02-09 10:03:36', '2019-02-09 10:03:35'),
(88, 10, 478, 1, 1, '09/12/2018', 'pass', '31/01/2019', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:36:30', '2019-02-09 10:36:28'),
(89, 20, 480, 1, 1, '01/02/2019', 'pass', '23/02/2019', 'Hillerød', 'Nordsjælland', 'pass', '2019-02-10 12:43:24', '2019-02-10 12:43:21'),
(90, 10, 478, 1, 1, '09/12/2018', 'pass', '31/01/2019', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-09 10:36:30', '2019-02-09 10:36:28'),
(91, 10, 479, 1, 1, '21/01/2019', 'fail', '30/01/2019', 'Hillerød', 'Nordsjælland', 'fail', '2019-02-10 10:00:47', '2019-02-10 10:00:44'),
(92, 9, 479, 2, 2, '12/02/2019', 'pass', '01/02/2019', 'ooo', 'Nordsjælland', 'pass', '2019-02-10 10:00:47', '2019-02-10 10:00:44'),
(93, 20, 480, 1, 1, '20/11/2018', 'pass', '23/02/2019', 'Hillerød', 'Nordsjælland', 'pass', '2019-02-10 12:43:24', '2019-02-10 12:43:21'),
(94, 36, 481, 1, 1, '08/01/2019', 'fail', '08/02/2019', 'Hillerød', 'Nordsjælland', 'pass', '2019-02-10 18:59:05', '2019-02-10 18:59:01'),
(95, 9, 481, 2, 2, 'undefined', 'undefined', '12/02/2019', '123', 'Nordsjælland', 'pass', '2019-02-10 18:59:05', '2019-02-10 18:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_14_025853_create_examiners_table', 1),
(4, '2018_02_14_030030_create_students_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f04a4ad243adb78402766092fda07c2bae9775bf', NULL, '103.17.203.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEJ4bm1RR3hwckZXUXBWNjFNVTJYUU9uT1d5V2FoaGtwazc5OHk1UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vbXktc2l0ZTgwMi4wMDB3ZWJob3N0YXBwLmNvbS9hcGkvdjEvbG9naW5DaGVjayI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1NTIxNDUyODE7czoxOiJjIjtpOjE1NTIxNDUyNTk7czoxOiJsIjtzOjE6IjAiO319', 1552145281),
('9f55929e821c4c557da6a125ce0310314b397443', NULL, '196.195.50.208', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2ZUSWJCRGJOUkFFSUhTMnowNGdwSDJRZm5rQjVMQ2l1dFFvazBRcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbXktc2l0ZTgwMi4wMDB3ZWJob3N0YXBwLmNvbS9mYXZpY29uLmljbyI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1NTIyNTI5OTE7czoxOiJjIjtpOjE1NTIyNTI4MDY7czoxOiJsIjtzOjE6IjAiO319', 1552252991),
('8b44b45fb053e9531af1a70ade1dffae3b249019', NULL, '103.245.193.159', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGdVNWZWSmNvT2c3SUV5eURnSE83cEFZRHNkb2NVN2FCUnFOMTJNYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbXktc2l0ZTgwMi4wMDB3ZWJob3N0YXBwLmNvbS9mYXZpY29uLmljbyI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1NTQxMzQ2ODc7czoxOiJjIjtpOjE1NTQxMzQ2NzY7czoxOiJsIjtzOjE6IjAiO319', 1554134687),
('ffda736ea2e72ccb61d3e7f6aea9871849fba6de', NULL, '168.211.176.193', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGVhbXA2cFRtSjlwcWs4eGNISXVjY0h2ekR3QTFWOUhzSUxFZFFMayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbXktc2l0ZTgwMi4wMDB3ZWJob3N0YXBwLmNvbS9mYXZpY29uLmljbyI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE1Njk1NDM2NzI7czoxOiJjIjtpOjE1Njk1NDM2NjY7czoxOiJsIjtzOjE6IjAiO319', 1569543672);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_sec_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiner_id` int(11) NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_status_ok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finish_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_days_spent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_extra_lessons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_course_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `close_track_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_aid_course_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slippery_course_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_1` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_2` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_3` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_4` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_5` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_6` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_6` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_date_no_7` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theory_test_passorfail_no_7` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_6` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_6` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practical_test_date_no_7` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examiners_name_town_and_district_7` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_or_not` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `social_sec_no`, `examiner_id`, `age`, `age_status_ok`, `gender`, `mail_address`, `cell_no`, `occupation`, `driving_school_name`, `department`, `license_category`, `start_date`, `finish_date`, `no_of_days_spent`, `no_of_extra_lessons`, `session_rate`, `current_course_status`, `close_track_date`, `first_aid_course_date`, `slippery_course_date`, `theory_test_date_no_1`, `theory_test_passorfail_no_1`, `theory_test_date_no_2`, `theory_test_passorfail_no_2`, `theory_test_date_no_3`, `theory_test_passorfail_no_3`, `theory_test_date_no_4`, `theory_test_passorfail_no_4`, `theory_test_date_no_5`, `theory_test_passorfail_no_5`, `theory_test_date_no_6`, `theory_test_passorfail_no_6`, `theory_test_date_no_7`, `theory_test_passorfail_no_7`, `practical_test_date_no_1`, `examiners_name_town_and_district_1`, `practical_test_date_no_2`, `examiners_name_town_and_district_2`, `practical_test_date_no_3`, `examiners_name_town_and_district_3`, `practical_test_date_no_4`, `examiners_name_town_and_district_4`, `practical_test_date_no_5`, `examiners_name_town_and_district_5`, `practical_test_date_no_6`, `examiners_name_town_and_district_6`, `practical_test_date_no_7`, `examiners_name_town_and_district_7`, `invoice_date`, `invoice_amount`, `completed_or_not`, `created_at`, `updated_at`) VALUES
(480, 'Sunil', 'Harwani', '2606733707', 0, '45', '', 'Han', 'Sunil@rtntraders.com', '21 80 62 73', 'Importering og eksportering', 'Alliance Køreskole', 'Amager', 'Bil', '21/11/2018', '23/11/2018', '2', '4', '400', 'active', '05/11/2018', '14/11/2018', '27/11/2018', '20/11/2018', 'pass', '', '', '', '', '', '', '', '', '', '', '', '', '23/02/2019', '', '', '', '', '', '', '', '', '', '', '', '', '', '21/11/2018', '5500', '1', '2019-02-10 12:43:20', '2019-02-10 12:43:20'),
(481, 'Bertram', 'Mørk', '0406991997', 0, '19', '', 'Han', 'bertrammork@gmail.com', '27 50 98 34', 'Arkitek elev', 'Alliance Køreskole', 'Amager', 'Bil', '16/10/2018', '12/02/2019', '119', '24', '400', 'active', '17/09/2018', '30/09/2018', '23/01/2019', '08/01/2019', 'fail', 'undefined', 'undefined', '', '', '', '', '', '', '', '', '', '', '08/02/2019', '', '12/02/2019', '', '', '', '', '', '', '', '', '', '', '', '31/12/2018', '5500', '1', '2019-02-10 12:48:31', '2019-02-10 18:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'haris', 'haris@yahoo.com', '$2y$10$orpEQjlqCnKGHpudOCjKTOVLrUTBgrgKx7yLVM3zlzNtVllMtMHU6', '1', '71NIZL7fNGn7ekMyOHU0KtC5VaGgQGZGhfJ166LTI3I7jzeuQ8yattclTte8', NULL, '2019-02-09 10:05:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examiners`
--
ALTER TABLE `examiners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examiners`
--
ALTER TABLE `examiners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=482;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
