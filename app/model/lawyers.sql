-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2023 at 10:03 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.7

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
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `ID` int NOT NULL,
  `Photo` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `lawyers` (`ID`, `Photo`, `name`, `number`, `email`, `address`, `speciality`, `education`, `experience`, `password`) VALUES
(42, 'uploads/lawyers/64a1c156dc6e6.jpeg', 'sadfghjk', 31243, 'dfghjkl@asdas', 'dfghjkl', 'dfghjk', 'cvbnm,', 'rty', 'uio123'),
(43, 'uploads/lawyers/64a1c18cb08b5.jpeg', 'Muneeb Usmani', 98201323, 'muneebusmani8355@gmail.com', 'sareena', 'criminal', 'LLM', 'NA', 'muneeb123'),
(44, 'uploads/lawyers/64a2793b28515.jpeg', 'SHoaib Khan', 3351124, 'root@aljkshdasdaslnkmclkn', '.,asmndlkhizxpi', ',.zmxci9-1', 'a.,snilawjip', ',.zmajafsi;ojpio', 'ak;ldpoas['),
(45, 'uploads/lawyers/64a27cedc680e.jpeg', 'Shaddy', 123, 'shaddykhan123@gmail.com', '123', '123', '123', '123', '123456');

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
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
