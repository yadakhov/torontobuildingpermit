
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
DROP TABLE IF EXISTS `permits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permits` (
  `id` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `permit_num` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `revision_num` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structure_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_num` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_direction` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geo_id` int(10) unsigned DEFAULT NULL,
  `ward_grid` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `current_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proposed_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwelling_units_created` bigint(20) DEFAULT NULL,
  `dwelling_units_lost` bigint(20) DEFAULT NULL,
  `est_const_cost` decimal(16,2) DEFAULT NULL,
  `assembly` decimal(8,2) DEFAULT NULL,
  `institutional` decimal(8,2) DEFAULT NULL,
  `residential` decimal(8,2) DEFAULT NULL,
  `business_and_personal_services` decimal(12,2) DEFAULT NULL,
  `mercantile` decimal(8,2) DEFAULT NULL,
  `industrial` decimal(8,2) DEFAULT NULL,
  `interior_alterations` decimal(8,2) DEFAULT NULL,
  `demolition` decimal(8,2) DEFAULT NULL,
  `geocode` tinyint(1) NOT NULL DEFAULT '0',
  `lat` decimal(11,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `slug` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_date` (`application_date`),
  KEY `issued_date` (`issued_date`),
  KEY `geocode` (`geocode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

