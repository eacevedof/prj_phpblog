CREATE TABLE `app_sentence_tops` (
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
`id_user` int(11) DEFAULT NULL COMMENT 'texto traducido',
`id_sentence` int(11) DEFAULT NULL COMMENT 'app_sentence.id',
`code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `app_sentence_attempts` (
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
`id_user` int(11) DEFAULT NULL COMMENT 'texto traducido',
`id_sentence_tr` int(11) DEFAULT NULL COMMENT 'app_sentence_tr.id',
`iresult` tinyint(4) NOT NULL COMMENT '0: error, 1:ok, 2:skip',
`code_cache` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_language` */
insert  into `app_language`(`processflag`,`insert_platform`,`insert_user`,`insert_date`,`update_platform`,`update_user`,`update_date`,`delete_platform`,`delete_user`,`delete_date`,`cru_csvnote`,`is_erpsent`,`is_enabled`,`i`,`id`,`code_erp`,`description`,`translated`,`language`,`id_parent`,`code_cache`) values (NULL,'1',NULL,'2020-10-25 10:58:47',NULL,NULL,'2020-10-25 10:58:47',NULL,NULL,NULL,NULL,'0','1',NULL,1,'en','English',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 10:59:10',NULL,NULL,'2020-10-25 10:59:10',NULL,NULL,NULL,NULL,'0','1',NULL,2,'es','Spanish',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 10:59:31',NULL,NULL,'2020-10-25 10:59:31',NULL,NULL,NULL,NULL,'0','1',NULL,3,'nl','Dutch',NULL,'english',NULL,NULL),(NULL,'1',NULL,'2020-10-25 11:00:42',NULL,NULL,'2020-10-25 11:00:42',NULL,NULL,NULL,NULL,'0','1',NULL,4,'fr','French',NULL,'english',NULL,NULL);

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
