-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 02:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ins_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `zipcode` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `phone` int(50) NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `surname`, `street`, `city`, `zipcode`, `email`, `phone`, `password_hash`) VALUES
(1, 'Anna', 'Testovací', 'Ulice 123', 'Město', 12345, 'bet@bet.cz', 123456789, '$2y$10$7qV070pK9FV2RHEKLJLxL.5BCz8yTQNEQbl8mtMKEPTuCPHPeAqKS'),
(2, 'Petr', 'Marek', 'Zelená 12', 'Praha', 10010, 'praha@nekde.cz', 456456789, '$2y$10$/x/52mXv0jECJYXA/RAIPeXOmSgeU5up2QtapklgT6A7hnJgDQKXS'),
(3, 'Adéla', 'Gouldová', 'Ulice nad ulicí 78', 'Olomouc', 77900, 'adela@adela.cz', 734915222, '$2y$10$5ocY2bKS5Yce3oVYJdRqbONPMjVPIV2Ah49nvgZnqLvvv15LA9JEO'),
(4, 'Petra', 'Novotná', 'Jemná 35', 'Brno', 75002, 'petra@petra.cz', 789456123, '$2y$10$xUSV1OuqZzq30kFhCNa5eeKupi64wYKvM1zf3cPFtAp1D/lf28vZW'),
(5, 'Pavel', 'Novák', 'Nad potokem 147', 'Brno', 61600, 'pavel@mujmail.cz', 147258369, '$2y$10$k.iy4sPJNVWiHjYFCeItO.RKBGNf4jaF4cZibeScxeTkQQw0kn8cK'),
(6, 'Zora', 'Hodná', '9.května 73', 'Praha', 10200, 'zora@mailuju.cz', 987654321, '$2y$10$FcYHqp6/L9tASHW7Bi33eObFp4146u1fvWnjvZWxAIyZl8uj4WXoC');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `event_num` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `status` enum('otevřená','uzavřená','zpracovává se','') COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `client_id`, `ins_id`, `event_num`, `event_date`, `status`) VALUES
(1, 1, 1, 2105456, '2021-05-18', 'uzavřená'),
(2, 4, 3, 2002741, '2020-02-11', 'uzavřená'),
(3, 3, 4, 2008174, '2020-08-27', 'uzavřená'),
(4, 6, 6, 2007639, '2020-07-19', 'uzavřená'),
(5, 5, 9, 2207645, '2022-07-03', 'otevřená'),
(6, 1, 2, 2206746, '2021-06-29', 'zpracovává se');

-- --------------------------------------------------------

--
-- Stand-in structure for view `event_details`
-- (See below for the actual view)
--
CREATE TABLE `event_details` (
`event_num` int(11)
,`ins_cat` enum('pojištění vozidel','pojištění majetku a odpovědnosti','pojištění osob','cestovní pojištění')
,`ins_number` int(11)
,`event_date` date
,`status` enum('otevřená','uzavřená','zpracovává se','')
,`client_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `ins_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ins_number` int(11) NOT NULL,
  `ins_cat` enum('pojištění vozidel','pojištění majetku a odpovědnosti','pojištění osob','cestovní pojištění') COLLATE utf8mb4_czech_ci NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `ins_status` enum('aktivní','neaktivní','čeká na schválení změn','') COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`ins_id`, `client_id`, `ins_number`, `ins_cat`, `startdate`, `enddate`, `ins_status`) VALUES
(1, 1, 22061020, 'pojištění osob', '2015-06-10', '2024-06-10', 'aktivní'),
(2, 1, 21021410, 'pojištění vozidel', '2021-02-03', '2023-02-03', 'čeká na schválení změn'),
(3, 4, 22051478, 'pojištění osob', '2022-05-09', '2024-05-09', 'aktivní'),
(4, 3, 22077896, 'pojištění majetku a odpovědnosti', '2021-07-04', '2023-07-04', 'čeká na schválení změn'),
(5, 1, 21079930, 'cestovní pojištění', '2021-06-30', '2021-07-10', 'neaktivní'),
(6, 6, 19078816, 'pojištění vozidel', '2019-07-08', '2022-07-08', 'čeká na schválení změn'),
(7, 5, 20087525, 'cestovní pojištění', '2020-08-06', '2020-08-22', 'neaktivní'),
(8, 2, 21047820, 'pojištění vozidel', '2021-04-04', '2025-04-04', 'aktivní'),
(9, 5, 21037315, 'pojištění majetku a odpovědnosti', '2021-03-25', '2026-03-25', 'aktivní');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `pay_ammount` int(11) NOT NULL,
  `pay_until` date NOT NULL,
  `pay_via` enum('převodem z účtu','na pobočce','poštovní poukázkou') COLLATE utf8mb4_czech_ci NOT NULL,
  `frequency` enum('měsíční','čtvrtletní','roční','jednorázově') COLLATE utf8mb4_czech_ci NOT NULL,
  `pay_to` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `pay_status` enum('zaplaceno','v prodlení','uzavřeno','čeká na zpracování') COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `client_id`, `ins_id`, `pay_ammount`, `pay_until`, `pay_via`, `frequency`, `pay_to`, `pay_status`) VALUES
(1, 1, 22061020, 500, '2022-08-31', 'převodem z účtu', 'měsíční', '777888999/111', 'zaplaceno'),
(2, 1, 21021410, 6000, '2023-01-02', 'převodem z účtu', 'roční', '555888999/111', 'čeká na zpracování'),
(3, 4, 22051478, 1000, '2023-01-02', 'převodem z účtu', 'měsíční', '777888999/111', 'zaplaceno'),
(4, 3, 22077896, 2500, '2022-10-30', 'převodem z účtu', 'roční', '666888999/111', 'zaplaceno'),
(5, 1, 21079930, 699, '2021-07-10', 'na pobočce', 'jednorázově', '444888999/111', 'uzavřeno'),
(6, 6, 19078816, 550, '2022-06-08', 'převodem z účtu', 'měsíční', '555888999/000', 'v prodlení'),
(7, 5, 20087525, 1250, '2020-08-22', 'na pobočce', 'jednorázově', '444888999/111', 'uzavřeno'),
(8, 2, 21047820, 2450, '2023-04-04', 'na pobočce', 'roční', '555888999/111', 'zaplaceno'),
(9, 5, 20087525, 1900, '2023-03-25', 'poštovní poukázkou', 'roční', '666888999/111', 'zaplaceno');

-- --------------------------------------------------------

--
-- Structure for view `event_details`
--
DROP TABLE IF EXISTS `event_details`;

CREATE VIEW `event_details`  AS SELECT `events`.`event_num` AS `event_num`, `insurances`.`ins_cat` AS `ins_cat`, `insurances`.`ins_number` AS `ins_number`, `events`.`event_date` AS `event_date`, `events`.`status` AS `status`, `insurances`.`client_id` AS `client_id` FROM (`events` join `insurances` on(`events`.`ins_id` = `insurances`.`ins_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_client` (`client_id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`ins_id`),
  ADD KEY `client_insurance` (`client_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `ins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `event_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `client_insurance` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
