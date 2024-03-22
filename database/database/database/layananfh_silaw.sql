-- MariaDB dump 10.19  Distrib 10.6.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: layananfh_silaw
-- ------------------------------------------------------
-- Server version	10.6.15-MariaDB-cll-lve

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
-- Table structure for table `km_jenis_suratketerangan`
--

DROP TABLE IF EXISTS `km_jenis_suratketerangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `km_jenis_suratketerangan` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_jenis_suratketerangan`
--

LOCK TABLES `km_jenis_suratketerangan` WRITE;
/*!40000 ALTER TABLE `km_jenis_suratketerangan` DISABLE KEYS */;
INSERT INTO `km_jenis_suratketerangan` VALUES (1,'Surat keterangan mahasiswa aktif',1),(2,'Surat Rekomendasi Beasiswa',1),(3,'Tunjangan Anak(PNS)',1),(4,'BPJS',1),(5,'Lain-lain',1);
/*!40000 ALTER TABLE `km_jenis_suratketerangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_suratketerangan`
--

DROP TABLE IF EXISTS `km_suratketerangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `km_suratketerangan` (
  `id_suket` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'user mahasiswa',
  `file` text DEFAULT NULL,
  `lain` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id_suket`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_suratketerangan`
--

LOCK TABLES `km_suratketerangan` WRITE;
/*!40000 ALTER TABLE `km_suratketerangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `km_suratketerangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL DEFAULT 0,
  `nama_menu` text DEFAULT NULL,
  `link` text NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `morder` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,1,'Home','#',0,1,1),(2,1,'Dashboard','dashboarda',1,1,1),(3,1,'Master','#',0,2,1),(4,1,'Menu','dashboarda/master/menu',3,1,1),(9,1,'User','dashboarda/master/user',3,2,1),(10,4,'Home','#',0,1,1),(11,4,'Dashboard','dashboardkm',10,1,1),(12,4,'Surat Keterangan','#',0,2,1),(13,4,'Data','dashboardkm/suratketerangan/data',12,1,1),(14,5,'Home','#',0,1,1),(15,5,'Dashboard','dashboardsd',14,1,1),(16,5,'Jadwal Dekanat','#',0,2,1),(17,5,'Data','dashboardsd/jadwaldekanat/data',16,1,1),(18,6,'Home','#',0,1,1),(19,6,'Dashboard','dashboardd',18,1,1),(20,7,'Home','#',0,1,1),(21,7,'Dashboard','dashboardwadeki',20,1,1),(22,8,'Home','#',0,1,1),(23,8,'Dashboard','dashboardwadekii',22,1,1),(24,9,'Home','#',0,1,1),(25,9,'Dashboard','dashboardwadekiii',24,1,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodi`
--

DROP TABLE IF EXISTS `prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prodi` text DEFAULT NULL,
  `jenjang` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodi`
--

LOCK TABLES `prodi` WRITE;
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
INSERT INTO `prodi` VALUES (51,'ILMU HUKUM','S1',1),(54,'KENOTARIATAN','S2',1),(55,'ILMU HUKUM','S2',1),(56,'ILMU HUKUM','S3',1);
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrator',1),(2,'Mahasiswa',1),(3,'Dosen',1),(4,'Kemahasiswaan',1),(5,'Sekretaris Dekanat',1),(6,'Dekan',1),(7,'Wakil Dekan I',1),(8,'Wakil Dekan II',1),(9,'Wakil Dekan III',1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sd_jadwaldekanat`
--

DROP TABLE IF EXISTS `sd_jadwaldekanat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sd_jadwaldekanat` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `nama_acara` text DEFAULT NULL,
  `tempat` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sd_jadwaldekanat`
--

LOCK TABLES `sd_jadwaldekanat` WRITE;
/*!40000 ALTER TABLE `sd_jadwaldekanat` DISABLE KEYS */;
INSERT INTO `sd_jadwaldekanat` VALUES (5,'coba judul','coba tempat','2023-12-16','23:45:00','23:30:00',1,'2023-12-16 20:53:55');
/*!40000 ALTER TABLE `sd_jadwaldekanat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sd_jadwaldekanat_owner`
--

DROP TABLE IF EXISTS `sd_jadwaldekanat_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sd_jadwaldekanat_owner` (
  `id_owner` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `id_struktural` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `whatsapp_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=belum kirim\r\n1=sent\r\n2=failed',
  PRIMARY KEY (`id_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sd_jadwaldekanat_owner`
--

LOCK TABLES `sd_jadwaldekanat_owner` WRITE;
/*!40000 ALTER TABLE `sd_jadwaldekanat_owner` DISABLE KEYS */;
INSERT INTO `sd_jadwaldekanat_owner` VALUES (9,5,1,1,1);
/*!40000 ALTER TABLE `sd_jadwaldekanat_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sd_struktural`
--

DROP TABLE IF EXISTS `sd_struktural`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sd_struktural` (
  `id_struktural` int(11) NOT NULL AUTO_INCREMENT,
  `nama_struktural` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_struktural`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sd_struktural`
--

LOCK TABLES `sd_struktural` WRITE;
/*!40000 ALTER TABLE `sd_struktural` DISABLE KEYS */;
INSERT INTO `sd_struktural` VALUES (1,'Dekan',1),(2,'Wakil Dekan I',1),(3,'Wakil Dekan II',1),(4,'Wakil Dekan III',1);
/*!40000 ALTER TABLE `sd_struktural` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(11) NOT NULL DEFAULT 0,
  `username` text DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT NULL,
  `sebagai` int(11) DEFAULT NULL COMMENT '1=dosen,2=tendik,3=mahasiswa',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,0,'198907312018013101','Agan Haris',1,'2023-11-10 00:00:00',2),(6,54,'233221010','TRISCHA GALUH KRISHNASANTI ',1,'2023-12-04 11:49:43',3),(7,0,'198105162018013201','Aini Meiliyah, S.Si.',1,'2023-12-04 11:57:27',2),(8,0,'196812181990031002','AMIN RACHMAD',1,'2023-12-04 11:57:58',2),(9,55,'032024153060','MIFTAHUR ROHMAN ',1,'2023-12-04 14:53:26',3),(10,0,'199006192018013201','Yuni Ma\'rifatul Afifah, A.Md.',1,'2023-12-04 15:19:25',2),(11,0,'199007272018035201','ERI WULANDARI, S.E.',1,'2023-12-04 15:20:16',2),(12,55,'032114153013','Wahyu Aliansa ',1,'2023-12-04 19:53:50',3),(13,51,'031911133084','GILAR ANDIKA MAULANA ',1,'2023-12-05 03:58:06',3),(14,0,'198902062018013201','Khusnul Latifah, S.IIP.',1,'2023-12-05 08:42:25',2),(15,0,'198708112018013101','Rizki Rudi Antoni, S.IIP.',1,'2023-12-05 08:43:06',2),(16,51,'032011133140','MUHAMMAD \'ILMAN NUR \'ARIF ',1,'2023-12-05 21:14:40',3),(17,51,'032011133090','PUTRI KIRANA ',1,'2023-12-15 18:31:01',3),(18,51,'198403102018013101','Subeki, ST',1,'2023-12-16 10:39:12',2),(19,51,'197602042005011003','IMAN PRIHANDONO, S.H., M.H., LL.M., Ph.D.',1,'2023-12-16 13:37:18',1),(20,51,'198304192006041001','MARADONA, S.H., LL.M., Ph.D.',1,'2023-12-16 13:38:22',1),(21,51,'198001232009121005','Dr. MOHAMMAD SYAIFUL ARIS, S.H., M.H.,LL.M',1,'2023-12-16 13:39:34',1),(22,51,'196412111990022001','Dr. ENNY NARWATI, S.H., M.H.',1,'2023-12-16 13:40:37',1),(23,55,'231221051','DIANA SEPTAVIANA ',1,'2023-12-18 08:52:39',3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrole` (
  `id_userrole` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `is_aktif` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_userrole`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrole`
--

LOCK TABLES `userrole` WRITE;
/*!40000 ALTER TABLE `userrole` DISABLE KEYS */;
INSERT INTO `userrole` VALUES (1,1,1,0,1,'2023-10-10 00:00:00'),(10,6,2,1,1,'2023-12-04 11:49:43'),(11,7,4,1,1,'2023-12-04 11:57:33'),(12,8,4,1,1,'2023-12-04 11:58:02'),(13,1,4,0,1,'2023-12-04 12:00:42'),(14,9,2,1,1,'2023-12-04 14:53:26'),(15,10,1,1,1,'2023-12-04 15:19:33'),(16,11,5,1,1,'2023-12-04 15:20:23'),(17,12,2,1,1,'2023-12-04 19:53:50'),(18,13,2,1,1,'2023-12-05 03:58:06'),(19,14,5,1,1,'2023-12-05 08:42:31'),(20,15,5,1,1,'2023-12-05 08:43:18'),(21,1,6,0,1,'2023-12-05 10:09:34'),(22,1,5,1,1,'2023-12-05 10:24:49'),(23,1,7,0,1,'2023-12-05 11:02:02'),(24,1,8,0,1,'2023-12-05 11:02:05'),(25,1,9,0,1,'2023-12-05 11:02:08'),(26,16,2,1,1,'2023-12-05 21:14:40'),(27,17,2,1,1,'2023-12-15 18:31:01'),(28,18,1,1,1,'2023-12-16 10:39:19'),(29,19,6,1,1,'2023-12-16 13:37:27'),(30,20,9,1,1,'2023-12-16 13:38:31'),(31,21,8,1,1,'2023-12-16 13:39:42'),(32,22,7,1,1,'2023-12-16 13:40:44'),(33,23,2,1,1,'2023-12-18 08:52:39');
/*!40000 ALTER TABLE `userrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'layananfh_silaw'
--

--
-- Dumping routines for database 'layananfh_silaw'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-05  0:29:16
