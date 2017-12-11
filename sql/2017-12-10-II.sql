# SQL Manager 2011 for MySQL 5.1.0.2
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : autonoma


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `autonoma`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `autonoma`;

#
# Structure for the `modalidad` table : 
#

CREATE TABLE `modalidad` (
  `idmodalidad` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`idmodalidad`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `user` table : 
#

CREATE TABLE `user` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `apellido` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `codigo_estudiantil` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `facultad` ENUM('Ing. Sistemas informatico','Ing. Ambiental','Ing. Electronica','') NOT NULL,
  `username` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  `auth_key` VARCHAR(32) COLLATE utf8_general_ci NOT NULL,
  `password_hash` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  `password_reset_token` VARCHAR(255) COLLATE utf8_general_ci DEFAULT NULL,
  `email` VARCHAR(255) COLLATE utf8_general_ci NOT NULL,
  `status` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `created_at` DATE NOT NULL,
  `updated_at` DATE NOT NULL,
  `cont` INTEGER(11) NOT NULL DEFAULT 0,
  `fecha_fin` DATE DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
)ENGINE=InnoDB
AUTO_INCREMENT=74 AVG_ROW_LENGTH=356 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
COMMENT=''
;

CREATE DEFINER = 'root'@'localhost' TRIGGER `fecha_fin_proyecto` BEFORE INSERT ON `user`
  FOR EACH ROW
BEGIN
SET NEW.fecha_fin = ADDDATE(curdate(), INTERVAL 365 DAY);
END;

#
# Structure for the `anteproyecto` table : 
#

