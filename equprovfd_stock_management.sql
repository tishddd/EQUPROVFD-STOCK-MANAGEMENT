-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: equprovfd_stock_management
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` varchar(255) NOT NULL,
  `batch_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `batches_batch_id_unique` (`batch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (30,'BAT-2025-03-31','2025-03-31','Auto-generated batch','2025-03-31 04:58:36','2025-03-31 04:58:36');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel_cache_2bygrbylP8vBbd1F','s:7:\"forever\";',2058511845),('laravel_cache_8PKqogEyWE3zzt29','s:7:\"forever\";',2058777597);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_issues`
--

DROP TABLE IF EXISTS `device_issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_issues` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` bigint(20) unsigned NOT NULL,
  `issue_type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','repaired','irreparable') NOT NULL DEFAULT 'pending',
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `device_issues_device_id_foreign` (`device_id`),
  CONSTRAINT `device_issues_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_issues`
--

LOCK TABLES `device_issues` WRITE;
/*!40000 ALTER TABLE `device_issues` DISABLE KEYS */;
/*!40000 ALTER TABLE `device_issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `model_number` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `status` enum('in_office','sold','damaged') NOT NULL DEFAULT 'in_office',
  `region_code` varchar(255) DEFAULT NULL,
  `office_id` bigint(20) unsigned DEFAULT 6,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `user_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sold_price` decimal(10,2) DEFAULT NULL,
  `customer_tin` varchar(20) DEFAULT NULL,
  `sold_date` timestamp NULL DEFAULT NULL,
  `batch_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `devices_serial_number_unique` (`serial_number`),
  KEY `devices_office_id_foreign` (`office_id`),
  KEY `devices_employee_id_foreign` (`employee_id`),
  KEY `devices_batch_id_foreign` (`batch_id`),
  CONSTRAINT `devices_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE SET NULL,
  CONSTRAINT `devices_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `devices_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1092,'Pos','H10S','H10S755248T0077','sold','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-05-14 04:00:29',550000.00,550000.00,'147852369','2025-04-27 21:00:00','BAT-2025-03-31'),(1093,'Pos','H10S','H10S755248T0144','sold','MB',6,NULL,NULL,'2025-03-31 04:58:36','2025-04-28 09:26:27',550000.00,550000.00,'96369632','2025-04-28 21:00:00','BAT-2025-03-31'),(1094,'Pos','H10S','H10S755248T0456','in_office','MB',6,NULL,NULL,'2025-03-31 04:58:36','2025-04-28 08:26:23',550000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1095,'Pos','H10S','H10S755248T0111','in_office','SH',16,NULL,NULL,'2025-03-31 04:58:36','2025-05-07 05:23:33',550000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1096,'Pos','H10S','H10S755248T0020','in_office','SH',2,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',550000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1097,'Pos','H10S','H10S755248T0789','sold','SH',2,NULL,13,'2025-03-31 04:58:36','2025-04-17 06:57:38',550000.00,550000.00,'789653',NULL,'BAT-2025-03-31'),(1098,'Pos','H10S','H10S755248T0258','sold','MO',5,NULL,24,'2025-03-31 04:58:36','2025-03-31 05:04:43',550000.00,550000.00,'114935085','2025-03-31 05:04:43','BAT-2025-03-31'),(1099,'Pos','H10S','H10S755248T8369','sold','MO',5,NULL,24,'2025-03-31 04:58:36','2025-03-31 05:24:37',550000.00,550000.00,'148772983','2025-03-31 05:24:36','BAT-2025-03-31'),(1100,'Pos','H10S','H10S755248T0123','in_office','MW',6,NULL,NULL,'2025-03-31 04:58:36','2025-05-07 05:04:14',550000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1101,'Printer','OCMO','OCM062243100041','in_office','MB',1,NULL,NULL,'2025-03-31 04:58:36','2025-04-17 10:34:24',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1102,'Printer','OCMO','OCM062243100042','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1103,'Printer','OCMO','OCM062243100043','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1104,'Printer','OCMO','OCM062243100044','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1105,'Printer','OCMO','OCM062243100045','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1106,'Printer','OCMO','OCM062243100046','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1107,'Printer','OCMO','OCM062243100047','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1108,'Printer','OCMO','OCM062243100048','in_office','MB',3,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1109,'Printer','OCMO','OCM062243100049','sold','MB',3,NULL,24,'2025-03-31 04:58:36','2025-04-02 04:17:39',150000.00,250000.00,'124325153','2025-04-02 04:17:37','BAT-2025-03-31'),(1110,'Printer','OCMO','OCM062243100050','in_office','DO',4,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1111,'Printer','OCMO','OCM062243100051','in_office','DO',4,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1112,'Printer','OCMO','OCM062243100052','in_office','DO',4,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1113,'Printer','OCMO','OCM062243100053','in_office','DO',4,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1114,'Printer','OCMO','OCM062243100054','in_office','DO',4,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1115,'Printer','OCMO','OCM062243100055','sold','SH',1,NULL,13,'2025-03-31 04:58:36','2025-05-07 05:20:46',150000.00,250000.00,'101604209','2025-03-31 05:40:44','BAT-2025-03-31'),(1116,'Printer','OCMO','OCM062243100056','sold','SH',2,NULL,13,'2025-03-31 04:58:36','2025-03-31 07:41:21',150000.00,250000.00,'142536635','2025-03-31 07:41:20','BAT-2025-03-31'),(1117,'Printer','OCMO','OCM062243100057','in_office','SH',2,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1118,'Printer','OCMO','OCM062243100058','in_office','SH',3,NULL,NULL,'2025-03-31 04:58:36','2025-05-07 05:16:47',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1119,'Printer','OCMO','OCM062243100059','in_office','SH',3,NULL,NULL,'2025-03-31 04:58:36','2025-05-07 05:15:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1120,'Printer','OCMO','OCM062243100060','sold','MW',1,NULL,13,'2025-03-31 04:58:36','2025-04-28 09:00:13',150000.00,150000.00,'789653777',NULL,'BAT-2025-03-31'),(1121,'Printer','OCMO','OCM062243100061','in_office','MW',1,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1122,'Printer','OCMO','OCM062243100062','in_office','MW',1,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1123,'Printer','OCMO','OCM062243100063','in_office','DSM',6,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31'),(1124,'Printer','OCMO','OCM062243100064','in_office','DSM',6,NULL,NULL,'2025-03-31 04:58:36','2025-03-31 04:58:36',150000.00,0.00,NULL,NULL,'BAT-2025-03-31');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_05_093618_create_offices_table',2),(5,'2025_03_05_101022_create_devices_table',3),(6,'2025_03_05_101409_create_transactions_table',4),(7,'2025_03_05_103635_create_device_issues_table',5),(8,'2025_03_13_143220_create_batches_table',6),(9,'2025_03_13_144917_modify_devices_add_foreign_batch_id',7),(10,'2025_03_26_114736_create_user_category_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `region_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
INSERT INTO `offices` VALUES (1,'Equpro','Mwanza','MW','2025-03-06 16:33:13','2025-03-27 06:11:40'),(2,'Kahama','Shinyanga','SH','2025-03-06 16:33:39','2025-03-27 06:11:33'),(3,'Equpro','Mbeya','MB','2025-03-06 16:34:59','2025-03-27 05:21:35'),(4,'Equpro','Dodoma','DO','2025-03-06 16:35:10','2025-03-06 16:35:10'),(5,'Equpro','Morogoro','MO','2025-03-06 16:35:23','2025-03-06 16:35:23'),(6,'Equpro','Dsm','DSM','2025-03-13 08:13:59','2025-03-13 08:13:59'),(12,'equpro','Segerea','SG','2025-04-03 09:37:54','2025-04-03 09:37:54'),(13,'equpro','Goba','GOB','2025-04-03 09:38:47','2025-04-03 09:38:47'),(14,'equpro','Pwani','PWN','2025-04-03 09:39:48','2025-04-03 09:39:48'),(15,'equpro','Msata','MST','2025-04-03 09:40:26','2025-04-03 09:40:26'),(16,'equpro','Ifakala-Kilosa','IFKL','2025-04-03 09:41:44','2025-04-03 09:41:44'),(17,'equpro','Chalinze','CHZ','2025-04-03 09:42:35','2025-04-03 09:42:35'),(18,'equpro','Tuliani','TLN','2025-04-03 09:42:57','2025-04-03 09:42:57'),(19,'equpro','Iringa','ING','2025-04-03 09:43:36','2025-04-03 09:43:36'),(21,'equpro','Ifakala','IFKL','2025-04-03 09:46:24','2025-04-03 09:46:24');
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1SZPmXujW8zfOXUuUGavMzJaDRLHXLOUMlYvBk9j',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSG9pb3pGSGtST3JGMGdhRzQxVjZDMERhSFFzbG1YTUU0UnRCMFdFNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747208795),('2kmRp0PT9zvCcpgtQIU8idcTWD3jzXyrLNK0fUzf',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidWxxVmgxQ2ZhR1R4Tm9lRlp2d1JuZGp4MzZ1b0RkQ0xaZ0tXSUtGcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1747206171),('AWGCPF3MMSjxu7bfrhrkpyb1xSlZC2lNBsB8jLpd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmRnUDB4Q3RZWmxSdTQydEt0bGJsZXVFQzFwNGxDTVU3bFFHVVg2VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747208794),('azTtNo0UOPEeo9wd8Tgc8MpMXBunErWhkqul5HSC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFRVWE5vU3M5Z0p4U0N0TE9zMW5SSUxmTGNqMm0xNFlFRjdHY1c3ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747208794),('DeR03BjvDYctWoPScJjbTigO7KolbVzXZKqVKrLo',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRk9EeVBMbTBmZDQ0SUtoWDBvbjFsS2ExT1FVd3FxbVVsWVdKQzVwVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1747205716),('qD5IBLhCCkCFAa2BDfoQnuGo2OHIXp2hpTi6P9Aq',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnhKbXFHT0FlRnh6b1FKYjRza0pFZmh4UXJ4VGsyTGhFRUFQck00UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1746607594),('VGMOiEDDNZYcasuHhciqFbhqUxTexGXcQJ6i6PzX',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmZnWG92Y3JQOFIzRkRRdE1uWFI0UzlmS3ZUYURWbUJBc09jVGFORSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747205521),('YLxaV1243JHoxX11Unf2av82LrDBY4dgbXGopsHi',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVJuQTNRYmtxOGF0RHBNUndMWmNOZHhyT0laUXdKQzlVYXRGRnY3SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747208794),('ZT2edigGVwQzL7wPlKQSkls2kceTO6jv2C6rYXqd',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2dESkFaeHFLYmp1a0FHbGlWcUlHUm5BdWlVc0tMVVJGYWp3eG15TCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747208793);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `device_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `region` varchar(255) NOT NULL,
  `customer_tin` varchar(255) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('sent','sold') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_device_id_foreign` (`device_id`),
  KEY `transactions_employee_id_foreign` (`employee_id`),
  CONSTRAINT `transactions_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_category`
--

DROP TABLE IF EXISTS `user_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_category`
--

LOCK TABLES `user_category` WRITE;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
INSERT INTO `user_category` VALUES (1,'Admin','control everything','2025-03-26 09:55:23','2025-03-26 09:55:23'),(2,'store keeper','manage stock','2025-03-26 09:57:10','2025-03-26 09:57:10');
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_code` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `user_code` (`user_code`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `user_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,13,'Muumini Mwinyi','info@equprostock.com',NULL,'$2y$12$K6xWUd1zQ1D7fjIPVrZbyu7wL8tY9loYypWSbGr/sANNWJj7ez6RG',NULL,'2025-03-06 08:13:34','2025-03-28 04:47:09',NULL),(23,14,'Simon Gasomi','managervfd@equprovfd.co.tz',NULL,'$2y$12$LpyOXZcRL8cMUCi145OywudGD3btuCSdWOdaMf0ekVvWRoi45zqJC',NULL,'2025-03-28 04:44:31','2025-03-28 04:44:31',NULL),(24,15,'albert chuwa','albert@equprovfd.co.tz',NULL,'$2y$12$0ZOnQ5nxYKpIKJl0/dRxbuE2g.fFNC407D5U23.SjWDo/Bhhfsp9u',NULL,'2025-03-28 04:45:32','2025-03-28 04:45:32',NULL),(25,16,'Lazaro mbida','mbida@equprovfd.co.tz',NULL,'$2y$12$orealMhAcVDnNLkALvWRb.L2hG6VrePvO3lp2xxv.HwAgDCBdoRfC',NULL,'2025-03-28 04:46:33','2025-03-28 04:46:33',NULL),(26,17,'Salome Sinde','salome@equprovfd.co.tz',NULL,'$2y$12$DIbgZNPuND5fgbvOV6mW/e7UNWq.dx2cvPWWFQO/bUzVcN/QeYMjC',NULL,'2025-03-28 04:47:48','2025-03-28 04:47:48',NULL),(27,18,'fransis Paulo','fransis@equprovfd.co.tz',NULL,'$2y$12$AI4Cr.7ivMpMtzhTMoFSn.HPrAaGWALWEBeRcSHm0cNsBYErA8Nk6',NULL,'2025-03-28 04:48:53','2025-03-28 04:48:53',NULL),(28,19,'Manson Jackson','manson@equprovfd.co.tz',NULL,'$2y$12$wuoo27L2xquwi9Py9xCBJuXD7FWa7165F41AwpCsn.9tQ2zShxtDO',NULL,'2025-03-28 04:49:45','2025-03-28 04:49:45',NULL),(29,20,'John Majaliwa','john@equprovfd.co.tz',NULL,'$2y$12$iP561AxgQpg2LfO13ZrZ7u4xqBP4y0mSHcbDP.z4e/Cw2f7yK2SGm',NULL,'2025-03-28 04:50:38','2025-03-28 04:50:38',NULL),(30,24,'elasto damas','elasto@yahoo.com',NULL,'$2y$12$ExXFB3dLhTokYGWq4xOzVeQCKFHaczIJ26h.j87gI1qcW0b0ti0IS',NULL,'2025-03-31 03:35:07','2025-03-31 03:35:07',NULL);
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

-- Dump completed on 2025-05-24 16:31:53
