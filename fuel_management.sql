-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 12, 2022 at 06:10 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuel_order`
--

DROP TABLE IF EXISTS `fuel_order`;
CREATE TABLE IF NOT EXISTS `fuel_order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `station_id` varchar(10) NOT NULL,
  `fuel_id` int(10) NOT NULL,
  `order_qty` float NOT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `station_id` (`station_id`),
  KEY `fuel_id` (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_order`
--

INSERT INTO `fuel_order` (`order_id`, `station_id`, `fuel_id`, `order_qty`, `order_status`, `order_time`) VALUES
(8, 'GC020', 4, 777, 'COMPLETE', '2022-10-07 14:28:50'),
(9, 'GC020', 2, 444, 'PENDING', '2022-10-07 14:29:38'),
(10, 'GC020', 2, 444, 'PENDING', '2022-10-07 14:30:06'),
(11, 'GC020', 1, 5555, 'PENDING', '2022-10-07 14:31:49'),
(12, 'GC020', 3, 33333, 'PENDING', '2022-10-07 15:09:05'),
(13, '2', 1, 1000, 'PENDING', '2022-10-11 18:28:49'),
(14, '2', 1, 1000, 'REJECTED', '2022-10-12 06:31:55'),
(15, '2', 1, 6500, 'PENDING', '2022-10-12 16:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_price`
--

DROP TABLE IF EXISTS `fuel_price`;
CREATE TABLE IF NOT EXISTS `fuel_price` (
  `price_id` int(10) NOT NULL AUTO_INCREMENT,
  `fuel_id` int(10) NOT NULL,
  `price` float NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`price_id`),
  KEY `fuel_id` (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_price`
--

INSERT INTO `fuel_price` (`price_id`, `fuel_id`, `price`, `update_time`) VALUES
(1, 1, 440, '2022-10-12 16:29:57'),
(2, 2, 550, '2022-10-06 08:53:53'),
(3, 3, 540, '2022-10-06 08:54:06'),
(4, 4, 340, '2022-10-03 00:50:10'),
(5, 5, 420, '2022-10-06 08:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_station`
--

DROP TABLE IF EXISTS `fuel_station`;
CREATE TABLE IF NOT EXISTS `fuel_station` (
  `station_id` varchar(10) NOT NULL,
  `station_name` varchar(100) NOT NULL,
  `manager_id` int(10) NOT NULL,
  `station_zip` varchar(100) NOT NULL,
  PRIMARY KEY (`station_id`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_station`
--

INSERT INTO `fuel_station` (`station_id`, `station_name`, `manager_id`, `station_zip`) VALUES
('2', 'Lanka Filling Station Dompe', 2, 'Dompe'),
('GC007', 'Gampaha Mpcs Ltd', 100, 'Gampaha'),
('GC020', 'Dehiwala Mpcs Ltd', 12345, 'Dehiwala'),
('PC001', 'D H G Ananda', 25, 'Kandy'),
('PC012', 'gavindu Filling ', 895, 'Kaduwela'),
('PC087', 'ABC FILLING STATION', 569, 'HORANA'),
('PC123', 'ARUNA FILLING STATION', 7854, 'KURUNAGALA'),
('PC564', 'Abesekara filling station', 5541, 'jafna'),
('PC999', 'Aradana Filling station', 992, 'galle');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_stock`
--

DROP TABLE IF EXISTS `fuel_stock`;
CREATE TABLE IF NOT EXISTS `fuel_stock` (
  `stock_id` int(10) NOT NULL AUTO_INCREMENT,
  `station_id` varchar(10) NOT NULL,
  `fuel_id` int(10) NOT NULL,
  `stock` float NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`stock_id`),
  KEY `station_id` (`station_id`),
  KEY `fuel_id` (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_stock`
--

INSERT INTO `fuel_stock` (`stock_id`, `station_id`, `fuel_id`, `stock`, `update_time`) VALUES
(1, 'PC001', 1, 994, '2022-10-12 05:39:23'),
(2, 'PC001', 2, 100, '2022-10-03 00:52:31'),
(3, 'PC001', 3, 100, '2022-10-03 00:52:31'),
(4, 'PC001', 4, 100, '2022-10-03 00:52:31'),
(5, 'PC001', 5, 100, '2022-10-03 00:52:31'),
(6, '2', 1, 889, '2022-10-11 16:22:37'),
(7, '2', 2, 1072, '2022-10-11 16:23:49'),
(8, '2', 3, 1000, '2022-10-11 08:44:09'),
(9, '2', 4, 995, '2022-10-12 05:33:55'),
(10, '2', 5, 1100, '2022-10-11 08:44:34'),
(11, 'PC012', 1, 100, '2022-10-05 08:48:04'),
(12, 'PC012', 2, 100, '2022-10-05 08:44:26'),
(13, 'PC012', 3, 100, '2022-10-05 08:48:34'),
(14, 'PC012', 4, 100, '2022-10-05 08:44:26'),
(15, 'PC012', 5, 100, '2022-10-05 08:44:26'),
(16, 'GC020', 1, 700, '2022-10-07 14:18:56'),
(17, 'GC020', 2, 0, '2022-10-07 08:05:30'),
(18, 'GC020', 3, 818, '2022-10-07 14:17:45'),
(19, 'GC020', 4, 0, '2022-10-07 08:05:30'),
(20, 'GC020', 5, 0, '2022-10-07 08:05:30'),
(21, 'GC007', 1, 100, '2022-10-07 11:34:55'),
(22, 'GC007', 2, 100, '2022-10-07 11:34:55'),
(23, 'GC007', 3, 100, '2022-10-07 11:34:55'),
(24, 'GC007', 4, 100, '2022-10-07 11:34:55'),
(25, 'GC007', 5, 100, '2022-10-07 11:34:55'),
(26, 'PC999', 1, 1000, '2022-10-12 16:43:34'),
(27, 'PC999', 2, 1000, '2022-10-12 16:44:06'),
(28, 'PC999', 3, 0, '2022-10-12 15:58:46'),
(29, 'PC999', 4, 0, '2022-10-12 15:58:46'),
(30, 'PC999', 5, 0, '2022-10-12 15:58:46'),
(46, 'PC564', 1, 0, '2022-10-12 16:48:11'),
(47, 'PC564', 2, 0, '2022-10-12 16:48:11'),
(48, 'PC564', 3, 0, '2022-10-12 16:48:11'),
(49, 'PC564', 4, 0, '2022-10-12 16:48:11'),
(50, 'PC564', 5, 0, '2022-10-12 16:48:11'),
(51, 'PC123', 1, 0, '2022-10-12 17:03:55'),
(52, 'PC123', 2, 0, '2022-10-12 17:03:55'),
(53, 'PC123', 3, 0, '2022-10-12 17:03:55'),
(54, 'PC123', 4, 0, '2022-10-12 17:03:55'),
(55, 'PC123', 5, 0, '2022-10-12 17:03:55'),
(56, 'PC087', 1, 0, '2022-10-12 17:16:20'),
(57, 'PC087', 2, 0, '2022-10-12 17:16:20'),
(58, 'PC087', 3, 0, '2022-10-12 17:16:20'),
(59, 'PC087', 4, 0, '2022-10-12 17:16:20'),
(60, 'PC087', 5, 0, '2022-10-12 17:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

DROP TABLE IF EXISTS `fuel_type`;
CREATE TABLE IF NOT EXISTS `fuel_type` (
  `fuel_id` int(10) NOT NULL,
  `fuel_type` varchar(100) NOT NULL,
  PRIMARY KEY (`fuel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`fuel_id`, `fuel_type`) VALUES
(1, '92petrol'),
(2, '95petrol'),
(3, 'diesel'),
(4, 'kerosene'),
(5, 'super-diesel');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `station_id` varchar(10) NOT NULL,
  `pumper_id` int(10) DEFAULT NULL,
  `fuel_id` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `invoice_date` datetime NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `station_id` (`station_id`),
  KEY `fuel_id` (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `station_id`, `pumper_id`, `fuel_id`, `price`, `quantity`, `total`, `invoice_date`) VALUES
(1, 'GC007', 111, 1, 150, 2, 3000, '2022-10-06 22:19:18'),
(2, '2', 89, 1, 150, 10, 1500, '2022-10-06 22:20:50'),
(12, '2', 89, NULL, NULL, 3, NULL, '2022-10-07 00:21:13'),
(13, '2', 89, 1, NULL, 3, NULL, '2022-10-07 00:22:54'),
(14, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:28:55'),
(15, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:30:53'),
(16, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:32:08'),
(17, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:34:00'),
(18, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:35:15'),
(19, '2', 89, NULL, NULL, NULL, NULL, '2022-10-07 00:35:50'),
(20, '2', 89, 4, 340, 5, 1700, '2022-10-07 00:40:47'),
(21, '2', 89, 4, 340, 5, 1700, '2022-10-07 00:42:08'),
(22, '2', 89, 1, 4555, 7, 31885, '2022-10-07 00:42:29'),
(23, '2', 89, 2, 550, 10, 5500, '2022-10-07 00:50:28'),
(24, '2', 8787, 3, 540, 10, 5400, '2022-10-07 00:55:22'),
(25, 'GC007', 1111, 4, 340, 7, 2380, '2022-10-07 00:56:47'),
(26, 'GC007', 1111, 1, 4555, 0, 0, '2022-10-07 01:05:45'),
(27, '2', NULL, 2, 550, 5, 2750, '2022-10-07 02:37:39'),
(28, '2', NULL, 3, 540, 5, 2700, '2022-10-07 02:38:06'),
(29, '2', 89, 1, 4555, 15, 68325, '2022-10-07 02:39:17'),
(30, '2', 89, 1, 4555, 20, 91100, '2022-10-07 02:48:10'),
(31, '2', 89, 1, 4555, 10, 45550, '2022-10-07 02:50:41'),
(32, '2', 89, 1, 4555, 10, 45550, '2022-10-07 02:51:15'),
(33, '2', 89, 2, 550, 5, 2750, '2022-10-07 02:56:33'),
(34, '2', 89, 1, 4555, 0, 0, '2022-10-07 03:18:11'),
(35, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:18:17'),
(36, '2', 89, 1, 4555, 6, 27330, '2022-10-07 03:18:50'),
(37, '2', 89, 1, 4555, 6, 27330, '2022-10-07 03:19:46'),
(38, '2', 89, 1, 4555, 6, 27330, '2022-10-07 03:20:01'),
(39, '2', 89, 1, 4555, 4, 18220, '2022-10-07 03:20:06'),
(40, '2', 89, 1, 4555, 1, 4555, '2022-10-07 03:20:20'),
(41, '2', 89, 1, 4555, 1, 4555, '2022-10-07 03:21:17'),
(42, '2', 89, 1, 4555, 5, 22775, '2022-10-07 03:22:51'),
(43, '2', 89, 1, 4555, 4, 18220, '2022-10-07 03:26:28'),
(44, '2', 89, 1, 4555, 4, 18220, '2022-10-07 03:27:36'),
(45, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:29:13'),
(46, '2', 89, 1, 4555, 0, 0, '2022-10-07 03:32:08'),
(47, '2', 89, 1, 4555, 1, 4555, '2022-10-07 03:37:11'),
(48, '2', 89, 1, 4555, 1, 4555, '2022-10-07 03:38:10'),
(49, '2', 89, 1, 4555, 8, 36440, '2022-10-07 03:38:58'),
(50, '2', 89, 1, 4555, 7, 31885, '2022-10-07 03:41:03'),
(51, '2', 89, 1, 4555, 33, 150315, '2022-10-07 03:43:49'),
(52, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:47:26'),
(53, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:47:54'),
(54, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:52:54'),
(55, '2', 89, 1, 4555, 3, 13665, '2022-10-07 03:53:35'),
(56, '2', 89, 1, 4555, 4, 18220, '2022-10-07 03:53:55'),
(57, '2', 89, 1, 4555, 2, 9110, '2022-10-07 03:55:27'),
(58, '2', 89, 1, 4555, 8, 36440, '2022-10-07 03:59:14'),
(59, '2', 89, 1, 4555, 3, 13665, '2022-10-07 04:02:46'),
(60, '2', 89, 1, 4555, 4, 18220, '2022-10-07 04:04:00'),
(61, '2', 89, 1, 4555, 7, 31885, '2022-10-07 04:05:32'),
(62, '2', 89, 2, 550, 7, 3850, '2022-10-07 04:07:14'),
(63, '2', 89, 1, 4555, 7, 31885, '2022-10-07 04:07:53'),
(64, '2', 89, 1, 4555, 7, 31885, '2022-10-07 04:08:23'),
(65, '2', 89, 1, 4555, 33, 150315, '2022-10-07 04:09:17'),
(66, '2', 89, 3, 540, 3, 1620, '2022-10-07 04:09:58'),
(67, '2', 89, 1, 4555, 1, 4555, '2022-10-07 04:10:16'),
(68, '2', 89, 1, 4555, 1, 4555, '2022-10-07 04:13:35'),
(69, '2', 89, 1, 4555, 4, 18220, '2022-10-07 04:18:28'),
(70, '2', 89, 1, 4555, 0, 0, '2022-10-07 04:25:38'),
(71, '2', 89, 2, 550, 4, 2200, '2022-10-07 12:57:35'),
(72, '2', 89, 2, 550, 4, 2200, '2022-10-07 13:01:47'),
(73, '2', 89, 1, 4555, 10, 45550, '2022-10-07 13:03:40'),
(74, '2', 89, 1, 4555, 10, 45550, '2022-10-07 13:03:55'),
(75, '2', 89, 2, 550, 4, 2200, '2022-10-07 13:04:15'),
(76, '2', 89, 1, 4555, 4, 18220, '2022-10-07 13:07:34'),
(77, '2', 89, 1, 4555, 4, 18220, '2022-10-07 13:09:51'),
(78, '2', 89, 1, 4555, 3, 13665, '2022-10-07 13:10:23'),
(79, '2', 89, 1, 4555, 1, 4555, '2022-10-07 13:17:37'),
(80, '2', 89, 1, 4555, 1, 4555, '2022-10-07 13:19:59'),
(81, '2', 89, 1, 4555, 1, 4555, '2022-10-07 13:21:25'),
(82, '2', 89, 1, 4555, 1, 4555, '2022-10-07 13:22:24'),
(83, 'GC007', 1111, 1, 4555, 4, 18220, '2022-10-07 13:23:43'),
(84, '2', 89, 1, 4555, 5, 22775, '2022-10-07 13:38:53'),
(85, '2', 89, 1, 4555, 9, 40995, '2022-10-07 13:40:04'),
(86, '2', 89, 1, 4555, 3, 13665, '2022-10-07 14:05:11'),
(87, '2', 89, 1, 4555, 7, 31885, '2022-10-07 14:33:21'),
(88, '2', 89, 3, 540, 7, 3780, '2022-10-07 15:02:16'),
(89, '2', 89, 1, 4555, 1, 4555, '2022-10-07 15:02:28'),
(90, '2', 89, 1, 4555, 1000, 4555000, '2022-10-11 12:56:08'),
(91, '2', 89, 2, 550, 2, 1100, '2022-10-11 12:58:22'),
(92, '2', 89, 2, 550, 500, 275000, '2022-10-11 12:59:39'),
(93, '2', 8787, 1, 4555, 300, 1366500, '2022-10-11 14:21:48'),
(94, '2', 89, 1, 450, 100, 45000, '2022-10-11 15:10:35'),
(95, '2', 89, 1, 450, 100, 45000, '2022-10-11 21:52:37'),
(96, '2', 89, 2, 550, 2, 1100, '2022-10-11 21:53:49'),
(97, '2', 89, 4, 340, 5, 1700, '2022-10-12 11:03:55'),
(98, 'PC001', 1122, 1, 450, 6, 2700, '2022-10-12 11:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `login_record`
--

DROP TABLE IF EXISTS `login_record`;
CREATE TABLE IF NOT EXISTS `login_record` (
  `NotificationId` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `NotificationMessage` varchar(255) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `DeviceIp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NotificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_record`
--

INSERT INTO `login_record` (`NotificationId`, `user_id`, `NotificationMessage`, `last_login`, `DeviceIp`) VALUES
(1, 878454, 'Welcome to the system', '2022-10-06 09:21:26', NULL),
(2, 5161768, 'Welcome to the system', NULL, NULL),
(3, 89, 'Welcome to the system', '2022-10-12 16:36:18', NULL),
(4, 100, 'Welcome to the system', '2022-10-12 09:03:38', NULL),
(5, 895, 'Welcome to the system', '2022-10-07 11:43:42', NULL),
(6, 12345, 'Welcome to the system', '2022-10-07 11:43:55', NULL),
(7, 992, 'Welcome to the system', '2022-10-12 16:43:22', NULL),
(8, 78945, 'Welcome to the system', NULL, NULL),
(9, 5541, 'Welcome to the system', '2022-10-12 16:55:58', NULL),
(10, 7854, 'Welcome to the system', '2022-10-12 17:04:15', NULL),
(11, 569, 'Welcome to the system', '2022-10-12 17:16:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `roleid` int(10) NOT NULL,
  `roletype` varchar(100) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`roleid`, `roletype`) VALUES
(0, 'ADMIN'),
(1, 'MANAGER'),
(2, 'PUMPER'),
(3, 'SUPER-ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `pumper_station`
--

DROP TABLE IF EXISTS `pumper_station`;
CREATE TABLE IF NOT EXISTS `pumper_station` (
  `pumper_station_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `station_id` varchar(10) NOT NULL,
  PRIMARY KEY (`pumper_station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pumper_station`
--

INSERT INTO `pumper_station` (`pumper_station_id`, `user_id`, `station_id`) VALUES
(1, 89, '2'),
(3, 895, 'PC012'),
(4, 1111, 'GC007'),
(5, 1122, 'PC001'),
(6, 878454, 'PC012'),
(7, 8787, '2'),
(8, 5445, 'PC001'),
(9, 998, 'GC020'),
(10, 9985, 'PC001');

-- --------------------------------------------------------

--
-- Table structure for table `station_status`
--

DROP TABLE IF EXISTS `station_status`;
CREATE TABLE IF NOT EXISTS `station_status` (
  `status_id` int(10) NOT NULL AUTO_INCREMENT,
  `station_id` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`status_id`),
  KEY `station_id` (`station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station_status`
--

INSERT INTO `station_status` (`status_id`, `station_id`, `status`, `update_time`) VALUES
(1, 'PC001', 'active', '2022-10-03 00:34:26'),
(2, '2', 'Inactive', '2022-10-03 00:34:26'),
(6, 'GC007', 'active', '2022-10-05 08:23:23'),
(7, 'PC012', 'active', '2022-10-05 08:44:26'),
(8, 'GC020', 'active', '2022-10-07 08:05:30'),
(9, 'PC999', 'active', '2022-10-12 15:58:46'),
(10, 'PC564', 'active', '2022-10-12 16:48:11'),
(11, 'PC123', 'active', '2022-10-12 17:03:55'),
(12, 'PC087', 'active', '2022-10-12 17:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `roleid` int(10) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `pwd`, `roleid`, `reg_time`) VALUES
(1, 'admingavindu', 'admingavindu@gmail.com', 'admingavindu@gmail.com', 0, '2022-09-18 01:27:00'),
(2, 'managergavindu', 'managergavindu@gmail.com', 'managergavindu@gmail.com', 1, '2022-10-01 03:57:54'),
(4, 'superadmin', 'supergavindu@gmail.com', 'supergavindu@gmail.com', 3, '2022-09-29 22:21:41'),
(8, NULL, 'adminasyad@gmail.com', 'adminasyad@gmail.com', 0, '2022-10-01 04:16:44'),
(25, 'manager25', 'manager1@gmail.com', 'manager1@gmail.com', 1, '2022-10-03 00:22:35'),
(89, NULL, '89@gmail.com', '89@gmail.com', 2, '2022-10-04 07:17:28'),
(100, 'fdfhdhgdh', 'virtualgavindu2000eeee@gmail.com', '100@gmail.com', 1, '2022-10-04 07:21:04'),
(524, 'pumper524', 'pumper524@gmail.com', 'pumper524@gmail.com', 2, '2022-10-04 09:15:33'),
(569, NULL, '569@gmail.com', '569@gmail.com', 1, '2022-10-12 17:14:03'),
(895, NULL, '895@gmail.com', '895@gmail.com', 1, '2022-10-04 07:59:28'),
(992, 'Need to update', 'managertest@gmail.com', 'managertest@gmail.com', 1, '2022-10-12 15:55:07'),
(998, 'GC020pumper', 'GC020pumper@gmail.com', 'GC020pumper', 2, '2022-10-07 12:37:38'),
(1111, 'pumper111', 'pumper111@gmail.com', 'pumper111@gmail.com', 2, '2022-10-04 17:17:06'),
(1122, 'aaaaaaa', 'aaaa@gmail.com', 'aaaa@gmail.com', 2, '2022-10-04 17:20:02'),
(5445, 'sandula5445', 'sansula@gmail.com', 'sansula@gmail.com', 2, '2022-10-06 03:48:41'),
(5541, '5541', 'managertest@gmail.com', 'managergavindu1@gmail.com', 1, '2022-10-12 16:46:03'),
(7854, NULL, '7854@gmail.com', '7854@gmail.com', 1, '2022-10-12 17:01:37'),
(8787, 'sansali', 'sansali@gmail.com', 'sansali@gmail.com', 2, '2022-10-06 02:50:24'),
(9985, 'PUMPERTEST', 'PUMPERTEST@GMAIL.COM', 'PUMPERTEST@GMAIL.COM', 2, '2022-10-12 15:50:36'),
(12345, 'icbt', 'icbt@gmail.com', '12345@gmail.com', 1, '2022-10-07 08:04:49'),
(78945, 'Need to update', 'admintest@gmail.com', 'admintest@gmail.com', 0, '2022-10-12 16:04:06'),
(878454, NULL, 'pupmper1@gmail.com', 'pupmper1@gmail.com', 2, '2022-10-03 01:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `phone` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`phone`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`phone`, `user_id`, `fname`, `lname`, `zip`, `longitude`, `latitude`) VALUES
('+94767862124', 2, 'virtual', 'Gavindu', 'GQ	11061', 'mnggavindu', 'gavindu'),
('04578652', 524, 'pump', NULL, NULL, NULL, NULL),
('0715486521', 992, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST'),
('0715983125', 1, 'wijerathna', 'sankalpa', 'gavindu', 'gavindu', 'gavindu'),
('076548715', 9985, 'pumperTEST', NULL, NULL, NULL, NULL),
('3255456363', 12345, 'icbt', 'icbt', 'icbt', NULL, NULL),
('517477578471/7', 1122, 'aaaaaa', NULL, NULL, NULL, NULL),
('53456767688', 998, 'GC020pumper', NULL, NULL, NULL, NULL),
('5878178187', 1111, 'pumper111', NULL, NULL, NULL, NULL),
('81878787', 5541, 'managertest', 'managertest', '54545', NULL, NULL),
('826988', 895, 'kaduwela', 'kaduwela', 'kaduwela', NULL, NULL),
('8787818178787', 8787, 'sansa', NULL, NULL, NULL, NULL),
('8787878787', 5445, 'sandula', NULL, NULL, NULL, NULL),
('mng100@gmail.com', 100, 'fname', 'lname', 'mng100@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `Userstatus_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Userstatus_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`Userstatus_id`, `user_id`, `status`, `update_time`) VALUES
(1, 1, 'Active', '2022-10-04 07:13:50'),
(2, 2, 'Active', '2022-10-04 07:13:50'),
(5, 89, 'Active', '2022-10-04 07:17:28'),
(6, 100, 'Active', '2022-10-04 07:21:04'),
(8, 4, 'active', '2022-10-04 07:26:44'),
(9, 8, 'active', '2022-10-04 07:26:44'),
(10, 25, 'active', '2022-10-04 07:26:44'),
(11, 878454, 'active', '2022-10-04 07:26:44'),
(12, 895, 'Active', '2022-10-04 07:59:28'),
(13, 524, 'Active', '2022-10-04 09:15:33'),
(14, 1111, 'Active', '2022-10-04 17:17:06'),
(15, 1122, 'Active', '2022-10-04 17:20:02'),
(17, 8787, 'Active', '2022-10-06 02:50:24'),
(18, 5445, 'Active', '2022-10-06 03:48:41'),
(19, 12345, 'Active', '2022-10-07 08:04:49'),
(20, 998, 'Active', '2022-10-07 12:37:38'),
(21, 9985, 'Active', '2022-10-12 15:50:36'),
(22, 992, 'Active', '2022-10-12 15:55:07'),
(23, 78945, 'Active', '2022-10-12 16:04:06'),
(24, 5541, 'Active', '2022-10-12 16:46:03'),
(25, 7854, 'Active', '2022-10-12 17:01:37'),
(26, 569, 'Active', '2022-10-12 17:14:03');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fuel_order`
--
ALTER TABLE `fuel_order`
  ADD CONSTRAINT `fuel_order_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `fuel_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fuel_order_ibfk_2` FOREIGN KEY (`fuel_id`) REFERENCES `fuel_type` (`fuel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fuel_price`
--
ALTER TABLE `fuel_price`
  ADD CONSTRAINT `fuel_price_ibfk_1` FOREIGN KEY (`fuel_id`) REFERENCES `fuel_type` (`fuel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fuel_station`
--
ALTER TABLE `fuel_station`
  ADD CONSTRAINT `fuel_station_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fuel_stock`
--
ALTER TABLE `fuel_stock`
  ADD CONSTRAINT `fuel_stock_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `fuel_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fuel_stock_ibfk_2` FOREIGN KEY (`fuel_id`) REFERENCES `fuel_type` (`fuel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `fuel_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`fuel_id`) REFERENCES `fuel_type` (`fuel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `station_status`
--
ALTER TABLE `station_status`
  ADD CONSTRAINT `station_status_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `fuel_station` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `permission` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_status`
--
ALTER TABLE `user_status`
  ADD CONSTRAINT `user_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
