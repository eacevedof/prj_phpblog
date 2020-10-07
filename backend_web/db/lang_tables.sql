/*
php artisan migrate:generate app_language,app_subject,app_sentence,app_sentence_images,app_sentence_tags,app_sentence_tr
*/

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
`code_cache` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
`source` varchar(500) DEFAULT NULL COMMENT 'fuente bibliografica link o texto',
`url_resource` varchar(500) DEFAULT NULL COMMENT 'url para el audio que no esta en el servidor',
`id_type_source` int(11) DEFAULT NULL COMMENT 'tipo de recurso, video, audio, imagen texto',
`code_cache` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
`translatable` varchar(2000) DEFAULT NULL COMMENT 'texto principal',
`id_language` int(11) DEFAULT NULL COMMENT 'app_language.id',
`is_notificable` tinyint(4) DEFAULT NULL COMMENT 'indica si se tomará en cuenta para examen',
`id_type` int(11) DEFAULT NULL COMMENT 'si estan en algún grupo',
`code_cache` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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

