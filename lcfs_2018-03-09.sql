# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.2.9-MariaDB)
# Database: lcfs
# Generation Time: 2018-03-09 16:56:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '1 for ordinary and 2 for super admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(13,'08137990656','$2y$10$2neX8oDt7IIXcoGL.Ucz.eyPFmX58xOnlk3NXzNOXjoGZ62Yvpg0i',2,'Rm4rax2sLDYUPj3S9ISKBN9svZ2yQWBckNa3DmB2ptswR1y9ATcMzzCfZKDe','2017-08-20 00:49:37','2017-08-20 00:49:37');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table backgroundactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `backgroundactions`;

CREATE TABLE `backgroundactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `backgroundactions` WRITE;
/*!40000 ALTER TABLE `backgroundactions` DISABLE KEYS */;

INSERT INTO `backgroundactions` (`id`, `action_name`, `interval`, `created_at`, `updated_at`)
VALUES
	(1,'growth',1,'2017-07-23 23:00:00','2018-03-07 07:28:31'),
	(2,'auto_match',1,'2017-07-23 23:00:00','2017-08-08 06:04:56'),
	(3,'time_out',1,'2017-07-24 23:00:00','2018-03-07 07:28:31'),
	(4,'make_teamlead',1,'2017-07-27 23:00:00','2018-03-07 07:29:35'),
	(5,'pause_automatch',0,NULL,'2018-03-07 06:36:41'),
	(6,'insurance_value',30,NULL,'2018-03-06 11:34:06');

/*!40000 ALTER TABLE `backgroundactions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bonuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bonuses`;

CREATE TABLE `bonuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `rsmile_id` int(11) NOT NULL DEFAULT 0,
  `referee_gsmile_id` int(11) NOT NULL DEFAULT 0,
  `referee_id` int(11) NOT NULL DEFAULT 0,
  `has_cashed_out` int(11) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cconfirmations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cconfirmations`;

CREATE TABLE `cconfirmations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gsmile_id` int(11) NOT NULL,
  `rsmile_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `payment_type` int(10) NOT NULL DEFAULT 0 COMMENT '0 for 10% 1 for 90%',
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `teller_link` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `left_amount` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table gsmiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gsmiles`;

CREATE TABLE `gsmiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `left_amount` int(11) NOT NULL DEFAULT 0 COMMENT 'Amount left after part matching. it must return to 0.',
  `growth` int(11) NOT NULL DEFAULT 0 COMMENT 'ROI ',
  `age` int(11) NOT NULL DEFAULT 0 COMMENT 'GS age',
  `hidden` int(11) NOT NULL DEFAULT 0 COMMENT 'hidde for bonus and 10% pioneer',
  `track_token` int(11) NOT NULL,
  `r_token` int(11) NOT NULL DEFAULT 0,
  `reap_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 unreap, 1 for reaped',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table insurances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `insurances`;

CREATE TABLE `insurances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pioneer_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `insurances` WRITE;
/*!40000 ALTER TABLE `insurances` DISABLE KEYS */;

INSERT INTO `insurances` (`id`, `pioneer_id`, `count`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(12,40,1,NULL,'2017-08-06 23:00:00','2017-08-09 23:24:25'),
	(13,37,1,NULL,'2017-08-06 23:00:00','2017-08-06 23:00:00');

/*!40000 ALTER TABLE `insurances` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table matchusers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matchusers`;

CREATE TABLE `matchusers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gsmile_user_id` int(11) NOT NULL,
  `rsmile_user_id` int(11) NOT NULL,
  `gsmile_id` int(11) NOT NULL,
  `rsmile_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT 0 COMMENT '1 for 10% 0 for 90%',
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT 'gs of the 10%',
  `track_token` int(11) NOT NULL DEFAULT 0,
  `is_extended` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment_link` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2017_07_18_134449_create_referers_table',2),
	(4,'2017_07_18_202739_create_newsfeeds_table',3),
	(5,'2017_07_19_082342_create_testimonials_table',4),
	(8,'2017_07_19_095611_create_gsmiles_table',5),
	(9,'2017_07_19_095720_create_rsmiles_table',5),
	(11,'2017_07_20_030625_create_matchusers_table',6),
	(13,'2017_07_22_174040_create_confirmations_table',7),
	(14,'2017_07_22_221119_create_cconfirmations_table',8),
	(15,'2017_07_24_081716_create_backgroundactions_table',9),
	(17,'2017_07_25_150818_create_messages_table',10),
	(18,'2017_07_27_164703_create_bonuses_table',11),
	(20,'2017_08_03_140610_create_insurances_table',12),
	(21,'2017_08_08_211106_create_retaiments_table',13);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table newsfeeds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsfeeds`;

CREATE TABLE `newsfeeds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table referers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `referers`;

CREATE TABLE `referers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referer_user_id` int(11) DEFAULT 0,
  `referee_user_id` int(11) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table retaiments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `retaiments`;

CREATE TABLE `retaiments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `rsmile_id` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=reap,ed, 0=pending',
  `r_token` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table rsmiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rsmiles`;

CREATE TABLE `rsmiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gsmile_id` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL,
  `left_amount` int(11) NOT NULL,
  `has_received` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `track_token` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table testimonials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rsmile_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `video_link` varchar(256) DEFAULT NULL,
  `has_video` varchar(256) DEFAULT NULL,
  `has_approved` varchar(256) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pioneer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_teamlead` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_early_reaper` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_block` int(11) DEFAULT 0,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_account_name_unique` (`account_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `phone`, `email`, `password`, `name`, `activation_code`, `is_pioneer`, `is_teamlead`, `is_early_reaper`, `is_active`, `ip_address`, `is_block`, `account_no`, `account_name`, `bank`, `referer_link`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(37,'09078298167','system@gmail.com','$2y$10$UL.Ri0qwfY2Xmh.IicDSN.tfoFiVZ4QMAngIw6DG6RXnT7pzO6TTW','System ','SS87878','0','0',NULL,'1',NULL,0,'2101908076','Abimbola Helen Gbemisola','UBA','08101108569','AgybVlsLximMfTV20kX357Su41W9v8YJASDe8m66Atd7eUFjxAYBIcRbSb0I','2017-08-02 23:00:00','2017-08-06 07:10:41'),
	(40,'09078298168','system2@gmail.com','$2y$10$UL.Ri0qwfY2Xmh.IicDSN.tfoFiVZ4QMAngIw6DG6RXnT7pzO6TTW','System2','SS87879','0','0',NULL,'1',NULL,0,'2101908076','Abimbola Gbemisola','UBA','08101108569','efpG0r3aY7tKrXkzVOug23SO6J59FwbcY4XaFjhnoPLEjfoiZDcZ5jbNpuOy','2017-08-02 23:00:00','2017-08-09 23:25:57'),
	(101,'08161690210','olorunlogbonjohn89@gmail.com','$2y$10$A8v12nGoDUn2xnWNt96yTuxzVUHxfeiv9ltidRyDuUoyYpwG4C0Wy','Olorunlogbon John','SS87878','0','1',NULL,'1',NULL,0,'0036333778','Olorunlogbon John','First','','NBpT1wpajMATHGuZnOuV3VfKjDZOf2bqH5pbcCodA87ZbjEooxCqbuW1I3Xt','2017-08-02 23:00:00','2017-08-20 17:25:23');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
