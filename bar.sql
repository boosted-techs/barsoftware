-- MySQL dump 10.13  Distrib 8.0.30, for macos11.6 (x86_64)
--
-- Host: localhost    Database: bar_management
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Internal sale','ashiraff@tumusii.me','0700000000','90','2023-03-23 07:32:27'),(2,'Namata Shubaiha','ashan@boostedtechs.com','070000054','Kampala Uganda','2023-03-23 18:15:32'),(3,'Medie','ashiraff@tumusii.com','0700000001','jfjfjfjf','2023-03-24 02:48:01');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `stock_level` int DEFAULT NULL,
  `status` smallint DEFAULT '0',
  `user` int NOT NULL,
  `date_created` datetime NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `_type` smallint NOT NULL DEFAULT '1',
  `image` char(100) NOT NULL DEFAULT 'blank.jpg',
  PRIMARY KEY (`id`),
  KEY `fk_supplier` (`supplier_id`),
  CONSTRAINT `fk_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'ALCOHOL',9000.00,'nn',900,1,1,'2023-03-22 09:52:09',NULL,1,'blank.jpg'),(2,'B2',7000.00,'Room 3',1,1,1,'2023-03-22 09:53:03',NULL,2,'blank.jpg'),(3,'ALCOHOL 3',400.00,'New alcohol 3 from Jamaica',400,1,1,'2023-03-23 03:46:04',NULL,1,'0c420a61dec05e1079fde61358b2b50a.png'),(4,'BEER edited',400.00,'Beered price',1000,1,1,'2023-03-23 03:47:22',NULL,1,'77d64fe9c9a86abe1871345b26bb4a7b.png'),(5,'MANDANZI',5000.00,'new item',400,1,1,'2023-03-24 00:13:35',NULL,1,'3ecd7745323889508aa0765c0a72c6f4.png');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL,
  `quantity` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `item_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `fk_order_items_items` (`item_id`),
  CONSTRAINT `fk_order_items_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,2,5,'2023-03-23 10:59:27',4),(2,3,0,'2023-03-23 10:59:27',2),(3,4,5,'2023-03-23 11:05:48',4),(4,4,5,'2023-03-23 11:05:48',1),(5,5,0,'2023-03-23 11:05:48',2),(6,5,0,'2023-03-23 11:05:48',1),(7,6,0,'2023-03-23 11:07:23',3),(8,7,0,'2023-03-23 11:08:22',3),(9,8,0,'2023-03-23 11:08:44',3),(10,9,1,'2023-03-23 11:10:53',4),(11,9,1,'2023-03-23 11:10:53',1),(12,10,0,'2023-03-23 11:11:01',2),(13,11,8,'2023-03-23 21:15:33',4),(14,11,8,'2023-03-23 21:15:33',3),(15,11,8,'2023-03-23 21:15:33',2),(16,12,7,'2023-03-24 00:14:09',5),(17,13,2,'2023-03-24 05:48:01',5),(18,13,2,'2023-03-24 05:48:01',3),(19,13,2,'2023-03-24 05:48:01',2),(20,14,1,'2023-03-24 05:48:01',3);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `order_type` enum('bar','room') NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,1,1,'bar','approved','2023-03-23 10:59:27','2023-03-23 22:44:38',1),(3,1,1,'room','pending','2023-03-23 10:59:27','2023-03-23 10:59:27',NULL),(4,1,1,'bar','pending','2023-03-23 11:05:48','2023-03-23 11:05:48',NULL),(5,1,1,'room','pending','2023-03-23 11:05:48','2023-03-23 11:05:48',NULL),(6,1,1,'room','pending','2023-03-23 11:07:23','2023-03-23 11:07:23',NULL),(7,1,1,'room','pending','2023-03-23 11:08:22','2023-03-23 11:08:22',NULL),(8,1,1,'room','pending','2023-03-23 11:08:44','2023-03-23 11:08:44',NULL),(9,1,1,'bar','rejected','2023-03-23 11:10:53','2023-03-23 17:02:33',1),(10,1,1,'room','approved','2023-03-23 11:11:01','2023-03-23 15:55:16',1),(11,2,1,'bar','pending','2023-03-23 21:15:33','2023-03-23 21:15:33',NULL),(12,1,1,'bar','pending','2023-03-24 00:14:09','2023-03-24 00:14:09',NULL),(13,3,1,'bar','pending','2023-03-24 05:48:01','2023-03-24 05:48:01',NULL),(14,3,1,'room','pending','2023-03-24 05:48:01','2023-03-24 05:48:01',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `room_number` varchar(50) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('free','booked','closed') DEFAULT 'free',
  `user` int NOT NULL,
  `image` char(100) NOT NULL DEFAULT 'blank.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'R30','New item',25000.00,'2023-03-22 11:46:45','free',1,'blank.jpg'),(2,'R31','New item',25000.00,'2023-03-22 11:47:12','booked',1,'blank.jpg'),(3,'ROOM 6','Room 6',2500.00,'2023-03-23 01:03:53','booked',1,'147715fa9475ba8caeae3adf4056f955.png');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','receptionist','cashier') DEFAULT 'receptionist',
  `user` int DEFAULT NULL,
  `access` smallint NOT NULL DEFAULT '1',
  `phone` char(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com','e10adc3949ba59abbe56e057f20f883e','admin',NULL,1,NULL,NULL),(2,'Cashier','cashier@gmail.com','e10adc3949ba59abbe56e057f20f883e','cashier',NULL,1,NULL,NULL),(3,'Receptionist','receptionist@gmail.com','e10adc3949ba59abbe56e057f20f883e','receptionist',NULL,1,NULL,NULL),(4,'Ashiraff Tumusiime Edited','ashan@boostedtechs.com','81dc9bdb52d04dc20036dbd8313ed055','cashier',NULL,1,'+256759800742','2023-03-23 19:45:09');
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

-- Dump completed on 2023-03-26 20:00:58
