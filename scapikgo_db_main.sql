-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2017 at 06:22 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 5.6.31-6+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scapikgo_db_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_logins`
--

CREATE TABLE `admin_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_logins`
--

INSERT INTO `admin_logins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'scapikgo17', '$2y$10$CUyMSpJK5O9yxebEk9cYUeM1/9.8H7PORE/dq69dm70AbHz8tD8Ku', NULL, '2017-11-29 05:21:10', '2017-11-29 05:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `belongs_tos`
--

CREATE TABLE `belongs_tos` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `sub_vendor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `is_sub_or_nos`
--

CREATE TABLE `is_sub_or_nos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `is_sub_or_nos`
--

INSERT INTO `is_sub_or_nos` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Vendor', 0, NULL, NULL),
(2, 'Sub Vendor', 1, NULL, NULL);

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
(3, '2017_10_26_044607_create_admins_table', 2),
(15, '2017_11_17_060301_create_vendor_logins_table', 3),
(16, '2017_11_18_054542_create_belongs_tos_table', 3),
(20, '2017_11_17_060328_create_sub_vendor_logins_table', 4),
(23, '2017_11_29_095150_create_admin_logins_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pg_address`
--

CREATE TABLE `pg_address` (
  `id` int(11) NOT NULL,
  `street` varchar(150) NOT NULL,
  `addressline1` varchar(150) DEFAULT NULL,
  `addressline2` varchar(150) DEFAULT NULL,
  `landmark` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(7) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_address`
--

INSERT INTO `pg_address` (`id`, `street`, `addressline1`, `addressline2`, `landmark`, `city`, `pincode`, `state`, `country`, `updated_at`, `created_at`) VALUES
(2, '43 avon street', 'this line1', 'that 2', 'behind school', 'banga', 543534, 'kar', 'ind', '2017-03-02 04:29:11', '2017-02-20 05:23:46'),
(4, '--- street', 'line1111', 'line2222', 'near park', '1', 123, '2', '1', '2017-02-21 04:13:00', '2017-02-21 04:12:43'),
(5, '222 street', 'bel circle', 'vidyaranyapura', 'near lake', 'bangalore', 560111, 'karnataka', 'india', '2017-03-02 04:22:54', '2017-03-02 04:14:40'),
(6, '12 check', 'line1', 'line2', 'near some where', 'bangalore', 64213, 'karnataka', 'india', '2017-10-26 05:21:11', '2017-10-26 05:21:11'),
(7, '12 check', 'line1', 'line2', 'near some where', 'bangalore', 64213, 'karnataka', 'india', '2017-10-26 05:21:16', '2017-10-26 05:21:16'),
(8, 'new street', 'address one', 'address two', 'bank shop', 'Bangalore', 560046, 'karanataka', 'India', '2017-10-27 00:42:42', '2017-10-27 00:42:42'),
(16, 'something new', 'some new address', 'second address', 'near the phone', 'Bangalore', 560046, 'karanataka', 'India', '2017-11-01 23:42:48', '2017-11-01 23:42:48'),
(17, 'Mahadevpura', 'Hp Park', 'East-Bay', 'Phenoix market city', 'Bangalore', 560046, 'karanataka', 'India', '2017-11-01 23:46:05', '2017-11-01 23:46:05'),
(18, 'sterrt', 'addline one', 'addressline two', 'the noodles shop', 'shang hang', 487216, 'bangalore', 'china', '2017-11-08 01:02:16', '2017-11-08 01:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `pg_composite_order`
--

CREATE TABLE `pg_composite_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(30) NOT NULL,
  `order_amt` decimal(12,3) NOT NULL,
  `order_date` date NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `proc_status` tinyint(3) UNSIGNED NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `spl_instructions` varchar(100) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_composite_order`
--

INSERT INTO `pg_composite_order` (`id`, `code`, `order_amt`, `order_date`, `status`, `proc_status`, `delivery_date`, `delivery_time`, `spl_instructions`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SNDR96503715', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:24:57', '2017-02-24 10:24:57'),
(2, 'SNDR849964918', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:25:19', '2017-02-24 10:25:19'),
(3, 'SNDR388767208', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:26:09', '2017-02-24 10:26:09'),
(4, 'SNDR708405931', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:28:46', '2017-02-24 10:28:46'),
(5, 'SNDR294781624', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:37:32', '2017-02-24 10:37:32'),
(6, 'SNDR840233501', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:38:27', '2017-02-24 10:38:27'),
(7, 'SNDR521538219', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 10:40:42', '2017-02-24 10:40:42'),
(8, 'SNDR837758332', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 11:32:16', '2017-02-24 11:32:16'),
(9, 'SNDR180421251', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 11:33:38', '2017-02-24 11:33:38'),
(10, 'SNDR747471717', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 11:37:52', '2017-02-24 11:37:52'),
(11, 'SNDR737228574', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:40:10', '2017-02-24 12:40:10'),
(12, 'SNDR356654827', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:42:20', '2017-02-24 12:42:20'),
(13, 'SNDR128798482', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:42:27', '2017-02-24 12:42:27'),
(14, 'SNDR929581376', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:43:50', '2017-02-24 12:43:50'),
(15, 'SNDR456374697', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:44:22', '2017-02-24 12:44:22'),
(16, 'SNDR179866678', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:48:01', '2017-02-24 12:48:01'),
(17, 'SNDR165268326', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:50:31', '2017-02-24 12:50:31'),
(18, 'SNDR277194831', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:54:46', '2017-02-24 12:54:46'),
(19, 'SNDR121915711', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:55:35', '2017-02-24 12:55:35'),
(20, 'SNDR767531759', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 12:55:56', '2017-02-24 12:55:56'),
(21, 'SNDR550720191', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 13:01:54', '2017-02-24 13:01:54'),
(22, 'SNDR839479075', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 13:14:17', '2017-02-24 13:14:17'),
(23, 'SNDR752602800', '1342.200', '2017-02-24', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-24 13:14:25', '2017-02-24 13:14:25'),
(24, 'SNDR933100501', '133.960', '2017-02-25', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 05:03:58', '2017-02-25 05:03:58'),
(25, 'INFY143318856', '1342.200', '2017-02-25', 1, 1, NULL, NULL, 'no ins', 1, '2017-02-25 05:33:30', '2017-02-25 05:33:30'),
(26, 'SNDR454153001', '1342.200', '2017-02-25', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 06:34:50', '2017-02-25 06:34:50'),
(30, 'SNDR744647534', '1342.200', '2017-02-25', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 06:47:54', '2017-02-25 06:47:54'),
(31, 'SNDR427777009', '1342.200', '2017-02-25', 2, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 07:08:13', '2017-02-25 07:08:13'),
(32, 'SNDR222323102', '1342.200', '2017-02-25', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 07:30:04', '2017-02-25 07:30:04'),
(33, 'SNDR164738715', '116.200', '2017-02-25', 2, 1, NULL, NULL, 'Do not use MSG', 1, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(40, 'TCSEL338791543', '55.600', '2017-03-03', 2, 1, NULL, NULL, 'No soy sauce please.', 1, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(44, 'SNDR285882764', '116.200', '2017-03-03', 2, 1, NULL, NULL, 'Do not use MSG', 1, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(45, 'SNDR981562943', '116.200', '2017-10-27', 1, 1, NULL, NULL, 'Do not use MSG', 1, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(46, 'SNDR607515568', '1180.200', '2017-10-27', 2, 1, NULL, NULL, 'Do not use MSG', 1, '2017-10-27 06:36:55', '2017-10-27 06:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `pg_court`
--

CREATE TABLE `pg_court` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location_code` varchar(10) DEFAULT NULL,
  `venue_id` int(10) UNSIGNED NOT NULL,
  `land_mark` varchar(30) DEFAULT NULL,
  `location_map` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_court`
--

INSERT INTO `pg_court` (`id`, `name`, `location_code`, `venue_id`, `land_mark`, `location_map`, `created_at`, `updated_at`) VALUES
(3, 'Food Court', 'E101', 8, 'near tower', 'some/file/map.png', '2017-02-20 09:16:39', '2017-02-20 09:16:39'),
(5, 'old Court', 'c101', 8, 'near tower', 'other/file/map.png', '2017-02-20 09:29:43', '2017-02-21 09:55:17'),
(6, 'ribinscurt', 'R100', 2, 'basks', 'folder/file/map.png', '2017-02-21 10:05:05', '2017-02-21 10:05:05'),
(7, 'north food court', 'NF100', 9, 'near back entrance', 'other/file/map.png', '2017-03-02 11:20:12', '2017-03-02 11:20:12'),
(8, 'south food', 'SF111', 9, 'near tower', NULL, '2017-03-02 11:23:09', '2017-03-02 11:25:00'),
(9, 'south food court', 'SF100', 9, 'near entrance', NULL, '2017-03-02 11:23:18', '2017-03-02 11:23:18'),
(12, 'ba somehting', 'so124', 11, 'near kfc', 'some image', '2017-11-01 08:15:22', '2017-11-01 08:15:22'),
(13, 'Bay1', 'E012', 12, 'Phenoix', NULL, '2017-11-02 05:20:25', '2017-11-02 05:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `pg_foodcat`
--

CREATE TABLE `pg_foodcat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` bit(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_foodcat`
--

INSERT INTO `pg_foodcat` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'sub', b'1', '2017-02-20 12:53:59', '2017-02-20 12:53:59'),
(2, 'Beverages', b'1', '2017-02-20 12:54:12', '2017-02-20 12:54:12'),
(4, 'Veg Fries', b'1', '2017-02-20 12:56:29', '2017-02-20 12:56:29'),
(5, 'pepsi', b'1', '2017-02-21 06:01:43', '2017-02-21 06:01:43'),
(6, 'pastries', b'1', '2017-02-21 10:19:25', '2017-02-21 10:21:10'),
(7, 'boiled sugar', b'1', '2017-02-21 10:21:30', '2017-02-21 10:21:30'),
(8, 'boiled sugar', b'1', '2017-02-21 10:21:32', '2017-02-21 10:21:32'),
(9, 'Poultry Deep Fries', b'1', '2017-03-03 11:58:21', '2017-03-03 11:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `pg_order_proc_status`
--

CREATE TABLE `pg_order_proc_status` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(15) NOT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_order_proc_status`
--

INSERT INTO `pg_order_proc_status` (`id`, `code`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'NEW', 'Processing Not Started', NULL, NULL),
(2, 'DELIVERED', 'Someone has Attended To This Order', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pg_order_status`
--

CREATE TABLE `pg_order_status` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `code` varchar(15) NOT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_order_status`
--

INSERT INTO `pg_order_status` (`id`, `code`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'NEW', 'No payment is made', NULL, NULL),
(2, 'CLOSED', 'Payment is accepted', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pg_payments`
--

CREATE TABLE `pg_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comp_order_id` int(10) UNSIGNED NOT NULL,
  `comp_order_code` varchar(20) NOT NULL,
  `trans_amt` decimal(12,2) NOT NULL,
  `trans_id` varchar(50) NOT NULL,
  `trans_date` datetime NOT NULL,
  `trans_status` varchar(20) NOT NULL,
  `trans_tag` varchar(20) NOT NULL,
  `bank_message` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_payments`
--

INSERT INTO `pg_payments` (`id`, `comp_order_id`, `comp_order_code`, `trans_amt`, `trans_id`, `trans_date`, `trans_status`, `trans_tag`, `bank_message`, `created_at`, `updated_at`) VALUES
(3, 33, 'SNDR164738715', '116.20', 'asd1233424', '2017-03-02 22:10:10', 'success', 'dont know', 'everything is fine', '2017-03-02 08:53:33', '2017-03-02 08:53:33'),
(5, 32, 'SNDR222323102', '116.20', 'asd1233424', '2017-03-02 22:10:10', 'success', 'dont know', 'everything is fine', '2017-03-02 09:12:21', '2017-03-02 09:12:21'),
(6, 33, 'SNDR222323102', '116.20', 'asd1233424', '2017-03-02 22:10:10', 'success', 'dont know', 'everything is fine', '2017-03-02 09:22:49', '2017-03-02 09:22:49'),
(7, 31, 'SNDR427777009', '116.20', 'asd1233424', '2017-03-02 22:10:10', 'success', 'dont know', 'everything is fine', '2017-03-02 09:24:31', '2017-03-02 09:24:31'),
(8, 40, 'TCSEL338791543', '56.00', 'GH1233424', '2017-03-03 22:10:12', 'success', 'tag and tag and tag', 'made complete payment. thank you.', '2017-03-03 08:17:56', '2017-03-03 08:17:56'),
(9, 44, 'SNDR285882764', '116.20', 'GH1233424', '2017-03-03 22:10:30', 'success', 'tag and tag and tag', 'Made complete payment. thank you.', '2017-03-03 12:14:09', '2017-03-03 12:14:09'),
(10, 46, 'SNDR607515568', '1180.20', 'GH1233424', '2017-10-27 22:10:30', 'success', 'tag and tag and tag', 'Made complete payment. thank you.', '2017-10-27 06:48:59', '2017-10-27 06:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `pg_stall`
--

CREATE TABLE `pg_stall` (
  `id` int(11) NOT NULL,
  `stall_no` varchar(30) NOT NULL,
  `court_id` int(11) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `open_today` bit(1) NOT NULL,
  `working_days` varchar(40) NOT NULL,
  `working_hours` varchar(100) NOT NULL,
  `todays_special` varchar(100) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_stall`
--

INSERT INTO `pg_stall` (`id`, `stall_no`, `court_id`, `vendor_id`, `open_today`, `working_days`, `working_hours`, `todays_special`, `updated_at`, `created_at`) VALUES
(2, 'E222', 3, 4, b'0', 'MON-TUE-WED-THU-FRI', '09:00 AM - 06:00 PM', 'unclear soup', '2017-02-21 11:15:23', '2017-02-20 11:56:15'),
(4, 'AB20', 5, 3, b'0', 'MON-TUE-WED-THU-FRI', '09:00 AM - 06:00 PM', 'strawberry desert', '2017-02-20 11:57:03', '2017-02-20 11:57:03'),
(5, 'B20', 3, 4, b'0', 'MON-TUE-WED-THU-FRI', '09:00 AM - 06:00 PM', 'strawberry desert', '2017-02-21 11:14:06', '2017-02-21 11:13:20'),
(6, 'B20', 6, 3, b'0', 'MON-TUE-WED-THU-FRI', '09:00 AM - 06:00 PM', 'strawberry desert', '2017-02-21 11:14:19', '2017-02-21 11:14:19'),
(8, 'E122', 5, 2, b'1', 'MON-TUE-WED', '09:00 AM - 11:00 AM', 'potato soup', '2017-03-02 12:35:58', '2017-03-02 12:34:35'),
(9, 'E22', 5, 2, b'1', 'MON-TUE-WED', '09:00 AM - 11:00 AM', 'potato soup', '2017-03-02 12:37:27', '2017-03-02 12:37:27'),
(10, 'E22', 5, 2, b'1', 'MON-TUE-WED', '09:00 AM - 11:00 AM', 'potato soup', '2017-03-02 12:37:29', '2017-03-02 12:37:29'),
(11, 'E22', 5, 2, b'0', 'MON-TUE-WED', '09:00 AM - 11:00 AM', 'potato soup', '2017-03-02 12:43:00', '2017-03-02 12:37:30'),
(12, 'TCSSTLE122', 9, 9, b'0', 'MON-TUE-WED', '06:00 AM - 10:00 PM', 'burnt pizza', '2017-03-03 05:56:29', '2017-03-03 05:56:29'),
(13, 'TCSBE123', 9, 8, b'0', 'MON-TUE-WED', '12:00 NOON - 7:00 PM', 'nothing', '2017-03-03 06:01:49', '2017-03-03 06:01:49'),
(14, 'Stall 01 KFC', 3, 2, b'1', '2', '09:00 AM - 06:00 PM', 'something', '2017-11-09 05:50:30', '2017-11-09 05:50:30'),
(15, 'Stall 02 DMNO', 13, 13, b'0', '13', '09:00 AM - 06:00 PM', 'something', '2017-11-09 06:02:29', '2017-11-09 06:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `pg_stall_food_item`
--

CREATE TABLE `pg_stall_food_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `foodcat_id` int(10) UNSIGNED NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(9,2) UNSIGNED NOT NULL,
  `available_days` varchar(60) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `desc` varchar(200) DEFAULT NULL,
  `img` varchar(60) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_stall_food_item`
--

INSERT INTO `pg_stall_food_item` (`id`, `name`, `foodcat_id`, `stall_id`, `unit_price`, `available_days`, `active`, `desc`, `img`, `created_at`, `updated_at`) VALUES
(1, 'not soft bake', 7, 16, '50.00', 'everyday', b'0', 'okay this is desc', 'some/image', '2017-03-01 11:55:43', '2017-11-27 12:49:15'),
(2, 'fruit', 4, 6, '45.00', 'mon tue', b'1', 'hey', 'hey', '2017-03-01 12:54:35', '2017-11-27 11:23:14'),
(5, 'cake', 6, 6, '20.00', 'FRI-SAT-SUN', b'1', 'chocolette cake', NULL, '2017-03-02 12:48:47', '2017-03-02 12:48:47'),
(7, 'marshmallow', 6, 6, '20.00', 'SUN-THU', b'1', 'wheat bread stick', NULL, '2017-03-02 12:51:25', '2017-03-02 13:32:50'),
(8, 'cup cake', 6, 6, '20.00', 'FRI-SAT-SUN', b'1', 'walnut cup cake', NULL, '2017-03-02 13:26:23', '2017-03-02 13:26:23'),
(9, 'cup cake', 6, 6, '20.00', 'FRI-SAT-SUN', b'1', 'walnut cup cake', NULL, '2017-03-02 13:26:27', '2017-03-02 13:26:27'),
(10, 'coffe bun', 1, 13, '2.00', 'MON-TO-SAT', b'1', 'Bun with flavour of coffee', 'nothing/nothing.png', '2017-03-03 06:09:53', '2017-03-03 06:09:53'),
(11, 'cherry bun', 6, 12, '4.00', 'MON-TO-SAT', b'1', 'Bun with flavour of cherry', 'nothing/nothing.png', '2017-03-03 06:24:19', '2017-03-03 06:24:19'),
(12, 'Strawberry Wafers', 6, 12, '4.00', 'MON-TO-SAT', b'1', 'Wafers with strawberry flavoured cream', 'nothing/nothing.png', '2017-03-03 06:26:15', '2017-03-03 06:26:15'),
(15, 'not new fod', 8, 46, '16.00', 'every day', b'0', 'nice food mate', 'image not new', '2017-11-27 12:40:03', '2017-11-27 12:43:04'),
(16, 'straberry', 6, 4, '45.00', 'mon', b'0', 'monday', 'image', '2017-11-27 12:41:32', '2017-11-27 12:41:32'),
(17, 'nice food', 7, 6, '41.00', 'moday', b'1', 'fruit salllad', 'some place', '2017-11-30 09:26:56', '2017-11-30 09:26:56'),
(18, 'asas', 7, 6, '4.00', 'mod-tue-wed', b'1', 'nice food mate', 'some place', '2017-11-30 09:48:27', '2017-11-30 09:48:27'),
(19, 'new food 2', 2, 2, '2.00', '2', b'1', '2', 'sd', '2017-11-30 09:49:16', '2017-11-30 09:49:16'),
(21, 'picture', 7, 6, '78.00', 'mod-tue-wed', b'1', 'nice food mate', 'C:\\fakepath\\giphy.gif', '2017-11-30 10:39:04', '2017-11-30 10:39:04'),
(22, 'food', 7, 6, '45.00', 'moday', b'1', 'fruit salllad', 'C:\\fakepath\\omg', '2017-11-30 12:36:03', '2017-11-30 12:36:03'),
(23, 'nice  22', 7, 6, '45.00', 'mod-tue-wed', b'1', 'nice food mate', 'C:\\fakepath\\giphy.gif', '2017-11-30 12:46:37', '2017-11-30 12:46:37'),
(24, 'new hey food', 7, 6, '18.00', 'mon-tue-wed', b'1', 'sallad', 'C:\\fakepath\\giphy.gif', '2017-11-30 12:51:22', '2017-11-30 12:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `pg_stall_order`
--

CREATE TABLE `pg_stall_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `composite_order_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) NOT NULL,
  `stall_order_amt` decimal(10,3) UNSIGNED NOT NULL,
  `orderdate` datetime NOT NULL,
  `proc_status` tinyint(3) UNSIGNED NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `stall_id` int(11) NOT NULL,
  `spl_instructions` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_stall_order`
--

INSERT INTO `pg_stall_order` (`id`, `composite_order_id`, `code`, `stall_order_amt`, `orderdate`, `proc_status`, `delivery_date`, `delivery_time`, `stall_id`, `spl_instructions`, `created_at`, `updated_at`) VALUES
(1, 16, '_SNDR179866678', '21.400', '2017-02-24 00:00:00', 2, NULL, NULL, 6, NULL, '2017-02-24 12:48:01', '2017-02-24 12:48:01'),
(2, 17, '_SNDR165268326', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 12:50:32', '2017-02-24 12:50:32'),
(3, 18, '_SNDR277194831', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 12:54:47', '2017-02-24 12:54:47'),
(4, 19, '_SNDR121915711', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 12:55:35', '2017-02-24 12:55:35'),
(5, 20, '_SNDR767531759', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 12:55:57', '2017-02-24 12:55:57'),
(6, 21, '_SNDR550720191', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 13:01:54', '2017-02-24 13:01:54'),
(7, 22, '_SNDR839479075', '21.400', '2017-02-24 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-24 13:14:17', '2017-02-24 13:14:17'),
(8, 23, '_SNDR752602800', '1240.000', '2017-02-24 00:00:00', 2, NULL, NULL, 4, NULL, '2017-02-24 13:14:26', '2017-02-24 13:14:26'),
(9, 23, '_SNDR752602800', '80.800', '2017-02-24 00:00:00', 2, NULL, NULL, 5, NULL, '2017-02-24 13:14:26', '2017-02-24 13:14:26'),
(10, 23, '_SNDR752602800', '21.400', '2017-02-24 00:00:00', 2, NULL, NULL, 6, NULL, '2017-02-24 13:14:26', '2017-02-24 13:14:26'),
(11, 24, '_SNDR933100501', '133.960', '2017-02-25 00:00:00', 2, NULL, NULL, 6, NULL, '2017-02-25 05:03:58', '2017-02-25 05:03:58'),
(12, 25, '_INFY143318856', '1240.000', '2017-02-25 00:00:00', 1, NULL, NULL, 4, NULL, '2017-02-25 05:33:30', '2017-02-25 05:33:30'),
(13, 25, '_INFY143318856', '80.800', '2017-02-25 00:00:00', 1, NULL, NULL, 5, NULL, '2017-02-25 05:33:30', '2017-02-25 05:33:30'),
(14, 25, '_INFY143318856', '21.400', '2017-02-25 00:00:00', 1, NULL, NULL, 6, NULL, '2017-02-25 05:33:31', '2017-02-25 05:33:31'),
(15, 30, 'SNDR744647534 (v2)', '1240.000', '2017-02-25 00:00:00', 1, NULL, NULL, 4, NULL, '2017-02-25 06:47:54', '2017-02-25 06:47:54'),
(16, 30, 'SNDR744647534 (v3)', '80.800', '2017-02-25 00:00:00', 1, NULL, NULL, 5, NULL, '2017-02-25 06:47:55', '2017-02-25 06:47:55'),
(17, 30, 'SNDR744647534 (v2)', '21.400', '2017-02-25 00:00:00', 2, NULL, NULL, 6, NULL, '2017-02-25 06:47:59', '2017-02-25 06:47:59'),
(18, 31, 'SNDR427777009 (v2)', '1342.200', '2017-02-25 00:00:00', 1, NULL, NULL, 4, NULL, '2017-02-25 07:08:13', '2017-02-25 07:08:13'),
(19, 32, 'SNDR222323102 (v2)', '1342.200', '2017-02-25 00:00:00', 1, NULL, NULL, 4, NULL, '2017-02-25 07:30:04', '2017-02-25 07:30:04'),
(20, 33, 'SNDR164738715 (v2)', '102.200', '2017-02-25 00:00:00', 1, NULL, NULL, 4, NULL, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(21, 33, 'SNDR164738715 (v3)', '14.000', '2017-02-25 00:00:00', 2, NULL, NULL, 5, NULL, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(28, 40, 'TCSEL338791543 (CONECT)', '41.000', '2017-03-03 00:00:00', 2, NULL, NULL, 12, NULL, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(29, 40, 'TCSEL338791543 (CONECT)', '14.600', '2017-03-03 00:00:00', 2, NULL, NULL, 13, NULL, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(36, 44, 'SNDR285882764 (v2)', '102.200', '2017-03-03 00:00:00', 1, NULL, NULL, 4, NULL, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(37, 44, 'SNDR285882764 (v3)', '14.000', '2017-03-03 00:00:00', 1, NULL, NULL, 5, NULL, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(38, 45, 'SNDR981562943 (v2)', '102.200', '2017-10-27 00:00:00', 1, NULL, NULL, 4, NULL, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(39, 45, 'SNDR981562943 (v3)', '14.000', '2017-10-27 00:00:00', 1, NULL, NULL, 5, NULL, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(40, 46, 'SNDR607515568 (v2)', '1026.200', '2017-10-27 00:00:00', 1, NULL, NULL, 4, NULL, '2017-10-27 06:36:55', '2017-10-27 06:36:55'),
(41, 46, 'SNDR607515568 (v3)', '154.000', '2017-10-27 00:00:00', 1, NULL, NULL, 5, NULL, '2017-10-27 06:36:55', '2017-10-27 06:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `pg_stall_order_item`
--

CREATE TABLE `pg_stall_order_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `stall_order_id` int(10) UNSIGNED NOT NULL,
  `composite_order_id` int(10) UNSIGNED NOT NULL,
  `stall_food_item_id` int(10) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) UNSIGNED NOT NULL,
  `item_total_amt` decimal(10,2) UNSIGNED NOT NULL,
  `user_feedback` varchar(60) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_stall_order_item`
--

INSERT INTO `pg_stall_order_item` (`id`, `stall_order_id`, `composite_order_id`, `stall_food_item_id`, `quantity`, `unit_price`, `item_total_amt`, `user_feedback`, `created_at`, `updated_at`) VALUES
(1, 10, 23, 1, 2, '10.70', '21.40', NULL, '2017-02-24 13:14:28', '2017-02-24 13:14:28'),
(2, 9, 23, 1, 4, '20.20', '80.80', NULL, '2017-02-24 13:14:28', '2017-02-24 13:14:28'),
(3, 8, 23, 1, 100, '12.40', '1240.00', NULL, '2017-02-24 13:14:28', '2017-02-24 13:14:28'),
(4, 11, 24, 1, 2, '1.70', '3.40', NULL, '2017-02-25 05:03:59', '2017-02-25 05:03:59'),
(5, 11, 24, 1, 3, '0.22', '0.66', NULL, '2017-02-25 05:03:59', '2017-02-25 05:03:59'),
(6, 11, 24, 1, 10, '12.99', '129.90', NULL, '2017-02-25 05:03:59', '2017-02-25 05:03:59'),
(7, 14, 25, 1, 2, '10.70', '21.40', NULL, '2017-02-25 05:33:31', '2017-02-25 05:33:31'),
(8, 13, 25, 1, 4, '20.20', '80.80', NULL, '2017-02-25 05:33:31', '2017-02-25 05:33:31'),
(9, 12, 25, 1, 100, '12.40', '1240.00', NULL, '2017-02-25 05:33:31', '2017-02-25 05:33:31'),
(10, 17, 30, 1, 2, '10.70', '21.40', NULL, '2017-02-25 06:48:09', '2017-02-25 06:48:09'),
(11, 16, 30, 1, 4, '20.20', '80.80', NULL, '2017-02-25 06:48:09', '2017-02-25 06:48:09'),
(12, 15, 30, 1, 100, '12.40', '1240.00', NULL, '2017-02-25 06:48:09', '2017-02-25 06:48:09'),
(13, 18, 31, 1, 2, '10.70', '21.40', NULL, '2017-02-25 07:08:13', '2017-02-25 07:08:13'),
(14, 18, 31, 1, 4, '20.20', '80.80', NULL, '2017-02-25 07:08:13', '2017-02-25 07:08:13'),
(15, 18, 31, 1, 100, '12.40', '1240.00', NULL, '2017-02-25 07:08:13', '2017-02-25 07:08:13'),
(16, 19, 32, 1, 2, '10.70', '21.40', NULL, '2017-02-25 07:30:04', '2017-02-25 07:30:04'),
(17, 19, 32, 1, 4, '20.20', '80.80', NULL, '2017-02-25 07:30:04', '2017-02-25 07:30:04'),
(18, 19, 32, 1, 100, '12.40', '1240.00', NULL, '2017-02-25 07:30:04', '2017-02-25 07:30:04'),
(19, 20, 33, 1, 2, '10.70', '21.40', NULL, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(20, 20, 33, 1, 4, '20.20', '80.80', NULL, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(21, 21, 33, 1, 10, '1.40', '14.00', NULL, '2017-02-25 07:32:53', '2017-02-25 07:32:53'),
(22, 28, 40, 11, 2, '10.50', '21.00', NULL, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(23, 28, 40, 12, 4, '5.00', '20.00', NULL, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(24, 29, 40, 10, 10, '1.46', '14.60', NULL, '2017-03-03 07:07:55', '2017-03-03 07:07:55'),
(25, 36, 44, 1, 2, '10.70', '21.40', NULL, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(26, 36, 44, 2, 4, '20.20', '80.80', NULL, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(27, 37, 44, 5, 10, '1.40', '14.00', NULL, '2017-03-03 12:06:26', '2017-03-03 12:06:26'),
(28, 38, 45, 1, 2, '10.70', '21.40', NULL, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(29, 38, 45, 2, 4, '20.20', '80.80', NULL, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(30, 39, 45, 5, 10, '1.40', '14.00', NULL, '2017-10-27 05:47:34', '2017-10-27 05:47:34'),
(31, 40, 46, 1, 2, '102.70', '205.40', NULL, '2017-10-27 06:36:55', '2017-10-27 06:36:55'),
(32, 40, 46, 2, 4, '205.20', '820.80', NULL, '2017-10-27 06:36:55', '2017-10-27 06:36:55'),
(33, 41, 46, 5, 10, '15.40', '154.00', NULL, '2017-10-27 06:36:55', '2017-10-27 06:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `pg_sub_vendor_logins`
--

CREATE TABLE `pg_sub_vendor_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_vendor_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `sub_vendor_address_id` int(11) NOT NULL,
  `sub_vendor_venue_id` int(10) UNSIGNED NOT NULL,
  `sub_vendor_court_id` int(11) NOT NULL,
  `sub_vendor_stall_id` int(11) NOT NULL,
  `is_ven_or_sub` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_sub_vendor_logins`
--

INSERT INTO `pg_sub_vendor_logins` (`id`, `name`, `email`, `password`, `sub_vendor_id`, `vendor_id`, `sub_vendor_address_id`, `sub_vendor_venue_id`, `sub_vendor_court_id`, `sub_vendor_stall_id`, `is_ven_or_sub`, `created_at`, `updated_at`) VALUES
(1, 'sub', 'sub@ho.com', '$2y$10$sTW89ap/IhZVG3iPC2Y0c.oipRQYvLRHTm/aj0MVQL4YNR93ec18a', 3, 2, 2, 2, 3, 2, 1, '2017-11-22 03:58:06', '2017-11-22 03:58:06'),
(2, 'sub two', 'sub@two.com', '$2y$10$8KmeN9A2Uo6XCoXg5M5hl.G5RcDY6NszwQEDrDEGHmPf3Jince2gK', 8, 2, 7, 9, 9, 9, 1, '2017-11-23 01:35:16', '2017-11-23 01:35:16'),
(3, 'ven sub', 'ven@sub.com', '$2y$10$J8v9K4qK0MxuUMot6kkIK.bVk2SWh0OB7s0zLtG/CAigMwL7lRO7i', 22, 3, 6, 9, 8, 11, 1, '2017-11-25 02:27:31', '2017-11-25 02:27:31'),
(4, 'okay try', 'okay@gmail.com', '$2y$10$aijK27BuGMQcDSp1tK6zYOAXa.P.CHvrRHKlAI2WEqwqnj5/XrvBO', 8, 3, 7, 11, 7, 8, 1, '2017-11-25 02:34:45', '2017-11-25 02:34:45'),
(5, 'jim ast', 'ven@jim.com', '$2y$10$K/OHUr94bvivWoGQvoEFGe0Bzsv5Rlz.UGa9a.CFUv1P8Buc3SUyS', 13, 12, 5, 9, 5, 10, 1, '2017-11-25 03:16:43', '2017-11-25 03:16:43'),
(6, 'santa', 'santa@gmail.com', '$2y$10$HwbuZdZndQgFtfqQ9PN5A.4Q/L0i7eCW06lO0E9N7w6CUv0Ut8zDq', 22, 4, 2, 2, 3, 2, 1, '2017-11-25 03:23:08', '2017-11-25 03:23:08'),
(7, 'ani sub ve', 'sub@ani.com', '$2y$10$8tEoTLWeg9YkuQVlb7PBZ.C3.ecf4OhgBj/SO33W31.XOoY7HFvA2', 11, 13, 8, 9, 7, 13, 1, '2017-11-28 04:04:01', '2017-11-28 04:04:01'),
(8, 'AnirudhSub', 'anirudh@subxyz.com', '$2y$10$3dIMgV2YvIPTL3DWKt.GQ.IAEOuMVgVYu2ITQsWYDMumMqTpgO//m', 5, 2, 6, 2, 6, 9, 1, '2017-11-28 04:11:08', '2017-11-28 04:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `pg_user`
--

CREATE TABLE `pg_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_user`
--

INSERT INTO `pg_user` (`id`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'first', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pg_vendor`
--

CREATE TABLE `pg_vendor` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_account_no` varchar(20) NOT NULL,
  `bank_account_name` varchar(100) NOT NULL COMMENT 'franchisee name',
  `account_type` varchar(3) NOT NULL COMMENT 'CA, SB etc',
  `name` varchar(50) NOT NULL,
  `code` varchar(6) NOT NULL,
  `active` bit(1) DEFAULT b'0',
  `verified` bit(1) DEFAULT b'0',
  `verified_date` date DEFAULT NULL,
  `address_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fk_address',
  `pancard_no` varchar(10) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `contact_email` varchar(70) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_vendor`
--

INSERT INTO `pg_vendor` (`id`, `bank_account_no`, `bank_account_name`, `account_type`, `name`, `code`, `active`, `verified`, `verified_date`, `address_id`, `pancard_no`, `phone_no`, `contact_person`, `contact_email`, `created_at`, `updated_at`) VALUES
(2, '', 'nonveg acc', 'ca', 'veg', 'v1', b'0', b'0', '0000-00-00', 123, 'asdfasdf12', '1234567890', 'Mr contact', 'contacted@junk.com', '2017-02-11 04:17:07', '2017-02-21 06:21:41'),
(3, '', 'kfc', 'ca', 'kfc chicken', 'v2', b'0', b'0', '0000-00-00', 123, 'asdfasdf12', '1234567890', 'Mr contact', 'contact@junk.com', '2017-02-11 04:18:08', '2017-02-11 04:18:08'),
(4, '', 'junkveg acc', 'ca', 'fresh veg', 'v3', b'0', b'0', '0000-00-00', 123, 'asdfasdf12', '1231231233', 'Mr contact', 'contact@junk.com', '2017-02-11 04:18:54', '2017-02-17 05:02:31'),
(5, '', 'nonveg acc', 'ca', 'veg', 'v4', b'0', b'0', '0000-00-00', 123, 'asdfasdf12', '1234567890', 'Mr contact', 'contacted@junk.com', '2017-02-21 06:22:22', '2017-02-21 06:22:22'),
(6, '', 'nonveg acc', 'ca', 'veg', 'v5', b'0', b'1', '0000-00-00', 123, 'asdfasdf12', '1234567890', 'Mr contact', 'contacted@junk.com', '2017-02-21 06:22:23', '2017-02-21 06:26:05'),
(7, '00020123123121', 'old name', 'CUR', 'vnnect tech', 'VNNECT', b'1', b'1', '2017-03-02', 5, 'ASDF1234KK', '1234567890', 'Mr Contact2', 'contact2@junk.com', '2017-03-02 05:31:35', '2017-03-02 05:35:32'),
(8, '0005456636', 'HDFC name', 'SB', 'CONNECT tech', 'CONECT', b'1', b'1', '2017-03-02', 5, 'ASDF1234KK', '1234567890', 'Mr Contact2', 'contact2@junk.com', '2017-03-02 05:37:53', '2017-03-02 05:37:53'),
(9, '0005456636', 'HDFC name', 'SB', 'CONNECT tech', 'CONECT', b'1', b'1', '2017-03-02', 5, 'ASDF1234KK', '1234567890', 'Mr Contact2', 'contact2@junk.com', '2017-03-02 05:37:56', '2017-03-02 05:37:56'),
(11, '4512345', 'canarea', 'sa', 'kimson', 'v2 sca', b'1', b'1', '2017-10-26', 2, 'jukjsgkh51', '9535369485', 'jimmy', 'kim@gmail.com', '2017-10-26 04:25:13', '2017-10-26 04:28:11'),
(12, '4512345', 'canarea', 'sa', 'jim brown', 'v2 sca', b'1', b'1', '2017-10-26', 2, 'jukjsgkh51', '9535369485', 'jimmy', 'kim@gmail.com', '2017-10-26 04:25:15', '2017-10-26 04:25:15'),
(13, '4512345', 'canarea', 'sa', 'kimson', 'v2 sca', b'1', b'1', '2017-10-26', 2, 'jukjsgkh51', '9535369485', 'jimmy', 'kim@gmail.com', '2017-10-26 04:40:01', '2017-10-26 04:40:01'),
(14, '0512345', 'icic', 'sa', 'check one', 'v2 sca', b'1', b'1', '2017-10-27', 2, 'jukjsgkh51', '9535369485', 'check himmy', 'kim@gmail.com', '2017-10-26 05:19:54', '2017-10-26 05:19:54'),
(15, '0512345', 'icic', 'sa', 'check one', 'v2 sca', b'1', b'1', '2017-10-27', 7, 'jukjsgkh51', '9535369485', 'check himmy', 'kim@gmail.com', '2017-10-26 05:59:41', '2017-10-26 05:59:41'),
(17, '123254981', 'some acc', 'ca', 'veg', 'v1 k', b'0', b'0', '2017-10-28', 2, 'asdfasdf12', '1234567890', 'Mr contact', 'contacted@junk.com', '2017-10-28 00:28:19', '2017-10-28 00:28:19'),
(22, '12345678', 'ICICI', 'SA', 'Harshitha', 'DOM', NULL, NULL, '2018-11-02', 17, 'AMPH40579R', '7787687898', 'Thursday Harshitha', 'abc@xyx.com', '2017-11-01 23:48:39', '2017-11-01 23:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `pg_vendor_logins`
--

CREATE TABLE `pg_vendor_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `vendor_address_id` int(11) NOT NULL,
  `vendor_venue_id` int(10) UNSIGNED NOT NULL,
  `vendor_court_id` int(11) NOT NULL,
  `vendor_stall_id` int(11) NOT NULL,
  `is_ven_or_sub` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_vendor_logins`
--

INSERT INTO `pg_vendor_logins` (`id`, `name`, `email`, `password`, `vendor_id`, `vendor_address_id`, `vendor_venue_id`, `vendor_court_id`, `vendor_stall_id`, `is_ven_or_sub`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ho', 'ho@gmail.com', '$2y$10$GnqaqplJoul3EpGHSnABq.31EWku9hGWn8ZPxxfdmz7GTAZ7a.W6K', 2, 2, 2, 3, 2, 0, 'A53980p1pAu1LfiJQ1I0IM1XQ8syEpbHSfnUeef1nPBcABXXwXQIEL5PfByH', '2017-11-22 02:46:38', '2017-11-22 02:46:38'),
(2, 'ven', 'ven@two.com', '$2y$10$nsYIx.hIqRVisWrVhfTEZuDELijr8SIULGIiBb/B7bY/PzYz1mbv6', 3, 16, 9, 12, 11, 0, 'hIM3eS6GO7SA36gdfdsVZbXwqtgGK9z3JhFXBXoc8nNTjyzK7zcKsN0rO1Pg', '2017-11-23 03:51:44', '2017-11-23 03:51:44'),
(3, 'jim brown', 'jim@brown.com', '$2y$10$xzwXRR8FvcE37xn.SdfRYOTkSyp96cWKjgyCFQZqQEb/Y/LxzmBam', 12, 8, 9, 9, 10, 0, 'mVhwDmSf8VF1ncR3Mp8TBPeVqSB63mihxzXJvrCwPH0543QT1l5mTTbHxTJh', '2017-11-25 03:14:33', '2017-11-25 03:14:33'),
(4, 'new one', 'new@ven.com', '$2y$10$3gb/MgX8b/YWSaqswgOjvehwnBqeSMtyiiH82LWVCqg1nx8yuypxS', 4, 7, 9, 12, 12, 0, 'lQaIpX5ZriZsrGWeOrNJe24miZeBv1hKGW0IduOngS5TrBMZTMfnYjMxOIey', '2017-11-25 03:20:37', '2017-11-25 03:20:37'),
(5, 'Anirudh', 'ani@xyz.com', '$2y$10$L0hzZxc8RDUifWCns8Q38u4m1bkbthRH0fnZHZt5WnC4fzBjOPEc2', 5, 2, 8, 12, 10, 0, NULL, '2017-11-28 03:56:25', '2017-11-28 03:56:25'),
(6, 'ani new', 'ani@new.com', '$2y$10$.7sh21N11ourP1OQfA1c5./EcVgseeqP8Zs.YLfXVJOgjqAZlHUya', 14, 7, 2, 8, 13, 0, NULL, '2017-11-28 04:02:31', '2017-11-28 04:02:31'),
(8, 'Anirudh', 'anirudh@xyz.com', '$2y$10$0uEx19lkJ6y19smUxO6VC.opKl4jkMZ4q.7.wjKeESj37CXs.oOrK', 7, 5, 9, 6, 2, 0, NULL, '2017-11-28 04:08:25', '2017-11-28 04:08:25'),
(9, 'check', 'check@ho.com', '$2y$10$BosKUROW1mZPDP35Bkfmcu8jsUsFM6fsS59zg8latL9UIHVd07qHu', 11, 4, 9, 8, 6, 0, NULL, '2017-11-30 04:08:08', '2017-11-30 04:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `pg_venue`
--

CREATE TABLE `pg_venue` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(7) NOT NULL,
  `address_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pg_venue`
--

INSERT INTO `pg_venue` (`id`, `name`, `code`, `address_id`, `created_at`, `updated_at`) VALUES
(2, 'Infosys Electronic City Campus', 'INFY', 2, '2017-02-10 02:26:36', '2017-02-21 07:04:03'),
(8, 'Schneider Campus', 'SNDR', 2, '2017-02-21 07:05:02', '2017-02-21 07:05:02'),
(9, 'TCS Electronic City', 'TCSEL', 5, '2017-03-02 04:39:46', '2017-03-02 04:50:48'),
(10, 'Tech park nice one', 'TPNC', 2, '2017-11-01 02:11:06', '2017-11-01 02:11:06'),
(11, 'check techpark', 'ckp', 8, '2017-11-01 02:14:40', '2017-11-01 02:14:40'),
(12, 'Hp Campus', 'HPE', 17, '2017-11-01 23:46:27', '2017-11-01 23:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `facebook_id`, `created_at`, `updated_at`) VALUES
(1, 'Nagarajan K', 'nagarajan75star@gmail.com', '$2y$10$oNhpO/pobOgRcfrV4k60YuD1ID3ln2QbFX0MbmyLtFeN4L9nagUnK', 'dwT58MWPkDk7mc9k3ibl6JcWzyiVV8FK4VsR4nbz7ITPPsfvgZA9jTEDDarG', NULL, '2017-05-04 06:25:47', '2017-05-04 06:25:47'),
(2, 'nagarajan', 'nagarajank@vnnect.com', '$2y$10$G7mgxUqdnCr8VlSxWsIKR.5YFPpgCtYKKxHhgoJoKDrKxFUgmNwQa', NULL, NULL, '2017-05-13 04:17:19', '2017-05-13 04:17:19'),
(3, 'nagarajan', 'nag4@nag.com', '$2y$10$PgDkpeAMe9f5GFGV6pliIuR/FoTr9KIJsGJWulaWMtcR51FAL6hIu', NULL, NULL, '2017-06-12 19:27:32', '2017-06-12 19:27:32'),
(5, 'Rajesha', 'rajesha@gmail.com', '$2y$10$8hxaQlkJIHC/IjjOH/qLL.iM.gi99lnuVkqLqO/xbC3PalHctUopK', NULL, NULL, '2017-07-03 19:01:58', '2017-07-03 19:01:58'),
(6, 'Rajesha', 'rajesha@gmail.cim', '$2y$10$Hey0bSYOAKj52W570cj0Z.YdUPpkZQHj3DZfRfMPV.inpzra6oNOG', NULL, NULL, '2017-07-03 19:22:21', '2017-07-03 19:22:21'),
(7, 'Harsh', 'harsh@xyz.com', '$2y$10$fSnuCzOQ6zhVD/1f1nPPqeQ5BybgS88m8KJvmMEUVnGG6hybBGM/G', NULL, NULL, '2017-07-04 16:47:46', '2017-07-04 16:47:46'),
(8, 'kim', 'kim@gmail.com', '$2y$10$JDtXSguaHnFwmkxiiEPAj.vBn0W0bm7Ljj7yKlkXZ0ETUqqSA7S1m', '0XGbNIHKaneSVNbYjxNNnrfzHjmHzB4XWTaZgubJOzqUcs8h2IZSWdCXNa3I', NULL, '2017-09-27 15:00:09', '2017-09-27 15:00:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_logins`
--
ALTER TABLE `admin_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_logins_email_unique` (`email`);

--
-- Indexes for table `belongs_tos`
--
ALTER TABLE `belongs_tos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belongs_tos_vendor_id_foreign` (`vendor_id`),
  ADD KEY `belongs_tos_sub_vendor_id_foreign` (`sub_vendor_id`);

--
-- Indexes for table `is_sub_or_nos`
--
ALTER TABLE `is_sub_or_nos`
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
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `pg_address`
--
ALTER TABLE `pg_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_composite_order`
--
ALTER TABLE `pg_composite_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `proc_status` (`proc_status`);

--
-- Indexes for table `pg_court`
--
ALTER TABLE `pg_court`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `pg_foodcat`
--
ALTER TABLE `pg_foodcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_order_proc_status`
--
ALTER TABLE `pg_order_proc_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_order_status`
--
ALTER TABLE `pg_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_payments`
--
ALTER TABLE `pg_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_stall`
--
ALTER TABLE `pg_stall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `pg_stall_food_item`
--
ALTER TABLE `pg_stall_food_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_stall_order`
--
ALTER TABLE `pg_stall_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_id` (`stall_id`),
  ADD KEY `proc_status` (`proc_status`);

--
-- Indexes for table `pg_stall_order_item`
--
ALTER TABLE `pg_stall_order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_order_id` (`stall_order_id`),
  ADD KEY `stall_food_item_id` (`stall_food_item_id`);

--
-- Indexes for table `pg_sub_vendor_logins`
--
ALTER TABLE `pg_sub_vendor_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pg_sub_vendor_logins_email_unique` (`email`),
  ADD KEY `pg_sub_vendor_logins_sub_vendor_id_foreign` (`sub_vendor_id`),
  ADD KEY `pg_sub_vendor_logins_vendor_id_foreign` (`vendor_id`),
  ADD KEY `pg_sub_vendor_logins_sub_vendor_address_id_foreign` (`sub_vendor_address_id`),
  ADD KEY `pg_sub_vendor_logins_sub_vendor_venue_id_foreign` (`sub_vendor_venue_id`),
  ADD KEY `pg_sub_vendor_logins_sub_vendor_court_id_foreign` (`sub_vendor_court_id`),
  ADD KEY `pg_sub_vendor_logins_sub_vendor_stall_id_foreign` (`sub_vendor_stall_id`);

--
-- Indexes for table `pg_user`
--
ALTER TABLE `pg_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_vendor`
--
ALTER TABLE `pg_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_vendor_logins`
--
ALTER TABLE `pg_vendor_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pg_vendor_logins_email_unique` (`email`),
  ADD KEY `pg_vendor_logins_vendor_id_foreign` (`vendor_id`),
  ADD KEY `pg_vendor_logins_vendor_address_id_foreign` (`vendor_address_id`),
  ADD KEY `pg_vendor_logins_vendor_venue_id_foreign` (`vendor_venue_id`),
  ADD KEY `pg_vendor_logins_vendor_court_id_foreign` (`vendor_court_id`),
  ADD KEY `pg_vendor_logins_vendor_stall_id_foreign` (`vendor_stall_id`);

--
-- Indexes for table `pg_venue`
--
ALTER TABLE `pg_venue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_id` (`address_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_logins`
--
ALTER TABLE `admin_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `belongs_tos`
--
ALTER TABLE `belongs_tos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `is_sub_or_nos`
--
ALTER TABLE `is_sub_or_nos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pg_address`
--
ALTER TABLE `pg_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pg_composite_order`
--
ALTER TABLE `pg_composite_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `pg_court`
--
ALTER TABLE `pg_court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pg_foodcat`
--
ALTER TABLE `pg_foodcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pg_order_proc_status`
--
ALTER TABLE `pg_order_proc_status`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pg_order_status`
--
ALTER TABLE `pg_order_status`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pg_payments`
--
ALTER TABLE `pg_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pg_stall`
--
ALTER TABLE `pg_stall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pg_stall_food_item`
--
ALTER TABLE `pg_stall_food_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pg_stall_order`
--
ALTER TABLE `pg_stall_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `pg_stall_order_item`
--
ALTER TABLE `pg_stall_order_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `pg_sub_vendor_logins`
--
ALTER TABLE `pg_sub_vendor_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pg_user`
--
ALTER TABLE `pg_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pg_vendor`
--
ALTER TABLE `pg_vendor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `pg_vendor_logins`
--
ALTER TABLE `pg_vendor_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pg_venue`
--
ALTER TABLE `pg_venue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `belongs_tos`
--
ALTER TABLE `belongs_tos`
  ADD CONSTRAINT `belongs_tos_sub_vendor_id_foreign` FOREIGN KEY (`sub_vendor_id`) REFERENCES `pg_vendor` (`id`),
  ADD CONSTRAINT `belongs_tos_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `pg_vendor` (`id`);

--
-- Constraints for table `pg_composite_order`
--
ALTER TABLE `pg_composite_order`
  ADD CONSTRAINT `pg_composite_order_ibfk_1` FOREIGN KEY (`status`) REFERENCES `pg_order_status` (`id`),
  ADD CONSTRAINT `pg_composite_order_ibfk_2` FOREIGN KEY (`proc_status`) REFERENCES `pg_order_proc_status` (`id`),
  ADD CONSTRAINT `pg_composite_order_ibfk_3` FOREIGN KEY (`status`) REFERENCES `pg_order_status` (`id`),
  ADD CONSTRAINT `pg_composite_order_ibfk_4` FOREIGN KEY (`proc_status`) REFERENCES `pg_order_proc_status` (`id`);

--
-- Constraints for table `pg_court`
--
ALTER TABLE `pg_court`
  ADD CONSTRAINT `pg_court_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `pg_venue` (`id`);

--
-- Constraints for table `pg_stall`
--
ALTER TABLE `pg_stall`
  ADD CONSTRAINT `pg_stall_ibfk_1` FOREIGN KEY (`court_id`) REFERENCES `pg_court` (`id`),
  ADD CONSTRAINT `pg_stall_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `pg_vendor` (`id`);

--
-- Constraints for table `pg_stall_order`
--
ALTER TABLE `pg_stall_order`
  ADD CONSTRAINT `pg_stall_order_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `pg_stall` (`id`),
  ADD CONSTRAINT `pg_stall_order_ibfk_2` FOREIGN KEY (`proc_status`) REFERENCES `pg_order_proc_status` (`id`);

--
-- Constraints for table `pg_stall_order_item`
--
ALTER TABLE `pg_stall_order_item`
  ADD CONSTRAINT `pg_stall_order_item_ibfk_1` FOREIGN KEY (`stall_order_id`) REFERENCES `pg_stall_order` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `pg_stall_order_item_ibfk_2` FOREIGN KEY (`stall_food_item_id`) REFERENCES `pg_stall_food_item` (`id`);

--
-- Constraints for table `pg_sub_vendor_logins`
--
ALTER TABLE `pg_sub_vendor_logins`
  ADD CONSTRAINT `pg_sub_vendor_logins_sub_vendor_address_id_foreign` FOREIGN KEY (`sub_vendor_address_id`) REFERENCES `pg_address` (`id`),
  ADD CONSTRAINT `pg_sub_vendor_logins_sub_vendor_court_id_foreign` FOREIGN KEY (`sub_vendor_court_id`) REFERENCES `pg_court` (`id`),
  ADD CONSTRAINT `pg_sub_vendor_logins_sub_vendor_id_foreign` FOREIGN KEY (`sub_vendor_id`) REFERENCES `pg_vendor` (`id`),
  ADD CONSTRAINT `pg_sub_vendor_logins_sub_vendor_stall_id_foreign` FOREIGN KEY (`sub_vendor_stall_id`) REFERENCES `pg_stall` (`id`),
  ADD CONSTRAINT `pg_sub_vendor_logins_sub_vendor_venue_id_foreign` FOREIGN KEY (`sub_vendor_venue_id`) REFERENCES `pg_venue` (`id`),
  ADD CONSTRAINT `pg_sub_vendor_logins_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `pg_vendor` (`id`);

--
-- Constraints for table `pg_vendor_logins`
--
ALTER TABLE `pg_vendor_logins`
  ADD CONSTRAINT `pg_vendor_logins_vendor_address_id_foreign` FOREIGN KEY (`vendor_address_id`) REFERENCES `pg_address` (`id`),
  ADD CONSTRAINT `pg_vendor_logins_vendor_court_id_foreign` FOREIGN KEY (`vendor_court_id`) REFERENCES `pg_court` (`id`),
  ADD CONSTRAINT `pg_vendor_logins_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `pg_vendor` (`id`),
  ADD CONSTRAINT `pg_vendor_logins_vendor_stall_id_foreign` FOREIGN KEY (`vendor_stall_id`) REFERENCES `pg_stall` (`id`),
  ADD CONSTRAINT `pg_vendor_logins_vendor_venue_id_foreign` FOREIGN KEY (`vendor_venue_id`) REFERENCES `pg_venue` (`id`);

--
-- Constraints for table `pg_venue`
--
ALTER TABLE `pg_venue`
  ADD CONSTRAINT `pg_venue_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `pg_address` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
