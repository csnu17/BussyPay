-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bussypay
-- ------------------------------------------------------
-- Server version	5.5.60

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
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(100) NOT NULL,
  `source` varchar(255) NOT NULL,
  `terminal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buses`
--

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;
INSERT INTO `buses` VALUES (1,'สาย 28 เลขที่ 1234','สายใต้ใหม่','เมเจอร์รัชโยธิน'),(2,'สาย 8 เลขที่ 1234','แฮปปีแลนด์','สะพานพุทธ'),(99,'','','');
/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_status`
--

DROP TABLE IF EXISTS `transaction_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('success','failure') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_status`
--

LOCK TABLES `transaction_status` WRITE;
/*!40000 ALTER TABLE `transaction_status` DISABLE KEYS */;
INSERT INTO `transaction_status` VALUES (1,'success'),(2,'failure');
/*!40000 ALTER TABLE `transaction_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_name` enum('top_up','payment') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'top_up'),(2,'payment');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_type` tinyint(4) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `bus_id` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_number` (`transaction_number`,`transaction_type`,`user_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'7133790511',100,'2018-05-20 13:21:29',1,1,99,1),(2,'2224021144',50,'2018-05-20 13:21:29',2,1,1,1),(3,'2487172910',500,'2018-05-20 13:25:07',1,2,99,1),(4,'1830945599',100,'2018-05-20 13:25:07',2,2,2,1),(5,'1925926896',30,'2018-05-20 13:27:08',2,1,1,2),(6,'3006890434',68,'2018-05-20 13:27:08',1,2,99,2),(7,'1976157328',1000,'2018-05-20 14:45:13',1,1,99,1),(8,'7150728326',1000,'2018-05-20 22:26:32',1,1,99,1),(9,'5685165037',1000,'2018-05-20 22:27:31',2,1,1,1),(10,'7227894243',1000000,'2018-05-22 15:29:19',2,1,1,1),(11,'8401376096',10000000,'2018-05-22 16:12:38',1,1,99,1),(12,'7958044383',10000000,'2018-05-22 22:30:09',1,1,99,1),(13,'5299371251',10000000,'2018-05-22 22:30:56',1,1,99,1),(14,'2742754944',10000000,'2018-05-22 22:31:07',1,1,99,1),(15,'8254650518',200,'2018-05-25 08:55:45',1,1,99,1),(16,'6419868162',5000,'2018-05-25 09:14:38',1,1,99,1),(17,'4528715680',1,'2018-05-25 09:19:04',1,1,99,1),(18,'5839785988',199919,'2018-05-25 15:48:56',1,1,99,1),(19,'9523137074',98765,'2018-05-25 16:11:51',2,1,2,1),(20,'8373521369',666,'2018-05-25 16:12:42',1,1,99,2),(21,'5751808875',50,'2018-05-25 18:56:12',1,1,99,1),(22,'5553911600',70,'2018-05-25 18:56:50',2,1,2,1),(23,'8954173181',70,'2018-05-25 18:57:39',1,1,99,1),(24,'6837618901',30,'2018-05-25 19:00:10',1,1,99,1),(25,'5015726236',40,'2018-05-25 19:00:48',1,1,99,1),(26,'4280066170',500,'2018-05-25 19:03:18',1,1,99,1),(27,'1649658775',5,'2018-05-25 19:03:48',1,1,99,1),(28,'2320681032',100,'2018-05-26 01:26:23',1,1,99,1),(29,'9874191036',200,'2018-05-26 01:26:48',1,1,99,1),(30,'8700326661',55,'2018-05-26 01:32:17',2,1,2,2),(31,'9100593752',4444,'2018-05-26 05:25:52',1,1,99,1),(32,'1430188544',60,'2018-05-26 05:26:58',2,1,1,1),(33,'8583072565',111,'2018-05-26 06:21:00',2,1,1,1),(34,'6324997197',200,'2018-05-26 06:21:09',1,1,99,1),(35,'4020786827',100,'2018-05-26 06:52:02',1,1,99,1),(36,'2490354640',55,'2018-05-26 06:54:29',1,1,99,1),(37,'5368428142',55,'2018-05-26 06:54:43',2,1,1,1),(38,'1829649690',70,'2018-05-26 06:56:51',1,1,99,1),(39,'3862757933',769650,'2018-05-26 07:06:54',1,1,99,1),(40,'6421620424',50,'2018-05-26 07:08:43',2,1,1,1),(41,'9635785700',5000,'2018-05-26 07:15:55',1,1,99,1),(42,'8513718792',20,'2018-05-26 07:17:04',2,1,1,1),(43,'5467659340',16,'2018-05-26 07:20:20',2,1,1,1),(44,'9426282247',18,'2018-05-26 07:22:02',2,1,1,1),(45,'3823427244',18,'2018-05-26 08:15:36',1,1,99,1),(46,'5158792716',17,'2018-05-26 08:23:17',1,1,99,1),(47,'1538368525',17,'2018-05-26 08:24:44',1,1,99,1),(48,'4589400022',1000,'2018-05-26 08:28:16',1,1,99,1),(49,'1993328842',6156,'2018-05-26 08:28:59',2,1,1,1),(50,'2082970497',1000,'2018-05-26 08:33:03',1,1,99,2),(51,'1136357563',1000,'2018-05-26 08:37:18',1,1,99,2);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'iTopStory','11111111','1111','Kittisak','Phetrungnapha','cs.sealsoul@gmail.com','0812345678',1),(2,'chamai1234','22222222','2222','Chamaiporn','Suphachettapun','joy190134@gmail.com','0812345679',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wallet_id` varchar(50) NOT NULL,
  `balance` double NOT NULL,
  `wallet_own` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallet_id_3` (`wallet_id`),
  KEY `wallet_id` (`wallet_id`,`wallet_own`),
  KEY `wallet_id_2` (`wallet_id`,`wallet_own`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'top_wallet_1234',60000000,1),(2,'joy_wallet_1234',123456.78,2);
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-26 16:27:03
