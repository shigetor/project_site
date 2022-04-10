-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: s
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
-- Table structure for table `acl_classes`
--

DROP TABLE IF EXISTS `acl_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acl_classes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `class_type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_69DD750638A36066` (`class_type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_classes`
--

LOCK TABLES `acl_classes` WRITE;
/*!40000 ALTER TABLE `acl_classes` DISABLE KEYS */;
INSERT INTO `acl_classes` VALUES (1,'App\\Admin\\CategoryAdmin'),(3,'App\\Admin\\CommentAdmin'),(4,'App\\Admin\\OrdersAdmin'),(2,'App\\Admin\\ProductAdmin'),(7,'App\\Entity\\SonataUserUser'),(6,'Sonata\\UserBundle\\Admin\\Entity\\GroupAdmin'),(5,'Sonata\\UserBundle\\Admin\\Entity\\UserAdmin');
/*!40000 ALTER TABLE `acl_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_entries`
--

DROP TABLE IF EXISTS `acl_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acl_entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int unsigned NOT NULL,
  `object_identity_id` int unsigned DEFAULT NULL,
  `security_identity_id` int unsigned NOT NULL,
  `field_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ace_order` smallint unsigned NOT NULL,
  `mask` int NOT NULL,
  `granting` tinyint(1) NOT NULL,
  `granting_strategy` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `audit_success` tinyint(1) NOT NULL,
  `audit_failure` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4` (`class_id`,`object_identity_id`,`field_name`,`ace_order`),
  KEY `IDX_46C8B806EA000B103D9AB4A6DF9183C9` (`class_id`,`object_identity_id`,`security_identity_id`),
  KEY `IDX_46C8B806EA000B10` (`class_id`),
  KEY `IDX_46C8B8063D9AB4A6` (`object_identity_id`),
  KEY `IDX_46C8B806DF9183C9` (`security_identity_id`),
  CONSTRAINT `FK_46C8B8063D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_46C8B806DF9183C9` FOREIGN KEY (`security_identity_id`) REFERENCES `acl_security_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_46C8B806EA000B10` FOREIGN KEY (`class_id`) REFERENCES `acl_classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_entries`
--

LOCK TABLES `acl_entries` WRITE;
/*!40000 ALTER TABLE `acl_entries` DISABLE KEYS */;
INSERT INTO `acl_entries` VALUES (1,1,NULL,1,NULL,0,64,1,'all',0,0),(2,1,NULL,2,NULL,1,8224,1,'all',0,0),(3,1,NULL,3,NULL,2,4098,1,'all',0,0),(4,1,NULL,4,NULL,3,4096,1,'all',0,0),(5,2,NULL,5,NULL,0,64,1,'all',0,0),(6,2,NULL,6,NULL,1,8224,1,'all',0,0),(7,2,NULL,7,NULL,2,4098,1,'all',0,0),(8,2,NULL,8,NULL,3,4096,1,'all',0,0),(9,3,NULL,9,NULL,0,64,1,'all',0,0),(10,3,NULL,10,NULL,1,8224,1,'all',0,0),(11,3,NULL,11,NULL,2,4098,1,'all',0,0),(12,3,NULL,12,NULL,3,4096,1,'all',0,0),(13,4,NULL,13,NULL,0,64,1,'all',0,0),(14,4,NULL,14,NULL,1,8224,1,'all',0,0),(15,4,NULL,15,NULL,2,4098,1,'all',0,0),(16,4,NULL,16,NULL,3,4096,1,'all',0,0),(17,5,NULL,17,NULL,0,64,1,'all',0,0),(18,5,NULL,18,NULL,1,8224,1,'all',0,0),(19,5,NULL,19,NULL,2,4098,1,'all',0,0),(20,5,NULL,20,NULL,3,4096,1,'all',0,0),(21,6,NULL,21,NULL,0,64,1,'all',0,0),(22,6,NULL,22,NULL,1,8224,1,'all',0,0),(23,6,NULL,23,NULL,2,4098,1,'all',0,0),(24,6,NULL,24,NULL,3,4096,1,'all',0,0),(25,7,NULL,17,NULL,0,64,1,'all',0,0),(26,7,NULL,18,NULL,1,32,1,'all',0,0),(27,7,NULL,19,NULL,2,4,1,'all',0,0),(28,7,NULL,20,NULL,3,1,1,'all',0,0),(29,7,8,25,NULL,0,128,1,'all',0,0);
/*!40000 ALTER TABLE `acl_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_object_identities`
--

DROP TABLE IF EXISTS `acl_object_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acl_object_identities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_object_identity_id` int unsigned DEFAULT NULL,
  `class_id` int unsigned NOT NULL,
  `object_identifier` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `entries_inheriting` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9407E5494B12AD6EA000B10` (`object_identifier`,`class_id`),
  KEY `IDX_9407E54977FA751A` (`parent_object_identity_id`),
  CONSTRAINT `FK_9407E54977FA751A` FOREIGN KEY (`parent_object_identity_id`) REFERENCES `acl_object_identities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_object_identities`
