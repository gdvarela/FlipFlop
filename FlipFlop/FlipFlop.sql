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
-- Table structure for table `Chats`
--

DROP TABLE IF EXISTS `Chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chats` (
  `idChat` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) DEFAULT NULL,
  `idInterested` int(11) DEFAULT NULL,
  `lastMessage` int(11) DEFAULT '0',
  PRIMARY KEY (`idChat`),
  KEY `idProducto_chats_idx` (`idProduct`),
  KEY `idInterested_idx` (`idInterested`),
  CONSTRAINT `idInterested` FOREIGN KEY (`idInterested`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idProducto_chats` FOREIGN KEY (`idProduct`) REFERENCES `Products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chats`
--

LOCK TABLES `Chats` WRITE;
/*!40000 ALTER TABLE `Chats` DISABLE KEYS */;
INSERT INTO `Chats` VALUES (3,9,2,0),(4,9,2,0);
/*!40000 ALTER TABLE `Chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Images`
--

DROP TABLE IF EXISTS `Images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Images` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `idProduct` int(11) DEFAULT NULL,
  PRIMARY KEY (`idImage`),
  UNIQUE KEY `uri_UNIQUE` (`uri`),
  KEY `idProduct_idx` (`idProduct`),
  CONSTRAINT `idProduct` FOREIGN KEY (`idProduct`) REFERENCES `Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Images`
--

LOCK TABLES `Images` WRITE;
/*!40000 ALTER TABLE `Images` DISABLE KEYS */;
INSERT INTO `Images` VALUES (1,'11',1),(2,'21',2),(3,'31',3),(4,'41',4),(5,'51',5),(6,'61',6),(7,'71',7),(8,'81',8),(9,'91',9),(10,'101',10),(11,'111',11),(12,'82',8),(13,'92',9),(14,'93',9),(15,'102',10);
/*!40000 ALTER TABLE `Images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messages`
--

DROP TABLE IF EXISTS `Messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Messages` (
  `idChat` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL,
  `message` text COLLATE latin1_spanish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idMessage`,`idChat`),
  KEY `idChat_idx` (`idChat`),
  KEY `idUsuario_idx` (`owner`),
  CONSTRAINT `idChat` FOREIGN KEY (`idChat`) REFERENCES `Chats` (`idChat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idUsuario` FOREIGN KEY (`owner`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messages`
--

LOCK TABLES `Messages` WRITE;
/*!40000 ALTER TABLE `Messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `Messages` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `Products` VALUES (1,'Chancleta ','Super Awesome Chancleta',100,'#chancleta #Youtuber #420 #Summer','2016-11-22',1),(2,'Alpargata','Alpargata for Winter that is comming',50,'#Alpargata #Winter #Jhon','2016-10-22',3),(3,'Tenis','Hipster runner Mike Guachoski',160,'#LifeStyle','2016-09-22',1),(4,'Bambas','Bambas Panchitas',10,'#SportDesigned','2016-08-22',2),(5,'Zapatillas','Clasical home zapatillas',2,'#Chinese #NoChinese #MadeInTaiwan','2015-11-22',4),(6,'Botas','Typical katiuskas  for the lluvia',50,'#Rain #Men','2016-07-22',2),(7,'Tabi Ninja','Armored Shoes for Ad enemies',300,'#RitoPls #NerfRengar','2015-09-22',1),(8,'Hello kitty Mocasines','Mocasines only for adults',20,'#MocasinesSaltarines #BurnsRules','2016-10-22',3),(9,'Tenis','Messi Football tenis',600,'#NotFake #100%Real','2015-07-22',3),(10,'Tacones','Big Mexican vegetal tacos ',5,'#Burrito #MuerteaTrump','2016-07-22',2),(11,'Boots','Bern Grills ultimate survival boots, knife incorpored, free insects for Lee',225,'#UltimateSurvival #Blind','2016-10-22',4);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'David','admin','David','Ansia','david@gmail.com','654987322','65498721E'),(2,'Guille','admin','Guillermo','Davila','guillermo@gmail.com','654987313','65498754T'),(3,'Jaime','user','Jaime','Perez','jaime@gmail.com','698547215','58963254H'),(4,'Maria','user','Maria','Acevedo','maria@gmail.com','654873217','36547854N'),(10,'Guillermo','admin1234','Guillermo','Davila Varela','guillermo.davilavarela@gmail.com','638233366','53193712W');
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

-- Dump completed on 2016-11-30 13:28:30
