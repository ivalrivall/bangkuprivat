-- MySQL dump 10.13  Distrib 8.0.26, for macos11.3 (x86_64)
--
-- Host: localhost    Database: bangkuprivat
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `detail_alamat`
--

DROP TABLE IF EXISTS `detail_alamat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_alamat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alamat_detail` text NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_alamat`
--

LOCK TABLES `detail_alamat` WRITE;
/*!40000 ALTER TABLE `detail_alamat` DISABLE KEYS */;
INSERT INTO `detail_alamat` VALUES (16,'Pondok Aren','Banten','Kota Tangerang Selatan','Pondok Aren','Pondok Aren','2021-09-04 08:24:54','2021-09-04 08:24:54'),(17,'Jl. Cendrawasih 5','Banten','Tangerang','Tigaraksa','Margasari','2021-09-04 12:28:12','2021-09-04 12:28:12'),(18,'Jl. Raya Dayeuh, Desa Sukanegara, Kec. Jonggol, Kab. Bogor.','Jawa Barat','Kabupaten Bogor','Kecamatan Jonggol','Desa Sukanegara','2021-09-04 12:54:07','2021-09-04 12:54:07'),(19,'Islamic Village Tangerang','Banten','Kab. Tangerang','Kelapa dua','Kelapa Dua','2021-09-04 13:21:19','2021-09-04 13:21:19'),(20,'Sapugarut, Pekalongan','Jawa Tengah','Kabupaten Pekalongan','Kecamatan Buaran','Sapugarut','2021-09-04 14:18:02','2021-09-04 14:18:02'),(21,'Bintaro Pondok Aren','Banten','Kota Tangerang Selatan','Bintaro','Pondok Aren','2021-09-04 14:36:54','2021-09-04 14:36:54'),(22,'Kedoya Selatan Kebon Jeruk, Jakarta Barat, DKI Jakarta','DKI Jakarta','Jakarta Barat','Kebon Jeruk','Kedoya Selatan','2021-09-04 20:57:08','2021-09-04 20:57:08'),(23,'Tebet, Jakarta Selatan, DKI Jakarta','DKI Jakarta','Jakarta Selatan','Kecamatan Tebet','Manggarai','2021-09-04 21:18:59','2021-09-04 21:18:59'),(24,'Langsa Aceh','Aceh','Kota Langsa','Langsa Barat','Langsa','2021-09-04 22:07:11','2021-09-04 22:07:11'),(25,'Jl. Nakula Blok Akf. 11 No. 04 Perum Pws Tigaraksa','Banten','Kabupaten Tangerang','Tigaraksa','Margasari','2021-09-04 22:13:35','2021-09-04 22:13:35'),(26,'Klaten Jawa Tengah','Jawa Tengah','Klaten','Klaten','Klaten','2021-09-04 22:17:40','2021-09-04 22:17:40'),(27,'Bumi Pasar Kemis Indah, Blok E4 No. 7, Pasar Kemis Tangerang, Indonesia','Banten','Kabupaten Tangerang','Pasar Kemis','Pasar Kemis','2021-09-05 06:01:20','2021-09-05 06:01:20'),(28,'Kp.Cibunar Kompa RT 002 / RW 001 Desa Cibunar. Kec Parung Panjang','Jawa Barat','Kabupaten Bogor','Kec Parung Panjang','Desa Cibunar','2021-09-05 06:14:46','2021-09-05 06:14:46'),(29,'Jl. Anggrek III Blok AiF 6 No 13, RT 003 RW 003','Banten','Tangerang','Tigaraksa','Margasari','2021-09-05 08:05:09','2021-09-05 08:05:09');
/*!40000 ALTER TABLE `detail_alamat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_hari`
--

DROP TABLE IF EXISTS `detail_hari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_hari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `detail_mentor_id` int NOT NULL,
  `hari_id` int NOT NULL,
  `start_jam` time DEFAULT NULL,
  `end_jam` time DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_hari_tbl_detail_mentor1_idx` (`detail_mentor_id`),
  KEY `fk_detail_hari_master_hari1_idx` (`hari_id`),
  CONSTRAINT `fk_detail_hari_master_hari1` FOREIGN KEY (`hari_id`) REFERENCES `master_hari` (`id`),
  CONSTRAINT `fk_detail_hari_tbl_detail_mentor1` FOREIGN KEY (`detail_mentor_id`) REFERENCES `tbl_detail_mentor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_hari`
--

LOCK TABLES `detail_hari` WRITE;
/*!40000 ALTER TABLE `detail_hari` DISABLE KEYS */;
INSERT INTO `detail_hari` VALUES (46,15,1,'08:00:00','13:00:00','2021-09-04 12:33:19','2021-09-04 12:33:19'),(47,15,2,'09:30:00','21:00:00','2021-09-04 12:33:19','2021-09-04 12:33:19'),(48,15,3,'10:00:00','23:00:00','2021-09-04 12:33:19','2021-09-04 12:33:19'),(49,16,1,'08:00:00','17:00:00','2021-09-04 13:01:02','2021-09-04 13:01:02'),(50,16,2,'08:00:00','17:00:00','2021-09-04 13:01:02','2021-09-04 13:01:02'),(51,16,3,'08:00:00','17:00:00','2021-09-04 13:01:02','2021-09-04 13:01:02'),(52,16,4,'08:00:00','17:00:00','2021-09-04 13:01:02','2021-09-04 13:01:02'),(53,16,5,'08:00:00','17:00:00','2021-09-04 13:01:02','2021-09-04 13:01:02'),(54,17,6,'08:00:00','12:00:00','2021-09-04 13:45:11','2021-09-04 13:45:11'),(55,17,7,'08:00:00','12:00:00','2021-09-04 13:45:11','2021-09-04 13:45:11'),(56,18,6,'08:00:00','17:00:00','2021-09-04 14:26:58','2021-09-04 14:26:58'),(57,18,7,'08:00:00','17:00:00','2021-09-04 14:26:58','2021-09-04 14:26:58'),(58,19,6,'08:00:00','10:00:00','2021-09-04 14:41:56','2021-09-04 14:41:56'),(59,19,7,'08:00:00','15:00:00','2021-09-04 14:41:56','2021-09-04 14:41:56'),(60,20,6,'08:00:00','17:00:00','2021-09-04 21:04:21','2021-09-04 21:04:21'),(61,20,7,'08:00:00','17:00:00','2021-09-04 21:04:21','2021-09-04 21:04:21'),(62,21,5,'18:00:00','22:00:00','2021-09-04 21:25:25','2021-09-04 21:25:25'),(63,21,6,'08:00:00','13:00:00','2021-09-04 21:25:25','2021-09-04 21:25:25'),(64,21,7,'08:00:00','11:00:00','2021-09-04 21:25:25','2021-09-04 21:25:25'),(65,22,5,'13:00:00','20:00:00','2021-09-04 22:09:43','2021-09-04 22:09:43'),(66,22,6,'08:00:00','11:00:00','2021-09-04 22:09:43','2021-09-04 22:09:43'),(67,22,7,'08:00:00','15:00:00','2021-09-04 22:09:43','2021-09-04 22:09:43'),(70,23,6,'15:00:00','17:00:00','2021-09-05 06:08:32','2021-09-05 06:08:32'),(71,23,7,'10:00:00','12:00:00','2021-09-05 06:08:32','2021-09-05 06:08:32'),(72,24,6,'08:00:00','17:00:00','2021-09-05 06:17:02','2021-09-05 06:17:02'),(73,24,7,'08:00:00','17:00:00','2021-09-05 06:17:02','2021-09-05 06:17:02'),(74,25,6,'07:00:00','17:00:00','2021-09-05 08:11:16','2021-09-05 08:11:16'),(75,25,7,'19:00:00','17:00:00','2021-09-05 08:11:16','2021-09-05 08:11:16');
/*!40000 ALTER TABLE `detail_hari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_reservasi`
--

DROP TABLE IF EXISTS `detail_reservasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_reservasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservasi_id` int NOT NULL,
  `hari_id` int NOT NULL,
  `start_jam` time NOT NULL,
  `end_jam` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservasi_id` (`reservasi_id`),
  KEY `hari_id` (`hari_id`),
  CONSTRAINT `detail_reservasi_ibfk_2` FOREIGN KEY (`reservasi_id`) REFERENCES `tbl_reservasi` (`id`),
  CONSTRAINT `detail_reservasi_ibfk_3` FOREIGN KEY (`hari_id`) REFERENCES `master_hari` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_reservasi`
--

LOCK TABLES `detail_reservasi` WRITE;
/*!40000 ALTER TABLE `detail_reservasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_reservasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_skill`
--

DROP TABLE IF EXISTS `detail_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `detail_mentor_id` int NOT NULL,
  `skill_id` int NOT NULL,
  `lama_pengalaman` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_skill_tbl_detail_mentor1_idx` (`detail_mentor_id`),
  KEY `fk_detail_skill_master_skill1_idx` (`skill_id`),
  CONSTRAINT `fk_detail_skill_master_skill1` FOREIGN KEY (`skill_id`) REFERENCES `master_skill` (`id`),
  CONSTRAINT `fk_detail_skill_tbl_detail_mentor1` FOREIGN KEY (`detail_mentor_id`) REFERENCES `tbl_detail_mentor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_skill`
--

LOCK TABLES `detail_skill` WRITE;
/*!40000 ALTER TABLE `detail_skill` DISABLE KEYS */;
INSERT INTO `detail_skill` VALUES (40,15,70,10,'2021-09-04 12:33:19','2021-09-04 12:33:19'),(41,16,69,6,'2021-09-04 13:01:02','2021-09-04 13:01:02'),(42,16,73,5,'2021-09-04 13:01:02','2021-09-04 13:01:02'),(43,17,85,4,'2021-09-04 13:45:11','2021-09-04 13:45:11'),(44,17,92,1,'2021-09-04 13:45:11','2021-09-04 13:45:11'),(45,18,91,7,'2021-09-04 14:26:58','2021-09-04 14:26:58'),(46,18,70,2,'2021-09-04 14:26:58','2021-09-04 14:26:58'),(47,18,92,2,'2021-09-04 14:26:58','2021-09-04 14:26:58'),(48,19,70,7,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(49,19,91,7,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(50,19,63,7,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(51,19,39,7,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(52,20,93,7,'2021-09-04 21:04:21','2021-09-04 21:04:21'),(53,20,57,7,'2021-09-04 21:04:21','2021-09-04 21:04:21'),(54,20,92,7,'2021-09-04 21:04:21','2021-09-04 21:04:21'),(55,21,44,20,'2021-09-04 21:25:25','2021-09-04 21:25:25'),(56,21,82,20,'2021-09-04 21:25:25','2021-09-04 21:25:25'),(57,21,63,20,'2021-09-04 21:25:25','2021-09-04 21:25:25'),(58,22,118,3,'2021-09-04 22:09:43','2021-09-04 22:09:43'),(62,23,70,2,'2021-09-05 06:08:32','2021-09-05 06:08:32'),(63,23,69,2,'2021-09-05 06:08:32','2021-09-05 06:08:32'),(64,23,73,2,'2021-09-05 06:08:32','2021-09-05 06:08:32'),(65,24,74,1,'2021-09-05 06:17:02','2021-09-05 06:17:02'),(66,25,91,2,'2021-09-05 08:11:16','2021-09-05 08:11:16'),(67,25,74,1,'2021-09-05 08:11:16','2021-09-05 08:11:16'),(68,25,36,1,'2021-09-05 08:11:16','2021-09-05 08:11:16');
/*!40000 ALTER TABLE `detail_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_tipe_pengajaran`
--

DROP TABLE IF EXISTS `detail_tipe_pengajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_tipe_pengajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `detail_mentor_id` int NOT NULL,
  `tipe_pengajaran_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_mentor_id` (`detail_mentor_id`),
  KEY `tipe_pengajaran_id` (`tipe_pengajaran_id`),
  CONSTRAINT `detail_tipe_pengajaran_ibfk_1` FOREIGN KEY (`detail_mentor_id`) REFERENCES `tbl_detail_mentor` (`id`),
  CONSTRAINT `detail_tipe_pengajaran_ibfk_2` FOREIGN KEY (`tipe_pengajaran_id`) REFERENCES `master_tipe_pengajaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_tipe_pengajaran`
