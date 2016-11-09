CREATE DATABASE  IF NOT EXISTS `FlipFlop` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;
USE `FlipFlop`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: FlipFlop
-- ------------------------------------------------------
-- Server version	5.7.16-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `description` text COLLATE latin1_spanish_ci,
  `price` float DEFAULT NULL,
  `tags` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `add_date` date DEFAULT NULL,
  `seller` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Seller_idx` (`seller`),
  CONSTRAINT `Seller` FOREIGN KEY (`seller`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'p1','d1',1,'1','2016-11-22',1),(2,'p2','d2',2,'2','2016-10-22',2),(3,'p3','d3',3,'3','2016-09-22',1),(4,'p4','d4',4,'4','2016-08-22',2),(5,'p5','d5',5,'5','2015-11-22',2),(6,'p6','d6',6,'6','2016-07-22',1),(7,'p7','d7',7,'7','2015-09-22',1),(8,'p8','d8',8,'8','2016-10-22',2),(9,'p9','d9',9,'9','2015-07-22',2),(10,'p10','d10',10,'10','2016-07-22',2),(11,'p11','d11',11,'11','2016-10-22',1);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `name` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE latin1_spanish_ci DEFAULT NULL,
  `DNI` varchar(9) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'David','admin','David','Ansia','david@gmail.com','654987321','65498721E'),(2,'Guille','admin','Guillermo','Davila','guillermo@gmail.com','65498731','65498754T');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-09 12:37:48
