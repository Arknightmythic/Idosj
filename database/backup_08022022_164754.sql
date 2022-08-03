-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: idosj
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `id` varchar(50) NOT NULL,
  `namaDepan` varchar(255) DEFAULT NULL,
  `namaBelakang` varchar(255) DEFAULT NULL,
  `fotoProfile` varchar(255) DEFAULT NULL,
  `tempatLahir` varchar(255) DEFAULT NULL,
  `tanggalLahir` date DEFAULT NULL,
  `golonganDarah` varchar(3) DEFAULT NULL,
  `komunitas` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomorTelepon` varchar(15) DEFAULT NULL,
  `jenisGradasi` int(11) DEFAULT NULL,
  `statusMeninggal` tinyint(1) DEFAULT NULL,
  `idSuperior` varchar(50) DEFAULT NULL,
  `idDelegat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenisGradasi` (`jenisGradasi`),
  KEY `anggota_ibfk_2` (`idSuperior`),
  KEY `anggota_ibfk_3` (`idDelegat`),
  KEY `komunitas` (`komunitas`),
  CONSTRAINT `anggota_ibfk_2` FOREIGN KEY (`idSuperior`) REFERENCES `anggota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `anggota_ibfk_3` FOREIGN KEY (`idDelegat`) REFERENCES `anggota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `anggota_ibfk_4` FOREIGN KEY (`jenisGradasi`) REFERENCES `gradasi_anggota` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `anggota_ibfk_5` FOREIGN KEY (`komunitas`) REFERENCES `komunitas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES ('IDO19991','Ignatius','Windar Santoso','windar.jpg','Jakarta','1979-12-19','A',1,'winsigsj@gmail.com','082133818723',3,0,'IDO19999','IDO19995'),('IDO19995','Octavianus','Bagaswara Adi',NULL,'aadwwd','2321-12-21','B',1,'adrianfinantyo@gmail.com','231231213123',7,0,'IDO19999',NULL),('IDO19999','Bonifasius','Ariesto Adrian Finantyo','profile_IDO15551.jpg','Jakarta','1979-12-19','B',1,'adrianfinantyo@gmail.com','082133818790',8,0,NULL,NULL),('IDO20121','Adrian Ke 2','Bonifasius','Profile_IDO20121.png','awdawdawdawd','2022-07-27','B',2,'adrianfinantyo@gmail.com','123123123123',3,0,'IDO19999','IDO19995');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bahasa`
--

DROP TABLE IF EXISTS `bahasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bahasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaBahasa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahasa`
--

LOCK TABLES `bahasa` WRITE;
/*!40000 ALTER TABLE `bahasa` DISABLE KEYS */;
INSERT INTO `bahasa` VALUES (1,'Arabic'),(2,'Aramaic'),(3,'Balinese'),(4,'Bataknese'),(5,'Burmese'),(6,'Cambodian'),(7,'Chinese'),(8,'Dutch'),(9,'English'),(10,'French'),(11,'German'),(12,'Greek'),(13,'Indonesian / Malay'),(14,'Italian'),(15,'Japanese'),(16,'Javanese'),(17,'Khmer'),(18,'Latin'),(19,'Portuguese'),(20,'Spanish'),(21,'Sundanese'),(22,'Swahili'),(23,'Tagalog'),(24,'Tetum'),(25,'Thai'),(26,'Urdu'),(27,'Yapese (Micronesia)'),(28,'Yapesse');
/*!40000 ALTER TABLE `bahasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bahasa_anggota`
--

DROP TABLE IF EXISTS `bahasa_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bahasa_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusReading` tinyint(1) DEFAULT NULL,
  `statusWriting` tinyint(1) DEFAULT NULL,
  `statusSpeaking` tinyint(1) DEFAULT NULL,
  `idBahasa` int(11) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idBahasa` (`idBahasa`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `bahasa_anggota_ibfk_1` FOREIGN KEY (`idBahasa`) REFERENCES `bahasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bahasa_anggota_ibfk_2` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahasa_anggota`
--

LOCK TABLES `bahasa_anggota` WRITE;
/*!40000 ALTER TABLE `bahasa_anggota` DISABLE KEYS */;
INSERT INTO `bahasa_anggota` VALUES (1,1,1,1,13,'IDO19991'),(2,1,0,1,9,'IDO19991'),(6,1,1,1,13,'IDO19999'),(14,0,0,1,16,'IDO19999');
/*!40000 ALTER TABLE `bahasa_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dimissi_anggota`
--

DROP TABLE IF EXISTS `dimissi_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dimissi_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suratPermohonan` varchar(255) DEFAULT NULL,
  `suratProvinsial` varchar(255) DEFAULT NULL,
  `judgementProvinsial` varchar(255) DEFAULT NULL,
  `declarationFact` varchar(255) DEFAULT NULL,
  `r1` varchar(255) DEFAULT NULL,
  `d1` varchar(255) DEFAULT NULL,
  `n1` varchar(255) DEFAULT NULL,
  `schede` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `dimissi_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dimissi_anggota`
--

LOCK TABLES `dimissi_anggota` WRITE;
/*!40000 ALTER TABLE `dimissi_anggota` DISABLE KEYS */;
INSERT INTO `dimissi_anggota` VALUES (1,'Dokumen_Dimissi_IDO19991_suratPermohonan.pdf','Dokumen_Dimissi_IDO19991_suratProvinsial.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'IDO19991');
/*!40000 ALTER TABLE `dimissi_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen`
--

DROP TABLE IF EXISTS `dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaDokumen` varchar(255) DEFAULT NULL,
  `jenisDokumen` varchar(50) DEFAULT NULL,
  `fileDokumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen`
--

LOCK TABLES `dokumen` WRITE;
/*!40000 ALTER TABLE `dokumen` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen_anggota`
--

DROP TABLE IF EXISTS `dokumen_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumen_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaDokumen` varchar(255) DEFAULT NULL,
  `nomorDokumen` varchar(100) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `dokumen_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen_anggota`
--

LOCK TABLES `dokumen_anggota` WRITE;
/*!40000 ALTER TABLE `dokumen_anggota` DISABLE KEYS */;
INSERT INTO `dokumen_anggota` VALUES (17,'KTP','1928301209012','IDO19999');
/*!40000 ALTER TABLE `dokumen_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_kuning_anggota`
--

DROP TABLE IF EXISTS `form_kuning_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_kuning_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q1` date DEFAULT NULL,
  `q2` date DEFAULT NULL,
  `q3` varchar(255) DEFAULT NULL,
  `q4` varchar(255) DEFAULT NULL,
  `q5` text DEFAULT NULL,
  `q6` text DEFAULT NULL,
  `q7` varchar(255) DEFAULT NULL,
  `q8` text DEFAULT NULL,
  `q9` text DEFAULT NULL,
  `q10` text DEFAULT NULL,
  `tsToSuperior` timestamp NOT NULL DEFAULT current_timestamp(),
  `statusSuperior` tinyint(1) DEFAULT 0,
  `tanggapanSuperior` text DEFAULT NULL,
  `tsToProvinsial` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `statusProvinsial` tinyint(1) DEFAULT 0,
  `tanggapanProvinsial` text DEFAULT NULL,
  `idSuperior` varchar(50) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSuperior` (`idSuperior`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `form_kuning_anggota_ibfk_1` FOREIGN KEY (`idSuperior`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `form_kuning_anggota_ibfk_2` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_kuning_anggota`
--

LOCK TABLES `form_kuning_anggota` WRITE;
/*!40000 ALTER TABLE `form_kuning_anggota` DISABLE KEYS */;
INSERT INTO `form_kuning_anggota` VALUES (1,'2022-07-23','2022-07-30','Amerika','Jalan jalan','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel dolor maximus accumsan. Nunc euismod, dui consequat ultrices varius, nunc massa rutrum neque, et eleifend quam sem nec neque. Sed id condimentum felis, eget porta nibh. Cras quis pulvinar ex. Mauris sit amet vestibulum nulla. Nam blandit tellus sed lorem hendrerit, id tincidunt est euismod. Nullam ac ornare lectus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel dolor maximus accumsan. Nunc euismod, dui consequat ultrices varius, nunc massa rutrum neque, et eleifend quam sem nec neque. Sed id condimentum felis, eget porta nibh. Cras quis pulvinar ex. Mauris sit amet vestibulum nulla. Nam blandit tellus sed lorem hendrerit, id tincidunt est euismod. Nullam ac ornare lectus.','PT Sumarco Dencow Nestle','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel dolor maximus accumsan. Nunc euismod, dui consequat ultrices varius, nunc massa rutrum neque, et eleifend quam sem nec neque. Sed id condimentum felis, eget porta nibh. Cras quis pulvinar ex. Mauris sit amet vestibulum nulla. Nam blandit tellus sed lorem hendrerit, id tincidunt est euismod. Nullam ac ornare lectus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel dolor maximus accumsan. Nunc euismod, dui consequat ultrices varius, nunc massa rutrum neque, et eleifend quam sem nec neque. Sed id condimentum felis, eget porta nibh. Cras quis pulvinar ex. Mauris sit amet vestibulum nulla. Nam blandit tellus sed lorem hendrerit, id tincidunt est euismod. Nullam ac ornare lectus.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor vel dolor maximus accumsan. Nunc euismod, dui consequat ultrices varius, nunc massa rutrum neque, et eleifend quam sem nec neque. Sed id condimentum felis, eget porta nibh. Cras quis pulvinar ex. Mauris sit amet vestibulum nulla. Nam blandit tellus sed lorem hendrerit, id tincidunt est euismod. Nullam ac ornare lectus.','2022-07-20 07:36:22',1,'niceeeeee','2022-08-02 09:32:09',NULL,NULL,'IDO19999','IDO19991');
/*!40000 ALTER TABLE `form_kuning_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gradasi_anggota`
--

DROP TABLE IF EXISTS `gradasi_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gradasi_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeGradasi` varchar(5) NOT NULL,
  `namaGradasi` varchar(100) DEFAULT NULL,
  `statusKeanggotaan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gradasi_anggota`
--

LOCK TABLES `gradasi_anggota` WRITE;
/*!40000 ALTER TABLE `gradasi_anggota` DISABLE KEYS */;
INSERT INTO `gradasi_anggota` VALUES (1,'AZ','Dimissi','Keluar'),(2,'SC','Spiritual Coadjutor','Imam'),(3,'FA','Brother Approbatus','Bruder'),(4,'FF','Formed Brother','Bruder'),(5,'SA','Scholastic Approbatus','Frater'),(6,'NS','Novice','Bruder dan Frater'),(7,'P4','Professed','Imam'),(8,'SA','Ordained Scholastic Approbatus','Imam');
/*!40000 ALTER TABLE `gradasi_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informationes_anggota`
--

DROP TABLE IF EXISTS `informationes_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `informationes_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institusi` varchar(255) DEFAULT NULL,
  `sebelumTeologi` varchar(255) DEFAULT NULL,
  `sebelumTahbisan` varchar(255) DEFAULT NULL,
  `sebelumKaulAkhir` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `informationes_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informationes_anggota`
--

LOCK TABLES `informationes_anggota` WRITE;
/*!40000 ALTER TABLE `informationes_anggota` DISABLE KEYS */;
/*!40000 ALTER TABLE `informationes_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_relasi`
--

DROP TABLE IF EXISTS `jenis_relasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_relasi` (
  `id` int(11) NOT NULL,
  `namaRelasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_relasi`
--

LOCK TABLES `jenis_relasi` WRITE;
/*!40000 ALTER TABLE `jenis_relasi` DISABLE KEYS */;
INSERT INTO `jenis_relasi` VALUES (1,'Ayah'),(2,'Ibu'),(3,'Saudara Kandung'),(4,'Kerabat');
/*!40000 ALTER TABLE `jenis_relasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenjang_pendidikan`
--

DROP TABLE IF EXISTS `jenjang_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenjang_pendidikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaJenjang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenjang_pendidikan`
--

LOCK TABLES `jenjang_pendidikan` WRITE;
/*!40000 ALTER TABLE `jenjang_pendidikan` DISABLE KEYS */;
INSERT INTO `jenjang_pendidikan` VALUES (1,'Sekolah Dasar'),(2,'Sekolah Menengah Pertama'),(3,'Sekolah Menengah Atas'),(4,'Diploma (D3)'),(5,'Sarjana (S1)');
/*!40000 ALTER TABLE `jenjang_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaul_akhir`
--

DROP TABLE IF EXISTS `kaul_akhir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaul_akhir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggalKaulAkhir` date DEFAULT NULL,
  `suratPribadi` varchar(255) DEFAULT NULL,
  `dekritKaul` varchar(255) DEFAULT NULL,
  `teksKaul` varchar(255) DEFAULT NULL,
  `teksPelepasan` varchar(255) DEFAULT NULL,
  `testamenNotaris` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `kaul_akhir_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaul_akhir`
--

LOCK TABLES `kaul_akhir` WRITE;
/*!40000 ALTER TABLE `kaul_akhir` DISABLE KEYS */;
/*!40000 ALTER TABLE `kaul_akhir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keahlian_anggota`
--

DROP TABLE IF EXISTS `keahlian_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keahlian_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studiKhusus` varchar(255) DEFAULT NULL,
  `namaInstitusi` varchar(255) DEFAULT NULL,
  `levelKeahlian` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `keahlian_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keahlian_anggota`
--

LOCK TABLES `keahlian_anggota` WRITE;
/*!40000 ALTER TABLE `keahlian_anggota` DISABLE KEYS */;
/*!40000 ALTER TABLE `keahlian_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kematian_anggota`
--

DROP TABLE IF EXISTS `kematian_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kematian_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `waktu` varchar(100) DEFAULT NULL,
  `makam` varchar(255) DEFAULT NULL,
  `aktaKematian` varchar(255) DEFAULT NULL,
  `keteranganKematian` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `kematian_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kematian_anggota`
--

LOCK TABLES `kematian_anggota` WRITE;
/*!40000 ALTER TABLE `kematian_anggota` DISABLE KEYS */;
/*!40000 ALTER TABLE `kematian_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentar_anggota`
--

DROP TABLE IF EXISTS `komentar_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `textKomentar` text DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `komentar_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar_anggota`
--

LOCK TABLES `komentar_anggota` WRITE;
/*!40000 ALTER TABLE `komentar_anggota` DISABLE KEYS */;
INSERT INTO `komentar_anggota` VALUES (1,'awdawdawawdwad','IDO19999');
/*!40000 ALTER TABLE `komentar_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komunitas`
--

DROP TABLE IF EXISTS `komunitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komunitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `residensi` varchar(255) NOT NULL,
  `alamatResidensi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komunitas`
--

LOCK TABLES `komunitas` WRITE;
/*!40000 ALTER TABLE `komunitas` DISABLE KEYS */;
INSERT INTO `komunitas` VALUES (1,'Rumah Provinsialat SJ','Rumah Provinsialat SJ','Jl. Argopuro 24 Semarang, 50231 Semarang, Indonesia'),(2,'Aloysius','Sekolah Kolese Gonzaga','Jl. Pejaten Barat 10A RT.02/10, RT.2/RW.10, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550'),(3,'Aloysius','Sekolah Kolese Debrito','Jl. Laksda Adisucipto No.161, Demangan Baru, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281'),(4,'Ignatius','Sekolah Kolese Canisius','Jl. Argopuro 24 Semarang, 50231 Semarang, Indonesia');
/*!40000 ALTER TABLE `komunitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laisasi_anggota`
--

DROP TABLE IF EXISTS `laisasi_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laisasi_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suratPermohonan` varchar(255) DEFAULT NULL,
  `suratProvinsial` varchar(255) DEFAULT NULL,
  `cvWawancara` varchar(255) DEFAULT NULL,
  `judgementProvinsial` varchar(255) DEFAULT NULL,
  `testimony` varchar(255) DEFAULT NULL,
  `suratPater` varchar(255) DEFAULT NULL,
  `suratVatikan` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `laisasi_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laisasi_anggota`
--

LOCK TABLES `laisasi_anggota` WRITE;
/*!40000 ALTER TABLE `laisasi_anggota` DISABLE KEYS */;
INSERT INTO `laisasi_anggota` VALUES (1,NULL,'Dokumen_Laisasi_IDO19991_suratProvinsial.pdf',NULL,NULL,'Dokumen_Laisasi_IDO19991_testimony.pdf',NULL,NULL,'IDO19991');
/*!40000 ALTER TABLE `laisasi_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendidikan_anggota`
--

DROP TABLE IF EXISTS `pendidikan_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendidikan_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaInstitusi` varchar(255) DEFAULT NULL,
  `tahunMasuk` int(11) DEFAULT NULL,
  `tahunLulus` int(11) DEFAULT NULL,
  `kelengkapanIjazah` tinyint(1) DEFAULT NULL,
  `tingkatJenjang` int(11) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  KEY `tingkatJenjang` (`tingkatJenjang`),
  CONSTRAINT `pendidikan_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pendidikan_anggota_ibfk_2` FOREIGN KEY (`tingkatJenjang`) REFERENCES `jenjang_pendidikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendidikan_anggota`
--

LOCK TABLES `pendidikan_anggota` WRITE;
/*!40000 ALTER TABLE `pendidikan_anggota` DISABLE KEYS */;
INSERT INTO `pendidikan_anggota` VALUES (1,'SDN 02 Jakarta',1986,1992,1,1,'IDO19991'),(2,'SMPK St. Markus, Cililitan, Jakarta',1992,1995,1,2,'IDO19991'),(6,'SDK Mater Dei Pamulang',2008,2014,1,1,'IDO19999'),(7,'SMPK Mater Dei Pamulang',2014,2017,1,2,'IDO19999'),(8,'SMAK Mater Dei Pamulang',2017,2020,1,3,'IDO19999');
/*!40000 ALTER TABLE `pendidikan_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perutusan_anggota`
--

DROP TABLE IF EXISTS `perutusan_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perutusan_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempatPerutusan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tahunMasuk` varchar(4) DEFAULT NULL,
  `tahunBerakhir` varchar(4) DEFAULT NULL,
  `fileSK` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `perutusan_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perutusan_anggota`
--

LOCK TABLES `perutusan_anggota` WRITE;
/*!40000 ALTER TABLE `perutusan_anggota` DISABLE KEYS */;
INSERT INTO `perutusan_anggota` VALUES (1,'Novisiat St. Stanislaus Kostka, Ungaran, Indonesia',NULL,'1999','2001',NULL,'IDO19991'),(2,'Arrupe International Residence - Manila, Manila , Philippines',NULL,'2001','2002',NULL,'IDO19991'),(3,'STF Driyarkara, Jakarta, Indonesia',NULL,'2002','2006',NULL,'IDO19991'),(4,'Kolese de Britto, Yogyakarta, Indonesia','Pamong','2006','','sk-perutusan_IDO19991_1656318731615.pdf','IDO19991');
/*!40000 ALTER TABLE `perutusan_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publikasi_anggota`
--

DROP TABLE IF EXISTS `publikasi_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publikasi_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `tahunTerbit` varchar(4) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `publikasi_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publikasi_anggota`
--

LOCK TABLES `publikasi_anggota` WRITE;
/*!40000 ALTER TABLE `publikasi_anggota` DISABLE KEYS */;
INSERT INTO `publikasi_anggota` VALUES (2,'Sunset Di Tanah Air','2012','PT. Kompas Gramedia','Novel','IDO19991');
/*!40000 ALTER TABLE `publikasi_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relasi_anggota`
--

DROP TABLE IF EXISTS `relasi_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relasi_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaLengkap` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `nomorTelepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `kontakDarurat` tinyint(1) DEFAULT NULL,
  `statusMeninggal` tinyint(1) DEFAULT NULL,
  `idJenisRelasi` int(11) NOT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  KEY `idJenisRelasi` (`idJenisRelasi`),
  CONSTRAINT `relasi_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relasi_anggota_ibfk_2` FOREIGN KEY (`idJenisRelasi`) REFERENCES `jenis_relasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relasi_anggota`
--

LOCK TABLES `relasi_anggota` WRITE;
/*!40000 ALTER TABLE `relasi_anggota` DISABLE KEYS */;
INSERT INTO `relasi_anggota` VALUES (2,'Filixtiana Suyati','Vila Dago Tol Blok D7 Nomor 6','Guru / Karyawan Swasta','085885894300','-',1,0,2,'IDO19999'),(3,'Octavianus Bagaswara Adi','Jalan Elang Nomor 18, Ciputat','Mahasiswa','0882114188134','youngblueblack@gmail.com',1,0,4,'IDO19999'),(4,'Cerelius Andri Sulistyanto','Vila Dago Tol Blok D7 Nomor 6','Guru','081310294814','andrisulistyanto@gmail.com',0,0,1,'IDO19999');
/*!40000 ALTER TABLE `relasi_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `namaRole` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrator'),(2,'Personal'),(3,'Delegat'),(4,'Superior');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sakramen_anggota`
--

DROP TABLE IF EXISTS `sakramen_anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sakramen_anggota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaSakramen` varchar(255) DEFAULT NULL,
  `tanggalPenerimaan` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `sakramen_anggota_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sakramen_anggota`
--

LOCK TABLES `sakramen_anggota` WRITE;
/*!40000 ALTER TABLE `sakramen_anggota` DISABLE KEYS */;
INSERT INTO `sakramen_anggota` VALUES (1,'Baptis','2022-06-01','-','IDO19991'),(2,'Krisma','2022-06-25','-','IDO19991'),(9,'Baptis','2002-06-05',NULL,'IDO19999'),(10,'Krisma','2018-08-17','Oleh Mgr. Ignatius Suharyo','IDO19999');
/*!40000 ALTER TABLE `sakramen_anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serikat_jesus`
--

DROP TABLE IF EXISTS `serikat_jesus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serikat_jesus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) DEFAULT NULL,
  `tanggalTempat` varchar(255) DEFAULT NULL,
  `pembimbing` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `serikat_jesus_ibfk_1` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serikat_jesus`
--

LOCK TABLES `serikat_jesus` WRITE;
/*!40000 ALTER TABLE `serikat_jesus` DISABLE KEYS */;
/*!40000 ALTER TABLE `serikat_jesus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `namaLengkap` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idRole` int(11) DEFAULT NULL,
  `idAnggota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `idRole` (`idRole`),
  KEY `idAnggota` (`idAnggota`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`idAnggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','Administrator','$2y$10$6e8qRgJjn41Qf6Jtcfx5I.J1xGSsKdhx3OpnEj0A7G2x9PgU0zwAy',1,NULL),(4,'adrianfinantyo','Ariesto Adrian Finantyo, Bonifasius','$2y$10$AV5lJFlPT0lCGMHYtFJ3Zur4dBWPbQhNpzeLjt5yfbnxmE5cgsPBy',4,'IDO19999'),(21,'winsig','Windar Santoso, Ignatius','$2y$10$AV5lJFlPT0lCGMHYtFJ3Zur4dBWPbQhNpzeLjt5yfbnxmE5cgsPBy',2,'IDO19991'),(24,'bagas30','Octavianus Bagaswara Adi','$2y$10$ISZuIcVKgh1yQ8fA1ZpIZewux.l.WRbLD/kKwGMd0l..uXn/Clb2e',3,'IDO19995'),(25,'adrian2','Bonifasius, Adrian Ke 2','$2y$10$1OmwDSLB4TBHpHa42NfAEuJk0HR7xb.pEtDd7ZJ6q33c8AXyvSRdK',2,'IDO20121');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-02 16:47:54
