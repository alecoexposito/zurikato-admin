-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2019 at 10:59 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zurikato_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE `alarm` (
  `id` bigint(20) NOT NULL,
  `device` int(11) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `speed` float(10,2) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `code` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alarm_code`
--

CREATE TABLE `alarm_code` (
  `id` bigint(20) NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `readable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `alarm_code`
--

INSERT INTO `alarm_code` (`id`, `code`, `readable`, `createdAt`, `updatedAt`) VALUES
(1, '00011010', 'Boton de panico', '2018-04-30 00:00:00', '2018-04-30 00:00:00'),
(2, '01000010', '01000010', '2018-04-30 21:04:24', '2018-04-30 21:04:24'),
(3, '00000100', '00000100', '2018-04-30 21:06:20', '2018-04-30 21:06:20'),
(4, '00000000', '00000000', '2018-04-30 22:38:00', '2018-04-30 22:38:00'),
(5, '00110010', '00110010', '2018-04-30 22:53:03', '2018-04-30 22:53:03'),
(6, '00001010', '00001010', '2018-05-01 14:03:02', '2018-05-01 14:03:02'),
(7, '00101110', '00101110', '2018-05-02 15:28:17', '2018-05-02 15:28:17'),
(8, '00000001', '00000001', '2018-05-02 19:21:35', '2018-05-02 19:21:35'),
(9, '00111010', '00111010', '2018-05-04 01:17:01', '2018-05-04 01:17:01'),
(10, '00101101', '00101101', '2018-05-04 05:32:48', '2018-05-04 05:32:48'),
(11, '00101100', '00101100', '2018-05-05 13:58:42', '2018-05-05 13:58:42'),
(12, '00010010', '00010010', '2018-05-05 15:07:28', '2018-05-05 15:07:28'),
(13, '00000010', '00000010', '2018-05-09 15:24:11', '2018-05-09 15:24:11'),
(14, '00001111', '00001111', '2018-05-11 23:33:56', '2018-05-11 23:33:56'),
(15, '00010100', '00010100', '2018-05-18 17:12:51', '2018-05-18 17:12:51'),
(16, '00100110', '00100110', '2018-05-18 17:20:40', '2018-05-18 17:20:40'),
(17, '01010000', '01010000', '2018-05-18 17:25:09', '2018-05-18 17:25:09'),
(18, '100', 'Botón de pánico', '2018-05-18 17:48:28', '2018-05-18 17:48:28'),
(19, '010', '010', '2018-05-18 17:49:47', '2018-05-18 17:49:47'),
(20, '000', 'Exceso de velocidad', '2018-05-18 18:14:29', '2018-05-18 18:14:29'),
(21, '011', 'Batería baja', '2018-05-21 21:48:34', '2018-05-21 21:48:34'),
(22, '001', '001', '2018-05-22 02:18:36', '2018-05-22 02:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE `camera` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(240) DEFAULT NULL,
  `ip` varchar(12) DEFAULT NULL,
  `port` varchar(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `serial` varchar(240) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `url_camera` varchar(300) NOT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `control_tag`
--

CREATE TABLE `control_tag` (
  `id` bigint(20) NOT NULL,
  `rfid` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `internal_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `description_cost`
--

CREATE TABLE `description_cost` (
  `id` bigint(20) NOT NULL,
  `maintenance_id` bigint(20) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `idDevice` int(11) NOT NULL,
  `auth_device` varchar(64) NOT NULL,
  `auth_password` varchar(64) DEFAULT NULL,
  `idDeviceModel` int(11) DEFAULT NULL,
  `label` varchar(64) DEFAULT NULL,
  `sim` varchar(32) DEFAULT NULL,
  `autoSync` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `license_plate` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `remark` longtext,
  `activation_date` datetime DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `icon_map` varchar(255) DEFAULT NULL,
  `icon_updated_at` datetime DEFAULT NULL,
  `government_data_id` int(11) DEFAULT NULL,
  `route_name` varchar(30) DEFAULT NULL,
  `economic_number` varchar(300) DEFAULT NULL,
  `vehicle_plate` varchar(300) DEFAULT NULL,
  `panic_button` tinyint(1) DEFAULT NULL,
  `trashed` tinyint(1) DEFAULT '0',
  `mdvr_number` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `device_group`
--

CREATE TABLE `device_group` (
  `group_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_models`
--

CREATE TABLE `device_models` (
  `idDeviceModel` int(11) NOT NULL,
  `label` varchar(64) NOT NULL,
  `peripheral_gps` tinyint(1) NOT NULL,
  `peripheral_ticketsseller` tinyint(1) NOT NULL,
  `peripheral_cam1` tinyint(1) NOT NULL,
  `peripheral_cam2` tinyint(1) NOT NULL,
  `peripheral_cam3` tinyint(1) NOT NULL,
  `peripheral_cam4` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_models`
--

INSERT INTO `device_models` (`idDeviceModel`, `label`, `peripheral_gps`, `peripheral_ticketsseller`, `peripheral_cam1`, `peripheral_cam2`, `peripheral_cam3`, `peripheral_cam4`, `createdAt`, `updatedAt`) VALUES
(1, 'BB', 1, 1, 1, 1, 0, 0, '2018-01-15 13:25:36', '2018-01-15 13:25:36'),
(2, 'GT06', 1, 0, 0, 0, 0, 0, '2018-01-15 13:25:36', '2018-01-15 13:25:36'),
(3, 'MDVR', 1, 0, 1, 0, 0, 0, '2018-10-03 00:00:00', '2018-10-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `device_shares`
--

CREATE TABLE `device_shares` (
  `device_id` int(11) NOT NULL,
  `share_id` int(11) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dgroup`
--

CREATE TABLE `dgroup` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `label` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `civil_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiration_date` datetime DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_vehicle_log`
--

CREATE TABLE `employee_vehicle_log` (
  `id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `government_data`
--

CREATE TABLE `government_data` (
  `id` int(11) NOT NULL,
  `government_data_id` int(11) DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreRuta` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `numero_economico` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placas` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imei` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `altitud` double DEFAULT NULL,
  `velocidad` double DEFAULT NULL,
  `direccion` double DEFAULT NULL,
  `boton_panico` tinyint(1) NOT NULL,
  `url_camara` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acumulado_subidas` int(11) DEFAULT NULL,
  `acumulado_bajadas` int(11) DEFAULT NULL,
  `pasajeros_subieron_p_delantera` int(11) DEFAULT NULL,
  `pasajeros_subieron_p_trasera` int(11) DEFAULT NULL,
  `pasajeros_bajaron_p_delantera` int(11) DEFAULT NULL,
  `bloqueos_p_delantera` int(11) DEFAULT NULL,
  `bloqueos_p_trasera` int(11) DEFAULT NULL,
  `pasajeros_abordo` int(11) DEFAULT NULL,
  `pasajeros_bajaron_p_trasera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `maintenance_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scheduled_for` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peripheral_gps_data`
--

CREATE TABLE `peripheral_gps_data` (
  `idPeripheralGps` int(11) NOT NULL,
  `idDevice` int(11) DEFAULT NULL,
  `lat` varchar(64) NOT NULL,
  `lng` varchar(64) NOT NULL,
  `speed` varchar(64) NOT NULL,
  `vDate` varchar(64) DEFAULT NULL,
  `uuid` varchar(64) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `orientation_plain` varchar(100) DEFAULT NULL,
  `gps_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `peripheral_gps_data`
--
DELIMITER $$
CREATE TRIGGER `before_gps_insert` BEFORE INSERT ON `peripheral_gps_data` FOR EACH ROW BEGIN
	delete from peripheral_gps_data_last where idDevice = NEW.idDevice;
    insert into peripheral_gps_data_last values(NEW.idPeripheralGps, NEW.idDevice, NEW.lat, NEW.lng, NEW.speed, NEW.vDate, NEW.uuid, NEW.createdAt, NEW.updatedAt, NEW.orientation_plain, NEW.gps_status);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peripheral_gps_data_last`
--

CREATE TABLE `peripheral_gps_data_last` (
  `idPeripheralGps` int(11) NOT NULL,
  `idDevice` int(11) DEFAULT NULL,
  `lat` varchar(64) NOT NULL,
  `lng` varchar(64) NOT NULL,
  `speed` varchar(64) NOT NULL,
  `vDate` varchar(64) DEFAULT NULL,
  `uuid` varchar(64) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `orientation_plain` varchar(100) DEFAULT '0',
  `gps_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peripheral_ticketsseller_data`
--

CREATE TABLE `peripheral_ticketsseller_data` (
  `idPeripheralData` int(11) NOT NULL,
  `idDevice` int(11) DEFAULT NULL,
  `totalTickets` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `lat` varchar(64) NOT NULL,
  `lng` varchar(64) NOT NULL,
  `vDate` varchar(64) NOT NULL,
  `uuid` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rawdata`
--

CREATE TABLE `rawdata` (
  `idraw` int(11) NOT NULL,
  `data` text NOT NULL,
  `data_parsed` text NOT NULL,
  `vDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semov_data`
--

CREATE TABLE `semov_data` (
  `Provider` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `IDCompany` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `CompanyName` varchar(500) DEFAULT NULL,
  `RouteName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Time` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VIN` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EconomicNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VehiculePlate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IMEI` varchar(64) NOT NULL,
  `Latitude` varchar(64) NOT NULL,
  `Longitude` varchar(64) NOT NULL,
  `Altitude` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Speed` varchar(64) NOT NULL,
  `Direction` varchar(100) NOT NULL DEFAULT '0',
  `PanicButton` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `UrlCamera` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semov_log`
--

CREATE TABLE `semov_log` (
  `id` int(11) NOT NULL,
  `data_json` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(11) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `url_hash` varchar(1000) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tire`
--

CREATE TABLE `tire` (
  `id` bigint(20) NOT NULL,
  `control_tag_id` bigint(20) DEFAULT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `dot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `internal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` double DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_price` double DEFAULT NULL,
  `measure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renovated_number` int(11) DEFAULT NULL,
  `position` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `back_renovated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tire_depth`
--

CREATE TABLE `tire_depth` (
  `id` bigint(20) NOT NULL,
  `tire_id` bigint(20) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `depth_a` double NOT NULL,
  `depth_b` double NOT NULL,
  `depth_c` double NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tire_observation`
--

CREATE TABLE `tire_observation` (
  `id` bigint(20) NOT NULL,
  `tire_id` bigint(20) DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `label` varchar(64) DEFAULT NULL,
  `pass` text,
  `salt` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `auth_token` text,
  `token` text,
  `telephone` varchar(20) DEFAULT NULL,
  `username` varchar(180) NOT NULL,
  `username_canonical` varchar(180) NOT NULL,
  `email_canonical` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(100) DEFAULT NULL,
  `last_name` varchar(60) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `parentUser` int(11) DEFAULT NULL,
  `automatic_imeis` varchar(4000) DEFAULT NULL,
  `fences` text,
  `phone_number` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `email`, `label`, `pass`, `salt`, `userType`, `parent`, `active`, `createdAt`, `updatedAt`, `auth_token`, `token`, `telephone`, `username`, `username_canonical`, `email_canonical`, `enabled`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `last_name`, `discr`, `company_name`, `parentUser`, `automatic_imeis`, `fences`, `phone_number`) VALUES
(1, 'admin', '', '$2a$10$u8wG2F5uPGC13F8XMgY/WeW/UMV8/06ag6tv.pvafQadzoY2vxsJ.', '$2a$10$u8wG2F5uPGC13F8XMgY/We', 1, 0, 1, '2018-01-10 09:28:37', '2019-08-10 13:21:56', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InRlc3RlckBnbWFpbC5jb20iLCJsYWJlbCI6InRlc3RlciIsInBhc3MiOiIkMmEkMTAkdTh3RzJGNXVQR0MxM0Y4WE1nWS9XZVcvVU1WOC8wNmFnNnR2LnB2YWZRYWR6b1kydnhzShi4iLCJwYXJlbnQiOiIxIiwidXNlclR5cGUiOiIyIiwiYWN0aXZlIjoiMSIsInRlbGVwaG9uZSI6IjIzMTMyMzIxMzIxMzEiLCJzYWx0IjoiJDJhJDEwJHU4d0cyRjV1UEdDMTNGOFhNZ1kvV2UiLCJpYXQiOjE1MTYxMTg5MjEsImV4cCI6MTUxNjcyMzcyMX0.zBGZCzAqddY9qVWdr27Ny0Kgv2YgYOAmdHixl-3mctY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6InRlc3RlckBnbWFpbC5jb20iLCJsYWJlbCI6InRlc3RlciIsInBhc3MiOiIkMmEkMTAkdTh3RzJGNXVQR0MxM0Y4WE1nWS9XZVcvVU1WOC8wNmFnNnR2LnB2YWZRYWR6b1kydnhzSi4iLCJwYXJlbnQiOiIxIiwidXNlchlR5cGUiOiIyIiwiYWN0aXZlIjoiMSIsInRlbGVwaG9uZSI6IjIzMTMyMzIxMzIxMzEiLCJzYWx0IjoiJDJhJDEwJHU4d0cyRjV1UEdDMTNGOFhNZ1kvV2UiLCJhdXRoX3Rva2VuIjoiZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmxiV0ZwYkNJNkluUmxjM1JsY2tCbmJXRnBiQzVqYjIwaUxDSnNZV0psYkNJNkluUmxjM1JsY2lJc0luQmhjM01pT2lJa01tRWtNVEFrZFRoM1J6SkdOWFZRUjBNeE0wWTRXRTFuV1M5WFpWY3ZWVTFXT0M4d05tRm5OblIyTG5CMllXWlJZV1I2YjFreWRuaHpTaTRpTENKd1lYSmxiblFpT2lJeElpd2lkWE5sY2xSNWNHVWlPaUl5SWl3aVlXTjBhWFpsSWpvaU1TSXNJblJsYkdWd2FHOXVaU0k2SWpJek1UTXlNekl4TXpJeE16RWlMQ0p6WVd4MElqb2lKREpoSkRFd0pIVTRkMGN5UmpWMVVFZERNVE5HT0ZoTloxa3ZWMlVpTENKcFlYUWlPakUxTVRZeE1UZzVNakVzSW1WNGNDSTZNVFV4TmpjeU16Y3lNWDAuekJHWkN6QXFkZFk5cVZXZHIyN055MEtndjJZZ1lPQW1kSGl4bC0zbWN0WSIsImlhdCI6MTUxNjExODkyMSwiZXhwIjoxNTE2NzIzNzIxfQ.oSyivSMwcyw-wBRgLjIChpS4g5lYsRTJhmUN_cQVTco', '', 'admin', 'admin', 'admin', 1, '$2a$10$u8wG2F5uPGC13F8XMgY/WeW/UMV8/06ag6tv.pvafQadzoY2vxsJ.', '2019-09-30 00:55:22', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '', NULL, 'admin', NULL, NULL, 'undefined', '', ''),
(15, 'CONTABILIDAD@ZURIKATO.COM.MX', NULL, '$2y$13$krk/3MSjEfuJ50vIh3D4bujkv5yg7B2feQhHgYNhpauaNQ999h2oG', NULL, NULL, 0, 0, '2018-11-20 17:33:37', '2019-04-16 04:14:43', '', '', '', 'zurikato', 'zurikato', 'contabilidad@zurikato.com.mx', 1, '$2y$13$krk/3MSjEfuJ50vIh3D4bujkv5yg7B2feQhHgYNhpauaNQ999h2oG', '2019-07-24 16:00:57', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'Alyd', 'Gutierrez', 'client', 'Technology Vision Zurikato S.A. DE C.V.', NULL, 'undefined', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[-99.245885502053,19.61286949218114],[-99.24480188961098,19.611373742268295],[-99.24113262767861,19.612354066417485],[-99.24263466472695,19.61395087027641],[-99.245885502053,19.61286949218114]]]},\"properties\":{\"id\":1555388077960,\"title\":\"Casa\",\"description\":\"Sin descripción\",\"devices\":\"[{\\\"alarmOnEntering\\\":false,\\\"imei\\\":\\\"BBP24\\\",\\\"label\\\":\\\"BB24\\\",\\\"alreadyAlarmed\\\":false}]\"}},{\"type\":\"Feature\",\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[-99.93818176051957,20.079620013227274],[-99.91071594020707,19.65340572102058],[-99.48774230739457,20.071880917273372],[-99.93818176051957,20.079620013227274]]]},\"properties\":{\"id\":1555388077961,\"title\":\"Fence1\",\"description\":\"Sin descripción\",\"devices\":\"[]\"}},{\"type\":\"Feature\",\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[-98.87241125651042,19.77388150195611],[-98.85043860026042,19.478962437637254],[-98.57440710611979,19.581210556073934],[-98.68839026041667,19.868192540575752],[-98.87241125651042,19.77388150195611]]]},\"properties\":{\"id\":1555388077962,\"title\":\"Fence2\",\"description\":\"Sin descripción\",\"devices\":\"[]\"}},{\"type\":\"Feature\",\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[-99.38670874186198,19.848818129285725],[-99.38670874186198,19.848818129285725]]]},\"properties\":{\"id\":1555388077963,\"title\":\"Sin nombre\",\"description\":\"Sin descripción\",\"devices\":\"[]\"}},{\"type\":\"Feature\",\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[-99.69366728385415,19.690035659989213],[-99.71014677604165,19.501147613617572],[-99.57831083854165,19.538684101179214],[-99.57419096549478,19.731406103565483],[-99.69366728385415,19.690035659989213]]]},\"properties\":{\"id\":1555388077964,\"title\":\"Sin nombre\",\"description\":\"Sin descripción\",\"devices\":\"[]\"}}]}', '5569148635'),
(16, 'irving.alyd32@gmail.com', NULL, '$2y$13$d49ofSn4H1cS6iG1iJf/uu2YmUht29h4XW90HTHyBJPN6Dsx1A3ga', NULL, NULL, 0, 0, '2018-11-20 17:36:07', '2018-11-20 17:36:07', '', '', '', 'irving', 'irving', 'irving.alyd32@gmail.com', 1, '$2y$13$d49ofSn4H1cS6iG1iJf/uu2YmUht29h4XW90HTHyBJPN6Dsx1A3ga', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'Irving alyd', 'gutierrez', 'client', 'Privada', NULL, NULL, NULL, '5575188458'),
(17, 'agustin.lazcano@gmail.com', NULL, '$2y$13$ylgnCvO8rXYoSS5y49SepewI8XOcGWhEzZKPzPwotazbQThl7YO/C', NULL, NULL, 0, 0, '2018-11-20 17:37:01', '2018-11-20 17:37:01', '', '', '', 'Agustin', 'agustin', 'agustin.lazcano@gmail.com', 1, '$2y$13$ylgnCvO8rXYoSS5y49SepewI8XOcGWhEzZKPzPwotazbQThl7YO/C', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'Agustin', 'lazcano', 'client', 'Privada', NULL, NULL, NULL, '5589562312'),
(18, 'bimbo@gmail.com', NULL, '$2y$13$nCRKsjUljlGLbjEcIFuxpeRBB5v.aRqE4dG0vyKI2xtT2cHFFQxHe', NULL, NULL, 0, 0, '2018-11-20 17:38:32', '2018-11-20 17:38:32', '', '', '', 'Bimbo', 'bimbo', 'bimbo@gmail.com', 1, '$2y$13$nCRKsjUljlGLbjEcIFuxpeRBB5v.aRqE4dG0vyKI2xtT2cHFFQxHe', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'gerardo', 'perez', 'client', 'Bimbo', NULL, NULL, NULL, '5596132547'),
(19, 'oxxo@gmail.com', NULL, '$2y$13$baPIJyUpGzcYpEV1v0ITbeldnQJZGB5RDwwMEoqZVR69.SBGSdCE.', NULL, NULL, 0, 0, '2018-11-20 17:40:56', '2018-11-20 17:40:56', '', '', '', 'oxxo', 'oxxo', 'oxxo@gmail.com', 1, '$2y$13$baPIJyUpGzcYpEV1v0ITbeldnQJZGB5RDwwMEoqZVR69.SBGSdCE.', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'luis', 'trejo', 'client', 'oxxo', NULL, NULL, NULL, '5536231647'),
(20, NULL, NULL, '$2y$13$Q0SjeHQ6mCKgkmSyowFcee7BhehMr3usr0uEbFjItA/0WCucLn5Dm', NULL, NULL, 0, 0, '2019-09-30 01:07:21', '2019-09-30 01:07:21', '', '', '', 'totalplay', 'totalplay', NULL, 1, '$2y$13$Q0SjeHQ6mCKgkmSyowFcee7BhehMr3usr0uEbFjItA/0WCucLn5Dm', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'Totalplay', NULL, 'client', 'Totalplay', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_auth_token`
--

CREATE TABLE `user_auth_token` (
  `idAuthToken` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `token` text NOT NULL,
  `vDate` datetime NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `idUserDevice` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idDevice` int(11) DEFAULT NULL,
  `label` varchar(64) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_devices_groups`
--

CREATE TABLE `user_devices_groups` (
  `idUserDeviceGroup` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idDevice` int(11) DEFAULT NULL,
  `label` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `idUserRole` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`idUserRole`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'Administrador', '2018-01-16 10:07:16', '2018-01-16 10:07:16'),
(2, 'Cliente', '2018-01-16 10:07:16', '2018-01-16 10:07:16'),
(3, 'Espejo', '2018-01-16 10:07:31', '2018-01-16 10:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` bigint(20) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `odometer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_check`
--

CREATE TABLE `vehicle_check` (
  `id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL,
  `arrived_tags` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alarm`
--
ALTER TABLE `alarm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_749F46DD92FB68E` (`device`);

--
-- Indexes for table `alarm_code`
--
ALTER TABLE `alarm_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3B1CEE0594A4C7D4` (`device_id`);

--
-- Indexes for table `control_tag`
--
ALTER TABLE `control_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8FD74CD019EB6921` (`client_id`);

--
-- Indexes for table `description_cost`
--
ALTER TABLE `description_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EE2E0BE8F6C202BC` (`maintenance_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`idDevice`),
  ADD UNIQUE KEY `UNIQ_11074E9A543879F` (`government_data_id`),
  ADD KEY `IDX_11074E9AA76ED395` (`user_id`),
  ADD KEY `idDeviceModel` (`idDeviceModel`);

--
-- Indexes for table `device_group`
--
ALTER TABLE `device_group`
  ADD PRIMARY KEY (`group_id`,`device_id`),
  ADD KEY `IDX_AB45A4A2FE54D947` (`group_id`),
  ADD KEY `IDX_AB45A4A294A4C7D4` (`device_id`);

--
-- Indexes for table `device_models`
--
ALTER TABLE `device_models`
  ADD PRIMARY KEY (`idDeviceModel`),
  ADD KEY `idDeviceModel` (`idDeviceModel`);

--
-- Indexes for table `device_shares`
--
ALTER TABLE `device_shares`
  ADD PRIMARY KEY (`device_id`,`share_id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `share_id` (`share_id`);

--
-- Indexes for table `dgroup`
--
ALTER TABLE `dgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_89455F37A76ED395` (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5D9F75A119EB6921` (`client_id`),
  ADD KEY `IDX_5D9F75A1545317D1` (`vehicle_id`);

--
-- Indexes for table `employee_vehicle_log`
--
ALTER TABLE `employee_vehicle_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_944D707E545317D1` (`vehicle_id`),
  ADD KEY `IDX_944D707E8C03F15C` (`employee_id`);

--
-- Indexes for table `government_data`
--
ALTER TABLE `government_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5FCCD157543879F` (`government_data_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2F84F8E9545317D1` (`vehicle_id`);

--
-- Indexes for table `peripheral_gps_data`
--
ALTER TABLE `peripheral_gps_data`
  ADD PRIMARY KEY (`idPeripheralGps`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Indexes for table `peripheral_gps_data_last`
--
ALTER TABLE `peripheral_gps_data_last`
  ADD PRIMARY KEY (`idPeripheralGps`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Indexes for table `peripheral_ticketsseller_data`
--
ALTER TABLE `peripheral_ticketsseller_data`
  ADD PRIMARY KEY (`idPeripheralData`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Indexes for table `rawdata`
--
ALTER TABLE `rawdata`
  ADD PRIMARY KEY (`idraw`);

--
-- Indexes for table `semov_log`
--
ALTER TABLE `semov_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tire`
--
ALTER TABLE `tire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A2CE96DBAFB3B7F1` (`control_tag_id`),
  ADD KEY `IDX_A2CE96DB545317D1` (`vehicle_id`),
  ADD KEY `IDX_A2CE96DB19EB6921` (`client_id`);

--
-- Indexes for table `tire_depth`
--
ALTER TABLE `tire_depth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1A4ADE92BC5ADD68` (`tire_id`);

--
-- Indexes for table `tire_observation`
--
ALTER TABLE `tire_observation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2B635793BC5ADD68` (`tire_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`),
  ADD KEY `userType` (`userType`),
  ADD KEY `IDX_1483A5E95B6903E8` (`parentUser`);

--
-- Indexes for table `user_auth_token`
--
ALTER TABLE `user_auth_token`
  ADD PRIMARY KEY (`idAuthToken`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`idUserDevice`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Indexes for table `user_devices_groups`
--
ALTER TABLE `user_devices_groups`
  ADD PRIMARY KEY (`idUserDeviceGroup`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`idUserRole`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1B80E48694A4C7D4` (`device_id`),
  ADD KEY `IDX_1B80E48619EB6921` (`client_id`);

--
-- Indexes for table `vehicle_check`
--
ALTER TABLE `vehicle_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E212CFF545317D1` (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alarm`
--
ALTER TABLE `alarm`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4694;
--
-- AUTO_INCREMENT for table `alarm_code`
--
ALTER TABLE `alarm_code`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `control_tag`
--
ALTER TABLE `control_tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `description_cost`
--
ALTER TABLE `description_cost`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `idDevice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;
--
-- AUTO_INCREMENT for table `device_models`
--
ALTER TABLE `device_models`
  MODIFY `idDeviceModel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dgroup`
--
ALTER TABLE `dgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_vehicle_log`
--
ALTER TABLE `employee_vehicle_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `government_data`
--
ALTER TABLE `government_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `peripheral_gps_data`
--
ALTER TABLE `peripheral_gps_data`
  MODIFY `idPeripheralGps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236375136;
--
-- AUTO_INCREMENT for table `peripheral_gps_data_last`
--
ALTER TABLE `peripheral_gps_data_last`
  MODIFY `idPeripheralGps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236375137;
--
-- AUTO_INCREMENT for table `peripheral_ticketsseller_data`
--
ALTER TABLE `peripheral_ticketsseller_data`
  MODIFY `idPeripheralData` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rawdata`
--
ALTER TABLE `rawdata`
  MODIFY `idraw` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `semov_log`
--
ALTER TABLE `semov_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tire`
--
ALTER TABLE `tire`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tire_depth`
--
ALTER TABLE `tire_depth`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tire_observation`
--
ALTER TABLE `tire_observation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_auth_token`
--
ALTER TABLE `user_auth_token`
  MODIFY `idAuthToken` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `idUserDevice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
--
-- AUTO_INCREMENT for table `user_devices_groups`
--
ALTER TABLE `user_devices_groups`
  MODIFY `idUserDeviceGroup` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `idUserRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;
--
-- AUTO_INCREMENT for table `vehicle_check`
--
ALTER TABLE `vehicle_check`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `FK_749F46DD92FB68E` FOREIGN KEY (`device`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `camera`
--
ALTER TABLE `camera`
  ADD CONSTRAINT `FK_3B1CEE0594A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `control_tag`
--
ALTER TABLE `control_tag`
  ADD CONSTRAINT `FK_8FD74CD019EB6921` FOREIGN KEY (`client_id`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `description_cost`
--
ALTER TABLE `description_cost`
  ADD CONSTRAINT `FK_EE2E0BE8F6C202BC` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`);

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `FK_11074E9A543879F` FOREIGN KEY (`government_data_id`) REFERENCES `government_data` (`id`),
  ADD CONSTRAINT `FK_11074E9A82150784` FOREIGN KEY (`idDeviceModel`) REFERENCES `device_models` (`idDeviceModel`),
  ADD CONSTRAINT `FK_11074E9AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `device_group`
--
ALTER TABLE `device_group`
  ADD CONSTRAINT `FK_AB45A4A294A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `devices` (`idDevice`),
  ADD CONSTRAINT `FK_AB45A4A2FE54D947` FOREIGN KEY (`group_id`) REFERENCES `dgroup` (`id`);

--
-- Constraints for table `device_shares`
--
ALTER TABLE `device_shares`
  ADD CONSTRAINT `device_shares_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `devices` (`idDevice`),
  ADD CONSTRAINT `device_shares_ibfk_2` FOREIGN KEY (`share_id`) REFERENCES `shares` (`id`);

--
-- Constraints for table `dgroup`
--
ALTER TABLE `dgroup`
  ADD CONSTRAINT `FK_89455F37A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_5D9F75A119EB6921` FOREIGN KEY (`client_id`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `FK_5D9F75A1545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employee_vehicle_log`
--
ALTER TABLE `employee_vehicle_log`
  ADD CONSTRAINT `FK_944D707E545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_944D707E8C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `government_data`
--
ALTER TABLE `government_data`
  ADD CONSTRAINT `FK_5FCCD157543879F` FOREIGN KEY (`government_data_id`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `FK_2F84F8E9545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peripheral_gps_data`
--
ALTER TABLE `peripheral_gps_data`
  ADD CONSTRAINT `FK_ED5E70B46A3E1E14` FOREIGN KEY (`idDevice`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `peripheral_ticketsseller_data`
--
ALTER TABLE `peripheral_ticketsseller_data`
  ADD CONSTRAINT `FK_B1B913926A3E1E14` FOREIGN KEY (`idDevice`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `tire`
--
ALTER TABLE `tire`
  ADD CONSTRAINT `FK_A2CE96DB19EB6921` FOREIGN KEY (`client_id`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `FK_A2CE96DB545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_A2CE96DBAFB3B7F1` FOREIGN KEY (`control_tag_id`) REFERENCES `control_tag` (`id`);

--
-- Constraints for table `tire_depth`
--
ALTER TABLE `tire_depth`
  ADD CONSTRAINT `FK_1A4ADE92BC5ADD68` FOREIGN KEY (`tire_id`) REFERENCES `tire` (`id`);

--
-- Constraints for table `tire_observation`
--
ALTER TABLE `tire_observation`
  ADD CONSTRAINT `FK_2B635793BC5ADD68` FOREIGN KEY (`tire_id`) REFERENCES `tire` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E95B6903E8` FOREIGN KEY (`parentUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `FK_1483A5E98A918066` FOREIGN KEY (`userType`) REFERENCES `user_roles` (`idUserRole`);

--
-- Constraints for table `user_auth_token`
--
ALTER TABLE `user_auth_token`
  ADD CONSTRAINT `FK_347236A2FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD CONSTRAINT `FK_490A50906A3E1E14` FOREIGN KEY (`idDevice`) REFERENCES `devices` (`idDevice`),
  ADD CONSTRAINT `FK_490A5090FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `user_devices_groups`
--
ALTER TABLE `user_devices_groups`
  ADD CONSTRAINT `FK_46B4AF2E6A3E1E14` FOREIGN KEY (`idDevice`) REFERENCES `devices` (`idDevice`),
  ADD CONSTRAINT `FK_46B4AF2EFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `FK_1B80E48619EB6921` FOREIGN KEY (`client_id`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `FK_1B80E48694A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `devices` (`idDevice`);

--
-- Constraints for table `vehicle_check`
--
ALTER TABLE `vehicle_check`
  ADD CONSTRAINT `FK_5E212CFF545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