--

LOCK TABLES `detail_tipe_pengajaran` WRITE;
/*!40000 ALTER TABLE `detail_tipe_pengajaran` DISABLE KEYS */;
INSERT INTO `detail_tipe_pengajaran` VALUES (29,15,1,'2021-09-04 12:33:19','2021-09-04 12:33:19'),(30,15,2,'2021-09-04 12:33:19','2021-09-04 12:33:19'),(31,16,1,'2021-09-04 13:01:02','2021-09-04 13:01:02'),(32,16,2,'2021-09-04 13:01:02','2021-09-04 13:01:02'),(33,17,1,'2021-09-04 13:45:11','2021-09-04 13:45:11'),(34,17,2,'2021-09-04 13:45:11','2021-09-04 13:45:11'),(35,18,1,'2021-09-04 14:26:58','2021-09-04 14:26:58'),(36,18,2,'2021-09-04 14:26:58','2021-09-04 14:26:58'),(37,19,1,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(38,19,2,'2021-09-04 14:41:56','2021-09-04 14:41:56'),(39,20,1,'2021-09-04 21:04:21','2021-09-04 21:04:21'),(40,20,2,'2021-09-04 21:04:21','2021-09-04 21:04:21'),(41,21,1,'2021-09-04 21:25:25','2021-09-04 21:25:25'),(42,21,2,'2021-09-04 21:25:25','2021-09-04 21:25:25'),(43,22,1,'2021-09-04 22:09:43','2021-09-04 22:09:43'),(44,22,2,'2021-09-04 22:09:43','2021-09-04 22:09:43'),(47,23,1,'2021-09-05 06:08:32','2021-09-05 06:08:32'),(48,23,2,'2021-09-05 06:08:32','2021-09-05 06:08:32'),(49,24,1,'2021-09-05 06:17:02','2021-09-05 06:17:02'),(50,24,2,'2021-09-05 06:17:02','2021-09-05 06:17:02'),(51,25,1,'2021-09-05 08:11:16','2021-09-05 08:11:16'),(52,25,2,'2021-09-05 08:11:16','2021-09-05 08:11:16');
/*!40000 ALTER TABLE `detail_tipe_pengajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_gender`
--

DROP TABLE IF EXISTS `master_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_gender`
--

LOCK TABLES `master_gender` WRITE;
/*!40000 ALTER TABLE `master_gender` DISABLE KEYS */;
INSERT INTO `master_gender` VALUES (1,'Pria'),(2,'Wanita');
/*!40000 ALTER TABLE `master_gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_hari`
--

DROP TABLE IF EXISTS `master_hari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_hari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hari` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_hari`
--

LOCK TABLES `master_hari` WRITE;
/*!40000 ALTER TABLE `master_hari` DISABLE KEYS */;
INSERT INTO `master_hari` VALUES (1,'Senin'),(2,'Selasa'),(3,'Rabu'),(4,'Kamis'),(5,'Jumat'),(6,'Sabtu'),(7,'Minggu');
/*!40000 ALTER TABLE `master_hari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_kebutuhan`
--

DROP TABLE IF EXISTS `master_kebutuhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_kebutuhan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kebutuhan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_kebutuhan`
--

LOCK TABLES `master_kebutuhan` WRITE;
/*!40000 ALTER TABLE `master_kebutuhan` DISABLE KEYS */;
INSERT INTO `master_kebutuhan` VALUES (1,'Mentoring Belajar','2021-07-15 14:55:17',NULL),(2,'Penyelesaian Masalah (Tugas, Pekerjaan, dll)','2021-07-15 14:55:21',NULL),(3,'Memperdalam Keahlian','2021-07-15 14:55:50',NULL);
/*!40000 ALTER TABLE `master_kebutuhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_level`
--

DROP TABLE IF EXISTS `master_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_level`
--

LOCK TABLES `master_level` WRITE;
/*!40000 ALTER TABLE `master_level` DISABLE KEYS */;
INSERT INTO `master_level` VALUES (1,'Umum'),(2,'Mentor'),(3,'Admin');
/*!40000 ALTER TABLE `master_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_skill`
--

DROP TABLE IF EXISTS `master_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `skill` varchar(45) NOT NULL,
  `status_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_master_skill_master_status1_idx` (`status_id`),
  CONSTRAINT `fk_master_skill_master_status1` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_skill`
--

LOCK TABLES `master_skill` WRITE;
/*!40000 ALTER TABLE `master_skill` DISABLE KEYS */;
INSERT INTO `master_skill` VALUES (7,'.NET',2,'2021-07-15 14:57:57',NULL),(8,'.NET Core',2,'2021-07-15 14:58:53',NULL),(9,'Alibaba Cloud',2,'2021-07-15 14:59:17',NULL),(10,'Amazon DynamoDB',2,'2021-07-15 14:59:37',NULL),(11,'Amazon RDS/Aurora',2,'2021-07-15 14:59:57',NULL),(12,'Amazon Redshift',2,'2021-07-15 15:00:33',NULL),(14,'Angular',2,'2021-07-15 15:01:26',NULL),(16,'MySQL',2,'2021-07-15 15:01:53',NULL),(17,'Apache Hbase',2,'2021-07-15 15:02:24',NULL),(19,'Apache Hive',2,'2021-07-15 15:03:07',NULL),(20,'ASP .NET',2,'2021-07-15 15:03:56',NULL),(21,'Assembly',2,'2021-07-15 15:04:23',NULL),(22,'AWS Cloud',2,'2021-07-15 15:04:57',NULL),(23,'Bash/Shell',2,'2021-07-15 15:05:17',NULL),(24,'Boostrap',2,'2021-07-15 15:06:17',NULL),(25,'BSD/Unix',2,'2021-07-15 15:07:33',NULL),(26,'Business Analyst',2,'2021-07-15 15:08:07',NULL),(28,'C',2,'2021-07-15 15:08:45',NULL),(29,'C#',2,'2021-07-15 15:09:32',NULL),(31,'C++',2,'2021-08-23 14:22:01',NULL),(33,'Cassandra',2,'0000-00-00 00:00:00',NULL),(34,'CEO',2,'0000-00-00 00:00:00',NULL),(35,'Clojure',2,'0000-00-00 00:00:00',NULL),(36,'CodeIgniter',2,'0000-00-00 00:00:00',NULL),(37,'Construct',2,'0000-00-00 00:00:00',NULL),(38,'Cordova',2,'0000-00-00 00:00:00',NULL),(39,'CSS',2,'0000-00-00 00:00:00',NULL),(40,'CTO',2,'0000-00-00 00:00:00',NULL),(41,'Dart',2,'0000-00-00 00:00:00',NULL),(42,'Data Analyst',2,'0000-00-00 00:00:00',NULL),(43,'Data Scientist',2,'0000-00-00 00:00:00',NULL),(44,'Database Administrator',2,'0000-00-00 00:00:00',NULL),(45,'Delphi',2,'0000-00-00 00:00:00',NULL),(46,'DevOps Specialist',2,'0000-00-00 00:00:00',NULL),(47,'Django',2,'0000-00-00 00:00:00',NULL),(48,'Docker',2,'0000-00-00 00:00:00',NULL),(49,'Elasticsearch',2,'0000-00-00 00:00:00',NULL),(50,'Engineering Manager',2,'0000-00-00 00:00:00',NULL),(51,'Erlang',2,'0000-00-00 00:00:00',NULL),(52,'Express.js',2,'0000-00-00 00:00:00',NULL),(53,'F#',2,'0000-00-00 00:00:00',NULL),(54,'Firebase',2,'0000-00-00 00:00:00',NULL),(55,'Full-stack Development\r\n',2,'0000-00-00 00:00:00',NULL),(56,'GIT',2,'0000-00-00 00:00:00',NULL),(57,'Golang',2,'0000-00-00 00:00:00',NULL),(58,'Google BigQuery',2,'0000-00-00 00:00:00',NULL),(59,'Google Cloud Storage',2,'0000-00-00 00:00:00',NULL),(60,'Groovy',2,'0000-00-00 00:00:00',NULL),(61,'Hadoop',2,'0000-00-00 00:00:00',NULL),(62,'Heskell',2,'0000-00-00 00:00:00',NULL),(63,'HTML',2,'0000-00-00 00:00:00',NULL),(64,'IBM Db2',2,'0000-00-00 00:00:00',NULL),(65,'Information Security Analyst',2,'0000-00-00 00:00:00',NULL),(66,'IT Support',2,'0000-00-00 00:00:00',NULL),(67,'Java Desktop',2,'0000-00-00 00:00:00',NULL),(69,'Java Mobile',2,'0000-00-00 00:00:00',NULL),(70,'JavaScript',2,'0000-00-00 00:00:00',NULL),(71,'Jquery',2,'0000-00-00 00:00:00',NULL),(73,'Kotlin',2,'0000-00-00 00:00:00',NULL),(74,'Laravel',2,'0000-00-00 00:00:00',NULL),(75,'Linux-based',2,'0000-00-00 00:00:00',NULL),(76,'Mac OS\r\n',2,'0000-00-00 00:00:00',NULL),(77,'Machine Learning Specialist',2,'0000-00-00 00:00:00',NULL),(78,'MariaDB',2,'0000-00-00 00:00:00',NULL),(79,'Memcached',2,'0000-00-00 00:00:00',NULL),(80,'Microsoft Azure',2,'0000-00-00 00:00:00',NULL),(81,'MongoDB',2,'0000-00-00 00:00:00',NULL),(82,'MySQL',2,'0000-00-00 00:00:00',NULL),(83,'Neo4j',2,'0000-00-00 00:00:00',NULL),(84,'Network Architect',2,'0000-00-00 00:00:00',NULL),(85,'Network engineer',2,'0000-00-00 00:00:00',NULL),(86,'Node.js',2,'0000-00-00 00:00:00',NULL),(87,'Objective-C',2,'0000-00-00 00:00:00',NULL),(88,'Oracle',2,'0000-00-00 00:00:00',NULL),(89,'Pentester',2,'0000-00-00 00:00:00',NULL),(90,'Perl',2,'0000-00-00 00:00:00',NULL),(91,'PHP',2,'0000-00-00 00:00:00',NULL),(92,'Phython',2,'0000-00-00 00:00:00',NULL),(93,'PostgreSQL',2,'0000-00-00 00:00:00',NULL),(94,'Product Management',2,'0000-00-00 00:00:00',NULL),(96,'Product Owner',2,'0000-00-00 00:00:00',NULL),(97,'Quality Ansurance Manual',2,'0000-00-00 00:00:00',NULL),(98,'Quality Ansurance Otomation',2,'0000-00-00 00:00:00',NULL),(100,'R',2,'0000-00-00 00:00:00',NULL),(101,'React JS',2,'0000-00-00 00:00:00',NULL),(102,'Redis',2,'0000-00-00 00:00:00',NULL),(103,'Ruby',2,'0000-00-00 00:00:00',NULL),(104,'Rust',2,'0000-00-00 00:00:00',NULL),(105,'Scala',2,'0000-00-00 00:00:00',NULL),(106,'Security engineer',2,'0000-00-00 00:00:00',NULL),(107,'SEO specialist',2,'0000-00-00 00:00:00',NULL),(108,'Spark',2,'0000-00-00 00:00:00',NULL),(109,'Spring Boot',2,'0000-00-00 00:00:00',NULL),(110,'SQL Server',2,'0000-00-00 00:00:00',NULL),(111,'SQLite',2,'0000-00-00 00:00:00',NULL),(112,'Swift',2,'0000-00-00 00:00:00',NULL),(113,'System Administrator',2,'0000-00-00 00:00:00',NULL),(114,'Tailwind',2,'0000-00-00 00:00:00',NULL),(115,'TensorFlow',2,'0000-00-00 00:00:00',NULL),(116,'Torch/Py Torch',2,'0000-00-00 00:00:00',NULL),(117,'TypeScript',2,'0000-00-00 00:00:00',NULL),(118,'UI/UX Design',2,'0000-00-00 00:00:00',NULL),(119,'Unity',2,'0000-00-00 00:00:00',NULL),(120,'Visual Basic',2,'0000-00-00 00:00:00',NULL),(121,'VueJS',2,'0000-00-00 00:00:00',NULL),(122,'Windows OS',2,'0000-00-00 00:00:00',NULL),(123,'Wordpress',2,'0000-00-00 00:00:00',NULL),(124,'Xamarin',2,'0000-00-00 00:00:00',NULL),(125,'XML',2,'0000-00-00 00:00:00',NULL),(127,'Artificial Intelligence',2,'0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `master_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_status`
--

DROP TABLE IF EXISTS `master_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_status`
--

LOCK TABLES `master_status` WRITE;
/*!40000 ALTER TABLE `master_status` DISABLE KEYS */;
INSERT INTO `master_status` VALUES (1,'Non Aktif','2021-07-15 14:49:41',NULL),(2,'Aktif','2021-07-15 14:54:30',NULL),(3,'Reservasi','2021-07-15 14:54:35',NULL),(4,'Konfirmasi Admin','2021-07-15 14:54:38',NULL),(5,'Konfirmasi Mentor','2021-07-15 14:54:51',NULL),(6,'Ditolak Admin','2021-07-15 14:54:45',NULL),(7,'Ditolak Mentor','2021-07-15 14:54:42',NULL),(8,'Pembayaran Reservasi','2021-08-07 22:53:28',NULL),(9,'Pembayaran DiTolak','2021-08-15 02:08:36',NULL),(10,'Pembelajaran Sedang Berlangsung','2021-07-15 14:54:47',NULL),(11,'Resolve','2021-07-25 23:21:19',NULL),(12,'Solve','2021-07-25 23:21:21',NULL),(13,'Pengajuan Sebagai Mentor DiTolak','2021-07-29 13:50:53',NULL),(14,'Pengajuan Perubahan Data Mentor','2021-08-15 02:08:30',NULL),(15,'Perubahan Data Mentor DiTerima','2021-08-15 02:08:32',NULL),(16,'Perubahan Data Mentor DiTolak','2021-08-15 02:08:33',NULL);
/*!40000 ALTER TABLE `master_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_tipe_pengajaran`
--

DROP TABLE IF EXISTS `master_tipe_pengajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_tipe_pengajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipe` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_tipe_pengajaran`
--

LOCK TABLES `master_tipe_pengajaran` WRITE;
/*!40000 ALTER TABLE `master_tipe_pengajaran` DISABLE KEYS */;
INSERT INTO `master_tipe_pengajaran` VALUES (1,'Online'),(2,'Offline');
/*!40000 ALTER TABLE `master_tipe_pengajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_user`
--

DROP TABLE IF EXISTS `master_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gender_id` int DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `detail_alamat_id` int DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `level_id` int NOT NULL,
  `status_id` int NOT NULL,
  `fhoto` varchar(255) DEFAULT NULL,
  `path_fhoto` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_user_tbl_gander_idx` (`gender_id`),
  KEY `fk_tbl_user_tbl_level1_idx` (`level_id`),
  KEY `fk_tbl_user_tbl_status1_idx` (`status_id`),
  KEY `fk_master_user_detail_alamat1_idx` (`detail_alamat_id`),
  CONSTRAINT `fk_master_user_detail_alamat1` FOREIGN KEY (`detail_alamat_id`) REFERENCES `detail_alamat` (`id`),
  CONSTRAINT `fk_tbl_user_tbl_gander` FOREIGN KEY (`gender_id`) REFERENCES `master_gender` (`id`),
  CONSTRAINT `fk_tbl_user_tbl_level1` FOREIGN KEY (`level_id`) REFERENCES `master_level` (`id`),
  CONSTRAINT `fk_tbl_user_tbl_status1` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_user`
--

LOCK TABLES `master_user` WRITE;
/*!40000 ALTER TABLE `master_user` DISABLE KEYS */;
INSERT INTO `master_user` VALUES (21,'admin@gmail.com','$2y$10$4Uk0QsA2/ZPNzXGCpv7U/e7txH.bCg6s8yNIdEGBlxT8LZNUoWsFK','Admin',1,'Bintaro','1990-01-01',16,'081297780620',3,2,'admin.png','1630744146','2021-09-04 08:21:22','2021-09-04 08:29:06'),(22,'juwono@gmail.com','$2y$10$rk4I67ceBCPGMOORFrUJxuyugSa4Vr77wveJWizu58m4mE0LXQ/mC','Juwono',1,'Tangerang','1996-05-10',17,'089631839935',2,2,'Foto juwono.jpg','1630758492','2021-09-04 12:25:35','2021-09-04 12:34:25'),(23,'senno@gmail.com','$2y$10$L4rFyhDTtdO5dueWtgpo6eUTrR..nzDqOAOVdIU8Z5qYcR2y8lU5S','Senno Hananto',1,'Karawang','1997-08-29',18,'0851556160233',2,2,'FP Senno.jpg','1630760047','2021-09-04 12:45:12','2021-09-04 13:02:15'),(24,'aziz@gmail.com','$2y$10$pOdH2LX.rHrYjUeKpF96N.9JQXnTOq/Mk2X42yF1lwqOCpJSuYoo.','Sebriyanto Muhammad Aziz',1,'Tangerang','1998-09-13',19,'089684770351',2,2,'IMG20200816052615.jpg','1630762097','2021-09-04 13:17:30','2021-09-04 13:47:32'),(25,'ziaul@gmail.com','$2y$10$ffPGVnkA4KvI6KU8cV37C.bm4M7yttgT6XlN.AVlDg2rWif1t0Mcy','Ziaul',1,'Pekalongan','1993-06-01',20,'085719997812',2,2,'Ziaul.jpg','1630765082','2021-09-04 14:12:13','2021-09-04 14:27:23'),(26,'ricky@gmail.com','$2y$10$TymNGmvRNskNnlyxZ3zATOQTrQA6.R9ulFYaOuN6eQdarR9CE.mpa','Muhammad Ricky Muliawan',1,'Tangerang','1995-06-10',21,'083815858242',2,2,'Ricky.jpg','1630766214','2021-09-04 14:31:50','2021-09-04 14:42:13'),(27,'panji@gmail.com','$2y$10$UYn2PXu7Ps/oX8LxLES2Ee6WekLUHVMFZB4rbLqLVoyD9ovJmka7K','A M Panji Muryadi',1,'Jakarta Barat','1995-02-01',22,'085719997819',2,2,'FP Panji.jpg','1630789576','2021-09-04 20:52:38','2021-09-04 21:06:16'),(28,'defalina@gmail.com','$2y$10$Jj8lyfemWARdh8pr4pzqPeQdxS0HglB4fe6gyx7opaigytAU9vdDa','Defalina',2,'Jakarta Selatan','1977-06-07',23,'085719997812',2,2,'FP Defalina.jpg','1630790339','2021-09-04 21:14:00','2021-09-04 21:26:47'),(29,'said@gmail.com','$2y$10$j3yKf0OaVxILC4yxmpJbzeh.5gnI62sdzMZVN8lX3GrzcyHWFG1yu','Said',1,'Aceh','1990-02-13',24,'085719997812',2,2,'FP Said.jpg','1630793231','2021-09-04 22:04:19','2021-09-04 22:10:26'),(30,'satria.bagaskara@ft-umt.ac.id','$2y$10$17P6E/mPwIjV8HmNqTVMweZf41/c2lPkpcUElw0KnmPW13VFjJvy.','Satria Bagaskara',1,'Tangerang','1997-06-01',25,'089677832054',1,2,'IMG_0211.jpg','1630793615','2021-09-04 22:11:39','2021-09-04 22:13:35'),(31,'rasya@gmail.com','$2y$10$3p6Nab2UpuMvR.I6JtYD7u5VGbI/kKb1ApsCKowaXmkQ3HT6nfOK6','Rasya Mutiara Al Bani',2,'Klaten','1997-06-05',26,'085719997812',1,2,'DSC09930.JPG','1630793860','2021-09-04 22:16:02','2021-09-04 22:17:40'),(32,'viky@gmail.com','$2y$10$KxPjyxYu68vZru8BHSoDZek5Zaw/8XO4ZgToR3zvSo6JMYN6qxA/G','Viky Yahya',1,'Klaten','1993-12-21',27,'0895368019831',2,2,'FP Viky.jpg','1630821680','2021-09-05 05:57:13','2021-09-05 06:07:36'),(33,'iqbal@gmail.com','$2y$10$WmYpvUrLZE8cQ2KPb3WG7OeMongaVjvCgYdV7LDyTPDgG79g2b5Wu','Muhammad Iqbal',1,'Tangerang','1998-02-01',28,'085777272928',2,2,'FP Iqbal.jfif','1630822486','2021-09-05 06:11:02','2021-09-05 06:17:18'),(34,'agung@gmail.com','$2y$10$b3pYqmxxkIl60Lx6yUR6i.e/ajS624aDzNB/HiuSXUDkZwYJ.t0Xu','Agung Gumelar',1,'Kampung Bogor','1997-12-12',29,'08979100048',2,2,'foto jas.jpg','1630829122','2021-09-05 08:01:23','2021-09-05 08:11:48');
/*!40000 ALTER TABLE `master_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_08_08_100000_create_telescope_entries_table',1),(2,'2021_10_10_022416_alter_table_detail_reservasi',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_reset` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_reservasi`
--

DROP TABLE IF EXISTS `pembayaran_reservasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran_reservasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bukti_transfer` varchar(255) NOT NULL,
  `path_bukti` varchar(255) NOT NULL,
  `atas_nama_pengirim` varchar(100) NOT NULL,
  `asal_bank` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_reservasi`
--

LOCK TABLES `pembayaran_reservasi` WRITE;
/*!40000 ALTER TABLE `pembayaran_reservasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran_reservasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perubahan_detail_hari`
--

DROP TABLE IF EXISTS `perubahan_detail_hari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perubahan_detail_hari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perubahan_detail_mentor_id` int NOT NULL,
  `hari_id` int NOT NULL,
  `start_jam` time NOT NULL,
  `end_jam` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hari_id` (`hari_id`),
  KEY `perubahan_detail_mentor_id` (`perubahan_detail_mentor_id`),
  CONSTRAINT `perubahan_detail_hari_ibfk_1` FOREIGN KEY (`hari_id`) REFERENCES `master_hari` (`id`),
  CONSTRAINT `perubahan_detail_hari_ibfk_2` FOREIGN KEY (`perubahan_detail_mentor_id`) REFERENCES `perubahan_detail_mentor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perubahan_detail_hari`
--

LOCK TABLES `perubahan_detail_hari` WRITE;
/*!40000 ALTER TABLE `perubahan_detail_hari` DISABLE KEYS */;
/*!40000 ALTER TABLE `perubahan_detail_hari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perubahan_detail_mentor`
--

DROP TABLE IF EXISTS `perubahan_detail_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perubahan_detail_mentor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `detail_skill` varchar(255) NOT NULL,
  `biodata` text NOT NULL,
  `detail_pengajaran` text NOT NULL,
  `pengalaman_ngajar` int NOT NULL,
  `harga_perjam` bigint DEFAULT NULL,
  `medsos_linkedin` varchar(50) NOT NULL,
  `medsos_github` varchar(255) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `path_document` varchar(150) DEFAULT NULL,
  `status_id` int NOT NULL,
  `alasan_ditolak` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `perubahan_detail_mentor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`),
  CONSTRAINT `perubahan_detail_mentor_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perubahan_detail_mentor`
--

LOCK TABLES `perubahan_detail_mentor` WRITE;
/*!40000 ALTER TABLE `perubahan_detail_mentor` DISABLE KEYS */;
/*!40000 ALTER TABLE `perubahan_detail_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perubahan_detail_skill`
--

DROP TABLE IF EXISTS `perubahan_detail_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perubahan_detail_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perubahan_detail_mentor_id` int NOT NULL,
  `skill_id` int NOT NULL,
  `lama_pengalaman` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_id` (`skill_id`),
  KEY `perubahan_detail_mentor_id` (`perubahan_detail_mentor_id`),
  CONSTRAINT `perubahan_detail_skill_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `master_skill` (`id`),
  CONSTRAINT `perubahan_detail_skill_ibfk_2` FOREIGN KEY (`perubahan_detail_mentor_id`) REFERENCES `perubahan_detail_mentor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perubahan_detail_skill`
--

LOCK TABLES `perubahan_detail_skill` WRITE;
/*!40000 ALTER TABLE `perubahan_detail_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `perubahan_detail_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perubahan_detail_tipe_pengajaran`
--

DROP TABLE IF EXISTS `perubahan_detail_tipe_pengajaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perubahan_detail_tipe_pengajaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perubahan_detail_mentor_id` int NOT NULL,
  `tipe_pengajaran_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perubahan_detail_mentor_id` (`perubahan_detail_mentor_id`),
  KEY `tipe_pengajaran_id` (`tipe_pengajaran_id`),
  CONSTRAINT `perubahan_detail_tipe_pengajaran_ibfk_1` FOREIGN KEY (`perubahan_detail_mentor_id`) REFERENCES `perubahan_detail_mentor` (`id`),
  CONSTRAINT `perubahan_detail_tipe_pengajaran_ibfk_2` FOREIGN KEY (`tipe_pengajaran_id`) REFERENCES `master_tipe_pengajaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perubahan_detail_tipe_pengajaran`
--

LOCK TABLES `perubahan_detail_tipe_pengajaran` WRITE;
/*!40000 ALTER TABLE `perubahan_detail_tipe_pengajaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `perubahan_detail_tipe_pengajaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bantuan`
--

DROP TABLE IF EXISTS `tbl_bantuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_bantuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul_bantuan` text NOT NULL,
  `bantuan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bantuan`
--

LOCK TABLES `tbl_bantuan` WRITE;
/*!40000 ALTER TABLE `tbl_bantuan` DISABLE KEYS */;
INSERT INTO `tbl_bantuan` VALUES (1,'Bagaimana cara saya menemukan mentor ?','Mudah! Temukan mentor anda melalui mesin pencari kami.pilih subject dan kota anda, dan itu saja! anda akan dapat mengakses beberapa mentor terbaik kami, yang tersedia untuk memberikan kursus di dekat anda atau melalui kamera web. Ketika anda telah memilih seorang mentor, anda dapat menghubungi mentor tersebut dengan mengklik tombol \"Pesan Kursus/Reservasi\".','2021-08-23 22:28:17','2021-08-23 16:45:32'),(2,'Bagaimana saya bisa yakin dengan kualitas mentor ?','Transparansi profil.Lihat profil mentor dengan bebas dan pesan mentor ideal yang sesuai dengan kebutuhan anda (keahlian. kualifikasi, pengalaman, lokasi, ulasan dari pada murid, menawarkan kursus tatap muka atau secara online).','2021-08-23 22:28:46',NULL),(3,'Atur jadwal kursus kamu sendiri.','Kami meminta pengajar kami untuk menjadi setransparan mungkin dalam membuat kelas pengajaran mereka dan dengan cerman meinri pengalaman, metodologi, dan data-data hidup mereka.\r\nVerifikasi data pribadi mereka dan informasi yang diberikan kami memverifikasi identitas, data pribadi (Nomor Telepon, alamat E-mail, fhoto) dan ijazah universitas dari semua mentor kami.','2021-08-23 22:29:23',NULL),(4,'100% ulasan kami adalan otentik - kekuatan komunitas','Kami memverifikasi semua ulasan dan rekomendasi yang diterima mentor kami untuk menjamin bahwa mereka 100% asli. Hanya anggota kami yang dapat memberikan ulasan untuk mentor kami. Anda dapat yakin bahwa mentor kami sangat bagus, kompete, dan tersedia berkat komunitas siswa/murid kami!','2021-08-23 22:29:39',NULL),(5,'Apa yang bisa saya pelajari melalui Bangku Privat ?','Dengan Bangku Privat, Anda dapat mempelajari hal yang berkaitan dengan Teknologi Informasi! dengan tatap muka secara langsung atau melalui kamera web (Online). Tidak ada alasan lagi, inilah saatnya untuk meningkatkan kemampuan Anda!','2021-08-23 22:29:53',NULL),(6,'Jika saya sebagai mentor tetapi keahlian saya tidak tercantum dalam pilihan bagaimana?','Anda dapat menghubungi pihak kami di nomor dibawah ini untuk kami bicarakan terlebih dahulu dan jika memang keahlian anda sesuai dengan ketentuan kami maka kami tambah di resource database kami.','2021-08-23 22:30:10',NULL),(7,'Anda perlu menghubungi kami mengenai guru ?','','2021-08-23 22:30:27','2021-08-23 16:05:48'),(8,'Hubungi kami di sini:','Senin-Jum\'at : 09:30 - 17:15\r\nSabtu-Minggu : 09:30 - 12:00\r\nTelepon/WA : +62 812-9778-0620\r\nE-mail : ryanzulham.umt@gmail.com','2021-09-05 05:22:02',NULL);
/*!40000 ALTER TABLE `tbl_bantuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detail_mentor`
--

DROP TABLE IF EXISTS `tbl_detail_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_detail_mentor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `detail_skill` text NOT NULL,
  `biodata` text NOT NULL,
  `detail_pengajaran` text NOT NULL,
  `pengalaman_ngajar` int NOT NULL,
  `harga_perjam` bigint NOT NULL,
  `medsos_linkedin` varchar(50) DEFAULT NULL,
  `medsos_github` varchar(255) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `path_document` varchar(255) DEFAULT NULL,
  `status_id` int NOT NULL,
  `alasan_ditolak` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_detail_mentor_master_user1_idx` (`user_id`),
  KEY `fk_tbl_detail_mentor_master_status1_idx` (`status_id`),
  CONSTRAINT `fk_tbl_detail_mentor_master_status1` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`),
  CONSTRAINT `fk_tbl_detail_mentor_master_user1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detail_mentor`
--

LOCK TABLES `tbl_detail_mentor` WRITE;
/*!40000 ALTER TABLE `tbl_detail_mentor` DISABLE KEYS */;
INSERT INTO `tbl_detail_mentor` VALUES (15,22,'Saya ahli dalam bahasa pemprograman javascript, node JS, react JS','Saya adalah seorang mahasiswa dan juga menjabat sebagai Software Development di TimesDoor. Saya menangani beberapa projek yang berhubungan dengan web development, web design, dan backend development.','saya mengajar menggunakan metode blended learning dengan memadukan beberapa materi pembelajaran seperti video, praktek dan penjelasan secara langsung.',10,250000,'/juwono136','@juwono136','@uno136','CV-JUWONO.pdf','1630758799',2,NULL,'2021-09-04 12:33:19','2021-09-04 12:34:25'),(16,23,'Saya memiliki pengalaman dalam Kotlin Android Programming dengan menjadi Guru SMK dan juga Mentor di Binar Academy. Bisa mengajarkan konsep dasar OOP Java maupun Kotlin hingga Android Development.','Saya seorang Ahli Madya dengan pengalaman sebagai Android Engineer di salah satu BUMN.\r\n\r\nDitambah dengan pengalaman mengajar khusus tentang programming selama 2 Tahun.\r\n\r\nSelain itu, juga saya menjadi Mentor di salah satu Startup Education-Tech di Jabodetabek. Sehingga saya memiliki cara khusus untuk berbagi ilmu.','Metode pengajaran saya adalah dengan memberikan hal-hal mendasar mengenai materi yang saya ajarkan serta dikemas menggunakan bahasa dan analogi yang mudah untuk dipahami.\r\n\r\nSelain itu, juga memberikan konsultasi mengenai project ataupun tugas mengenai pengembangan Aplikasi Android baik Java maupun Kotlin.\r\n\r\nPembelajaran online menggunakan Google meet, dan Video rekaman kelas akan dishare secara FULL. sehingga bisa diulang-ulang di rumah :)',2,100000,'in/sennohananto','@sennohananto','@sennohananto','Curriculum Vitae and Portfolio Senno Hananto.pdf','1630760462',2,NULL,'2021-09-04 13:01:02','2021-09-04 13:02:15'),(17,24,'Saya berpengalaman dalam bidang IT sejak akhir 2018, saat ini saya berkerja sebagai Network Enggineer.','Saya seorang Network Enggineer di salah satu perusahaan IT di Jakarta, saya saat ini juga seorang mahasiswa tingkat akhir di Universitas Muhammadiyah Tangerang. Beberapa perangkat jaringan yang bisa saya kuasai diantaranya : Cisco, Palo Alto, Aruba, F5 dan Aruba.Disamping itu juga saya sedikit menguasai bahasa pemograman Python. Dan untuk tugas akhir saya membuat aplikasi untuk pengerjaan sebagai Network Enggineer yaitu Network Automation Tools.','Saya mengajarkan dari tahap basic hingga medium, mengajar sesuai dengan panduan modul dan menyesuaikan pada tiap tiap peserta.',0,300000,'in/sebriyanto-muhammad-azis-575a82129/','@Cheshire','@symaziz','Surat Lamaran Aziz.docx','1630763111',2,NULL,'2021-09-04 13:45:11','2021-09-04 13:47:32'),(18,25,'Mari mempelajari Pemrograman Dasar dengan kurikulum S1 dengan berbekal pengalaman industri teknologi','Saya telah memulai karir sebagai software engineer sejak tahun 2015.\r\nSaat ini menjadi freelancer dari dalam maupun luar negeri.\r\n\r\nBerbagi pengalaman dan belajar bersama merupakan sarana saya agar tetap mempertahankan performa serta mengikuti trend terbaru dalam area web development.\r\n\r\nPengalaman kuliah yakni S1 teknik informatika di Universitas Dian Nuswantoro Semarang, dengan 1 semester diantaranya menjadi student mobility ke Universiti Teknikal Malaysia Malaka pada tahun 2013.','Saya lebih suka belajar bersama face-to-face, baik secara online maupun offline, dengan sedikit orang. maksimal 2 orang dalam satu kelompok, agar fokus dalam pendalaman materi maupun konsultasi.\r\n\r\nSelain itu, saya selalu merekam proses pembelajaran, agar siswa dapat mengulas kembali materi di lain waktu. sepenuhnya dalam bentuk video dan diakses secara online',7,30000,'in/ziaul','@ziaul','@ziaul','CV Ziaul.PNG','1630765618',2,NULL,'2021-09-04 14:26:58','2021-09-04 14:27:23'),(19,26,'Seorang Fullstack Developer dengan 4 tahun pengalaman yang ingin share ilmu frontend dan backend, coding itu asik','Haloo semuanya..\r\nPerkenalkan nama saya Ricky, saya sudah menjadi Fullstack Developer selama kurang lebih 4 tahun dan sekarang sedang melanjutkan pendidikan S2,\r\nSaya bisa bantu kalian untuk belajar coding atau pemrograman web, pemrograman dasar, bahasa pemrograman, membuat aplikasi, membuat website dan belajar tekonologi Backend dan Frontend.','Saya akan mengajarkan mulai dari basic pemrograman hingga advance dan beberapa tips2 best practices yang bisa berguna bagi pemula atau programmer :)\r\n\r\nSaya akan memberikan sesuai apa yang ada di lapangan dan teknologi yang sedang berkembang dan mempunyai peluang besar selama lebih dari 5 tahun kedepan\r\n\r\nSaya akan menyesuaikan seberapa jauh pengetahuan kalian, kalo dirasa bisa lompat materi saya akan lakukan biar ga banyak waktu yang terbuang.\r\n\r\nBagi yang ingin konsul skripsi, tugas akhir, project atau lain2 juga boleh yang pasti belajar sama saya santai dan ga kaku :)\r\nbisa tanya2 dulu di instagram: rickyhehe\r\n\r\nTeknologi dan pemrograman yang saya dapat ajarkan\r\nBasic:\r\n- HTML. CSS, Bootstrap, Antdesign, Javascript, Jquery, PHP, MySql, PostreSql\r\nAdvance:\r\nLaravel, Codeigniter, React JS, Node JS, Express JS, Docker, linux Server',4,130000,'in/rickyhehe','@mrickymuliawan','@rickyhehe','CV Ricky.pdf','1630766516',2,NULL,'2021-09-04 14:41:56','2021-09-04 14:42:13'),(20,27,'Software Engineer dengan pengalaman 6 tahun di dunia IT yang dapat membantu anda belajar Programming secara online','Saya seorang Software Engineer (Backend) yang telah berkecimpung di dunia IT sejak tahun 2015. Dengan pengalaman dan pengetahuan yang saya miliki, saya sangat berminat untuk membimbing orang lain.\r\n\r\nSubjek yang saya ajarkan dapat dikatakan bahasa pemrograman yang cukup dibutuhkan saat ini, seperti Go Language (Golang), Dart Language, dan Python. Selain itu, saya juga bisa mengajarkan Database, seperti MySQL dan PostgreSQL.','Saya adalah seorang Software Engineer (Backend) yang siap memberikan bimbingan (kursus) kepada siapa saja yang ingin belajar mengenai Programming. Materi yang saya gunakan pastinya mulai dari Basic hingga Advance.\r\n\r\nSelain itu, jika peserta didik ingin materi yang berbeda, misalnya untuk menyelesaikan skripsi, atau menyelesaikan tugas besar, atau mungkin untuk persiapan kerja, saya siap menyesuaikan materi yang akan saya ajarkan.\r\n\r\nMetode yang akan saya gunakan dalam bimbingan (kursus) ini ada 3 tahap, yakni :\r\n1. Memberikan pengetahuan secara teori.\r\nTenang saja, bahasa yang akan saya gunakan pastinya bahasa manusia yang sangat mudah untuk dipahami wkwkwk.\r\n\r\n2. Memberikan contoh berupa implementasi dari teori yang telah saya berikan.\r\nPada tahap ini, saya akan memberikan contoh code dari teori yang telah saya ajarkan.\r\n\r\n3. Learning by case.\r\nPada tahap ini, saya akan memberikan contoh kasus kepada peserta didik dan meminta peserta didik untuk menyelesaikannya dalam bentuk code.',6,85000,'in/panjimuryadi','@panji','@panji','CV Panji.PNG','1630789461',2,NULL,'2021-09-04 21:04:21','2021-09-04 21:04:58'),(21,28,'Lulusan IT dan sebagai Karyawan BUMN yang bergerak di bidang UMKM bekerja sebagai Senior IT Business Analyst dan Analyst System. Memiliki pengalaman mengajar > 15 tahun.','Saya seorang Sarjana Komputer lulusan dari Universitas YARSI bidang Informasi Teknologi. Memiliki pengalaman kerja selama 20 tahun di bidang IT dan mengajar pada bidang yang sama lebih kurang 12 tahun. Pernah menjadi asisten laboratorium dan asisten dosen pada saat kuliah.\r\nBekerja di salah satu perusahaan BUMN terbesar di Jakarta dengan posisi IT Business Analyst. Juga memiliki pengalaman sebagai IT Manager di perusahaan-perusahaan sebelumnya. Memiliki talenta mengajar dan merupakan kegiatan fav','Metodologi pengajaran yang saya sampaikan tidak menggunakan hafalan namun lebih ke logika dan implementasi. Ada juga teori yang diberikan sebagai bahan dasar pegangan bagi murid dan dapat dijadikan acuan nantinya. Tidak menyukai cara belajar yang kaku. Saya selalu berinteraksi dengan murid semaksimal mungkin agar mendapatkan apa saja kebutuhan dari murid tersebut.\r\nBila ada kesulitan saya lebih menyukai dengan sesi pertanyaan dan murid diizinkan untuk menyampaikan pendapatnya apabila penjelasan saya masih kurang dimengerti.',12,250000,'in/defalina','@defalina','@defalina','CV Defalina.PNG','1630790725',2,NULL,'2021-09-04 21:25:25','2021-09-04 21:26:47'),(22,29,'Mahasiswa Informatika bidang minat software engineer menawarkan kursus UI/UX design dan web','Saya Mahasiswa jurusan Informatika Universitas Syiah Kuala.\r\nSaya telah berpengalaman dalam mengajar di bidang saya. Hal itu dibuktikan dengan banyaknya saya menjadi assisten dosen dalam bidang rekayasa perangkat lunak, grafika komputer, dan pemrograman.\r\n\r\nSaya sudah terbiasa dalam mengajar secara berkelompok. Banyak mahasiswa yang memperoleh nilai baik dari jenis mentoring yang saya ajarkan.','Saya sering menjadi assisten dosen dan membantu dalam memberikan bahan pelajaran bagi para mahasiswa informatika.\r\n\r\nSaya sering mengajar dalam bentuk kelompok serti memberikan bimbingan privat kepada mahasiswa yang ingin ilmu lebih.\r\nMateri yang saya mengajar mengenai pemahaman dasar dan fungsinya, Implemetasi, serta manajemen dalam dunia kerja dan penelitian',2,50000,'in/said','@said','@said','CV Said.PNG','1630793383',2,NULL,'2021-09-04 22:09:43','2021-09-04 22:10:26'),(23,32,'Saya  Mobile developer, bahasa yang saya kuasai , Java , Kotlin, JavaScript','Saya merupakan mobile developer di PT Indivara group, Saya sudah banyak mengerjakan projek profesional baik swasta maupun instansi pemerintahan. Saya terbiasa menggunakan berbagai bahasa pemrograman mulai dari PHP, Javascript, dan Java.','Misal saya mengajar dari dasar hingga advance',1,100000,'/in/viky-yahya-4bb570159/','@vikyyahya','@vk_yy','CV Viky.pdf','1630821873',2,NULL,'2021-09-05 06:04:33','2021-09-05 06:07:36'),(24,33,'Saya Seorang Web Developer','Saya merupakan web developer pada salah satu software house di jakarta. Saya sudah mengerjakan beberapa project professional baik swasta maupun instansi pemerintahan. Saya terbiasa menggunakan bahasa pemrograman seperti PHP dan JavaScript. Serta beberapa framework pendukung seperti Laravel dan jQuery. Saya juga memahami metode pengembangan perangkat lunak dengann metode agile serta framework agile.','Saya mengajar dari dasar hingga advance',1,50000,'in/muhammad-iqbal-483145168/','@Iqbal333','@iqbalgooner33','CV_Muhamad_Iqbal-dikonversi - Muhammad Iqbal.pdf','1630822622',2,NULL,'2021-09-05 06:17:02','2021-09-05 06:17:18'),(25,34,'saya seorang Web Developer dan berpengalaman dalam program PHP, Framework Laravel, Codeigniter','saya merupakan karyawan di perusahaan GPS Tracker yang menghandle Internal Website','saya mengajarkan web developer dari basic hingga middle, dengan metode pembelajaran case by case',0,250000,'in/agunggumelar','@agunggum1912','agunggumlar','Resume Agung 2020(3).pdf','1630829476',2,NULL,'2021-09-05 08:11:16','2021-09-05 08:11:48');
/*!40000 ALTER TABLE `tbl_detail_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_informasi`
--

DROP TABLE IF EXISTS `tbl_informasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_informasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_rekening` varchar(20) NOT NULL,
  `nama_bank` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_informasi`
--

LOCK TABLES `tbl_informasi` WRITE;
/*!40000 ALTER TABLE `tbl_informasi` DISABLE KEYS */;
INSERT INTO `tbl_informasi` VALUES (1,'764 111 6835','Bank Central ','Bangku Privat','2021-08-08 01:10:36',NULL),(3,'888 009 2953','Bank Central Asia','Bangku Privat','2021-08-08 01:10:37',NULL);
/*!40000 ALTER TABLE `tbl_informasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reservasi`
--

DROP TABLE IF EXISTS `tbl_reservasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reservasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `kebutuhan_id` int NOT NULL,
  `detail_kebutuhan` text NOT NULL,
  `jumlah_jam` int NOT NULL,
  `tipe_pengajaran_id` int NOT NULL,
  `total_biaya` int NOT NULL,
  `status_id` int NOT NULL,
  `mentor_id` int DEFAULT NULL,
  `alasan_ditolak` text,
  `pembayaran_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_transaksi_master_user1_idx` (`user_id`),
  KEY `fk_tbl_transaksi_master_status1_idx` (`status_id`),
  KEY `fk_tbl_reservasi_master_kebutuhan1_idx` (`kebutuhan_id`),
  KEY `fk_tbl_transaksi_master_user2` (`mentor_id`),
  KEY `pembayaran_id` (`pembayaran_id`),
  KEY `tipe_pengajaran_id` (`tipe_pengajaran_id`),
  CONSTRAINT `fk_tbl_reservasi_master_kebutuhan1` FOREIGN KEY (`kebutuhan_id`) REFERENCES `master_kebutuhan` (`id`),
  CONSTRAINT `fk_tbl_transaksi_master_status1` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`),
  CONSTRAINT `fk_tbl_transaksi_master_user1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`),
  CONSTRAINT `fk_tbl_transaksi_master_user2` FOREIGN KEY (`mentor_id`) REFERENCES `master_user` (`id`),
  CONSTRAINT `tbl_reservasi_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran_reservasi` (`id`),
  CONSTRAINT `tbl_reservasi_ibfk_2` FOREIGN KEY (`tipe_pengajaran_id`) REFERENCES `master_tipe_pengajaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reservasi`
--

LOCK TABLES `tbl_reservasi` WRITE;
/*!40000 ALTER TABLE `tbl_reservasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reservasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telescope_entries`
--

DROP TABLE IF EXISTS `telescope_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries` (
  `sequence` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telescope_entries`
--

LOCK TABLES `telescope_entries` WRITE;
/*!40000 ALTER TABLE `telescope_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `telescope_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telescope_entries_tags`
--

DROP TABLE IF EXISTS `telescope_entries_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telescope_entries_tags`
--

LOCK TABLES `telescope_entries_tags` WRITE;
/*!40000 ALTER TABLE `telescope_entries_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `telescope_entries_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telescope_monitoring`
--

DROP TABLE IF EXISTS `telescope_monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telescope_monitoring`
--

LOCK TABLES `telescope_monitoring` WRITE;
/*!40000 ALTER TABLE `telescope_monitoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `telescope_monitoring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ulasan_mentor`
--

DROP TABLE IF EXISTS `ulasan_mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ulasan_mentor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservasi_id` int NOT NULL,
  `bintang` int NOT NULL,
  `ulasan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservasi_id` (`reservasi_id`),
  CONSTRAINT `ulasan_mentor_ibfk_1` FOREIGN KEY (`reservasi_id`) REFERENCES `tbl_reservasi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ulasan_mentor`
--

LOCK TABLES `ulasan_mentor` WRITE;
/*!40000 ALTER TABLE `ulasan_mentor` DISABLE KEYS */;
/*!40000 ALTER TABLE `ulasan_mentor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'bangkuprivat'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-20  8:28:39
