-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: apprenticehoursdb
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `apprenticeoccupationprogresstbl`
--

DROP TABLE IF EXISTS `apprenticeoccupationprogresstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apprenticeoccupationprogresstbl` (
  `aopid` int(11) NOT NULL AUTO_INCREMENT,
  `poaopfk` int(11) DEFAULT NULL,
  `owpfk` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aopid`),
  KEY `owpfk` (`owpfk`),
  KEY `poaopfk` (`poaopfk`),
  CONSTRAINT `owpfk_foreignkey` FOREIGN KEY (`owpfk`) REFERENCES `occupationworkprocessestbl` (`owpid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `poaopfk_foreignkey` FOREIGN KEY (`poaopfk`) REFERENCES `personoccupationstbl` (`poid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apprenticeoccupationprogresstbl`
--

LOCK TABLES `apprenticeoccupationprogresstbl` WRITE;
/*!40000 ALTER TABLE `apprenticeoccupationprogresstbl` DISABLE KEYS */;
INSERT INTO `apprenticeoccupationprogresstbl` VALUES (1,1,1,7,'2021-02-01 00:00:00'),(2,1,1,8,'2021-02-02 00:00:00'),(3,1,2,7,'2021-02-03 00:00:00'),(4,1,1,5,'2021-03-01 00:00:00'),(5,1,2,3,'2021-03-01 00:00:00'),(6,1,1,3,'2021-03-02 00:00:00'),(7,1,2,5,'2021-03-02 00:00:00');
/*!40000 ALTER TABLE `apprenticeoccupationprogresstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apprentsuperstbl`
--

DROP TABLE IF EXISTS `apprentsuperstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apprentsuperstbl` (
  `appsupid` int(11) NOT NULL AUTO_INCREMENT,
  `persappsupfk` int(11) DEFAULT NULL,
  `supappsupfk` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`appsupid`),
  KEY `persappsupfk` (`persappsupfk`),
  KEY `supappsupfk` (`supappsupfk`),
  CONSTRAINT `persappsupfk_foreignkey` FOREIGN KEY (`persappsupfk`) REFERENCES `personstbl` (`personid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `supappsupfk_foreignkey` FOREIGN KEY (`supappsupfk`) REFERENCES `supervisorstbl` (`supervisorid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apprentsuperstbl`
--

LOCK TABLES `apprentsuperstbl` WRITE;
/*!40000 ALTER TABLE `apprentsuperstbl` DISABLE KEYS */;
INSERT INTO `apprentsuperstbl` VALUES (1,1,1,'2021-03-03 06:03:29');
/*!40000 ALTER TABLE `apprentsuperstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursestbl`
--

DROP TABLE IF EXISTS `coursestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coursestbl` (
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  `coursetitle` varchar(45) NOT NULL,
  `coursedesc` varchar(45) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursestbl`
--

LOCK TABLES `coursestbl` WRITE;
/*!40000 ALTER TABLE `coursestbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `coursestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idependentskillstbl`
--

DROP TABLE IF EXISTS `idependentskillstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idependentskillstbl` (
  `idpid` int(11) NOT NULL AUTO_INCREMENT,
  `skillname` varchar(45) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpid`),
  UNIQUE KEY `skillname_UNIQUE` (`skillname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idependentskillstbl`
--

LOCK TABLES `idependentskillstbl` WRITE;
/*!40000 ALTER TABLE `idependentskillstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `idependentskillstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monthlysubmissionstbl`
--

DROP TABLE IF EXISTS `monthlysubmissionstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monthlysubmissionstbl` (
  `msid` int(11) NOT NULL AUTO_INCREMENT,
  `pomsfk` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatewhen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text,
  PRIMARY KEY (`msid`),
  KEY `pomsfk_foreignkey_idx` (`pomsfk`),
  CONSTRAINT `pomsfk_foreignkey` FOREIGN KEY (`pomsfk`) REFERENCES `personoccupationstbl` (`poid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monthlysubmissionstbl`
--

LOCK TABLES `monthlysubmissionstbl` WRITE;
/*!40000 ALTER TABLE `monthlysubmissionstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthlysubmissionstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `montlysubmissionsskillstbl`
--

DROP TABLE IF EXISTS `montlysubmissionsskillstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `montlysubmissionsskillstbl` (
  `mssid` int(11) NOT NULL AUTO_INCREMENT,
  `msfk` int(11) DEFAULT NULL,
  `oisfk` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`mssid`),
  KEY `msfk` (`msfk`),
  KEY `oisfk` (`oisfk`),
  CONSTRAINT `msfk_foreignkey` FOREIGN KEY (`msfk`) REFERENCES `monthlysubmissionstbl` (`msid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `oisfk_foreignkey` FOREIGN KEY (`oisfk`) REFERENCES `occupationidependentskillstbl` (`oisid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `montlysubmissionsskillstbl`
--

LOCK TABLES `montlysubmissionsskillstbl` WRITE;
/*!40000 ALTER TABLE `montlysubmissionsskillstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `montlysubmissionsskillstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupationidependentskillstbl`
--

DROP TABLE IF EXISTS `occupationidependentskillstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupationidependentskillstbl` (
  `oisid` int(11) NOT NULL AUTO_INCREMENT,
  `occoisfk` int(11) DEFAULT NULL,
  `idpfk` int(11) DEFAULT NULL,
  PRIMARY KEY (`oisid`),
  KEY `occoisfk` (`occoisfk`),
  KEY `idpfk` (`idpfk`),
  CONSTRAINT `idpfk_foreignkey` FOREIGN KEY (`idpfk`) REFERENCES `idependentskillstbl` (`idpid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `occoisfk_foreignkey` FOREIGN KEY (`occoisfk`) REFERENCES `occupationstbl` (`occupationid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupationidependentskillstbl`
--

LOCK TABLES `occupationidependentskillstbl` WRITE;
/*!40000 ALTER TABLE `occupationidependentskillstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupationidependentskillstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupationstbl`
--

DROP TABLE IF EXISTS `occupationstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupationstbl` (
  `occupationid` int(11) NOT NULL AUTO_INCREMENT,
  `occupationname` varchar(45) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`occupationid`),
  UNIQUE KEY `ocupationname_UNIQUE` (`occupationname`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupationstbl`
--

LOCK TABLES `occupationstbl` WRITE;
/*!40000 ALTER TABLE `occupationstbl` DISABLE KEYS */;
INSERT INTO `occupationstbl` VALUES (1,'Diesel Technician','2021-02-22 20:13:53'),(2,'Automotive Technician','2021-02-22 20:14:10');
/*!40000 ALTER TABLE `occupationstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupationworkprocessestbl`
--

DROP TABLE IF EXISTS `occupationworkprocessestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupationworkprocessestbl` (
  `owpid` int(11) NOT NULL AUTO_INCREMENT,
  `occfk` int(11) DEFAULT NULL,
  `procfk` int(11) DEFAULT NULL,
  `processletter` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`owpid`),
  KEY `occfk` (`occfk`),
  KEY `procfk` (`procfk`),
  CONSTRAINT `occfk_foreignkey` FOREIGN KEY (`occfk`) REFERENCES `occupationstbl` (`occupationid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `procfk_foreignkey` FOREIGN KEY (`procfk`) REFERENCES `workprocessestbl` (`workprocessid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupationworkprocessestbl`
--

LOCK TABLES `occupationworkprocessestbl` WRITE;
/*!40000 ALTER TABLE `occupationworkprocessestbl` DISABLE KEYS */;
INSERT INTO `occupationworkprocessestbl` VALUES (1,1,1,'A'),(2,1,2,'B'),(3,1,3,'C'),(4,1,4,'D'),(5,1,5,'E'),(6,1,6,'F'),(7,1,7,'G'),(8,1,8,'H'),(9,1,9,'I'),(10,1,10,'J'),(11,1,11,'K'),(12,2,1,'A'),(13,2,5,'B'),(14,2,4,'C'),(15,2,12,'D'),(16,2,13,'E'),(17,2,14,'G'),(18,2,15,'H');
/*!40000 ALTER TABLE `occupationworkprocessestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passwordstbl`
--

DROP TABLE IF EXISTS `passwordstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwordstbl` (
  `passwordid` int(11) NOT NULL AUTO_INCREMENT,
  `perspassfk` int(11) DEFAULT NULL,
  `passworddigest` char(40) DEFAULT NULL,
  `salt` int(11) DEFAULT NULL,
  PRIMARY KEY (`passwordid`),
  KEY `persspassfk` (`perspassfk`),
  CONSTRAINT `perspassfk_foreignkey` FOREIGN KEY (`perspassfk`) REFERENCES `personstbl` (`personid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwordstbl`
--

LOCK TABLES `passwordstbl` WRITE;
/*!40000 ALTER TABLE `passwordstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `passwordstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personoccupationstbl`
--

DROP TABLE IF EXISTS `personoccupationstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personoccupationstbl` (
  `poid` int(11) NOT NULL AUTO_INCREMENT,
  `perspersoccfk` int(11) DEFAULT NULL,
  `occpersoccfk` int(11) DEFAULT NULL,
  PRIMARY KEY (`poid`),
  KEY `perspersoccfk` (`perspersoccfk`),
  KEY `occpersoccfk` (`occpersoccfk`),
  CONSTRAINT `occpersoccfk_foreignkey` FOREIGN KEY (`occpersoccfk`) REFERENCES `occupationstbl` (`occupationid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `perspersoccfk_foreignkey` FOREIGN KEY (`perspersoccfk`) REFERENCES `personstbl` (`personid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personoccupationstbl`
--

LOCK TABLES `personoccupationstbl` WRITE;
/*!40000 ALTER TABLE `personoccupationstbl` DISABLE KEYS */;
INSERT INTO `personoccupationstbl` VALUES (1,1,1),(2,2,1);
/*!40000 ALTER TABLE `personoccupationstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personstbl`
--

DROP TABLE IF EXISTS `personstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personstbl` (
  `personid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `middle` varchar(45) DEFAULT NULL,
  `rolefk` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`personid`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `rolefk` (`rolefk`),
  CONSTRAINT `rolefk_foreignkey` FOREIGN KEY (`rolefk`) REFERENCES `rolestbl` (`roleid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='					';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personstbl`
--

LOCK TABLES `personstbl` WRITE;
/*!40000 ALTER TABLE `personstbl` DISABLE KEYS */;
INSERT INTO `personstbl` VALUES (1,'Bobby','Boy','Little',1,'bobbyboy@gmail.com','BBoy','2021-03-03 05:56:26'),(2,'Jack','Johnson','Smith',2,'johnson@gmail.com','JJ','2021-03-03 05:57:20');
/*!40000 ALTER TABLE `personstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolestbl`
--

DROP TABLE IF EXISTS `rolestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolestbl` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `role_UNIQUE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolestbl`
--

LOCK TABLES `rolestbl` WRITE;
/*!40000 ALTER TABLE `rolestbl` DISABLE KEYS */;
INSERT INTO `rolestbl` VALUES (1,'apprentice'),(2,'supervisor');
/*!40000 ALTER TABLE `rolestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisorstbl`
--

DROP TABLE IF EXISTS `supervisorstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supervisorstbl` (
  `supervisorid` int(11) NOT NULL AUTO_INCREMENT,
  `supervisorcode` varchar(45) DEFAULT NULL,
  `perssupfk` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supervisorid`),
  KEY `perssupfk` (`perssupfk`),
  CONSTRAINT `perssupfk` FOREIGN KEY (`perssupfk`) REFERENCES `personstbl` (`personid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisorstbl`
--

LOCK TABLES `supervisorstbl` WRITE;
/*!40000 ALTER TABLE `supervisorstbl` DISABLE KEYS */;
INSERT INTO `supervisorstbl` VALUES (1,'testcode',2,'2021-03-03 05:59:18');
/*!40000 ALTER TABLE `supervisorstbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wagestbl`
--

DROP TABLE IF EXISTS `wagestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wagestbl` (
  `wageid` int(11) NOT NULL AUTO_INCREMENT,
  `persoccwagefk` int(11) DEFAULT NULL,
  `wage` int(11) DEFAULT NULL,
  PRIMARY KEY (`wageid`),
  KEY `persoccwagefk` (`persoccwagefk`),
  CONSTRAINT `persoccwagefk_foreignkey` FOREIGN KEY (`persoccwagefk`) REFERENCES `personoccupationstbl` (`poid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wagestbl`
--

LOCK TABLES `wagestbl` WRITE;
/*!40000 ALTER TABLE `wagestbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `wagestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workprocessestbl`
--

DROP TABLE IF EXISTS `workprocessestbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workprocessestbl` (
  `workprocessid` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`workprocessid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workprocessestbl`
--

LOCK TABLES `workprocessestbl` WRITE;
/*!40000 ALTER TABLE `workprocessestbl` DISABLE KEYS */;
INSERT INTO `workprocessestbl` VALUES (1,'Shop Safety','2021-02-23 21:15:53'),(2,'Gas & Diesel Engines','2021-02-23 21:15:53'),(3,'Drive Trains','2021-02-23 21:15:53'),(4,'Brakes','2021-02-23 21:15:53'),(5,'Steering & Suspension','2021-02-23 21:15:53'),(6,'Electrical Systems & Electronic Controls','2021-02-23 21:15:53'),(7,'Heating, Ventilation, & Air Conditioning (HVAC)','2021-02-23 21:15:53'),(8,'Preventive Maintenance Inspections (PMI)','2021-02-23 21:15:53'),(9,'Hydraulic Systems','2021-02-23 21:15:53'),(10,'Cutting & Welding','2021-02-23 21:15:53'),(11,'Knowledge of CFR Regulations','2021-02-23 21:15:53'),(12,'Electrical / Electronic Systems','2021-02-23 21:17:35'),(13,'Engine Performance','2021-02-23 21:17:35'),(14,'Tires','2021-02-23 21:17:35'),(15,'Miscellaneous','2021-02-23 21:17:35');
/*!40000 ALTER TABLE `workprocessestbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workprocessrequiredhourstbl`
--

DROP TABLE IF EXISTS `workprocessrequiredhourstbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workprocessrequiredhourstbl` (
  `wprhid` int(11) NOT NULL AUTO_INCREMENT,
  `owpwprhfk` int(11) DEFAULT NULL,
  `reqhrs` int(11) NOT NULL,
  PRIMARY KEY (`wprhid`),
  KEY `owpwprhfk` (`owpwprhfk`),
  CONSTRAINT `owpwprhfk_foreignkey` FOREIGN KEY (`owpwprhfk`) REFERENCES `occupationworkprocessestbl` (`owpid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workprocessrequiredhourstbl`
--

LOCK TABLES `workprocessrequiredhourstbl` WRITE;
/*!40000 ALTER TABLE `workprocessrequiredhourstbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `workprocessrequiredhourstbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-15 21:11:22
