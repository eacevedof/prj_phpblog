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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_ip_untracked` */

DROP TABLE IF EXISTS `app_ip_untracked`;

CREATE TABLE `app_ip_untracked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insert_date` timestamp NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remote_ip` varchar(100) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `whois` varchar(200) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `is_enabled` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `remote_ip` (`remote_ip`),
  KEY `is_enabled` (`is_enabled`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_language` */

DROP TABLE IF EXISTS `app_language`;

CREATE TABLE `app_language` (
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
  `translated` varchar(250) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL COMMENT 'en-Uk,es-Sp,es-Lat,en-Usa',
  `id_parent` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_post` */

DROP TABLE IF EXISTS `app_post`;

CREATE TABLE `app_post` (
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
  `slug` varchar(150) DEFAULT NULL,
  `is_page` tinyint(4) DEFAULT 0,
  `url_final` varchar(300) DEFAULT NULL,
  `id_type` int(11) DEFAULT 1 COMMENT 'ar(10) categories',
  `url_img1` varchar(300) DEFAULT NULL COMMENT 'foto portada',
  `url_img2` varchar(300) DEFAULT NULL COMMENT 'foto listado',
  `url_img3` varchar(300) DEFAULT NULL COMMENT 'foto detalle',
  `title` varchar(350) DEFAULT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `excerpt` varchar(1000) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `id_user` int(11) DEFAULT 1 COMMENT 'author',
  `id_status` tinyint(4) DEFAULT 0 COMMENT 'ar(20) 1:enabled, 0:disabled',
  `publish_date` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `num_likes` int(5) DEFAULT NULL,
  `num_dislikes` int(5) DEFAULT NULL,
  `seo_title` varchar(65) DEFAULT NULL,
  `seo_description` varchar(160) DEFAULT NULL,
  `seo_keywords` varchar(160) DEFAULT NULL,
  `order_by` int(5) NOT NULL DEFAULT 100,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_sentence` */

DROP TABLE IF EXISTS `app_sentence`;

CREATE TABLE `app_sentence` (
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
  `id_subject` int(11) NOT NULL COMMENT 'app_subject.id',
  `id_context` int(11) DEFAULT NULL COMMENT 'app_array.id (lang-contexts)',
  `translatable` varchar(2000) DEFAULT NULL COMMENT 'texto principal',
  `id_language` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `is_notificable` tinyint(4) DEFAULT NULL COMMENT 'indica si se tomará en cuenta para examen',
  `id_type` int(11) DEFAULT NULL COMMENT 'si estan en algún grupo',
  `id_status` tinyint(4) DEFAULT 0,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_sentence_images` */

DROP TABLE IF EXISTS `app_sentence_images`;

CREATE TABLE `app_sentence_images` (
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
  `id_sentence` int(11) NOT NULL COMMENT 'app_language.id',
  `path_local` varchar(500) DEFAULT NULL COMMENT 'si se ha guardado en el servidor',
  `url_resource` varchar(500) DEFAULT NULL COMMENT 'url para evitar de guardar en el servidor',
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_sentence_tags` */

DROP TABLE IF EXISTS `app_sentence_tags`;

CREATE TABLE `app_sentence_tags` (
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
  `id_sentence` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_sentence_tr` */

DROP TABLE IF EXISTS `app_sentence_tr`;

CREATE TABLE `app_sentence_tr` (
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
  `translated` varchar(2000) DEFAULT NULL COMMENT 'texto traducido',
  `id_language` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `id_sentence` int(11) DEFAULT NULL COMMENT 'app_sentence.id',
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `app_subject` */

DROP TABLE IF EXISTS `app_subject`;

CREATE TABLE `app_subject` (
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
  `slug` varchar(150) DEFAULT NULL,
  `url_final` varchar(300) DEFAULT NULL,
  `url_img1` varchar(300) DEFAULT NULL,
  `url_img2` varchar(300) DEFAULT NULL,
  `title` varchar(350) DEFAULT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `url_resource` varchar(500) DEFAULT NULL COMMENT 'url para el audio que no esta en el servidor',
  `id_type_source` int(11) DEFAULT NULL COMMENT 'tipo de recurso, video, audio, imagen texto',
  `id_status` tinyint(4) DEFAULT 0,
  `seo_title` varchar(65) DEFAULT NULL,
  `seo_description` varchar(160) DEFAULT NULL,
  `seo_keywords` varchar(160) DEFAULT NULL,
  `code_cache` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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

/*Table structure for table `imp_post` */

DROP TABLE IF EXISTS `imp_post`;

CREATE TABLE `imp_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) DEFAULT NULL,
  `publish_date` varchar(20) DEFAULT NULL,
  `last_update` varchar(20) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `excerpt` varchar(2000) DEFAULT NULL,
  `id_status` varchar(100) DEFAULT NULL,
  `slug` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
