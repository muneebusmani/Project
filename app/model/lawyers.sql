-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2023 at 02:45 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `JusticiaLaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education`) VALUES
('llb'),
('llm'),
('Nowshera');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `experience` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`experience`) VALUES
('1'),
('2'),
('3'),
('4'),
('5-10'),
('10+'),
('000');

-- --------------------------------------------------------

--
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `ID` int NOT NULL,
  `Photo` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `number` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lawyers`
--

INSERT INTO `lawyers` (`ID`, `Photo`, `name`, `location`, `number`, `email`, `address`, `speciality`, `education`, `experience`, `password`) VALUES
(49, 'uploads/lawyers/64a7ebbc2a079.jpeg', 'MuneebUsmani', 'Karachi', 21312332, 'muneeb@gmail.com', 'Sector 15 A 1', 'affidavit', 'llm', '1', 'as;dlas'),
(50, 'uploads/lawyers/64a7fab809626.jpeg', 'Shoaib', 'Lahore', 456321, 'abc@adsa', 'aslkjdlaskj', 'affidavit', 'llm', '3', 'adasdsasd'),
(51, 'uploads/lawyers/64a9df067e5c8.png', 'Sheela', 'Islamabad', 123645, 'root@localhost', 'asdjlk;dfhjsk', 'affidavit', 'llm', '3', 'adasdadasd'),
(52, 'uploads/lawyers/64a9f4a50fa63.png', 'Mynameis', 'nowhere', 312645, 'root@lsajk', 'asdjksdfjlk', '6969', 'Nowshera', '10+', 'sadasd;lasdkk'),
(53, 'uploads/lawyers/64aa7d6993bf9.jpeg', 'Sheela', 'Lahore', 3120789, 'jlkdassdfjlk@asdjlk', 'j;adkslhjkdsa', 'affidavit', 'Nowshera', '4', 'hjkadsasdjkhhasdjk'),
(54, 'uploads/lawyers/64aa7f13023d3.jpeg', 'adshdfg', 'Islamabad', 546312, 'asd@asdjlk', 'adsljkaljdks', '6969', 'Nowshera', '4', 'asddsaasdasdasd'),
(56, 'uploads/lawyers/64aa88d742c90.jpeg', 'sheela lawyer', 'Islamabad', 0, 'root@adminasd', 'asdasd', 'affidavit', 'Nowshera', '10+', 'asdasdasd'),
(57, 'uploads/lawyers/64aa895931b9a.jpeg', 'asdasd', 'Pindi', 456123, 'root@admin', 'asdasd', 'affidavit', 'llm', '5-10', 'asdasdadmin');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location`) VALUES
('Karachi'),
('Lahore'),
('Islamabad'),
('Pindi'),
('Gujranwala'),
('salabad'),
('nowhere');

-- --------------------------------------------------------

--
-- Table structure for table `practice_area`
--

CREATE TABLE `practice_area` (
  `practice_area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `practice_area`
--

INSERT INTO `practice_area` (`practice_area`) VALUES
('criminal'),
('affidavit'),
('mahjong'),
('6969');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lawyers`
--
ALTER TABLE `lawyers`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
