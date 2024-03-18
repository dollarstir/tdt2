-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2024 at 02:22 PM
-- Server version: 8.0.36-0ubuntu0.23.10.1
-- PHP Version: 8.2.10-2ubuntu1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon_prices`
--

CREATE TABLE `addon_prices` (
  `id` int NOT NULL,
  `vehicle_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wash_package` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(30,2) NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addon_prices`
--

INSERT INTO `addon_prices` (`id`, `vehicle_type`, `wash_package`, `price`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 'Regular Size Car', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(2, 'Regular Size Car', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(3, 'Medium Size Car', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(4, 'Medium Size Car', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(5, 'Compact SUV', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(6, 'Compact SUV', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(7, 'Minivan', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(8, 'Minivan', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(9, 'Pickup Truck', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(10, 'Pickup Truck', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(11, 'Luxury Car', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(12, 'Luxury Car', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(13, 'Luxury Midsize SUV', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(14, 'Luxury Midsize SUV', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(15, 'Cargo Truck', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(16, 'Cargo Truck', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(17, 'Sports Car', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(18, 'Sports Car', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(19, 'Specialty Vehicle', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(20, 'Specialty Vehicle', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(21, 'Bus', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(22, 'Bus', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(23, 'Truck', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(24, 'Truck', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38'),
(25, 'Van', 'General Detail', 10.50, 1, 0, '2023-11-22 09:39:38'),
(26, 'Van', 'Deluxe Wash', 10.50, 1, 0, '2023-11-22 09:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `address_line_1` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address_line_2` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `residence` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `zip_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `set_default` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`id`, `client_id`, `address_line_1`, `address_line_2`, `residence`, `state`, `city`, `zip_code`, `set_default`, `timestamp`) VALUES
(1, 1, 'Achimota', '', 'Achimota', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 04:31:55'),
(2, 1, 'Achimota', '', 'Achimota', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 04:40:12'),
(3, 1, 'dome', '', 'dome', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:19:00'),
(4, 1, 'dome', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:31:10'),
(5, 1, 'http://www.dollardesigns.com', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:47:00'),
(6, 1, 'http://www.dollardesigns.com', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:48:35'),
(7, 1, 'http://www.dollardesigns.com', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:50:10'),
(8, 1, 'http://www.dollardesigns.com', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:51:42'),
(9, 1, 'http://www.dollardesigns.com', '', '', 'Greater Accra', 'Accra', '00233', 1, '2024-03-14 07:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `id` int NOT NULL,
  `brand_name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`id`, `brand_name`) VALUES
(1, 'Toyota'),
(2, 'Honda');

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

CREATE TABLE `car_models` (
  `id` int NOT NULL,
  `brand_name` int DEFAULT NULL,
  `model` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vehicle_type` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_models`
--

INSERT INTO `car_models` (`id`, `brand_name`, `model`, `vehicle_type`) VALUES
(1, 1, 'Toyota Corolla', 'Regular Size Car'),
(2, 1, 'Toyota RAV4', 'Compact SUV'),
(3, 2, 'Honda Civic', 'Regular Size Car'),
(4, 2, 'Honda CR-V', 'Compact SUV');

-- --------------------------------------------------------

--
-- Table structure for table `cleaning_prices`
--

CREATE TABLE `cleaning_prices` (
  `id` int NOT NULL,
  `vehicle_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wash_package` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(30,2) NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cleaning_prices`
--

INSERT INTO `cleaning_prices` (`id`, `vehicle_type`, `wash_package`, `price`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 'Regular Size Car', 'Basic Hand Wash', 14.97, 1, 0, '2023-11-22 09:39:38'),
(2, 'Regular Size Car', 'Deluxe Wash', 29.97, 1, 0, '2023-11-22 09:39:38'),
(3, 'Medium Size Car', 'Basic Hand Wash', 17.97, 1, 0, '2023-11-22 09:39:38'),
(4, 'Medium Size Car', 'Deluxe Wash', 37.47, 1, 0, '2023-11-22 09:39:38'),
(5, 'Compact SUV', 'Basic Hand Wash', 22.47, 1, 0, '2023-11-22 09:39:38'),
(6, 'Compact SUV', 'Deluxe Wash', 44.97, 1, 0, '2023-11-22 09:39:38'),
(7, 'Minivan', 'Basic Hand Wash', 26.97, 1, 0, '2023-11-22 09:39:38'),
(8, 'Minivan', 'Deluxe Wash', 52.47, 1, 0, '2023-11-22 09:39:38'),
(9, 'Pickup Truck', 'Basic Hand Wash', 29.97, 1, 0, '2023-11-22 09:39:38'),
(10, 'Pickup Truck', 'Deluxe Wash', 59.97, 1, 0, '2023-11-22 09:39:38'),
(11, 'Luxury Car', 'Basic Hand Wash', 37.47, 1, 0, '2023-11-22 09:39:38'),
(12, 'Luxury Car', 'Deluxe Wash', 74.97, 1, 0, '2023-11-22 09:39:38'),
(13, 'Luxury Midsize SUV', 'Basic Hand Wash', 44.97, 1, 0, '2023-11-22 09:39:38'),
(14, 'Luxury Midsize SUV', 'Deluxe Wash', 89.97, 1, 0, '2023-11-22 09:39:38'),
(15, 'Cargo Truck', 'Basic Hand Wash', 59.97, 1, 0, '2023-11-22 09:39:38'),
(16, 'Cargo Truck', 'Deluxe Wash', 119.97, 1, 0, '2023-11-22 09:39:38'),
(17, 'Sports Car', 'Basic Hand Wash', 41.97, 1, 0, '2023-11-22 09:39:38'),
(18, 'Sports Car', 'Deluxe Wash', 82.47, 1, 0, '2023-11-22 09:39:38'),
(19, 'Specialty Vehicle', 'Basic Hand Wash', 52.47, 1, 0, '2023-11-22 09:39:38'),
(20, 'Specialty Vehicle', 'Deluxe Wash', 104.97, 1, 0, '2023-11-22 09:39:38'),
(21, 'Bus', 'Basic Hand Wash', 74.97, 1, 0, '2023-11-22 09:39:38'),
(22, 'Bus', 'Deluxe Wash', 149.97, 1, 0, '2023-11-22 09:39:38'),
(23, 'Truck', 'Basic Hand Wash', 67.47, 1, 0, '2023-11-22 09:39:38'),
(24, 'Truck', 'Deluxe Wash', 134.97, 1, 0, '2023-11-22 09:39:38'),
(25, 'Van', 'Basic Hand Wash', 44.97, 1, 0, '2023-11-22 09:39:38'),
(26, 'Van', 'Deluxe Wash', 89.97, 1, 0, '2023-11-22 09:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `client_cards`
--

CREATE TABLE `client_cards` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `card_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `card_holder_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `card_number` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `exp_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cvv` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_cards`
--

INSERT INTO `client_cards` (`id`, `client_id`, `card_type`, `card_holder_name`, `card_number`, `exp_date`, `cvv`, `timestamp`) VALUES
(8, 1, 'visa', 'Dollar', '4120283456163772', '231', '123', '2024-03-14 07:50:10'),
(9, 1, 'visa', 'Dollar', '4120283456163772', '1231', '12321', '2024-03-14 07:51:42'),
(10, 1, 'visa', 'Dollar', '4337821257119458', '343', '234', '2024-03-14 07:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `client_cars`
--

CREATE TABLE `client_cars` (
  `id` int NOT NULL,
  `client_id` int NOT NULL COMMENT 'Should be Foreign ket to client table',
  `brand_name` int NOT NULL COMMENT 'this field is foreign key\r\nlinkd to the car_brand table',
  `model` int NOT NULL COMMENT 'Foreign key to  car model table',
  `vehicle_type` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `year` year NOT NULL,
  `color` int NOT NULL COMMENT 'foreign key to color table',
  `license_plate` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `driver_side_front` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `passenger_side_front` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `driver_side_rear` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `passenger_side_rear` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `damage_detail` text COLLATE utf8mb4_general_ci NOT NULL,
  `damage_image1` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `damage_image2` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `damage_image3` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `damage_image4` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `is_for_guest` int NOT NULL DEFAULT '0',
  `guest_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_cars`
--

INSERT INTO `client_cars` (`id`, `client_id`, `brand_name`, `model`, `vehicle_type`, `year`, `color`, `license_plate`, `image`, `driver_side_front`, `passenger_side_front`, `driver_side_rear`, `passenger_side_rear`, `damage_detail`, `damage_image1`, `damage_image2`, `damage_image3`, `damage_image4`, `is_for_guest`, `guest_name`, `timestamp`) VALUES
(21, 1, 1, 2, 'Compact SUV', '2015', 2, 'ASDSJNsdsd', 'assets/images/client_cars/1/21/carselect.png', 'assets/images/client_cars/1/21/sides/carselect.png', 'assets/images/client_cars/1/21/sides/carselect.png', 'assets/images/client_cars/1/21/sides/carselect.png', 'assets/images/client_cars/1/21/sides/carselect.png', '', '', '', '', '', 0, '', '2024-03-15 14:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `Name` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `Hex` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `Name`, `Hex`) VALUES
(1, 'Red', 'FF0000'),
(2, 'Green', '008000'),
(3, 'Blue', '0000FF');

-- --------------------------------------------------------

--
-- Table structure for table `id_verification`
--

CREATE TABLE `id_verification` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `state_id` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_verification`
--

INSERT INTO `id_verification` (`id`, `client_id`, `state_id`, `profile_picture`, `status`, `last_updated_by`, `timestamp`) VALUES
(9, 1, 'assets/images/idcards/1/id.png', 'assets/images/profilepictures/1/id.png', 'pending', 0, '2024-03-15 15:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `first_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_hired` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int NOT NULL DEFAULT '0',
  `password_recover` int NOT NULL DEFAULT '0',
  `reset_password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `account_type` int NOT NULL DEFAULT '0',
  `access_level` int NOT NULL DEFAULT '0',
  `allow_access_to` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linkedin` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_with` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `lastactivity` double NOT NULL DEFAULT '0',
  `gps_location` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gps_coordinates` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `location`, `username`, `password`, `date_hired`, `active`, `password_recover`, `reset_password`, `email_code`, `account_type`, `access_level`, `allow_access_to`, `profile_image`, `about`, `linkedin`, `facebook`, `twitter`, `created_with`, `created_by`, `last_updated_by`, `lastactivity`, `gps_location`, `gps_coordinates`, `timestamp`) VALUES
(1, 'gffg', 'gffh', 'aa@gmail.com', '5646455656', 'gjgh', 'fghfh', 'a01610228fe998f515a72dd730294d87', '2024-03-15 01:25:50', 0, 0, 'dfgf', 'dfg', 0, 0, 'fgd', 'dfgdf', 'dfg', 'ddg', 'dfgf', 'gdf', 'dfg', 0, 0, 0, 'dgffdfg', 'dgdf', '2024-03-14 17:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `wash_packages`
--

CREATE TABLE `wash_packages` (
  `id` int NOT NULL,
  `package` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_in_minutes` int NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wash_packages`
--

INSERT INTO `wash_packages` (`id`, `package`, `time_in_minutes`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 'Basic Hand Wash', 25, 0, 0, '2024-03-14 08:03:01'),
(2, 'Deluxe Wash', 35, 0, 0, '2024-03-14 08:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `wash_package_addons`
--

CREATE TABLE `wash_package_addons` (
  `id` int NOT NULL,
  `package` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_in_minutes` int NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wash_package_addons`
--

INSERT INTO `wash_package_addons` (`id`, `package`, `time_in_minutes`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 'General Detail', 20, 0, 0, '2024-03-15 16:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `wash_package_addon_detail`
--

CREATE TABLE `wash_package_addon_detail` (
  `id` int NOT NULL,
  `addon_id` int NOT NULL,
  `package_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wash_package_addon_detail`
--

INSERT INTO `wash_package_addon_detail` (`id`, `addon_id`, `package_name`, `detail`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 1, 'General Detail', 'Vacuum', 0, 0, '2024-03-15 17:30:25'),
(2, 1, 'General Detail', 'Wipe', 0, 0, '2024-03-15 17:30:25'),
(3, 1, 'General Detail', 'Shine', 0, 0, '2024-03-15 17:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `wash_package_detail`
--

CREATE TABLE `wash_package_detail` (
  `id` int NOT NULL,
  `package_id` int NOT NULL,
  `package_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int DEFAULT '0',
  `last_updated_by` int NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wash_package_detail`
--

INSERT INTO `wash_package_detail` (`id`, `package_id`, `package_name`, `detail`, `created_by`, `last_updated_by`, `timestamp`) VALUES
(1, 1, 'Basic Hand Wash', 'Exterior Hand Wash', 0, 0, '2024-03-15 15:31:00'),
(2, 1, 'Basic Hand Wash', 'Towel Hand Dry', 0, 0, '2024-03-15 15:31:00'),
(3, 1, 'Basic Hand Wash', 'Wheel Shine', 0, 0, '2024-03-15 15:31:00'),
(4, 2, 'Deluxe Wash', 'Exterior Hand Wash', 0, 0, '2024-03-15 15:31:00'),
(5, 2, 'Deluxe Wash', 'Towel Hand Dry', 0, 0, '2024-03-15 15:31:00'),
(6, 2, 'Deluxe Wash', 'Wheel Shine', 0, 0, '2024-03-15 15:31:00'),
(7, 2, 'Deluxe Wash', 'Windows In & Out', 0, 0, '2024-03-15 15:31:00'),
(8, 2, 'Deluxe Wash', 'Interior Cleaning', 0, 0, '2024-03-15 15:31:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addon_prices`
--
ALTER TABLE `addon_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brand_name` (`brand_name`);

--
-- Indexes for table `cleaning_prices`
--
ALTER TABLE `cleaning_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_cards`
--
ALTER TABLE `client_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_cars`
--
ALTER TABLE `client_cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_name` (`brand_name`),
  ADD KEY `model` (`model`),
  ADD KEY `color` (`color`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_verification`
--
ALTER TABLE `id_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wash_packages`
--
ALTER TABLE `wash_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wash_package_addons`
--
ALTER TABLE `wash_package_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wash_package_addon_detail`
--
ALTER TABLE `wash_package_addon_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addon_id` (`addon_id`);

--
-- Indexes for table `wash_package_detail`
--
ALTER TABLE `wash_package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addon_prices`
--
ALTER TABLE `addon_prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cleaning_prices`
--
ALTER TABLE `cleaning_prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `client_cards`
--
ALTER TABLE `client_cards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client_cars`
--
ALTER TABLE `client_cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_verification`
--
ALTER TABLE `id_verification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wash_packages`
--
ALTER TABLE `wash_packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wash_package_addons`
--
ALTER TABLE `wash_package_addons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wash_package_addon_detail`
--
ALTER TABLE `wash_package_addon_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wash_package_detail`
--
ALTER TABLE `wash_package_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD CONSTRAINT `billing_address_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `car_models`
--
ALTER TABLE `car_models`
  ADD CONSTRAINT `fk_brand_name` FOREIGN KEY (`brand_name`) REFERENCES `car_brands` (`id`);

--
-- Constraints for table `client_cards`
--
ALTER TABLE `client_cards`
  ADD CONSTRAINT `client_cards_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `client_cars`
--
ALTER TABLE `client_cars`
  ADD CONSTRAINT `client_cars_ibfk_1` FOREIGN KEY (`brand_name`) REFERENCES `car_brands` (`id`),
  ADD CONSTRAINT `client_cars_ibfk_2` FOREIGN KEY (`model`) REFERENCES `car_models` (`id`),
  ADD CONSTRAINT `client_cars_ibfk_3` FOREIGN KEY (`color`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `client_cars_ibfk_4` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wash_package_addon_detail`
--
ALTER TABLE `wash_package_addon_detail`
  ADD CONSTRAINT `wash_package_addon_detail_ibfk_1` FOREIGN KEY (`addon_id`) REFERENCES `wash_package_addons` (`id`);

--
-- Constraints for table `wash_package_detail`
--
ALTER TABLE `wash_package_detail`
  ADD CONSTRAINT `wash_package_detail_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `wash_packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