--

LOCK TABLES `acl_object_identities` WRITE;
/*!40000 ALTER TABLE `acl_object_identities` DISABLE KEYS */;
INSERT INTO `acl_object_identities` VALUES (1,NULL,1,'admin.category',1),(2,NULL,2,'admin.product',1),(3,NULL,3,'admin.comment',1),(4,NULL,4,'admin.orders',1),(5,NULL,5,'sonata.user.admin.user',1),(6,NULL,6,'sonata.user.admin.group',1),(7,NULL,7,'3',1),(8,NULL,7,'4',1);
/*!40000 ALTER TABLE `acl_object_identities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_object_identity_ancestors`
--

DROP TABLE IF EXISTS `acl_object_identity_ancestors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acl_object_identity_ancestors` (
  `object_identity_id` int unsigned NOT NULL,
  `ancestor_id` int unsigned NOT NULL,
  PRIMARY KEY (`object_identity_id`,`ancestor_id`),
  KEY `IDX_825DE2993D9AB4A6` (`object_identity_id`),
  KEY `IDX_825DE299C671CEA1` (`ancestor_id`),
  CONSTRAINT `FK_825DE2993D9AB4A6` FOREIGN KEY (`object_identity_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_825DE299C671CEA1` FOREIGN KEY (`ancestor_id`) REFERENCES `acl_object_identities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_object_identity_ancestors`
--

LOCK TABLES `acl_object_identity_ancestors` WRITE;
/*!40000 ALTER TABLE `acl_object_identity_ancestors` DISABLE KEYS */;
INSERT INTO `acl_object_identity_ancestors` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8);
/*!40000 ALTER TABLE `acl_object_identity_ancestors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acl_security_identities`
--

DROP TABLE IF EXISTS `acl_security_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acl_security_identities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8835EE78772E836AF85E0677` (`identifier`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_security_identities`
--

LOCK TABLES `acl_security_identities` WRITE;
/*!40000 ALTER TABLE `acl_security_identities` DISABLE KEYS */;
INSERT INTO `acl_security_identities` VALUES (25,'App\\Entity\\SonataUserUser-admin',1),(1,'ROLE_ADMIN_CATEGORY_ADMIN',0),(2,'ROLE_ADMIN_CATEGORY_EDITOR',0),(4,'ROLE_ADMIN_CATEGORY_GUEST',0),(3,'ROLE_ADMIN_CATEGORY_STAFF',0),(9,'ROLE_ADMIN_COMMENT_ADMIN',0),(10,'ROLE_ADMIN_COMMENT_EDITOR',0),(12,'ROLE_ADMIN_COMMENT_GUEST',0),(11,'ROLE_ADMIN_COMMENT_STAFF',0),(13,'ROLE_ADMIN_ORDERS_ADMIN',0),(14,'ROLE_ADMIN_ORDERS_EDITOR',0),(16,'ROLE_ADMIN_ORDERS_GUEST',0),(15,'ROLE_ADMIN_ORDERS_STAFF',0),(5,'ROLE_ADMIN_PRODUCT_ADMIN',0),(6,'ROLE_ADMIN_PRODUCT_EDITOR',0),(8,'ROLE_ADMIN_PRODUCT_GUEST',0),(7,'ROLE_ADMIN_PRODUCT_STAFF',0),(21,'ROLE_SONATA_USER_ADMIN_GROUP_ADMIN',0),(22,'ROLE_SONATA_USER_ADMIN_GROUP_EDITOR',0),(24,'ROLE_SONATA_USER_ADMIN_GROUP_GUEST',0),(23,'ROLE_SONATA_USER_ADMIN_GROUP_STAFF',0),(17,'ROLE_SONATA_USER_ADMIN_USER_ADMIN',0),(18,'ROLE_SONATA_USER_ADMIN_USER_EDITOR',0),(20,'ROLE_SONATA_USER_ADMIN_USER_GUEST',0),(19,'ROLE_SONATA_USER_ADMIN_USER_STAFF',0);
/*!40000 ALTER TABLE `acl_security_identities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`),
  CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (3,'Смартфоны гаджеты',NULL,'2022-03-07 16:31:38','2022-03-07 16:33:22',1),(4,'Телевизоры',NULL,'2022-03-07 16:31:54','2022-03-07 16:31:54',1),(5,'Ноутбуки и компьютеры',NULL,'2022-03-07 16:32:07','2022-03-07 16:32:07',1),(6,'Аксессуары',NULL,'2022-03-07 16:32:36','2022-03-07 16:32:36',1),(7,'Смартфоны Samsung',3,'2022-03-07 16:33:50','2022-03-07 16:33:50',1),(8,'Apple Iphone',3,'2022-03-07 16:34:14','2022-03-07 16:34:14',1),(9,'Все телевизоры',4,'2022-03-07 16:34:41','2022-03-07 16:34:41',1),(10,'Домашние кинотеатры',4,'2022-03-07 16:35:11','2022-03-07 16:35:11',1),(11,'Ноутбуки',5,'2022-03-07 16:35:36','2022-03-07 16:35:36',1),(12,'Персональные компьютеры',5,'2022-03-07 16:35:52','2022-03-07 16:35:52',1),(13,'Наушники',6,'2022-03-07 16:36:09','2022-03-07 16:36:09',1),(14,'Аксессуары для дома',6,'2022-03-07 16:36:38','2022-03-07 16:36:38',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text_comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `rate` int NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C4584665A` (`product_id`),
  CONSTRAINT `FK_9474526C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user__group`
--

DROP TABLE IF EXISTS `fos_user__group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fos_user__group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CDA27E965E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user__group`
--

LOCK TABLES `fos_user__group` WRITE;
/*!40000 ALTER TABLE `fos_user__group` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_user__group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user__user`
--

DROP TABLE IF EXISTS `fos_user__user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fos_user__user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data` json DEFAULT NULL,
  `twitter_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data` json DEFAULT NULL,
  `gplus_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data` json DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E54BFDA992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_E54BFDA9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_E54BFDA9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user__user`
--

LOCK TABLES `fos_user__user` WRITE;
/*!40000 ALTER TABLE `fos_user__user` DISABLE KEYS */;
INSERT INTO `fos_user__user` VALUES (3,'admin','admin','sash.koirev.ru@gmail.com','sash.koirev.ru@gmail.com',1,'4TM1AsQw8M1HJbiFLzV1gd8BvWhA6ywSKdolK5mFJBA','shhBXE41QHaDaYVJrpNFKJ4bb4aqAHZOpbyR8jGBjKnwoOa6HWxCrtK5sflSBbiAL9VTPod0jTG9co3HwNZjQA==','2022-03-10 21:04:54','eT1XXi87jgGOlkSXLU_O5QRB63WnrG02XxaK26gKU48','2022-03-09 15:59:30','a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}','2022-03-08 12:33:21','2022-03-10 21:04:54',NULL,NULL,NULL,NULL,NULL,'m',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'sasha','sasha','sash.kozizrev.grut@gmail.com','sash.kozizrev.grut@gmail.com',1,'oL3646F1EXBfaecsfBeBD1cxO.p0vzO2baTTR9iNxZw','X0x0TFzE/1LHclngTBPgrZLrT4RoxkRCZXyJtLD3qDeTVjQAIefsjo9I246LXL91PbNjUGJUskjj/aN0Gu+p7w==','2022-03-10 20:53:30',NULL,NULL,'a:0:{}','2022-03-09 16:54:13','2022-03-10 20:53:30',NULL,NULL,NULL,NULL,NULL,'m',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fos_user__user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user_user`
--

DROP TABLE IF EXISTS `fos_user_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fos_user_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_C560D761C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user_user`
--

LOCK TABLES `fos_user_user` WRITE;
/*!40000 ALTER TABLE `fos_user_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_user_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user_user_group`
--

DROP TABLE IF EXISTS `fos_user_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fos_user_user_group` (
  `user_id` int NOT NULL,
  `group_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_B3C77447A76ED395` (`user_id`),
  KEY `IDX_B3C77447FE54D947` (`group_id`),
  CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user__user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user__group` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user_user_group`
--

LOCK TABLES `fos_user_user_group` WRITE;
/*!40000 ALTER TABLE `fos_user_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `fos_user_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `name_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD727ACA70` (`parent_id`),
  CONSTRAINT `FK_D34A04AD727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (2,11,'Lenovo IdeaPad Gaming','Мощный и современный ноутбук для комфортной работы'),(3,11,'Ноутбук Acer Swift 1','Acer Swift 1 – лёгкий и ультратонкий ноутбук для работы и развлечений. Он весит всего 1,3 кг, а толщина корпуса составляет 15 мм – положите мобильный компьютер в сумку и отправляйтесь в командировку или поездку.'),(4,8,'Phone 11 128GB Black (MHDH3RU/A)','iOS 15\r\nподдержка двух SIM-карт (nano SIM+eSIM)\r\nэкран 6.7\", разрешение 2778x1284\r\n3 камеры: сверхширокоугольная (12 МП), широкоугольная, телефото\r\nпроцессор Apple A15 Bionic'),(5,9,'Телевизор LG 43UP77006LB','Телевизор LG 43UP77006LB показывает чёткое изображение с яркими, насыщенными красками и высокой контрастностью. Его мощный процессор умеет повышать разрешение картинки, удалять шумы и выбирать идеальные настройки для каждого кадра. IPS-матрица с широкими углами обзора гарантирует отличную видимость для любого зрителя в комнате.'),(6,12,'Системный блок игровой ASUS ROG Strix Special G10DK-A3400G053T','Системный блок Asus ROG Strix Special G10DK-A3400G053T готов порадовать геймеров не только мощной начинкой, но и современным дизайном. Очертания корпуса больше напоминают фрагмент футуристичной брони. МАСТЕР НА ВСЕ РУКИ Чтобы у модели не возникало проблем при запуске игр, создатели установили внутри четырёхъядерный процессор'),(7,14,'Сковорода (Jamie Oliver) Tefal 28см (E2110673)','Сковорода Tefal E2110674 входит в премиальную серию посуды Jamie Oliver, в работе над которой принимал участие звезда мировой кулинарии Джейми Оливер. УНИВЕРСАЛЬНОСТЬПрочная сковорода особой формы изготовлена из литого алюминия.'),(8,13,'Наушники Apple AirPods 3-го поколения (MME73RU/A) Apple','Магия. В новой аранжировке. Представляем абсолютно новые AirPods. Технология пространственного аудио окружает звуком со всех сторон. Адаптивный эквалайзер подстраивает музыку персонально под вас. Аккумулятор работает ещё дольше без подзарядки. Наушники не боятся пота и воды. Ощущения просто волшебные.');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_to_orders`
--

DROP TABLE IF EXISTS `product_to_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_to_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_products_id` int DEFAULT NULL,
  `parent_orders_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AD5D47FE7A693D9` (`parent_products_id`),
  KEY `IDX_AD5D47FE3EB5B538` (`parent_orders_id`),
  CONSTRAINT `FK_AD5D47FE3EB5B538` FOREIGN KEY (`parent_orders_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_AD5D47FE7A693D9` FOREIGN KEY (`parent_products_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_to_orders`
--

LOCK TABLES `product_to_orders` WRITE;
/*!40000 ALTER TABLE `product_to_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-10 21:25:16