CREATE TABLE `anteproyecto` (
  `idanteproyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci DEFAULT NULL,
  `archivo_anteproyecto` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `estado` INTEGER(11) NOT NULL DEFAULT 0,
  `alerta` INTEGER(11) NOT NULL DEFAULT 1,
  `date_create` TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `idmodalidad` INTEGER(11) NOT NULL,
  `id` INTEGER(11) NOT NULL,
  `objetivos` TEXT COLLATE utf8_general_ci,
  `planteamiento_problema` TEXT COLLATE utf8_general_ci,
  `justificacion` TEXT COLLATE utf8_general_ci,
  PRIMARY KEY (`idanteproyecto`),
  KEY `fk_anteproyecto_modalidad1_idx` (`idmodalidad`),
  KEY `fk_anteproyecto_user1_idx` (`id`),
  CONSTRAINT `fk_anteproyecto_modalidad1` FOREIGN KEY (`idmodalidad`) REFERENCES `modalidad` (`idmodalidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_anteproyecto_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=34 AVG_ROW_LENGTH=630 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `auth_rule` table : 
#

CREATE TABLE `auth_rule` (
  `name` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  `data` BLOB,
  `created_at` INTEGER(11) DEFAULT NULL,
  `updated_at` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
)ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
COMMENT=''
;

#
# Structure for the `auth_item` table : 
#

CREATE TABLE `auth_item` (
  `name` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  `description` TEXT COLLATE utf8_general_ci,
  `rule_name` VARCHAR(64) COLLATE utf8_general_ci DEFAULT NULL,
  `data` BLOB,
  `created_at` INTEGER(11) DEFAULT NULL,
  `updated_at` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB
AVG_ROW_LENGTH=3276 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
COMMENT=''
;

#
# Structure for the `auth_assignment` table : 
#

CREATE TABLE `auth_assignment` (
  `item_name` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  `user_id` INTEGER(11) NOT NULL,
  `created_at` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB
AVG_ROW_LENGTH=399 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
COMMENT=''
;

#
# Structure for the `auth_item_child` table : 
#

CREATE TABLE `auth_item_child` (
  `parent` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  `child` VARCHAR(64) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
COMMENT=''
;

#
# Structure for the `conocimiento` table : 
#

CREATE TABLE `conocimiento` (
  `idconocimiento` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` INTEGER(11) NOT NULL,
  `correo` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `id_programas` INTEGER(11) DEFAULT NULL,
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idconocimiento`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `director_proyecto` table : 
#

CREATE TABLE `director_proyecto` (
  `iddirector_proyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`iddirector_proyecto`)
)ENGINE=InnoDB
AUTO_INCREMENT=5 AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `proyecto` table : 
#

CREATE TABLE `proyecto` (
  `idproyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci DEFAULT NULL,
  `archivo_proyecto` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `date_create` TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `id` INTEGER(11) NOT NULL,
  `articulo` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `estado` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `objetivos` TEXT COLLATE utf8_general_ci,
  `planteamiento_problema` TEXT COLLATE utf8_general_ci,
  `justificacion` TEXT COLLATE utf8_general_ci,
  PRIMARY KEY (`idproyecto`),
  KEY `fk_proyecto_anteproyecto1_idx` (`idproyecto`),
  KEY `fk_proyecto_user1_idx` (`id`),
  CONSTRAINT `fk_proyecto_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=10 AVG_ROW_LENGTH=1820 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `director_proyecto_por_proyecto` table : 
#

CREATE TABLE `director_proyecto_por_proyecto` (
  `iddirector_proyecto` INTEGER(11) NOT NULL,
  `idproyecto` INTEGER(11) NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`iddirector_proyecto`, `idproyecto`),
  KEY `fk_director_proyecto_has_proyecto_proyecto1_idx` (`idproyecto`),
  KEY `fk_director_proyecto_has_proyecto_director_proyecto1_idx` (`iddirector_proyecto`),
  CONSTRAINT `fk_director_proyecto_has_proyecto_director_proyecto1` FOREIGN KEY (`iddirector_proyecto`) REFERENCES `director_proyecto` (`iddirector_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_director_proyecto_has_proyecto_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `documento_tipo` table : 
#

CREATE TABLE `documento_tipo` (
  `id_documento_tipo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_documento_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=4 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `documento` table : 
#

CREATE TABLE `documento` (
  `iddocumento` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `archivo` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  `id_documento_tipo` INTEGER(11) DEFAULT NULL,
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iddocumento`),
  KEY `id_documento_tipo` (`id_documento_tipo`),
  CONSTRAINT `documento_fk1` FOREIGN KEY (`id_documento_tipo`) REFERENCES documento_tipo (`id_documento_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=2048 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `evento` table : 
#

CREATE TABLE `evento` (
  `idevento` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idevento`)
)ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `jurado` table : 
#

CREATE TABLE `jurado` (
  `idjurado` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`idjurado`)
)ENGINE=InnoDB
AUTO_INCREMENT=5 AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `jurado_has_proyecto` table : 
#

CREATE TABLE `jurado_has_proyecto` (
  `idjurado` INTEGER(11) NOT NULL,
  `idproyecto` INTEGER(11) NOT NULL,
  `idjurado2` INTEGER(11) NOT NULL,
  PRIMARY KEY (`idjurado`, `idproyecto`, `idjurado2`),
  KEY `fk_jurado_has_proyecto_proyecto1_idx` (`idproyecto`),
  KEY `fk_jurado_has_proyecto_jurado1_idx` (`idjurado`),
  KEY `fk_jurado_has_proyecto_jurado2_idx` (`idjurado2`),
  CONSTRAINT `fk_jurado_has_proyecto_jurado1` FOREIGN KEY (`idjurado`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jurado_has_proyecto_jurado2` FOREIGN KEY (`idjurado2`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jurado_has_proyecto_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AVG_ROW_LENGTH=2730 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `migration` table : 
#

CREATE TABLE `migration` (
  `version` VARCHAR(180) COLLATE utf8mb4_bin NOT NULL,
  `apply_time` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
)ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `novedades` table : 
#

CREATE TABLE `novedades` (
  `idnovedades` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `fecha` DATETIME NOT NULL,
  `idproyecto` INTEGER(11) NOT NULL,
  PRIMARY KEY (`idnovedades`),
  KEY `fk_novedades_proyecto1_idx` (`idproyecto`),
  CONSTRAINT `fk_novedades_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `programas` table : 
#

CREATE TABLE `programas` (
  `id_programas` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_programas`)
)ENGINE=InnoDB
AUTO_INCREMENT=4 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
COMMENT=''
;

#
# Structure for the `revision` table : 
#

CREATE TABLE `revision` (
  `idrevision` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `correccion` TEXT COLLATE utf8_general_ci NOT NULL,
  `archivo` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `estado` ENUM('Corrección','Rechazado','Aceptado') NOT NULL,
  `num_revisiones` INTEGER(11) NOT NULL,
  `date_create` TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `idanteproyecto` INTEGER(11) NOT NULL,
  `id_comite` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`idrevision`),
  KEY `fk_revision_anteproyecto1_idx` (`idanteproyecto`),
  CONSTRAINT `fk_revision_anteproyecto1` FOREIGN KEY (`idanteproyecto`) REFERENCES `anteproyecto` (`idanteproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=14 AVG_ROW_LENGTH=1260 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `revisonp` table : 
#

CREATE TABLE `revisonp` (
  `idrevisonp` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) COLLATE utf8_general_ci DEFAULT NULL,
  `correccion` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `archivo` VARCHAR(45) COLLATE utf8_general_ci NOT NULL,
  `estado` ENUM('Corrección','Rechazado','Aprobado') NOT NULL,
  `num_revisiones` INTEGER(11) NOT NULL,
  `idproyecto` INTEGER(11) NOT NULL,
  PRIMARY KEY (`idrevisonp`),
  KEY `fk_revisonp_proyecto1_idx` (`idproyecto`),
  CONSTRAINT `fk_revisonp_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=8 AVG_ROW_LENGTH=2340 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `sustentacion_final` table : 
#

CREATE TABLE `sustentacion_final` (
  `idsustentacion_final` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `lugar` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `idproyecto` INTEGER(11) NOT NULL,
  PRIMARY KEY (`idsustentacion_final`),
  KEY `fk_sustentacion_final_proyecto1_idx` (`idproyecto`),
  CONSTRAINT `fk_sustentacion_final_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=3276 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Data for the `modalidad` table  (LIMIT -497,500)
#

INSERT INTO `modalidad` (`idmodalidad`, `nombre`, `descripcion`) VALUES 
  (1,'pasantia',NULL),
  (2,'trabajo de Investigacion',NULL);
COMMIT;

#
# Data for the `user` table  (LIMIT -453,500)
#

INSERT INTO `user` (`id`, `nombre`, `apellido`, `codigo_estudiantil`, `facultad`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `cont`, `fecha_fin`) VALUES 
  (10,'hector','ricardo','12833737','Ing. Sistemas informatico','ricardo','UOpWFVTf-jrrQ6tZAERM_puxZxWtVbcR','$2y$13$2B7nOIiPsFrsW2rqdqQ57ef358ZIrsz/RhftxYj3KRR9WHeCvTLaW',NULL,'rit@gmail.com','Activo','2017-04-10','2017-09-08',1,'2018-04-10'),
  (27,'Juan','cifuentes','38748329748','Ing. Sistemas informatico','juan','yKi1G5DaZIwdEymiEW9TF_Kc139pP3le','$2y$13$5Qt2DH8ydXWQqeQp.TCycODBQ09Bq07udClk1SlCeYeJF94KF5pTC',NULL,'juan@uniautonoma.edu.co','Activo','2017-09-27','0000-00-00',0,'2018-09-27'),
  (28,'julian','bermudez','938422834','Ing. Sistemas informatico','julian','GM8l-Vl7XY9vPd-8GtXlikoT3DqwmiiD','$2y$13$dZRSUjXVCWmfeseeYQfkye1a6uK58HJYI8wEgaDd1xngCNnJ00fqG',NULL,'julian@uniautonoma.edu.co','Activo','2017-09-27','0000-00-00',1,'2018-09-27'),
  (29,'gabriel','osorio','38423489','Ing. Sistemas informatico','gabriel','i4dst9FWA_ryKsBWC17v_o6o4mq8izUT','$2y$13$TxnnvhYH8wztCZQxxFKnHezEm8jlvZw440xUNlHVXDpIFYmd.bKUu',NULL,'gabirel@uniautonoma.edu.co','Activo','2017-09-27','0000-00-00',1,'2018-09-27'),
  (30,'Rodrigo','Vivas','18948349','Ing. Sistemas informatico','Rodrigo','Rv8FUUV-7gLxRi3O1l2yCJ_rYsH3oZP8','$2y$13$jwOL5Amlpe3HRJVc1375S.CTu6q6dsOfqqdcE45S105oHFskpVcZi',NULL,'rodrigo@uniautonoma.edu.co','Activo','2017-09-27','0000-00-00',1,'2018-09-27'),
  (31,'Denis','Orozco','384923498','Ing. Sistemas informatico','denis','nwdBekIkBoaoBL7V1gdGZ0T_3FKJivVd','$2y$13$DqGzcERv.w54rp1PAsVy6eFXyig1NhUMikp5bazLQAAnaqAN8BacW',NULL,'denis@uniautonoma.edu.co','Activo','2017-10-05','0000-00-00',1,'2018-10-05'),
  (32,'henry','cordoba','93840385','Ing. Sistemas informatico','henry','-Pv6aC9SDe-SOHxZDe-asz01F_5zgMQ6','$2y$13$JZRagQS8WuK8dY49AzFQY.PrU9kGhzlsQTqQw3XSEXXyBVPqS0Bpa',NULL,'henry@uniautonoma.edu.co','Activo','2017-10-05','0000-00-00',0,'2018-10-05'),
  (33,'Daniel','Garcia','93840923489','Ing. Sistemas informatico','daniel','eG2vQLauGeVK1t8wnAyzxuLgQ-w5PB1z','$2y$13$5uGNR7pWVVANAHpX2ATfMOkarrRgZVDr9wy41UYJRVwJfu1hIESEK',NULL,'daniel@uniautonoma.edu.co','Activo','2017-10-07','0000-00-00',0,'2018-10-07'),
  (34,'Melina','sam','4566','Ing. Electronica','Melina','949oWOS-dn8rJMH_hj08WaK8C5p-gTLz','$2y$13$ScUVCvqyqNLwEnltdJqZme6rq/miCafR08hex5zPu0yk0ZQvmr/wi',NULL,'sa@f.com','Activo','2017-10-07','2017-10-07',0,'2018-10-07'),
  (35,'Dahiana','Orozco','874982349823','Ing. Ambiental','dahiana','9xJ9JWecPYmYXIoPex0trxX-oxQFY85H','$2y$13$CsQIgc2JxOXUIyY0.hNODuh0U9qMyskgTvY5lSyKtDDTH0CfYIrQK',NULL,'dahiana@uniautonoma.edu.co','Activo','2017-10-07','2017-10-07',0,'2018-10-07'),
  (36,'Andres','Cifuentes','1061772382','Ing. Sistemas informatico','andres','hX3qwBqRDz0uFa6tqvl7pffZXHa8AIAh','$2y$13$fRd.q4lQbv3NfuMJ2lSLseONF5F5UlwLU6T8IO5vhOgcLaBkUagnG',NULL,'octavio.c@uniautonoma.edu.co','Activo','2017-10-09','2017-10-24',1,'2018-10-09'),
  (37,'Daniela','Orozco','58943755784','Ing. Electronica','daniela','96LUHCmJ7XF7tdYAnG6pIQmbwr7OgX9W','$2y$13$Iyk44iwnN5JUCVnZuQSGBe1AjhILl4xGOq8fUI4HmEzb343I0.85S',NULL,'daniela@uniautonoma.edu.co','Activo','2017-10-09','2017-10-09',0,'2018-10-09'),
  (38,'James','Cifuentes','48759437589','Ing. Electronica','james','feS9pyRk9cSZ-o9nGUV6GD--6AH_iGQ7','$2y$13$AflwKb5yyfqeT1m8ju76wePJrRALE5DyQ.KPQc.H4GipMHQX7xlN2',NULL,'james@uniautonoma.edu.co','Activo','2017-10-09','2017-10-09',0,'2018-10-09'),
  (39,'hector','campo','3933','Ing. Electronica','hector','41URydzJ8clTVmldAmtftjr810xhbYjn','$2y$13$VcEYbjqqePtqp8T.IV.kyODbj11VNvDdYk1tHdD1dhzAVKkT.wZMe','utLyVdI7sxInxT351PLwVscIxPka8IWz_1507587639','riki0885@gmail.com','Activo','2017-10-09','2017-10-09',0,'2018-10-09'),
  (40,'Camilo','Ruiz Vidal','3294828234','Ing. Sistemas informatico','camilo','nhmJ7LfJQbag1axcaDOJUyAPEiP6lLaT','$2y$13$WBQE9WQYmfKm8Fn92B79dO6kLzIdrAevc5sIa0stSy/0tJ41GLuGO',NULL,'camilo@uniautonoma.edu.co','Activo','2017-10-09','2017-10-09',0,'2018-10-09'),
  (41,'Julian Eduardo','Hoyos','8576894','Ing. Sistemas informatico','julianh','OABCLt7jCmnVjwlN_uF-eAvs7tZ-NPT1','$2y$13$1SZFIEU4JeYihijkGPbdTO0m1SLZXoXyw7QXyEgrb5Yg5M2rPAM2K',NULL,'julianhoyos@uniautonoma.edu.co','Activo','2017-10-11','2017-10-11',0,'2018-10-11'),
  (42,'Julian','Hoyos ','874974589','Ing. Sistemas informatico','julianhoyos','Ef-nazmh1x1YAhu2z_LT82u85MtXBH4x','$2y$13$qOPnvZFy.3VO1NEOPAsWUeS9F20KYeu/UmVvgc2xJNExYwMzEb2SW',NULL,'julianandreshoyos@uniautonoma.edu.co','Activo','2017-10-19','2017-10-19',1,'2018-10-19'),
  (43,'andres','vasquez','1061688357','Ing. Sistemas informatico','afvasquez','jnHqXc2zjPIf1livpFKNvcFG_KIimv9g','$2y$13$LUIcw/yB3azGo5.JsTJneeCa1uvOEzlJmkG163XNERVO9nBhXtO5y',NULL,'andres.vasquez@uniautonoma.edu.co','Activo','2017-10-20','2017-10-20',0,'2018-10-20'),
  (44,'jimmy','hendrix','1061345333','Ing. Electronica','jhx','WwPkJAx0iXkb7jhkKVJEpstX33Z28w8t','$2y$13$Uy.uBzg7KgecmFdQc0B5yOGVQuRhXJD4YGPv5JkPHDgLDwSQcosHq',NULL,'jimmy.hendrix@uniautonoma.edu.co','Activo','2017-10-20','2017-10-20',0,'2018-10-20'),
  (45,'luis','giron','1431281','Ing. Sistemas informatico','lgirono','URdjJFTFuncI9wpY-rZPKYsmtbZ0kstC','$2y$13$TEnS6qKWD5GelBYgvH08ruzUSCWz/kQvR7ppZ6WnIKEQcOcTCICXe',NULL,'luis.giron@unicauca.edu.co','Activo','2017-10-21','2017-10-21',0,'2018-10-21'),
  (46,'Oscar Ivan','Diaz Salazar','498354','Ing. Sistemas informatico','oscar','C5H23pQbVs8S2ElAP7YEJihSIoBBqtGZ','$2y$13$HrOYnsYiS.k0sBCw6tM/T.UXlISL3rqnq7UmfHwuST0NVP0.3n50y',NULL,'oscar@hotmail.com','Activo','2017-10-21','2017-10-21',0,'2018-10-21'),
  (47,'andres felipe','vasquez','1061688357','Ing. Sistemas informatico','andres.vasquez','EwkjnuxpH-ENY5opImXo047ai-_bI28s','$2y$13$hDS5NIKwGo9gTLTE1iYDkOfaBrYIxIUvB4tGzNrTJtkB5yFcaDSlO',NULL,'afvasquez1986@gmail.com','Activo','2017-10-21','2017-11-15',1,'2018-10-21'),
  (48,'juan','vasquez','1061788980','Ing. Sistemas informatico','jvasquez','zqkegAHteIgQRf9vzpGjpE7Rf70JP4uS','$2y$13$QF.k4sBo382yUx9oI3fyqeXSBco3pMMUJDps7ze3ZknDqrua4kWni',NULL,'jvasquez@gmail.com','Activo','2017-10-21','2017-10-21',0,'2018-10-21'),
  (49,'prueba','aapapap','999','Ing. Sistemas informatico','prueba','zagt7rZeuKPfegGTtk6kMGHk2r2D8XXx','$2y$13$mK5vZUpueEH73NfDF42WLOo0mNv69us6sdWksorMdeLqnT9Ks6Th.',NULL,'pru@f.com','Activo','2017-10-24','2017-10-24',0,'2018-10-24'),
  (50,'Rodrigo','Garcia','38274832748','Ing. Sistemas informatico','rodrigogarcia','eHZEq8FllUizvqwEUe48WUQY_D8yExK9','$2y$13$W4SXQztDDIWx8Giju9v7b.B.ZaCvq4wfyhnTgQBcnXiil4b.qe8QK',NULL,'rodrigo@hotmail.com','Activo','2017-10-26','2017-10-26',1,'2018-10-26'),
  (51,'juan camilo','suarez','438284','Ing. Electronica','juanca','HBi8gMKlfUrYn5wASsQe4N6lorXZwQSU','$2y$13$QiQ2Q/si.8CqtvcpdsyPne1LjTEuZnUk9VSUuY6auhk1tpEMOj0LW',NULL,'juanca@hotmail.com','Activo','2017-10-26','2017-10-26',1,'2018-10-26'),
  (52,'fabian','ibarra','23984358','Ing. Sistemas informatico','fabian','0v17NY7xLZachPoujhKpeDVNBwY-l2Jp','$2y$13$ynxuf72pK2gz29n/fV0kNe.g7Ed.wrMR69sJRK8ssnH6zpijlX7Ri',NULL,'fabian@hotmail.com','Activo','2017-10-26','2017-10-26',1,'2018-10-26'),
  (53,'Juan Camilo','Garcia','8334','Ing. Ambiental','juancamilo','kXh9_0R4sxH6hJW7nunE6vyyR13Igp48','$2y$13$WAjc.ioZU.kf3hYU8YuRz.afupugqdEaq3G4TFZ3RYZUFBXL7IQM6',NULL,'camilo@hotmail.com','Activo','2017-11-07','2017-11-07',1,'2018-11-07'),
  (54,'fredy','yepes','4636434','Ing. Electronica','fredyyepes','jdAKunK4cLrWNPwr6GrTgKBDZrX-CIcW','$2y$13$NRI1gM9VZJ261Lu3dyqV..f.OXo7W1KexOxHz6Bi5bCt8KhGnyhJC',NULL,'fredy@hotmail.com','Activo','2017-11-07','2017-11-07',1,'2018-11-07'),
  (55,'camilo','ruiz','1010101010','Ing. Sistemas informatico','milo9022','R9tlQXXfxf---YssaaobK3E4mJfL4Lg4','$2y$13$Hkrr2qzvp2OeoKoCkouAkOH8P0rx1C93V.umgL2WyrhAxLIBevdE.',NULL,'camiloruizvidal@gmail.com','Activo','2017-11-14','2017-11-14',1,'2018-11-14'),
  (56,'David Santiago','Cordoba Camacho','182137912','Ing. Sistemas informatico','santiago','R6jsw70o503hlWHYa-M7xUlBQy_kZNih','$2y$13$VnFPDzZKejscw7nuff07iubQ5egMbjIa2Gn825iCDs4x0H9cyXGqW',NULL,'andrescifuentesdorado@gmail.com','Activo','2017-11-14','2017-11-14',1,'2018-11-14'),
  (57,'alejandro','restrepo','34543770','Ing. Sistemas informatico','alejimio','fTVbG5Qf0TOttj3ST9yMElq-hEzqbqdg','$2y$13$lsMd5tD.R/2UKsa.FDyuDeYnmTQgQduhd4OBBlwzrt0oXMQssRI4K',NULL,'alejandro.restrepo.s@uniautonoma.edu.co','Activo','2017-11-15','2017-11-15',1,'2018-11-15'),
  (58,'julian','caicedo','34543770','Ing. Electronica','juliancaicedo','SQai5VeIs8zyupiAM8fMcLq2pvMOBRNb','$2y$13$IVvP8zwCAWA.2G0nJDArS.wcBgOZE1jbDFj1qErjlwMtqLLnfZ3m2',NULL,'julian.caicedo@uniautonoma.edu.co','Activo','2017-11-15','2017-11-15',1,'2018-11-15'),
  (59,'Jimmy','Campo','568975620','Ing. Sistemas informatico','jimmyc','uGxWY46Y19AYeE6GH-jC_XsEVa7rZMk6','$2y$13$mL8wL8VPODmTZJsgIileI.R57X9Jxzs6gtv1IjtutSEcbpsRGGeHq',NULL,'jimmy.campo@uniautonoma.edu.co','Activo','2017-11-15','2017-11-15',1,'2018-11-15'),
  (60,'andres','pelon','456879','Ing. Sistemas informatico','andresito','j-gWRX_s8HuDEmZY5KFeyt160QzJMO9C','$2y$13$tJ3kqG0qWjDyPQzxaqiDPefLUox8bIcOBddwZ/xyA62vIm0iMMaVi',NULL,'andres.vasquez@uniautonama.edu.co','Activo','2017-11-15','2017-11-15',1,'2018-11-15'),
  (61,'felipe','ramiraz','67676','Ing. Sistemas informatico','felipe','l9CRkKOvl4xCgBzsz4Id4IqOi7rWMhnR','$2y$13$EoM3iFMU.LaXdmPLjRejRO94XjVsw3mCiL1s2a6t9wYK4NBi.ny4S',NULL,'felipe@uniautonoma.edu.co','Activo','2017-11-15','2017-11-15',1,'2018-11-15'),
  (62,'skldjas','dskjfsd','930234892','Ing. Sistemas informatico','juan2','T3-JZOfZjkUDlx6ObBlvqdyAUDZjXZ9u','$2y$13$0fOMg7gDQ1hU71amjCf5/OOY42KG3ZWy0egO93u3EH5VeAVa2nKHi',NULL,'dsfkjsd@dflkd.com','Activo','2017-11-17','2017-11-17',0,'2018-11-17'),
  (63,'camilo','ruiz','128931','','nj','VXQJhZu1MbQQm-8Q16stK2LpzRz06JAc','$2y$13$JnhxKSBdgI.LR44OzhdTFO5DUhHozh5bQHnvK5Jk4WGmSTEd.0vAC',NULL,'kjdsf@jf.com','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (64,'Camilo','Ruiz','19383','Ing. Sistemas informatico','milo90223','_HrxDhbWNlex8I5hxj3fWzdrDWArqd3M','$2y$13$FZHAMgC9YQRrjC1rC2UDGeAwYFDVrqNDMER324sg0vxnOoLM/XEIe',NULL,'camiloruizvidal123@gmail.com','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (65,'cami','lfks','90312','Ing. Sistemas informatico','90mkd','MuKVua3qPa4ZOddnNfvv5uXvqA0zKsU8','$2y$13$XHEb9HdaZxB.yJtQsqy0repJT.myXIq.FVLzFSc0HQuYOiahqXCAC',NULL,'dkfs@kf.com','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (66,'Camilo','Ruiz','19383','Ing. Sistemas informatico','milo902233','sLO6iDjWwSBl9m5QhkH4nn0yi3wDjlI-','$2y$13$7JqS0I44LhoQd4XWXUlk4uHXDLPNgxHQnui4X5.8eUCx9Bi2j5MMm',NULL,'camiloruizvidal@gmail.com2','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (67,'mmm','mmm','111','Ing. Sistemas informatico','111mmm','mEIkPiJIWjejdjxgFmAnMiG8RWpQtUZz','$2y$13$fE7.UcRoDkZCEEVIsi8efu0PPjbxGK73QEGuXa.YUCta1KljBOvTm',NULL,'111mmmmmmmmmmmq@jjj.com','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (68,'mmm','mmm','111','Ing. Sistemas informatico','111mmm1','QQ8fM6A5QtCVhw9YX69ipvG1jHIiHXuQ','$2y$13$e2WnVF7So1PFyrFybiLtb.NwsK6KTSiusHg2t8wVVhb29IOqM1lay',NULL,'111mmmmmmmmmmq@jjj.com','Activo','2017-12-03','2017-12-03',0,'2018-12-03'),
  (69,'camilo','ruiz','99','Ing. Ambiental','milo','zn3PSINTuyKNjy10zAxIcVXpgwZzFwMw','$2y$13$NDQWQxcI7XXvZmJwI7sgQOJvhrFujKJSq/sREAK8bVX/dXONp/dJ2',NULL,'milo902@l.com','Activo','2017-12-06','2017-12-06',1,'2018-12-06'),
  (70,'asd','unodostres','123','Ing. Sistemas informatico','asd123','QSIQQSqCTOV3h5JIDjGg9eC0IOk6-Ev2','$2y$13$oC7wH/X1KnAMCMbulSR0iuCgFL5AGMy9xIjen./GFHSNxalKwrFsW',NULL,'asd123@gmail.com','Activo','2017-12-07','2017-12-07',1,'2018-12-07'),
  (71,'camilo','ruiz','10712123','Ing. Sistemas informatico','milo123','YN4MG302KC6ZWTIHW90WrNPy7LCXBzFc','$2y$13$U.RpZi2NpNt3FKCASWsIAeQBPVcdaOYbW5yfRekfk7NGT8MjMxsIC',NULL,'camiloruizvidal213@gmail.com','Activo','2017-12-10','2017-12-10',1,'2018-12-10');
COMMIT;

#
# Data for the `anteproyecto` table  (LIMIT -472,500)
#

INSERT INTO `anteproyecto` (`idanteproyecto`, `nombre`, `descripcion`, `archivo_anteproyecto`, `estado`, `alerta`, `date_create`, `idmodalidad`, `id`, `objetivos`, `planteamiento_problema`, `justificacion`) VALUES 
  (1,'prueba','prueba','anteproyecto/prueba.txt',1,1,'2017-09-27 07:50:06',2,27,NULL,NULL,NULL),
  (2,'prueba2','esta es otra prueba','anteproyecto/prueba2.txt',0,1,'2017-09-27 19:09:59',2,27,NULL,NULL,NULL),
  (3,'prueba3','prueba genial','anteproyecto/prueba3.docx',1,1,'2017-10-06 00:22:18',2,31,NULL,NULL,NULL),
  (4,'prueba daniel','ojala esta sea','anteproyecto/prueba daniel.docx',0,1,'2017-10-07 10:10:45',2,33,NULL,NULL,NULL),
  (5,'Prueba','Prueba','anteproyecto/Prueba.docx',0,1,'2017-10-07 16:10:59',1,33,NULL,NULL,NULL),
  (6,'Prueba1','Prueba1','anteproyecto/Prueba1.docx',0,1,'2017-10-07 17:10:40',2,30,NULL,NULL,NULL),
  (7,'ingenieria ambiental','ingeniera ambiental','anteproyecto/ingenieria ambiental.docx',1,1,'2017-10-09 14:14:09',2,35,NULL,NULL,NULL),
  (8,'ksdks','dfdsf','anteproyecto/ksdks.docx',1,1,'2017-11-17 16:29:02',2,30,NULL,NULL,NULL),
  (9,'si funciona','pendejo jajajaj','anteproyecto/si funciona.txt',0,1,'2017-10-09 14:10:26',1,30,NULL,NULL,NULL),
  (10,'prueba daniela','funciona???','anteproyecto/prueba daniela.txt',0,1,'2017-10-09 14:10:08',2,37,NULL,NULL,NULL),
  (11,'aandres anteproyecto','pendejo  ','anteproyecto/aandres anteproyecto.txt',1,1,'2017-10-25 13:18:10',2,36,NULL,NULL,NULL),
  (12,'james prueba','sera que si?','anteproyecto/james prueba.docx',1,1,'2017-11-14 16:56:04',2,38,NULL,NULL,NULL),
  (13,'pruebas camilo','camilo ruiz vidal','anteproyecto/pruebas camilo.docx',0,1,'2017-10-10 00:10:43',2,40,NULL,NULL,NULL),
  (14,'juancamilo anteproyecto','prueba casi final','anteproyecto/juancamilo anteproyecto.docx',1,1,'2017-11-07 14:02:36',2,53,NULL,NULL,NULL),
  (15,'fredy yepes','este es fredy','anteproyecto/fredy yepes.txt',1,1,'2017-11-07 14:13:41',1,54,NULL,NULL,NULL),
  (16,'prueba de alerta','prueba','anteproyecto/prueba de alerta.txt',1,1,'2017-11-16 01:01:25',1,55,NULL,NULL,NULL),
  (17,'Esta lista la Plataforma','mañana tenemos presustentación','anteproyecto/Esta lista la Plataforma.docx',1,1,'2017-11-15 04:28:27',2,56,NULL,NULL,NULL),
  (18,'prueba 2','prueba 2','anteproyecto/prueba 2.txt',1,1,'2017-11-15 18:38:58',1,55,NULL,NULL,NULL),
  (19,'no he hecho nada de tesis','no se que hacer','anteproyecto/no he hecho nada de tesis.doc',1,1,'2017-11-15 15:37:06',2,57,NULL,NULL,NULL),
  (20,'proyecto a cancelar','se cancelara','anteproyecto/proyecto a cancelar.docx',1,1,'2017-11-15 16:24:21',2,60,NULL,NULL,NULL),
  (21,'prueba','123','anteproyecto/prueba.doc',1,1,'2017-12-05 23:14:50',1,55,NULL,NULL,NULL),
  (22,'Camilo ruiz','123','anteproyecto/Camilo ruiz.pdf',1,1,'2017-12-05 23:14:27',1,69,'Hola mundo',NULL,NULL),
  (23,'camilo','ruiz','anteproyecto/camilo.docx',0,1,'2017-12-05 23:40:48',1,69,'objetivo 1\r\nobjetivo 2\r\nobjetivo 32','Planteamiento del problema','Justificación del anteproyecto'),
  (24,'2','2','anteproyecto/2.pdf',1,1,'2017-12-05 23:41:18',1,69,'2','2','2'),
  (25,'asd123','asd123','anteproyecto/asd123.pdf',1,1,'2017-12-06 19:43:21',1,70,'Objetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\nObjetivo 1\r\n\r\n','Planteamiento','Justificacion'),
  (32,'Proyectos','Descripcio','anteproyecto/Proyectos.txt',1,1,'2017-12-10 00:18:38',1,71,'<p style=\"text-align: center;\"><strong>Objetivos</strong></p>\r\n<ol>\r\n<li><strong>Objetivo numero 1</strong></li>\r\n<li><strong>Objetivo numero 2</strong></li>\r\n<li><strong>Objetivo numero 3</strong></li>\r\n</ol>','<p style=\"text-align: center;\"><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px; font-weight: bold;\">Planteamiento del problema</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd</span></p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\"><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\"> as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa</span></p>\r\n<p style=\"text-align: justify;\"><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\"> sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px;\">Plasdnasdas da sd as adsf asd fasd fa sdfa</span></p>','<p style=\"text-align: center;\"><strong>Justificacion</strong></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\">dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfna</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"text-align: justify;\">sd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f</p>\r\n<p style=\"text-align: justify;\">asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf as</p>\r\n<p style=\"text-align: justify;\">d fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fs</p>\r\n<p style=\"text-align: justify;\">d dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd dsjfnasdfnasd f asdf asd fasdf asd fasdfasdf asdf asd fasdf asd fsd&nbsp;</p>'),
  (33,'mce','Editor mce','anteproyecto/mce.txt',0,1,'2017-12-10 23:12:12',2,71,'<p style=\"text-align: center;\"><strong>Objetivos</strong></p>\r\n<ol>\r\n<li><strong>Objetivo numero 1</strong></li>\r\n<li><strong>Objetivo numero 2</strong></li>\r\n<li><strong>3</strong></li>\r\n<li><strong>4</strong></li>\r\n<li><strong>5</strong></li>\r\n</ol>','<p style=\"text-align: center;\"><span style=\"color: #646464; font-family: Verdana, Arial; font-size: 12px; font-weight: bold;\">Planteamiento del problema</span></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, <em>consectetur adipiscing elit</em>. Vestibulum ac rutrum risus. Sed efficitur tristique cursus. Donec varius, nulla eu ornare euismod, diam nisl sodales urna, tempus fermentum magna massa sit amet eros. Duis posuere sed odio eget vehicula. Fusce nunc dolor, blandit non bibendum eget, viverra eget magna. Pellentesque ac sem interdum, ultricies lectus ut, egestas libero. <strong>Vivamus euismod sapien</strong> a elit tempor commodo. Duis vel pretium ex, commodo mattis velit. Praesent sed maximus arcu, vitae faucibus tortor. Phasellus accumsan, leo sit amet tristique dignissim, lorem metus tincidunt libero, vel sodales sapien libero id libero. Phasellus id velit ullamcorper, volutpat nulla sit amet, eleifend arcu. Nam nec tincidunt nisl. Quisque nec mi nulla. Nulla egestas lacinia nibh egestas luctus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px;\">Sed ultrices eros ac elit hendrerit, vitae condimentum nisi tempor. Pellentesque egestas ex vel purus vehicula interdum. In hac habitasse platea dictumst. Proin vel ex interdum, euismod ante sed, tristique mi. Duis commodo ultrices sem quis pharetra. Nam non gravida diam. Phasellus at mauris vitae lacus placerat posuere vel ut elit. Pellentesque rhoncus eu mi nec dignissim. Pellentesque suscipit lobortis rhoncus. Donec eu metus sit amet lorem iaculis pulvinar. Praesent lorem lectus, hendrerit non posuere at, rhoncus venenatis enim. Pellentesque a efficitur turpis, nec ultrices arcu.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px;\">Nunc quis ornare risus. Mauris aliquam commodo eros eu finibus. Cras luctus blandit ullamcorper. Curabitur ipsum tortor, euismod ut tempus ac, venenatis at arcu. Duis vel semper nisi, eu accumsan metus. Fusce eget metus neque. Integer tristique, turpis eu pulvinar maximus, lacus odio viverra mi, ut dictum dui dolor non nisl. Aliquam tristique velit vel imperdiet pretium. Sed dignissim ligula ornare tellus tristique ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed rhoncus justo nec imperdiet ornare. Maecenas mollis rhoncus facilisis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px;\">Sed sollicitudin nunc mauris, at facilisis tellus mattis at. Curabitur ut erat vitae tellus semper tempus nec ac ante. Nulla consequat molestie turpis non sodales. Aliquam erat volutpat. Maecenas condimentum blandit ex, in accumsan justo dictum non. Praesent viverra massa vitae pharetra cursus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse eu dapibus arcu. Quisque massa turpis, eleifend eget rutrum non, aliquet in turpis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px;\">Ut imperdiet non lectus et consectetur. Mauris placerat magna sit amet sapien rhoncus gravida. Duis scelerisque ligula vel libero vehicula convallis. Donec tempor cursus nisi, et rutrum turpis elementum et. Vestibulum quis varius sem, nec elementum orci. Cras id lectus eget massa congue facilisis ut ut neque. Nunc lacinia et purus ut pulvinar. Phasellus purus lorem, maximus sed fringilla vitae, convallis vel lectus. Quisque venenatis egestas arcu quis tincidunt. Phasellus quis vehicula ligula.</p>','<p style=\"text-align: center;\"><strong>Justificacion</strong></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ac tempus eros. Sed erat ligula, fringilla ut egestas sed, elementum ac nisi. Praesent eu arcu risus. Proin ullamcorper, dolor sed imperdiet condimentum, mi enim gravida leo, eget porttitor sem ex vel tortor. Nunc consectetur, lectus sit amet gravida sagittis, augue elit hendrerit risus, non egestas dui nulla eget erat. Quisque mattis ligula quis dolor aliquam, cursus aliquet augue varius. Fusce eget augue at orci egestas volutpat et et est. Fusce mauris est, feugiat non accumsan eget, semper a neque. Vivamus maximus nulla vitae cursus euismod. Proin tristique tempor velit, non dictum est eleifend non. Vivamus nec placerat tortor. Mauris eu diam in nibh dignissim elementum eget ut nunc. Suspendisse facilisis placerat mattis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Aliquam volutpat nibh sit amet sapien lobortis, at sagittis est varius. Nullam placerat massa enim, eu vehicula justo ultrices eu. Donec varius diam sem, rhoncus tristique sapien rhoncus a. Integer augue elit, egestas vitae quam at, vulputate rhoncus felis. Aliquam id laoreet mauris. Integer vitae elit imperdiet, sollicitudin nibh a, sagittis massa. Proin placerat feugiat ante vitae lobortis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In pretium eu tortor id laoreet. Aliquam quis interdum lacus, sed elementum eros. Vivamus consectetur sem augue, at feugiat lectus rhoncus sed. Aliquam enim dui, maximus sit amet finibus ut, maximus a ex. Fusce a sem mi. Vestibulum pellentesque volutpat odio, nec gravida odio congue nec.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Suspendisse posuere dui sed lobortis commodo. Pellentesque rutrum maximus erat, luctus tristique est ornare nec. Ut pharetra diam nec egestas scelerisque. Sed fringilla, nisi et aliquam dictum, ante lacus convallis arcu, a aliquam nisl felis vitae elit. Donec in enim ultrices, congue eros a, aliquam felis. Duis semper suscipit volutpat. Cras mattis sapien nibh, vel posuere nibh malesuada et. Ut molestie, erat vitae maximus tempus, sem lorem viverra felis, interdum pulvinar tellus leo ac urna. Mauris sollicitudin ante quis lorem tincidunt aliquam. Suspendisse potenti. Fusce diam eros, sodales quis interdum non, viverra id odio. Morbi iaculis mauris a ipsum auctor consectetur. Sed malesuada efficitur mauris, et consectetur mauris viverra sed.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Cras tempor dolor ac sem hendrerit luctus. Donec turpis lectus, euismod ac sem ac, ornare placerat urna. Suspendisse non volutpat urna. Quisque at turpis blandit, cursus erat nec, sodales sapien. Phasellus non sapien vitae mauris condimentum porta. Proin eget justo lobortis, facilisis orci eget, tempor lectus. Morbi dictum felis quis nisl convallis, eget egestas ipsum sodales. Integer vitae eros luctus, ultrices tellus tempus, consectetur magna. In condimentum augue sem, quis accumsan dui ullamcorper eget. Maecenas sit amet elementum enim. Fusce a quam ac urna consectetur egestas ac non erat.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Phasellus iaculis, ipsum eget vestibulum aliquam, dolor neque faucibus nisl, id rhoncus purus leo vel ex. Cras ac vulputate arcu. Suspendisse egestas maximus molestie. Mauris suscipit fringilla mauris. In tellus nisl, posuere ut egestas id, elementum ac metus. Nam sit amet sem eget leo molestie lacinia ac ac nibh. Maecenas pulvinar dui sed volutpat pulvinar. Cras euismod diam in eros gravida, sit amet ullamcorper dui placerat. Nulla in tellus sed orci accumsan semper eu a risus. Nunc egestas eu metus non rutrum. Aliquam iaculis, nulla eget imperdiet consequat, elit tortor consequat mauris, eu egestas nibh ligula vitae enim. Duis ut risus eget quam consectetur efficitur eget et tortor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Maecenas sollicitudin sem ut turpis hendrerit cursus. Suspendisse lorem enim, aliquet eu mi non, feugiat aliquet odio. Morbi ac sapien et nisl blandit ultricies ac quis tellus. Donec viverra ex et odio tempor rhoncus. Morbi a eleifend neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed maximus nisi malesuada nulla fermentum, quis dignissim velit porttitor. Curabitur in consequat urna. Vivamus feugiat dolor quis risus feugiat ornare. Vivamus porta neque non sapien rhoncus, ac ornare odio rhoncus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Aenean sed arcu nisl. Etiam nisl augue, congue eget magna non, facilisis commodo orci. Aliquam vitae ipsum a magna consectetur cursus ut at libero. Integer aliquet eleifend ullamcorper. Aenean et sodales eros, vel posuere libero. Donec mollis est ante, id rhoncus sapien convallis sit amet. Sed ultrices lorem ante, in convallis ligula hendrerit vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Donec et eleifend dolor. In eros elit, pharetra ac vestibulum vitae, congue vel mauris. Nullam euismod feugiat quam vel malesuada. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut sed turpis quis odio dapibus viverra et vitae justo. Etiam non efficitur lacus. Mauris sed sem sagittis, mollis magna non, accumsan risus. Proin malesuada porta mi. Nulla faucibus gravida mauris, non laoreet lacus semper nec. Maecenas vel lobortis justo.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Aliquam tempus nec mauris quis vestibulum. Etiam rutrum rutrum est et malesuada. Morbi tempus aliquet leo. Proin mattis lectus sit amet mattis tristique. Proin fringilla ante id ligula semper, et eleifend elit imperdiet. Mauris vestibulum facilisis elit. Vivamus vel ante non nibh porttitor fermentum rutrum a velit. Proin in ullamcorper lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Vivamus non consectetur lectus. Phasellus ut dignissim neque. Duis vestibulum molestie orci, quis fermentum leo suscipit id. Phasellus tempus velit at dolor mattis feugiat. Aliquam vitae augue enim. Vivamus sed nibh faucibus, gravida velit in, varius velit. Sed urna leo, placerat non malesuada ac, sollicitudin eget elit.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Aliquam congue sem at ipsum porttitor, id tincidunt leo convallis. Pellentesque quis purus a turpis sodales dapibus. Proin quis eros eu risus commodo bibendum. Vestibulum sodales sagittis vulputate. Donec imperdiet et ligula ut eleifend. Quisque non elementum libero. Nunc sed consectetur urna. Duis commodo fermentum leo, sit amet pretium nisi. Praesent a fermentum metus. Ut interdum pulvinar augue, consectetur posuere quam laoreet id. Donec vitae vulputate ligula. Morbi sollicitudin magna a eleifend fringilla.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Curabitur leo nulla, bibendum a mauris eget, efficitur tincidunt ex. Donec metus tellus, pharetra a lacus ut, convallis efficitur lacus. Cras vulputate dictum nisl, at auctor nisl scelerisque eu. Nulla eget lacus id diam pulvinar porttitor. Fusce bibendum, lacus nec pulvinar porta, felis dui blandit ante, sed elementum eros erat consectetur orci. Maecenas faucibus ultricies metus placerat iaculis. Nam semper massa eu tellus semper, nec volutpat ex placerat. Nam dignissim odio ipsum, ac pharetra mi pellentesque nec. Proin sed metus in justo viverra pellentesque. Maecenas ac risus urna.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Nunc condimentum massa dui, ut tincidunt nunc finibus ut. In congue fermentum leo non faucibus. Vivamus at lorem quis nulla aliquet efficitur. Curabitur in dolor quam. Quisque libero dui, finibus nec nisl ac, fermentum vehicula purus. Ut ut pulvinar ante. Nunc posuere blandit libero ac dictum. Curabitur sed facilisis lectus, in cursus urna. Pellentesque auctor cursus fringilla. Suspendisse suscipit justo eget pharetra tempor. Donec maximus varius leo, vitae hendrerit sem auctor interdum. Nunc porta nisl sit amet orci dapibus tristique bibendum ut libero.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Mauris sagittis consectetur metus at tristique. Mauris venenatis vel nulla nec ultricies. Ut tempor, mi eget dictum aliquet, nisi diam tincidunt lacus, nec pharetra turpis sem in metus. Aliquam fringilla purus id dui fermentum commodo. Donec ultricies lobortis vulputate. Ut congue felis sed bibendum placerat. Morbi pharetra mauris at est varius, id ultricies justo vestibulum. Proin volutpat, neque sed vehicula pulvinar, nisl diam interdum diam, ut tempus nulla neque id elit. Morbi dignissim, augue nec finibus sagittis, mauris metus eleifend urna, ut scelerisque quam orci nec ante. Sed in consequat augue. Sed dignissim quis tellus ut lacinia. Sed ut nulla tortor. Etiam nibh ex, pharetra vitae arcu ac, accumsan sagittis massa. Donec vehicula tortor vel ante lobortis, et sagittis sapien rutrum.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: ''Open Sans'', Arial, sans-serif; font-size: 14px; text-align: justify;\">Integer luctus augue et mi sodales porta. Cras in interdum neque, et tincidunt est. Cras in neque ultricies, semper velit interdum, porttitor nibh. Sed consequat est et aliquam suscipit. Ut sodales ut ipsum non bibendum. Mauris justo eros, lobortis et neque id, euismod dictum lorem. Fusce in metus lacus.</p>');
COMMIT;

#
# Data for the `auth_item` table  (LIMIT -494,500)
#

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES 
  ('Comite',1,NULL,NULL,NULL,NULL,NULL),
  ('Docente',2,NULL,NULL,NULL,NULL,NULL),
  ('Estudiante',1,NULL,NULL,NULL,NULL,NULL),
  ('Jurado',1,NULL,NULL,NULL,NULL,NULL),
  ('Secretario',1,NULL,NULL,NULL,NULL,NULL);
COMMIT;

#
# Data for the `auth_assignment` table  (LIMIT -453,500)
#

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES 
  ('Comite',28,NULL),
  ('Comite',48,NULL),
  ('Comite',58,NULL),
  ('Comite',62,NULL),
  ('Comite',63,NULL),
  ('Docente',34,NULL),
  ('Docente',41,NULL),
  ('Docente',42,NULL),
  ('Docente',45,NULL),
  ('Docente',46,NULL),
  ('Docente',62,NULL),
  ('Docente',65,NULL),
  ('Estudiante',27,NULL),
  ('Estudiante',30,NULL),
  ('Estudiante',31,NULL),
  ('Estudiante',33,NULL),
  ('Estudiante',35,NULL),
  ('Estudiante',36,NULL),
  ('Estudiante',37,NULL),
  ('Estudiante',38,NULL),
  ('Estudiante',40,NULL),
  ('Estudiante',43,NULL),
  ('Estudiante',47,NULL),
  ('Estudiante',50,NULL),
  ('Estudiante',51,NULL),
  ('Estudiante',52,NULL),
  ('Estudiante',53,NULL),
  ('Estudiante',54,NULL),
  ('Estudiante',55,NULL),
  ('Estudiante',56,NULL),
  ('Estudiante',57,NULL),
  ('Estudiante',60,NULL),
  ('Estudiante',61,NULL),
  ('Estudiante',62,NULL),
  ('Estudiante',69,NULL),
  ('Estudiante',70,NULL),
  ('Estudiante',71,NULL),
  ('Jurado',29,NULL),
  ('Jurado',32,NULL),
  ('Jurado',44,NULL),
  ('Jurado',49,NULL),
  ('Jurado',59,NULL),
  ('Jurado',62,NULL),
  ('Secretario',10,NULL),
  ('Secretario',39,NULL),
  ('Secretario',62,NULL);
COMMIT;

#
# Data for the `conocimiento` table  (LIMIT -497,500)
#

INSERT INTO `conocimiento` (`idconocimiento`, `nombre`, `descripcion`, `telefono`, `correo`, `id_programas`, `fecha`) VALUES 
  (1,'Sistema de alertas para un banco','Es un sistema que proporcione alertas a los m',32548745,'julianhoyos@uniautonoma.edu.co',1,'2017-11-17 14:40:29'),
  (2,'Nuevo proyecto por hacer','Algas marinas sistematizadas',2147483647,'julian.hoyos@uniautonoma.edu.co',2,'2017-11-17 14:40:29');
COMMIT;

#
# Data for the `director_proyecto` table  (LIMIT -495,500)
#

INSERT INTO `director_proyecto` (`iddirector_proyecto`, `nombre`) VALUES 
  (1,'bermudez'),
  (2,'andres vasquez'),
  (3,'Gabriel Osorio'),
  (4,'Camilo ruiz director');
COMMIT;

#
# Data for the `proyecto` table  (LIMIT -490,500)
#

INSERT INTO `proyecto` (`idproyecto`, `nombre`, `descripcion`, `archivo_proyecto`, `date_create`, `id`, `articulo`, `estado`, `objetivos`, `planteamiento_problema`, `justificacion`) VALUES 
  (1,'ultimo proyecto','este es el ultimo proyecto.','proyecto/ultimo proyecto.docx','2017-11-17 22:20:40',27,'','1',NULL,NULL,NULL),
  (2,'Plataforma denis','esta es una prueba de denis','proyecto/Plataforma denis.docx','2017-11-15 03:11:38',31,'','1',NULL,NULL,NULL),
  (3,'andres proyecto','este proyecto se enfoca en la optimización.','proyecto/andres proyecto.txt','2017-10-25 13:10:35',36,'articulo/andres proyecto.txt','',NULL,NULL,NULL),
  (4,'plataforma para la gestion y seguimiento','esto sirve para optimizar tiempo y dinero','proyecto/plataforma para la gestion y seguimi','2017-11-07 19:11:59',53,'articulo/plataforma para la gestion y seguimiento.docx','',NULL,NULL,NULL),
  (5,'plataforma para la gestion y seguimiento','sjadhjasdhkj','proyecto/plataforma para la gestion y seguimi','2017-11-07 19:11:08',53,'articulo/plataforma para la gestion y seguimiento.txt','',NULL,NULL,NULL),
  (6,'soy fredy yepes','este es el proyecto final de fredy','proyecto/soy fredy yepes.txt','2017-11-17 22:18:33',54,'articulo/soy fredy yepes.txt','1',NULL,NULL,NULL),
  (7,'juancamilo proyecto','este es de juancamilo','proyecto/juancamilo proyecto.txt','2017-11-17 21:40:05',53,'articulo/juancamilo proyecto.docx','1',NULL,NULL,NULL),
  (8,'Esta lista la Plataforma','vamos a presustentar mañana','proyecto/Esta lista la Plataforma.docx','2017-11-15 04:36:05',56,'articulo/Esta lista la Plataforma.docx','1',NULL,NULL,NULL),
  (9,'no se que hacer de tesis','aun no tengo nada','proyecto/no se que hacer de tesis.doc','2017-11-15 15:43:13',57,'articulo/no se que hacer de tesis.doc','1',NULL,NULL,NULL);
COMMIT;

#
# Data for the `director_proyecto_por_proyecto` table  (LIMIT -494,500)
#

INSERT INTO `director_proyecto_por_proyecto` (`iddirector_proyecto`, `idproyecto`, `fecha`) VALUES 
  (1,2,'2017-10-05 21:10:26'),
  (1,4,'2017-12-03 18:12:38'),
  (1,8,'2017-11-14 23:11:58'),
  (3,9,'2017-11-15 10:11:39'),
  (4,8,'2017-11-22 00:11:28');
COMMIT;

#
# Data for the `documento_tipo` table  (LIMIT -496,500)
#

INSERT INTO `documento_tipo` (`id_documento_tipo`, `descripcion`) VALUES 
  (1,'Oficios'),
  (2,'Resoluciones'),
  (3,'Formatos');
COMMIT;

#
# Data for the `documento` table  (LIMIT -491,500)
#

INSERT INTO `documento` (`iddocumento`, `nombre`, `archivo`, `id_documento_tipo`, `fecha`) VALUES 
  (1,'resolucion_0047_trabajos_de_grado1','Archivo/resolucion_0047_trabajos_de_grado1.pdf',1,'2017-11-17 11:50:25'),
  (2,'Formato No. 1_Presentación del Anteproyecto de Trabajo de Grado','Archivo/Formato No. 1_Presentacio?n del Anteproyecto de Trabajo de Grado.docx',1,'2017-11-17 11:50:25'),
  (3,'Formato No. 2_Seguimiento de los Trabajos de Grado','Archivo/Formato No. 2_Seguimiento de los Trabajos de Grado.docx',1,'2017-11-17 11:50:25'),
  (4,'Formato No. 3_Evaluacio?n Previa de la Pasanti?a','Archivo/Formato No. 3_Evaluacio?n Previa de la Pasanti?a.docx',1,'2017-11-17 11:50:25'),
  (5,'Gui?a No. 2_Evaluacio?n del Trabajo de Grado','Archivo/Gui?a No. 2_Evaluacio?n del Trabajo de Grado.docx',2,'2017-11-17 11:50:25'),
  (6,'prueba de documento','Archivo/prueba de documento.xlsx',3,'2017-11-17 11:50:25'),
  (7,'otro','Archivo/otro.xlsx',NULL,'2017-11-17 11:50:25'),
  (8,'Prueba de resolucion','Archivo/Prueba de resolucion.xlsx',2,'2017-11-17 11:50:25');
COMMIT;

#
# Data for the `evento` table  (LIMIT -496,500)
#

INSERT INTO `evento` (`idevento`, `titulo`, `descripcion`, `fecha`) VALUES 
  (1,'sustentacion electronica ii','','2017-11-23'),
  (2,'Evento que no se debe poder crear','','2017-11-07'),
  (3,'prueba','','2017-12-07');
COMMIT;

#
# Data for the `jurado` table  (LIMIT -495,500)
#

INSERT INTO `jurado` (`idjurado`, `nombre`) VALUES 
  (1,'henry'),
  (2,'jimmy'),
  (3,'andres'),
  (4,'camilo ruiz');
COMMIT;

#
# Data for the `jurado_has_proyecto` table  (LIMIT -492,500)
#

INSERT INTO `jurado_has_proyecto` (`idjurado`, `idproyecto`, `idjurado2`) VALUES 
  (1,2,2),
  (1,2,3),
  (1,7,3),
  (2,3,1),
  (2,8,1),
  (2,9,1),
  (4,9,4);
COMMIT;

#
# Data for the `novedades` table  (LIMIT -498,500)
#

INSERT INTO `novedades` (`idnovedades`, `descripcion`, `fecha`, `idproyecto`) VALUES 
  (1,'Crear Prorroga','2017-09-29 00:00:00',1);
COMMIT;

#
# Data for the `programas` table  (LIMIT -496,500)
#

INSERT INTO `programas` (`id_programas`, `descripcion`) VALUES 
  (1,'Ingenieria de Sistemas informaticos'),
  (2,'Ingeniería Ambiental'),
  (3,'Ingeniería Electrónica');
COMMIT;

#
# Data for the `revision` table  (LIMIT -486,500)
#

INSERT INTO `revision` (`idrevision`, `descripcion`, `correccion`, `archivo`, `estado`, `num_revisiones`, `date_create`, `idanteproyecto`, `id_comite`) VALUES 
  (1,'bien','bien hecho','Revisiones/bien.docx','Aceptado',1,'2017-09-27 14:09:24',1,NULL),
  (2,'ahora si','esta perfecto','Revisiones/ahora si.docx','Aceptado',2,'2017-10-06 00:23:15',3,NULL),
  (3,'no pasaste las correcciones','busca otro por hacer','Revisiones/no pasaste las correcciones.docx','Rechazado',3,'2017-10-09 14:13:11',7,NULL),
  (4,'excelente','perfecto','Revisiones/excelente.txt','Aceptado',1,'2017-10-25 13:10:44',11,NULL),
  (5,'quedo listo','ahora si juan camilo','Revisiones/quedo listo.txt','Aceptado',2,'2017-11-07 14:03:56',14,NULL),
  (6,'excelente fredy','bien fredy','Revisiones/excelente fredy.docx','Aceptado',2,'2017-11-07 19:05:44',15,NULL),
  (7,'esta muy bien santiago','esta todo perfecto','Revisiones/esta muy bien santiago.docx','Aceptado',1,'2017-11-15 04:11:19',17,NULL),
  (8,'esta perfecto','nada que hacer, esta super bien','Revisiones/esta perfecto.doc','Aceptado',1,'2017-11-15 15:11:27',19,NULL),
  (9,'no pudiste','te falto mucho','Revisiones/no pudiste.docx','Rechazado',3,'2017-11-15 16:22:26',20,NULL),
  (10,'Descripcion de concepto','Correcion  de concepto','Revisiones/Descripcion de concepto.pdf','Aceptado',1,'2017-12-07 01:12:21',25,NULL),
  (11,'descripcion','correccion','Revisiones/descripcion.txt','Aceptado',1,'2017-12-10 06:12:01',32,NULL),
  (12,'prueba','<p>Estado de prueba</p>','Revisiones/prueba.txt','Corrección',1,'2017-12-11 00:12:55',2,NULL),
  (13,'prueba','<p><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong><strong>Hola mundo&nbsp;</strong></p>','Revisiones/prueba.txt','Corrección',1,'2017-12-11 01:12:33',1,NULL);
COMMIT;

#
# Data for the `revisonp` table  (LIMIT -492,500)
#

INSERT INTO `revisonp` (`idrevisonp`, `descripcion`, `correccion`, `archivo`, `estado`, `num_revisiones`, `idproyecto`) VALUES 
  (1,'bien','excelente','RevisionesP/bien.docx','Aprobado',1,1),
  (2,'bien denis','esta excelente','RevisionesP/bien denis.docx','Aprobado',1,2),
  (3,'excelente andres','no tienes nada que corregir','RevisionesP/excelente andres.txt','Aprobado',1,3),
  (4,'falta','no esta bien','RevisionesP/falta.docx','Corrección',2,7),
  (5,'gfhfgh','ghfgh','RevisionesP/gfhfgh.docx','Corrección',1,7),
  (6,'Perfecto Santiago','Está perfecta Santiago','RevisionesP/Perfecto Santiago.docx','Aprobado',1,8),
  (7,'esta bien','pasaste de una','RevisionesP/esta bien.docx','Aprobado',1,9);
COMMIT;

#
# Data for the `sustentacion_final` table  (LIMIT -493,500)
#

INSERT INTO `sustentacion_final` (`idsustentacion_final`, `fecha`, `lugar`, `idproyecto`) VALUES 
  (1,'2017-09-26 18:00:00','Salón 202',1),
  (2,'2017-09-29 18:00:00','Salon 302',1),
  (3,'2017-11-20 19:00:00','La Quimera',2),
  (4,'2017-11-15 10:00:00','Sala 502',8),
  (5,'2017-11-20 14:00:00','Auditrio la quimera',9),
  (6,'2017-11-21 01:05:00','casa',9);
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;