
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
DROP TABLE IF EXISTS `permits_loading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permits_loading` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permit_num` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `revision_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permit_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `structure_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street_direction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geo_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward_grid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `application_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issued_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `completed_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `current_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proposed_use` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwelling_units_created` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwelling_units_lost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `est_const_cost` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assembly` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institutional` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residential` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business_and_personal_services` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mercantile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `industrial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interior_alterations` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `demolition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
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

