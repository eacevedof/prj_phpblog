/*
SQLyog Community v12.1 (32 bit)
MySQL - 10.4.11-MariaDB-1:10.4.11+maria~bionic : Database - db_eduardoaf
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_eduardoaf` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_eduardoaf`;

/*Table structure for table `app_array` */

DROP TABLE IF EXISTS `app_array`;

CREATE TABLE `app_array` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `id_tosave` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `url_final` varchar(200) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL COMMENT 'propietario del tipo o categoria',
  `order_by` int(5) NOT NULL DEFAULT 100,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `app_array` */

insert  into `app_array`(`processflag`,`insert_platform`,`insert_user`,`insert_date`,`update_platform`,`update_user`,`update_date`,`delete_platform`,`delete_user`,`delete_date`,`cru_csvnote`,`is_erpsent`,`is_enabled`,`i`,`id`,`code_erp`,`type`,`id_tosave`,`description`,`slug`,`url_final`,`id_user`,`order_by`,`code_cache`) values (NULL,'1',NULL,'2020-09-02 15:46:46',NULL,NULL,'2020-09-08 15:22:55',NULL,NULL,NULL,NULL,'0','1',NULL,1,NULL,'post',NULL,'generic','global',NULL,NULL,200,NULL),(NULL,'1',NULL,'2020-09-02 15:47:15',NULL,NULL,'2020-09-08 15:22:58',NULL,NULL,NULL,NULL,'0','1',NULL,2,NULL,'post',NULL,'single page','sp',NULL,NULL,300,NULL),(NULL,'1',NULL,'2020-09-02 15:47:35',NULL,NULL,'2020-09-17 15:09:58',NULL,NULL,NULL,NULL,'0','1',NULL,3,NULL,'post',NULL,'PHP','php','/blog/php',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 15:47:45',NULL,NULL,'2020-09-17 15:10:08',NULL,NULL,NULL,NULL,'0','1',NULL,4,NULL,'post',NULL,'Javascript','javascript','/blog/javascript',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 15:47:53',NULL,NULL,'2020-09-17 15:10:16',NULL,NULL,NULL,NULL,'0','1',NULL,5,NULL,'post',NULL,'SQL','sql','/blog/sql',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 15:48:21',NULL,NULL,'2020-09-17 15:10:23',NULL,NULL,NULL,NULL,'0','1',NULL,6,NULL,'post',NULL,'Docker','docker','/blog/docker',NULL,100,NULL),(NULL,'1',NULL,'2020-09-05 11:21:49',NULL,NULL,'2020-09-17 15:10:28',NULL,NULL,NULL,NULL,'0','1',NULL,7,NULL,'post',NULL,'Python','python','/blog/python',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 08:08:41',NULL,NULL,'2020-09-17 14:39:07',NULL,NULL,NULL,NULL,'0','1',NULL,8,NULL,'submenu-blog',NULL,'PHP','php','/blog/php',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 08:09:02',NULL,NULL,'2020-09-17 14:42:43',NULL,NULL,NULL,NULL,'0','1',NULL,9,NULL,'submenu-blog',NULL,'Javascript','javascript','/blog/javascript',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 08:09:10',NULL,NULL,'2020-09-17 14:42:47',NULL,NULL,NULL,NULL,'0','1',NULL,10,NULL,'submenu-blog',NULL,'SQL','sql','/blog/sql',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 08:09:23',NULL,NULL,'2020-09-17 14:42:51',NULL,NULL,NULL,NULL,'0','1',NULL,11,NULL,'submenu-blog',NULL,'Docker','docker','/blog/docker',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 08:09:30',NULL,NULL,'2020-09-17 14:42:55',NULL,NULL,NULL,NULL,'0','1',NULL,12,NULL,'submenu-blog',NULL,'Python','python','/blog/python',NULL,100,NULL),(NULL,'1',NULL,'2020-09-13 16:28:09',NULL,NULL,'2020-09-17 14:43:33',NULL,NULL,NULL,NULL,'0','1',NULL,14,NULL,'submenu-service',NULL,'Convertir PDF a jpg','convertir-pdf-a-jpg','/servicios/convertir-pdf-a-jpg',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 09:23:26',NULL,NULL,'2020-09-17 15:10:35',NULL,NULL,NULL,NULL,'0','1',NULL,15,NULL,'post',NULL,'Linux','linux','/blog/linux',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 09:23:59',NULL,NULL,'2020-09-17 14:43:00',NULL,NULL,NULL,NULL,'0','1',NULL,16,NULL,'submenu-blog',NULL,'Linux','slug','/blog/linux',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 09:49:30',NULL,NULL,'2020-09-17 15:10:44',NULL,NULL,NULL,NULL,'0','1',NULL,17,NULL,'post',NULL,'Modula 2','modula-2','/blog/modula-2',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 13:21:05',NULL,NULL,'2020-09-17 15:10:54',NULL,NULL,NULL,NULL,'0','1',NULL,18,NULL,'post',NULL,'Visual Basic','visual-basic','/blog/visual-basic',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 16:22:24',NULL,NULL,'2020-09-17 16:22:24',NULL,NULL,NULL,NULL,'0','1',NULL,19,NULL,'post',NULL,'Diseño gráfico','diseno-grafico','/blog/diseno-grafico',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 17:46:00',NULL,NULL,'2020-09-17 17:46:14',NULL,NULL,NULL,NULL,'0','1',NULL,20,NULL,'post',NULL,'CCNA','ccna','/blog/ccna',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 18:27:18',NULL,NULL,'2020-09-17 18:27:18',NULL,NULL,NULL,NULL,'0','1',NULL,21,NULL,'post',NULL,'C#','c-sharp','/blog/c-sharp',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 18:27:43',NULL,NULL,'2020-09-17 18:27:43',NULL,NULL,NULL,NULL,'0','1',NULL,22,NULL,'submenu-blog',NULL,'C#','c-sharp','/blog/c-sharp',NULL,100,NULL);

/*Table structure for table `app_post_comments` */

DROP TABLE IF EXISTS `app_post_comments`;

CREATE TABLE `app_post_comments` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL COMMENT 'para seo: 160 cjars',
  `id_post` int(11) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL COMMENT 'respuesta a uno anterior',
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site` varchar(150) DEFAULT NULL,
  `content` varchar(3000) DEFAULT NULL,
  `num_likes` int(5) DEFAULT NULL,
  `num_dislikes` int(5) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0 COMMENT 'si se ha aprobado',
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `app_post_comments` */

/*Table structure for table `app_posts_tags` */

DROP TABLE IF EXISTS `app_posts_tags`;

CREATE TABLE `app_posts_tags` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `id_tosave` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `order_by` int(5) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `app_posts_tags` */

/*Table structure for table `app_tag` */

DROP TABLE IF EXISTS `app_tag`;

CREATE TABLE `app_tag` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL COMMENT 'la descripcion en slug',
  `order_by` int(5) NOT NULL DEFAULT 100,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `app_tag` */

/*Table structure for table `app_tag_array` */

DROP TABLE IF EXISTS `app_tag_array`;

CREATE TABLE `app_tag_array` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `id_tosave` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `order_by` int(5) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `app_tag_array` */

/*Table structure for table `base_user` */

DROP TABLE IF EXISTS `base_user`;

CREATE TABLE `base_user` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `geo_location` varchar(500) DEFAULT NULL,
  `id_gender` int(11) DEFAULT NULL,
  `id_nationality` int(11) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL COMMENT 'app_array.type=country',
  `id_language` int(11) DEFAULT NULL COMMENT 'su idioma de preferencia',
  `path_picture` varchar(100) DEFAULT NULL,
  `id_profile` int(11) DEFAULT NULL COMMENT 'app_array.type=profile: user,maintenaince,system,enterprise, individual, client',
  `tokenreset` varchar(250) DEFAULT NULL,
  `log_attempts` int(5) DEFAULT 0,
  `rating` int(11) DEFAULT NULL COMMENT 'la puntuacion',
  `date_validated` varchar(14) DEFAULT NULL COMMENT 'cuando valido su cuenta por email',
  `is_notificable` tinyint(4) DEFAULT 0 COMMENT 'para enviar notificaciones push',
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `base_user_email_uindex` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `base_user` */

/*Table structure for table `base_user_array` */

DROP TABLE IF EXISTS `base_user_array`;

CREATE TABLE `base_user_array` (
  `processflag` varchar(5) DEFAULT NULL,
  `insert_platform` varchar(3) DEFAULT '1',
  `insert_user` varchar(15) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) DEFAULT NULL,
  `update_user` varchar(15) DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) DEFAULT NULL,
  `delete_user` varchar(15) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `cru_csvnote` varchar(500) DEFAULT NULL,
  `is_erpsent` varchar(3) DEFAULT '0',
  `is_enabled` varchar(3) DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `id_tosave` varchar(25) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `order_by` int(5) NOT NULL DEFAULT 100,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `base_user_array` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `imp_post` */

DROP TABLE IF EXISTS `imp_post`;

CREATE TABLE `imp_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publish_date` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `excerpt` varchar(1000) DEFAULT NULL,
  `id_status` varchar(100) DEFAULT NULL,
  `slug` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Data for the table `imp_post` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_09_02_111139_create_app_array_table',0),(5,'2020_09_02_111139_create_app_post_table',0),(6,'2020_09_02_111139_create_app_posts_tags_table',0),(7,'2020_09_02_111139_create_app_tag_table',0),(8,'2020_09_02_111139_create_app_tag_array_table',0),(9,'2020_09_02_111139_create_base_user_table',0),(10,'2020_09_02_111139_create_base_user_array_table',0),(11,'2020_09_02_111139_create_failed_jobs_table',0),(12,'2020_09_02_111139_create_password_resets_table',0),(13,'2020_09_02_111139_create_users_table',0),(14,'2020_09_02_105624_app_post',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Eduardo','eacevedof@hotmail.com',NULL,'$2y$10$fy2V3jvaRA9l/N1JO1l1ZOlL/xeXT9.nuzqVAVbpkrTCgqUa8gT5G',NULL,'2020-09-02 14:07:52','2020-09-02 14:07:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
