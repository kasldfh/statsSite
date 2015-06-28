-- MySQL dump 10.13  Distrib 5.6.19, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cod_stats
-- ------------------------------------------------------
-- Server version	5.6.19-1~exp1ubuntu2

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
-- Table structure for table `ctf`
--

DROP TABLE IF EXISTS `ctf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `team_a_score` int(11) DEFAULT NULL,
  `team_b_score` int(11) DEFAULT NULL,
  `team_a_host` tinyint(1) DEFAULT NULL,
  `team_b_host` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `game_time` int(11) NOT NULL,
  `a_victory` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctf`
--

LOCK TABLES `ctf` WRITE;
/*!40000 ALTER TABLE `ctf` DISABLE KEYS */;
INSERT INTO `ctf` VALUES (1,6,1,9,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(2,11,3,2,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(3,18,1,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(4,24,4,3,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',661,1),(5,31,3,1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1);
/*!40000 ALTER TABLE `ctf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctf_player`
--

DROP TABLE IF EXISTS `ctf_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctf_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctf_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `defends` int(11) DEFAULT NULL,
  `captures` int(11) DEFAULT NULL,
  `returns` int(11) DEFAULT NULL,
  `host` tinyint(1) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctf_player`
--

LOCK TABLES `ctf_player` WRITE;
/*!40000 ALTER TABLE `ctf_player` DISABLE KEYS */;
INSERT INTO `ctf_player` VALUES (1,1,9,0,0,0,0,15,28,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,13,0,4,0,0,32,16,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,10,0,0,0,0,18,27,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,14,0,3,0,0,25,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,11,0,0,0,0,17,25,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,15,0,1,0,0,25,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,12,0,0,0,0,16,29,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,16,0,1,0,0,26,16,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,2,18,0,0,0,0,28,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,2,1,0,0,0,0,27,19,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,2,19,0,1,0,0,25,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,2,2,0,0,0,0,15,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,2,20,0,1,0,0,14,20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,2,3,0,0,0,0,24,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,2,21,0,1,0,0,18,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,2,4,0,2,0,0,23,26,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,4,18,0,1,0,0,28,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,4,22,0,1,0,0,15,25,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,4,19,0,1,0,0,29,18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,4,23,0,1,0,0,27,22,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,4,20,0,0,0,0,15,25,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,4,24,0,1,0,0,20,22,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,4,21,0,2,0,0,20,17,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,4,25,0,0,0,0,16,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,5,1,1,0,5,0,23,20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,5,18,1,0,0,0,22,21,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,5,2,0,1,1,0,22,14,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,5,19,1,0,4,0,17,23,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,5,3,1,2,1,0,17,16,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,5,20,0,0,0,0,15,24,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,5,4,1,0,2,0,24,28,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,5,21,2,1,3,0,24,19,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ctf_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `game_title_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'Brazil',1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_type`
--

DROP TABLE IF EXISTS `event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_type`
--

LOCK TABLES `event_type` WRITE;
/*!40000 ALTER TABLE `event_type` DISABLE KEYS */;
INSERT INTO `event_type` VALUES (1,'LAN','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Online','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `event_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `game_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_mode_id` int(11) NOT NULL,
  `score_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',3,1),(3,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,1),(4,2,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',8,1),(5,2,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',11,1),(6,2,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',5,1),(7,2,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',13,1),(8,3,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(9,3,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',3,1),(10,3,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,1),(11,3,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',14,1),(12,3,5,'0000-00-00 00:00:00','0000-00-00 00:00:00',10,1),(13,4,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(14,4,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',3,1),(15,4,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',6,1),(16,5,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',4,1),(17,5,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',7,1),(18,5,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,3),(19,6,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',15,1),(20,6,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',10,1),(21,6,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',13,1),(22,7,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',4,1),(23,7,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',7,1),(24,7,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,1),(25,7,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',9,1),(26,8,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',15,1),(27,8,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',3,1),(28,8,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',13,1),(29,9,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',4,1),(30,9,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',11,1),(31,9,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,1),(32,9,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',9,1);
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_title`
--

DROP TABLE IF EXISTS `game_title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_title`
--

LOCK TABLES `game_title` WRITE;
/*!40000 ALTER TABLE `game_title` DISABLE KEYS */;
INSERT INTO `game_title` VALUES (1,'Advanced Warfare','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `game_title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp`
--

DROP TABLE IF EXISTS `hp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `team_a_score` int(11) NOT NULL,
  `team_b_score` int(11) NOT NULL,
  `team_a_host` tinyint(1) DEFAULT NULL,
  `team_b_host` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `game_time` int(11) NOT NULL,
  `a_victory` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp`
--

LOCK TABLES `hp` WRITE;
/*!40000 ALTER TABLE `hp` DISABLE KEYS */;
INSERT INTO `hp` VALUES (1,1,250,66,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',438,1),(2,4,230,174,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(3,8,170,202,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(4,13,250,106,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',566,1),(5,16,237,187,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(6,19,250,87,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',561,1),(7,22,187,210,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(8,26,174,206,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(9,29,250,94,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',486,1);
/*!40000 ALTER TABLE `hp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_player`
--

DROP TABLE IF EXISTS `hp_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hp_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hp_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `defends` int(11) DEFAULT NULL,
  `captures` int(11) DEFAULT NULL,
  `host` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_player`
--

LOCK TABLES `hp_player` WRITE;
/*!40000 ALTER TABLE `hp_player` DISABLE KEYS */;
INSERT INTO `hp_player` VALUES (1,1,1,27,17,1,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,5,22,28,1,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,2,26,19,1,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,6,18,27,1,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,3,27,16,1,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,7,15,30,2,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,4,30,14,4,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,8,11,26,0,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,2,9,26,34,4,11,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,2,13,36,32,6,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,2,10,31,29,5,13,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,2,14,32,32,1,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,2,11,30,32,2,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,2,15,28,32,3,11,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,2,12,37,35,11,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,2,16,32,30,0,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,3,18,37,33,5,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,3,1,32,32,2,12,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,3,19,25,35,2,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,3,2,32,31,1,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,3,20,35,33,5,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,3,3,34,33,4,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,3,21,32,39,5,13,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,3,4,42,36,4,13,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,4,22,38,29,2,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,4,13,28,36,4,11,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,4,23,29,30,0,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,4,14,22,33,0,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,4,24,39,24,2,14,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,4,15,32,33,5,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,4,25,30,21,0,12,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,4,16,20,35,1,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,5,1,43,35,5,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,5,22,26,36,2,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,5,2,32,31,5,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,5,23,22,38,5,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,5,3,30,28,1,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,5,24,52,32,8,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,5,4,34,32,1,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,5,25,25,33,6,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,6,18,36,21,1,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,6,13,25,38,0,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,6,19,34,28,3,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,6,14,28,33,2,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,6,20,31,27,2,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,6,15,20,33,0,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,6,21,32,24,4,14,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,6,16,24,30,0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,7,18,42,28,5,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,7,22,33,34,2,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,7,19,28,37,7,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,7,23,34,29,7,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,7,20,30,34,5,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,7,24,33,31,4,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,7,21,23,32,4,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,7,25,27,30,8,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,8,1,35,33,2,12,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,8,18,35,32,2,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,8,2,29,30,4,12,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,8,19,38,34,4,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,8,3,33,33,1,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,8,20,25,30,0,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,8,4,27,33,2,13,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,8,21,30,33,4,20,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,9,1,26,27,4,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,9,18,24,27,4,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,9,2,25,19,6,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,9,19,28,33,1,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,9,3,26,23,0,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,9,20,23,28,4,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,9,4,36,26,9,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,9,21,20,29,4,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hp_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `game_title_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` VALUES (1,'Retreat',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Riot',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Biolab',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Solar',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Detroit',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Recovery',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'Comeback',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'Ascend',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_mode`
--

DROP TABLE IF EXISTS `map_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map_id` int(11) NOT NULL,
  `mode_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_mode`
--

LOCK TABLES `map_mode` WRITE;
/*!40000 ALTER TABLE `map_mode` DISABLE KEYS */;
INSERT INTO `map_mode` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,2,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,3,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,3,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,3,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,4,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,5,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,5,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,5,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,6,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,7,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,7,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,8,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,4,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `map_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_table`
--

DROP TABLE IF EXISTS `match_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `roster_a_id` int(11) NOT NULL,
  `roster_b_id` int(11) NOT NULL,
  `a_map_count` int(11) DEFAULT NULL,
  `b_map_count` int(11) DEFAULT NULL,
  `match_type_id` int(11) NOT NULL,
  `score_type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `day` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_table`
--

LOCK TABLES `match_table` WRITE;
/*!40000 ALTER TABLE `match_table` DISABLE KEYS */;
INSERT INTO `match_table` VALUES (1,1,1,2,3,0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,1,3,4,1,3,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,1,5,1,2,3,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(4,1,6,4,3,0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(5,1,1,6,3,0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(6,1,5,4,3,0,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(7,1,5,6,3,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(8,1,1,5,0,3,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',2),(9,1,1,5,3,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',3);
/*!40000 ALTER TABLE `match_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match_type`
--

DROP TABLE IF EXISTS `match_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match_type`
--

LOCK TABLES `match_type` WRITE;
/*!40000 ALTER TABLE `match_type` DISABLE KEYS */;
INSERT INTO `match_type` VALUES (1,'Pool Play','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `match_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_06_14_225725_create_ctf_player_table',1),('2015_06_14_225725_create_ctf_table',1),('2015_06_14_225725_create_event_table',1),('2015_06_14_225725_create_event_type_table',1),('2015_06_14_225725_create_game_table',1),('2015_06_14_225725_create_game_title_table',1),('2015_06_14_225725_create_hp_player_table',1),('2015_06_14_225725_create_hp_table',1),('2015_06_14_225725_create_map_mode_table',1),('2015_06_14_225725_create_map_table',1),('2015_06_14_225725_create_match_table_table',1),('2015_06_14_225725_create_match_type_table',1),('2015_06_14_225725_create_mode_table',1),('2015_06_14_225725_create_password_reminders_table',1),('2015_06_14_225725_create_player_roster_table',1),('2015_06_14_225725_create_player_table',1),('2015_06_14_225725_create_roster_table',1),('2015_06_14_225725_create_roster_to_event_table',1),('2015_06_14_225725_create_score_type_table',1),('2015_06_14_225725_create_snd_player_table',1),('2015_06_14_225725_create_snd_table',1),('2015_06_14_225725_create_team_table',1),('2015_06_14_225725_create_uplink_player_table',1),('2015_06_14_225725_create_uplink_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mode`
--

DROP TABLE IF EXISTS `mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `game_title_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mode`
--

LOCK TABLES `mode` WRITE;
/*!40000 ALTER TABLE `mode` DISABLE KEYS */;
INSERT INTO `mode` VALUES (1,'Hardpoint',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Capture the Flag',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Uplink',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Search and Destroy',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminders`
--

LOCK TABLES `password_reminders` WRITE;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` date DEFAULT NULL,
  `age` int(11) NOT NULL,
  `first_event` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hometown` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_widget` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,'lele','lelelel','Caio','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(2,'lele','lelelel','Carlao','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(3,'lele','lelelel','Le','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(4,'lele','lelelel','Hx','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(5,'lele','lelelel','Sharq','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(6,'lele','lelelel','eMegicz','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(7,'lele','lelelel','Guigs','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(8,'lele','lelelel','RyeK','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(9,'lele','lelelel','Theuss','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(10,'lele','lelelel','LGnDz','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(11,'lele','lelelel','Lopes','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(12,'lele','lelelel','RapidBigThug','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(13,'lele','lelelel','Batuta','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(14,'lele','lelelel','FKiNg','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(15,'lele','lelelel','eRoDy','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(16,'lele','lelelel','DJNAY','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(18,'lele','lelelel','Nikko','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(19,'lele','lelelel','ForTunaTo','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(20,'lele','lelelel','iRapp','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(21,'lele','lelelel','STAL1ZY','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(22,'lele','lelelel','Rafa','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(23,'lele','lelelel','RxcK','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(24,'lele','lelelel','VrTChamp','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(25,'lele','lelelel','CocoLander','',NULL,0,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_roster`
--

DROP TABLE IF EXISTS `player_roster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_roster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roster_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `starter` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player_roster`
--

LOCK TABLES `player_roster` WRITE;
/*!40000 ALTER TABLE `player_roster` DISABLE KEYS */;
INSERT INTO `player_roster` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(3,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(4,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(5,2,5,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(6,2,6,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(7,2,7,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(8,2,8,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(9,3,9,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(10,3,10,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(11,3,11,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(13,3,12,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(14,4,13,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(15,4,14,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(16,4,15,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(17,4,16,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(18,5,18,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(19,5,19,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(20,5,20,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(21,5,21,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(22,6,22,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(23,6,23,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(24,6,24,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(25,6,25,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(26,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(27,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(28,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(29,1,4,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(30,2,5,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(31,2,6,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(32,2,7,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(33,2,8,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(34,3,9,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(35,3,10,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(36,3,11,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(37,3,12,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(38,4,13,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(39,4,14,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(40,4,15,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(41,4,16,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(42,5,18,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(43,5,19,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(44,5,20,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(45,5,21,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(46,6,22,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(47,6,23,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(48,6,24,'0000-00-00 00:00:00','0000-00-00 00:00:00',0),(49,6,25,'0000-00-00 00:00:00','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `player_roster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roster`
--

DROP TABLE IF EXISTS `roster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roster`
--

LOCK TABLES `roster` WRITE;
/*!40000 ALTER TABLE `roster` DISABLE KEYS */;
INSERT INTO `roster` VALUES (1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,4,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,5,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,6,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `roster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roster_to_event`
--

DROP TABLE IF EXISTS `roster_to_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roster_to_event` (
  `id` int(11) NOT NULL,
  `roster_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roster_to_event`
--

LOCK TABLES `roster_to_event` WRITE;
/*!40000 ALTER TABLE `roster_to_event` DISABLE KEYS */;
INSERT INTO `roster_to_event` VALUES (1,1,1,1),(2,2,1,2),(3,3,1,3),(4,4,1,4),(5,5,1,5),(6,6,1,6);
/*!40000 ALTER TABLE `roster_to_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score_type`
--

DROP TABLE IF EXISTS `score_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_short` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score_type`
--

LOCK TABLES `score_type` WRITE;
/*!40000 ALTER TABLE `score_type` DISABLE KEYS */;
INSERT INTO `score_type` VALUES (1,'Best of Five','BO5','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `score_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `snd`
--

DROP TABLE IF EXISTS `snd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `snd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `team_a_score` int(11) NOT NULL,
  `team_b_score` int(11) NOT NULL,
  `a_offense_wins` int(11) NOT NULL,
  `b_offense_wins` int(11) NOT NULL,
  `a_defense_wins` int(11) NOT NULL,
  `b_defense_wins` int(11) NOT NULL,
  `a_plant_a` int(11) DEFAULT NULL,
  `a_plant_b` int(11) DEFAULT NULL,
  `a_plant_a_win` int(11) DEFAULT NULL,
  `a_plant_b_win` int(11) DEFAULT NULL,
  `b_plant_a` int(11) DEFAULT NULL,
  `b_plant_b` int(11) DEFAULT NULL,
  `b_plant_a_win` int(11) DEFAULT NULL,
  `b_plant_b_win` int(11) DEFAULT NULL,
  `team_a_host` tinyint(1) DEFAULT NULL,
  `team_b_host` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `game_time` int(11) NOT NULL,
  `a_victory` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `snd`
--

LOCK TABLES `snd` WRITE;
/*!40000 ALTER TABLE `snd` DISABLE KEYS */;
INSERT INTO `snd` VALUES (1,2,6,4,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(2,5,2,6,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(3,9,6,5,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',597,1),(4,12,5,6,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(5,14,6,5,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',619,1),(6,17,6,5,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',594,1),(7,20,6,4,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',603,1),(8,23,6,5,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',612,1),(9,27,3,6,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',551,0),(10,30,0,6,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',306,0);
/*!40000 ALTER TABLE `snd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `snd_player`
--

DROP TABLE IF EXISTS `snd_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `snd_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snd_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `first_bloods` int(11) DEFAULT NULL,
  `first_blood_wins` int(11) DEFAULT NULL,
  `plants` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `host` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `defuse` int(11) DEFAULT NULL,
  `last_man_standing` int(11) NOT NULL,
  `last_man_standing_wins` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `snd_player`
--

LOCK TABLES `snd_player` WRITE;
/*!40000 ALTER TABLE `snd_player` DISABLE KEYS */;
INSERT INTO `snd_player` VALUES (1,1,1,0,NULL,0,8,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(2,1,5,0,NULL,0,10,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(3,1,2,0,NULL,4,7,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(4,1,6,0,NULL,0,4,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(5,1,3,0,NULL,0,8,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(6,1,7,0,NULL,0,4,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(7,1,4,0,NULL,0,7,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(8,1,8,0,NULL,2,5,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(9,2,9,0,NULL,0,2,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(10,2,13,0,NULL,0,11,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(11,2,10,0,NULL,1,4,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(12,2,14,0,NULL,0,7,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(13,2,11,0,NULL,1,3,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(14,2,15,0,NULL,3,5,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(15,2,12,0,NULL,0,3,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(16,2,16,0,NULL,0,7,2,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(17,3,18,0,NULL,1,9,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1,0),(18,3,1,2,NULL,0,9,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(19,3,19,1,NULL,0,10,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,2,0),(20,3,2,1,NULL,4,8,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(21,3,20,1,NULL,4,4,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(22,3,3,4,NULL,0,10,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(23,3,21,0,NULL,0,9,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(24,3,4,2,NULL,0,7,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,2,0),(25,4,18,0,NULL,0,6,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(26,4,1,2,NULL,1,4,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(27,4,19,1,NULL,0,8,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(28,4,2,1,NULL,2,8,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(29,4,20,0,NULL,1,9,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(30,4,3,2,NULL,0,8,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(31,4,21,1,NULL,0,6,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(32,4,4,2,NULL,0,5,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(33,5,22,1,NULL,0,9,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,3,0),(34,5,13,3,NULL,0,10,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(35,5,23,1,NULL,0,9,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(36,5,14,1,NULL,0,3,10,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(37,5,24,1,NULL,2,13,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(38,5,15,2,NULL,3,9,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(39,5,25,2,NULL,1,4,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(40,5,16,0,NULL,0,8,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,4,0),(41,6,1,3,NULL,1,8,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(42,6,22,1,NULL,0,7,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(43,6,2,0,NULL,2,9,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,3,0),(44,6,23,1,NULL,0,10,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(45,6,3,0,NULL,0,5,11,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(46,6,24,1,NULL,1,10,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,2,0),(47,6,4,3,NULL,0,9,11,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(48,6,25,2,NULL,0,9,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(49,7,18,2,NULL,0,9,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(50,7,13,2,NULL,0,7,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(51,7,19,1,NULL,0,7,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(52,7,14,2,NULL,0,6,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(53,7,20,1,NULL,1,6,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(54,7,15,1,NULL,0,7,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(55,7,21,1,NULL,1,9,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,3,0),(56,7,16,0,NULL,0,7,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,3,0),(57,8,18,2,NULL,0,8,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(58,8,22,0,NULL,0,3,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(59,8,19,0,NULL,0,2,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,0,0),(60,8,23,1,NULL,0,4,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,4,0),(61,8,20,2,NULL,0,7,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(62,8,24,2,NULL,1,6,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(63,8,21,3,NULL,1,14,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(64,8,25,0,NULL,1,7,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(65,9,1,0,NULL,0,3,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,3,0),(66,9,18,1,NULL,0,10,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,2,0),(67,9,2,1,NULL,3,6,8,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,4,0),(68,9,19,2,NULL,1,12,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(69,9,3,1,NULL,0,8,7,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1,0),(70,9,20,0,NULL,1,6,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,0,0),(71,9,4,0,NULL,0,2,9,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(72,9,21,4,NULL,1,5,5,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(73,10,1,0,NULL,0,3,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,3,0),(74,10,18,0,NULL,0,11,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(75,10,2,0,NULL,0,2,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,0),(76,10,19,1,NULL,1,2,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,0,0),(77,10,3,0,NULL,0,1,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,0),(78,10,20,2,NULL,2,7,3,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(79,10,4,1,NULL,1,3,6,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0),(80,10,21,2,NULL,0,4,4,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0);
/*!40000 ALTER TABLE `snd_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `owner1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitch` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mlg_tv` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `logo_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flair` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (1,'SSOF',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,'Classic Team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(3,'Milgares Team',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(4,'DOGS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(5,'Brazilla',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(6,'Virtue Gaming',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uplink`
--

DROP TABLE IF EXISTS `uplink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uplink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `team_a_score` int(11) NOT NULL,
  `team_b_score` int(11) NOT NULL,
  `team_a_host` tinyint(1) DEFAULT NULL,
  `team_b_host` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `game_time` int(11) NOT NULL,
  `a_victory` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uplink`
--

LOCK TABLES `uplink` WRITE;
/*!40000 ALTER TABLE `uplink` DISABLE KEYS */;
INSERT INTO `uplink` VALUES (1,3,11,0,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(2,7,11,14,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(3,10,4,17,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(4,15,12,4,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(5,21,20,1,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',544,1),(6,25,8,6,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,1),(7,28,4,11,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',600,0),(8,32,12,8,0,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',592,1);
/*!40000 ALTER TABLE `uplink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uplink_player`
--

DROP TABLE IF EXISTS `uplink_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uplink_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uplink_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `deaths` int(11) DEFAULT NULL,
  `uplinks` int(11) DEFAULT NULL,
  `makes` int(11) DEFAULT NULL,
  `misses` int(11) DEFAULT NULL,
  `host` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uplink_player`
--

LOCK TABLES `uplink_player` WRITE;
/*!40000 ALTER TABLE `uplink_player` DISABLE KEYS */;
INSERT INTO `uplink_player` VALUES (1,1,1,25,21,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,5,24,29,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,2,32,21,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,6,28,23,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,1,3,20,23,8,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,1,7,15,23,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,1,4,17,25,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,1,8,21,22,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,2,9,27,26,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,2,13,41,28,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,2,10,24,30,7,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,2,14,16,25,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,2,11,21,31,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,2,15,24,24,8,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,2,12,27,29,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,2,16,34,23,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,3,18,18,29,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,3,1,20,22,8,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,3,19,32,25,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,3,2,37,16,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,3,20,15,29,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,3,3,29,19,6,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,3,21,16,27,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,3,4,17,24,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,4,22,22,24,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,4,13,22,28,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,4,23,14,24,6,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,4,14,24,20,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,4,24,39,23,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,4,15,27,24,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,4,25,17,22,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,4,16,18,20,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,5,18,25,21,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,5,13,22,25,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,5,19,29,17,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,5,14,15,26,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,5,20,29,14,7,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,5,15,20,23,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,5,21,15,17,9,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,5,16,12,25,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,6,18,24,20,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,6,22,20,29,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,6,19,28,23,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,6,23,27,26,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,6,20,28,23,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,6,24,16,25,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,6,21,25,17,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,6,25,19,26,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,7,1,29,27,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,7,18,28,28,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,7,2,23,27,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,7,19,27,29,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,7,3,26,26,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,7,20,26,23,1,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,7,4,27,26,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,7,21,25,25,3,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,8,1,20,26,6,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,8,18,29,26,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,8,2,28,20,2,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,8,19,29,27,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,8,3,32,22,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,8,20,24,27,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,8,4,25,26,4,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,8,21,12,25,0,NULL,NULL,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `uplink_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-28 17:45:51
