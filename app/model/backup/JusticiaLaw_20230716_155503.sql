-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: JusticiaLaw
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointment_location`
--

DROP TABLE IF EXISTS `appointment_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointment_location` (
  `appointment_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_location`
--

LOCK TABLES `appointment_location` WRITE;
/*!40000 ALTER TABLE `appointment_location` DISABLE KEYS */;
INSERT INTO `appointment_location` VALUES ('Home'),('Hospital'),('Police Station'),('Court');
/*!40000 ALTER TABLE `appointment_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lawyer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (17,'John Doe','john.doe@example.com','1234567890','LawyerOffice','Lawyer A','2023-07-05','10:00 AM'),(18,'Jane Smith','jane.smith@example.com','9876543210','customLocation','Lawyer B','2023-07-06','02:30 PM'),(19,'Michael Johnson','michael.johnson@example.com','5555555555','Home','Lawyer C','2023-07-07','09:15 AM'),(20,'Emily Brown','emily.brown@example.com','4444444444','customLocation','Lawyer D','2023-07-08','11:30 AM'),(21,'David Wilson','david.wilson@example.com','1111111111','LawyerOffice','Lawyer E','2023-07-09','03:45 PM'),(22,'Olivia Davis','olivia.davis@example.com','7777777777','customLocation','Lawyer F','2023-07-10','10:30 AM'),(23,'Sophia Anderson','sophia.anderson@example.com','2222222222','LawyerOffice','Lawyer G','2023-07-11','01:00 PM'),(24,'William Martinez','william.martinez@example.com','8888888888','customLocation','Lawyer H','2023-07-12','09:45 AM'),(25,'James Thompson','james.thompson@example.com','6666666666','Home','Lawyer I','2023-07-13','02:15 PM'),(26,'Ava Lewis','ava.lewis@example.com','3333333333','customLocation','Lawyer J','2023-07-14','11:00 AM'),(27,'Mia Turner','mia.turner@example.com','9999999999','LawyerOffice','Lawyer K','2023-07-15','04:30 PM'),(28,'Benjamin Wright','benjamin.wright@example.com','7777777777','customLocation','Lawyer L','2023-07-16','10:45 AM'),(29,'Ethan Walker','ethan.walker@example.com','2222222222','LawyerOffice','Lawyer M','2023-07-17','01:30 PM'),(30,'Isabella Harris','isabella.harris@example.com','8888888888','customLocation','Lawyer N','2023-07-18','03:00 PM'),(31,'Oliver Clark','oliver.clark@example.com','5555555555','LawyerOffice','Lawyer O','2023-07-19','11:15 AM'),(32,'Muneeb Usmani','muneebusmani8355@gmail.com','03352835245','LSPD','John Doe','07/15/2023','7:54 PM'),(33,'muneebUsmani','asdkasldkj@asdasd','1123312','LawyerOffice','John Doe','08/05/2023','8:01 PM'),(34,'muneebUsmani','asdkasldkj@asdasd','1123312','LawyerOffice','John Doe','08/05/2023','8:01 PM');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `education` (
  `education` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` VALUES ('JD'),('LLB'),('LLM'),('JSD / SJD'),('LLD'),('MLS / MJ');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experience`
--

DROP TABLE IF EXISTS `experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experience` (
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experience`
--

LOCK TABLES `experience` WRITE;
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
INSERT INTO `experience` VALUES ('1'),('2'),('3'),('4'),('5'),('6'),('7'),('8'),('9'),('10'),('10 - 15'),('15 - 20'),('20+'),('Less Than 1'),('No  Experience');
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lawyers`
--

DROP TABLE IF EXISTS `lawyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lawyers` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Photo` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'https://picsum.photos/200',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `speciality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `education` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `number` (`number`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lawyers`
--

LOCK TABLES `lawyers` WRITE;
/*!40000 ALTER TABLE `lawyers` DISABLE KEYS */;
INSERT INTO `lawyers` VALUES (1,'https://picsum.photos/200','John Doe','Booked','1234567890','john.doe@example.com','123 Main St','Tax','Karachi','LLB','10','password123'),(2,'https://picsum.photos/200','Jane Smith','active','9876543210','jane.smith@example.com','456 Elm St','Family Law','Los Angeles','JD','8 years','password4567'),(3,'https://picsum.photos/200','Michael Johnson','active','7890123456','michael.johnson@example.com','789 Oak St','Corporate Law','Chicago','LLM','12 years','password789');
/*!40000 ALTER TABLE `lawyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES ('Karachi'),('Hyderabad'),('Sukkur'),('Larkana'),('Peshawar'),('Islamabad');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `practice_area`
--

DROP TABLE IF EXISTS `practice_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `practice_area` (
  `practice_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `practice_area`
--

LOCK TABLES `practice_area` WRITE;
/*!40000 ALTER TABLE `practice_area` DISABLE KEYS */;
INSERT INTO `practice_area` VALUES ('Corporate'),('Criminal'),('Family'),('Property'),('Affidavit'),('Real Estate'),('Employement'),('Tax'),('Environment'),('Health'),('Immigration'),('Civil ligitation'),('International'),('Bankruptcy'),('Entertainment'),('Adminstrative');
/*!40000 ALTER TABLE `practice_area` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-16 15:55:03
