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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `app_array` */

insert  into `app_array`(`processflag`,`insert_platform`,`insert_user`,`insert_date`,`update_platform`,`update_user`,`update_date`,`delete_platform`,`delete_user`,`delete_date`,`cru_csvnote`,`is_erpsent`,`is_enabled`,`i`,`id`,`code_erp`,`type`,`id_tosave`,`description`,`slug`,`url_final`,`id_user`,`order_by`,`code_cache`) values (NULL,'1',NULL,'2020-09-02 13:46:46',NULL,NULL,'2020-09-08 13:22:55',NULL,NULL,NULL,NULL,'0','1',NULL,1,NULL,'post',NULL,'generic','global',NULL,NULL,200,NULL),(NULL,'1',NULL,'2020-09-02 13:47:15',NULL,NULL,'2020-09-08 13:22:58',NULL,NULL,NULL,NULL,'0','1',NULL,2,NULL,'post',NULL,'single page','sp',NULL,NULL,300,NULL),(NULL,'1',NULL,'2020-09-02 13:47:35',NULL,NULL,'2020-09-17 13:09:58',NULL,NULL,NULL,NULL,'0','1',NULL,3,NULL,'post',NULL,'PHP','php','/blog/php',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 13:47:45',NULL,NULL,'2020-09-17 13:10:08',NULL,NULL,NULL,NULL,'0','1',NULL,4,NULL,'post',NULL,'Javascript','javascript','/blog/javascript',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 13:47:53',NULL,NULL,'2020-09-17 13:10:16',NULL,NULL,NULL,NULL,'0','1',NULL,5,NULL,'post',NULL,'SQL','sql','/blog/sql',NULL,100,NULL),(NULL,'1',NULL,'2020-09-02 13:48:21',NULL,NULL,'2020-09-17 13:10:23',NULL,NULL,NULL,NULL,'0','1',NULL,6,NULL,'post',NULL,'Docker','docker','/blog/docker',NULL,100,NULL),(NULL,'1',NULL,'2020-09-05 09:21:49',NULL,NULL,'2020-09-17 13:10:28',NULL,NULL,NULL,NULL,'0','1',NULL,7,NULL,'post',NULL,'Python','python','/blog/python',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 06:08:41',NULL,NULL,'2020-09-17 12:39:07',NULL,NULL,NULL,NULL,'0','1',NULL,8,NULL,'submenu-blog',NULL,'PHP','php','/blog/php',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 06:09:02',NULL,NULL,'2020-09-17 12:42:43',NULL,NULL,NULL,NULL,'0','1',NULL,9,NULL,'submenu-blog',NULL,'Javascript','javascript','/blog/javascript',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 06:09:10',NULL,NULL,'2020-09-17 12:42:47',NULL,NULL,NULL,NULL,'0','1',NULL,10,NULL,'submenu-blog',NULL,'SQL','sql','/blog/sql',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 06:09:23',NULL,NULL,'2020-09-17 12:42:51',NULL,NULL,NULL,NULL,'0','1',NULL,11,NULL,'submenu-blog',NULL,'Docker','docker','/blog/docker',NULL,100,NULL),(NULL,'1',NULL,'2020-09-06 06:09:30',NULL,NULL,'2020-09-17 12:42:55',NULL,NULL,NULL,NULL,'0','1',NULL,12,NULL,'submenu-blog',NULL,'Python','python','/blog/python',NULL,100,NULL),(NULL,'1',NULL,'2020-09-13 14:28:09',NULL,NULL,'2020-09-17 12:43:33',NULL,NULL,NULL,NULL,'0','1',NULL,14,NULL,'submenu-service',NULL,'Convertir PDF a jpg','convertir-pdf-a-jpg','/servicios/convertir-pdf-a-jpg',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 07:23:26',NULL,NULL,'2020-09-17 13:10:35',NULL,NULL,NULL,NULL,'0','1',NULL,15,NULL,'post',NULL,'Linux','linux','/blog/linux',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 07:23:59',NULL,NULL,'2020-09-17 12:43:00',NULL,NULL,NULL,NULL,'0','1',NULL,16,NULL,'submenu-blog',NULL,'Linux','slug','/blog/linux',NULL,100,NULL),(NULL,'1',NULL,'2020-09-16 07:49:30',NULL,NULL,'2020-09-17 13:10:44',NULL,NULL,NULL,NULL,'0','1',NULL,17,NULL,'post',NULL,'Modula 2','modula-2','/blog/modula-2',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 11:21:05',NULL,NULL,'2020-09-17 13:10:54',NULL,NULL,NULL,NULL,'0','1',NULL,18,NULL,'post',NULL,'Visual Basic','visual-basic','/blog/visual-basic',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 14:22:24',NULL,NULL,'2020-09-17 14:22:24',NULL,NULL,NULL,NULL,'0','1',NULL,19,NULL,'post',NULL,'Diseño gráfico','diseno-grafico','/blog/diseno-grafico',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 15:46:00',NULL,NULL,'2020-09-17 15:46:14',NULL,NULL,NULL,NULL,'0','1',NULL,20,NULL,'post',NULL,'CCNA','ccna','/blog/ccna',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 16:27:18',NULL,NULL,'2020-09-17 16:27:18',NULL,NULL,NULL,NULL,'0','1',NULL,21,NULL,'post',NULL,'C#','c-sharp','/blog/c-sharp',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 16:27:43',NULL,NULL,'2020-09-17 16:27:43',NULL,NULL,NULL,NULL,'0','1',NULL,22,NULL,'submenu-blog',NULL,'C#','c-sharp','/blog/c-sharp',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 16:27:18',NULL,NULL,'2020-09-17 16:27:18',NULL,NULL,NULL,NULL,'0','1',NULL,23,NULL,'post',NULL,'Cloud','cloud','/blog/cloud',NULL,100,NULL),(NULL,'1',NULL,'2020-09-17 16:27:43',NULL,NULL,'2020-09-17 16:27:43',NULL,NULL,NULL,NULL,'0','1',NULL,24,NULL,'submenu-blog',NULL,'cloud','cloud','/blog/cloud',NULL,100,NULL),(NULL,'1',NULL,'2020-10-09 22:00:00',NULL,NULL,'2020-10-09 22:00:00',NULL,NULL,NULL,NULL,'0','1',NULL,25,NULL,'post',NULL,'CSS','css','/blog/css',NULL,100,NULL),(NULL,'1',NULL,'2020-10-10 18:23:31',NULL,NULL,'2020-10-10 18:23:31',NULL,NULL,NULL,NULL,'0','1',NULL,26,NULL,'submenu-blog',NULL,'CSS','css','/blog/css',NULL,100,NULL),(NULL,'1',NULL,'2020-10-18 16:56:48',NULL,NULL,'2020-10-24 11:40:38',NULL,NULL,NULL,NULL,'0','1',NULL,27,NULL,'lang-source',NULL,'Image','image',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-18 16:58:18',NULL,NULL,'2020-10-24 11:40:04',NULL,NULL,NULL,NULL,'0','1',NULL,28,NULL,'lang-source',NULL,'Audio','audio',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-18 16:58:31',NULL,NULL,'2020-10-24 11:40:01',NULL,NULL,NULL,NULL,'0','1',NULL,29,NULL,'lang-source',NULL,'Video','video',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-18 16:58:31',NULL,NULL,'2020-10-18 16:58:44',NULL,NULL,NULL,NULL,'0','1',NULL,30,NULL,'lang-source',NULL,'Text','text',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-18 16:56:48',NULL,NULL,'2020-10-24 11:40:30',NULL,NULL,NULL,NULL,'0','1',NULL,31,NULL,'lang-source',NULL,'Other','other',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-25 12:16:54',NULL,NULL,'2020-10-25 12:16:54',NULL,NULL,NULL,NULL,'0','1',NULL,32,NULL,'lang-context',NULL,'Generic','generic',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-25 12:19:26',NULL,NULL,'2020-10-25 12:22:00',NULL,NULL,NULL,NULL,'0','1',NULL,33,NULL,'lang-type',NULL,'Generic','generic',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-25 13:15:34',NULL,NULL,'2020-10-25 13:15:34',NULL,NULL,NULL,NULL,'0','1',NULL,34,NULL,'lang-type',NULL,'Word','word',NULL,NULL,100,NULL),(NULL,'1',NULL,'2020-10-25 13:16:10',NULL,NULL,'2020-10-25 13:16:10',NULL,NULL,NULL,NULL,'0','1',NULL,35,NULL,'lang-type',NULL,'Sentence','sentence',NULL,NULL,100,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `app_ip_untracked` */

insert  into `app_ip_untracked`(`id`,`insert_date`,`update_date`,`remote_ip`,`country`,`whois`,`comment`,`is_enabled`) values (1,'2020-09-21 18:15:29','2020-10-03 14:02:48','139.47.67.18',NULL,NULL,NULL,1),(2,'2020-10-06 20:22:36','2020-10-06 20:22:36','139.47.75.65',NULL,NULL,NULL,1),(4,'2020-10-06 20:22:36','2020-10-06 20:22:36','139.47.75.46',NULL,NULL,NULL,1);

/*Table structure for table `app_language` */

DROP TABLE IF EXISTS `app_language`;

CREATE TABLE `app_language` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `translated` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'en-Uk,es-Sp,es-Lat,en-Usa',
  `id_parent` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_language` */

insert  into `app_language`(`processflag`,`insert_platform`,`insert_user`,`insert_date`,`update_platform`,`update_user`,`update_date`,`delete_platform`,`delete_user`,`delete_date`,`cru_csvnote`,`is_erpsent`,`is_enabled`,`i`,`id`,`code_erp`,`description`,`translated`,`language`,`id_parent`,`code_cache`) values (NULL,'1',NULL,'2020-10-25 10:58:47',NULL,NULL,'2020-10-25 10:58:47',NULL,NULL,NULL,NULL,'0','1',NULL,1,'en','English',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 10:59:10',NULL,NULL,'2020-10-25 10:59:10',NULL,NULL,NULL,NULL,'0','1',NULL,2,'es','Spanish',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 10:59:31',NULL,NULL,'2020-10-25 10:59:31',NULL,NULL,NULL,NULL,'0','1',NULL,3,'nl','Dutch',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 11:00:42',NULL,NULL,'2020-10-25 11:00:42',NULL,NULL,NULL,NULL,'0','1',NULL,4,'fr','French',NULL,'english',NULL,NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

/*Data for the table `app_posts_tags` */

/*Table structure for table `app_sentence` */

DROP TABLE IF EXISTS `app_sentence`;

CREATE TABLE `app_sentence` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_subject` int(11) NOT NULL COMMENT 'app_subject.id',
  `id_context` int(11) DEFAULT NULL COMMENT 'app_array.id (lang-contexts)',
  `translatable` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'texto principal',
  `id_language` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `is_notificable` tinyint(1) DEFAULT NULL COMMENT 'indica si se tomará en cuenta para examen',
  `id_type` int(11) DEFAULT NULL COMMENT 'si estan en algún grupo',
  `id_status` int(1) DEFAULT NULL COMMENT 'activo o inactivo',
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_sentence` */

/*Table structure for table `app_sentence_images` */

DROP TABLE IF EXISTS `app_sentence_images`;

CREATE TABLE `app_sentence_images` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sentence` int(11) NOT NULL COMMENT 'app_language.id',
  `path_local` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'si se ha guardado en el servidor',
  `url_resource` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'url para evitar de guardar en el servidor',
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_sentence_images` */

/*Table structure for table `app_sentence_tags` */

DROP TABLE IF EXISTS `app_sentence_tags`;

CREATE TABLE `app_sentence_tags` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sentence` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_sentence_tags` */

/*Table structure for table `app_sentence_tr` */

DROP TABLE IF EXISTS `app_sentence_tr`;

CREATE TABLE `app_sentence_tr` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `translated` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'texto traducido',
  `id_language` int(11) DEFAULT NULL COMMENT 'app_language.id',
  `id_sentence` int(11) DEFAULT NULL COMMENT 'app_sentence.id',
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_sentence_tr` */

/*Table structure for table `app_subject` */

DROP TABLE IF EXISTS `app_subject`;

CREATE TABLE `app_subject` (
  `processflag` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `insert_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_platform` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_user` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `cru_csvnote` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_erpsent` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_enabled` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `i` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_erp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_final` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_img1` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_img2` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_resource` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'url para el audio que no esta en el servidor',
  `id_type_source` int(11) DEFAULT NULL COMMENT 'tipo de recurso, video, audio, imagen texto',
  `id_status` tinyint(1) DEFAULT 0,
  `seo_title` varchar(65) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keywords` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_subject` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

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

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Eduardo','eacevedof@hotmail.com',NULL,'$2y$10$P35AQAhvnFaeJscDbDd9BOFoiMs9GkbZ6y2tplcNyQfhlvNyawBte',NULL,'2020-09-20 10:41:24','2020-09-20 10:41:24');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
