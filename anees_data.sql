-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: jewellerydb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES (1,'Gold Necklace','Best In all Gold Necklaces.','collections/92iYMzqfr6v1DZfN46rkJT3emEbHvW9cm1irStl8.jpg','2026-09-23 07:12:44','2026-09-23 07:12:44'),(3,'Diamond Collection','Diamond Jewellery','collections/QRri3AbvnrHR74FglCuLfTdk9ie4LaIzGRYtqr5g.webp','2026-09-23 07:19:31','2026-09-23 07:19:31');
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Diamond Ring','Diamond',700000.00,'10g','Fell The Luxury','products/HrQJAzEd4c96hhWvqOiOMxnboum2vCGZKFZU7343.jpg',1,'2026-09-23 03:12:21','2026-09-23 07:19:57',3),(5,'Diamond Necklace','Diamond',1200000.00,'15g','Diamond Necklace.','products/itDIx8ndZPLNoWq9mxhPoSaIOJB2QLDv0MNTixuJ.jpg',1,'2026-09-23 06:00:33','2026-09-23 07:19:51',3),(6,'Gold Necklace','Gold',300000.00,'25g','Gold Necklace','products/vjGun6hQcORr0dVUBpum0WkZBN0UpjAcUb8bQG8Q.jpg',0,'2026-09-23 06:01:33','2026-09-23 07:14:25',1),(7,'Gold Ring','Gold',120000.00,'10g','Gold Ring','products/LHSOqCd1RjNMIetBsKZOVhGQP5dytPQjgf5XnzOo.webp',0,'2026-09-23 06:02:25','2026-09-23 06:02:25',NULL),(8,'Diamond Ring 2-09','Diamond',276.00,'10g','Diamond Ring','products/qqZGt9T4aVKyON48L5Z0OmLktAPpHWZJdxJVzrkN.webp',1,'2026-09-23 06:39:54','2026-09-23 07:23:45',3);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (2,'Swarna 11-Month','Great plan!',11,1000.00,'2026-09-23 03:56:17','2026-09-23 03:56:17'),(3,'Super Saving','Super saving plan!',12,1500.00,'2026-09-24 00:54:03','2026-09-24 00:54:03');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,'50% OFF On Diamond Jewellery',50,'2026-09-24','2026-09-23 06:27:13','2026-09-24 00:37:35');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `gold_rates`
--

LOCK TABLES `gold_rates` WRITE;
/*!40000 ALTER TABLE `gold_rates` DISABLE KEYS */;
INSERT INTO `gold_rates` VALUES (1,7180.00,6589.23,86.50,'2026-09-23 06:24:14','2026-09-23 06:24:14','manual');
/*!40000 ALTER TABLE `gold_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_plans`
--

LOCK TABLES `user_plans` WRITE;
/*!40000 ALTER TABLE `user_plans` DISABLE KEYS */;
INSERT INTO `user_plans` VALUES (1,2,2,2000.00,10000.00,5,'cancelled','2026-09-23','2027-08-23','2026-09-23 03:57:05','2026-09-23 05:28:32'),(2,4,2,1500.00,0.00,0,'cancelled','2026-09-23','2027-08-23','2026-09-23 04:16:50','2026-09-23 04:36:24'),(3,4,2,2000.00,0.00,0,'cancelled','2026-09-23','2027-08-23','2026-09-23 04:37:10','2026-09-23 04:37:26'),(4,2,2,2000.00,6000.00,3,'active','2026-09-23','2027-08-23','2026-09-23 05:29:22','2026-09-23 05:29:28'),(5,2,2,1000.00,0.00,0,'active','2026-09-23','2027-08-23','2026-09-23 05:33:59','2026-09-23 05:33:59');
/*!40000 ALTER TABLE `user_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,2,1,2000.00,'TXN-6AB3B01129409','success','2026-09-23 05:25:13','2026-09-23 05:25:13'),(2,2,1,2000.00,'TXN-6AB3B0130BCF8','success','2026-09-23 05:25:15','2026-09-23 05:25:15'),(3,2,1,2000.00,'TXN-6AB3B015458FC','success','2026-09-23 05:25:17','2026-09-23 05:25:17'),(4,2,1,2000.00,'TXN-6AB3B0183E9A6','success','2026-09-23 05:25:20','2026-09-23 05:25:20'),(5,2,4,2000.00,'TXN-6AB3B10D2AE83','success','2026-09-23 05:29:25','2026-09-23 05:29:25'),(6,2,4,2000.00,'TXN-6AB3B10EB36D6','success','2026-09-23 05:29:26','2026-09-23 05:29:26'),(7,2,4,2000.00,'TXN-6AB3B110571CE','success','2026-09-23 05:29:28','2026-09-23 05:29:28');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (5,5,8,'2026-09-23 23:23:38','2026-09-23 23:23:38'),(6,5,3,'2026-09-23 23:24:34','2026-09-23 23:24:34');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-24 15:59:33
