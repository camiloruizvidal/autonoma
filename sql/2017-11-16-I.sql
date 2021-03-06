-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-11-2017 a las 13:18:36
-- Versión del servidor: 5.6.38
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soluci12_tesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anteproyecto`
--

CREATE TABLE `anteproyecto` (
  `idanteproyecto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `archivo_anteproyecto` varchar(45) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `alerta` int(11) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idmodalidad` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anteproyecto`
--

INSERT INTO `anteproyecto` (`idanteproyecto`, `nombre`, `descripcion`, `archivo_anteproyecto`, `estado`, `alerta`, `date_create`, `idmodalidad`, `id`) VALUES
(1, 'prueba', 'prueba', 'anteproyecto/prueba.txt', 1, 1, '2017-09-27 07:50:06', 2, 27),
(2, 'prueba2', 'esta es otra prueba', 'anteproyecto/prueba2.txt', 0, 1, '2017-09-27 19:09:59', 2, 27),
(3, 'prueba3', 'prueba genial', 'anteproyecto/prueba3.docx', 1, 1, '2017-10-06 00:22:18', 2, 31),
(4, 'prueba daniel', 'ojala esta sea', 'anteproyecto/prueba daniel.docx', 0, 1, '2017-10-07 10:10:45', 2, 33),
(5, 'Prueba', 'Prueba', 'anteproyecto/Prueba.docx', 0, 1, '2017-10-07 16:10:59', 1, 33),
(6, 'Prueba1', 'Prueba1', 'anteproyecto/Prueba1.docx', 0, 1, '2017-10-07 17:10:40', 2, 30),
(7, 'ingenieria ambiental', 'ingeniera ambiental', 'anteproyecto/ingenieria ambiental.docx', 1, 1, '2017-10-09 14:14:09', 2, 35),
(8, 'ksdks', 'dfdsf', 'anteproyecto/ksdks.docx', 0, 1, '2017-10-09 13:10:39', 2, 30),
(9, 'si funciona', 'pendejo jajajaj', 'anteproyecto/si funciona.txt', 0, 1, '2017-10-09 14:10:26', 1, 30),
(10, 'prueba daniela', 'funciona???', 'anteproyecto/prueba daniela.txt', 0, 1, '2017-10-09 14:10:08', 2, 37),
(11, 'aandres anteproyecto', 'pendejo  ', 'anteproyecto/aandres anteproyecto.txt', 1, 1, '2017-10-25 13:18:10', 2, 36),
(12, 'james prueba', 'sera que si?', 'anteproyecto/james prueba.docx', 1, 1, '2017-11-14 16:56:04', 2, 38),
(13, 'pruebas camilo', 'camilo ruiz vidal', 'anteproyecto/pruebas camilo.docx', 0, 1, '2017-10-10 00:10:43', 2, 40),
(14, 'juancamilo anteproyecto', 'prueba casi final', 'anteproyecto/juancamilo anteproyecto.docx', 1, 1, '2017-11-07 14:02:36', 2, 53),
(15, 'fredy yepes', 'este es fredy', 'anteproyecto/fredy yepes.txt', 1, 1, '2017-11-07 14:13:41', 1, 54),
(16, 'prueba de alerta', 'prueba', 'anteproyecto/prueba de alerta.txt', 1, 1, '2017-11-16 01:01:25', 1, 55),
(17, 'Esta lista la Plataforma', 'mañana tenemos presustentación', 'anteproyecto/Esta lista la Plataforma.docx', 1, 1, '2017-11-15 04:28:27', 2, 56),
(18, 'prueba 2', 'prueba 2', 'anteproyecto/prueba 2.txt', 1, 1, '2017-11-15 18:38:58', 1, 55),
(19, 'no he hecho nada de tesis', 'no se que hacer', 'anteproyecto/no he hecho nada de tesis.doc', 1, 1, '2017-11-15 15:37:06', 2, 57),
(20, 'proyecto a cancelar', 'se cancelara', 'anteproyecto/proyecto a cancelar.docx', 1, 1, '2017-11-15 16:24:21', 2, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Comite', 28, NULL),
('Comite', 48, NULL),
('Comite', 58, NULL),
('Docente', 34, NULL),
('Docente', 41, NULL),
('Docente', 42, NULL),
('Docente', 45, NULL),
('Docente', 46, NULL),
('Estudiante', 27, NULL),
('Estudiante', 30, NULL),
('Estudiante', 31, NULL),
('Estudiante', 33, NULL),
('Estudiante', 35, NULL),
('Estudiante', 36, NULL),
('Estudiante', 37, NULL),
('Estudiante', 38, NULL),
('Estudiante', 40, NULL),
('Estudiante', 43, NULL),
('Estudiante', 47, NULL),
('Estudiante', 50, NULL),
('Estudiante', 51, NULL),
('Estudiante', 52, NULL),
('Estudiante', 53, NULL),
('Estudiante', 54, NULL),
('Estudiante', 55, NULL),
('Estudiante', 56, NULL),
('Estudiante', 57, NULL),
('Estudiante', 60, NULL),
('Estudiante', 61, NULL),
('Jurado', 29, NULL),
('Jurado', 32, NULL),
('Jurado', 44, NULL),
('Jurado', 49, NULL),
('Jurado', 59, NULL),
('Secretario', 10, NULL),
('Secretario', 39, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8,
  `rule_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Comite', 1, NULL, NULL, NULL, NULL, NULL),
('Docente', 2, NULL, NULL, NULL, NULL, NULL),
('Estudiante', 1, NULL, NULL, NULL, NULL, NULL),
('Jurado', 1, NULL, NULL, NULL, NULL, NULL),
('Secretario', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conocimiento`
--

CREATE TABLE `conocimiento` (
  `idconocimiento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conocimiento`
--

INSERT INTO `conocimiento` (`idconocimiento`, `nombre`, `descripcion`, `telefono`, `correo`) VALUES
(1, 'Sistema de alertas para un banco', 'Es un sistema que proporcione alertas a los m', 32548745, 'julianhoyos@uniautonoma.edu.co'),
(2, 'Nuevo proyecto por hacer', 'Algas marinas sistematizadas', 2147483647, 'julian.hoyos@uniautonoma.edu.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_proyecto`
--

CREATE TABLE `director_proyecto` (
  `iddirector_proyecto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `director_proyecto`
--

INSERT INTO `director_proyecto` (`iddirector_proyecto`, `nombre`) VALUES
(1, 'bermudez'),
(2, 'andres vasquez'),
(3, 'Gabriel Osorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_proyecto_por_proyecto`
--

CREATE TABLE `director_proyecto_por_proyecto` (
  `iddirector_proyecto` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `director_proyecto_por_proyecto`
--

INSERT INTO `director_proyecto_por_proyecto` (`iddirector_proyecto`, `idproyecto`, `fecha`) VALUES
(1, 2, '2017-10-05 21:10:26'),
(1, 8, '2017-11-14 23:11:58'),
(3, 9, '2017-11-15 10:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `iddocumento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `archivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `nombre`, `archivo`) VALUES
(1, 'resolucion_0047_trabajos_de_grado1', 'Archivo/resolucion_0047_trabajos_de_grado1.pdf'),
(2, 'Formato No. 1_Presentación del Anteproyecto de Trabajo de Grado', 'Archivo/Formato No. 1_Presentación del Anteproyecto de Trabajo de Grado.docx'),
(3, 'Formato No. 2_Seguimiento de los Trabajos de Grado', 'Archivo/Formato No. 2_Seguimiento de los Trabajos de Grado.docx'),
(4, 'Formato No. 3_Evaluación Previa de la Pasantía', 'Archivo/Formato No. 3_Evaluación Previa de la Pasantía.docx'),
(5, 'Guía No. 2_Evaluación del Trabajo de Grado', 'Archivo/Guía No. 2_Evaluación del Trabajo de Grado.docx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `idevento` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`idevento`, `titulo`, `descripcion`, `fecha`) VALUES
(1, 'sustentacion electronica ii', '', '2017-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurado`
--

CREATE TABLE `jurado` (
  `idjurado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jurado`
--

INSERT INTO `jurado` (`idjurado`, `nombre`) VALUES
(1, 'henry'),
(2, 'jimmy'),
(3, 'andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurado_has_proyecto`
--

CREATE TABLE `jurado_has_proyecto` (
  `idjurado` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `idjurado2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jurado_has_proyecto`
--

INSERT INTO `jurado_has_proyecto` (`idjurado`, `idproyecto`, `idjurado2`) VALUES
(1, 2, 2),
(1, 2, 3),
(2, 3, 1),
(1, 7, 3),
(2, 8, 1),
(2, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `idmodalidad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`idmodalidad`, `nombre`, `descripcion`) VALUES
(1, 'pasantia', NULL),
(2, 'trabajo de Investigacion', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `idnovedades` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `novedades`
--

INSERT INTO `novedades` (`idnovedades`, `descripcion`, `fecha`, `idproyecto`) VALUES
(1, 'Crear Prorroga', '2017-09-29 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idproyecto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `archivo_proyecto` varchar(45) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL,
  `articulo` varchar(200) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idproyecto`, `nombre`, `descripcion`, `archivo_proyecto`, `date_create`, `id`, `articulo`, `estado`) VALUES
(1, 'ultimo proyecto', 'este es el ultimo proyecto.', 'proyecto/ultimo proyecto.docx', '2017-09-27 14:09:13', 27, '', ''),
(2, 'Plataforma denis', 'esta es una prueba de denis', 'proyecto/Plataforma denis.docx', '2017-11-15 03:11:38', 31, '', '1'),
(3, 'andres proyecto', 'este proyecto se enfoca en la optimización.', 'proyecto/andres proyecto.txt', '2017-10-25 13:10:35', 36, 'articulo/andres proyecto.txt', ''),
(4, 'plataforma para la gestion y seguimiento', 'esto sirve para optimizar tiempo y dinero', 'proyecto/plataforma para la gestion y seguimi', '2017-11-07 19:11:59', 53, 'articulo/plataforma para la gestion y seguimiento.docx', ''),
(5, 'plataforma para la gestion y seguimiento', 'sjadhjasdhkj', 'proyecto/plataforma para la gestion y seguimi', '2017-11-07 19:11:08', 53, 'articulo/plataforma para la gestion y seguimiento.txt', ''),
(6, 'soy fredy yepes', 'este es el proyecto final de fredy', 'proyecto/soy fredy yepes.txt', '2017-11-07 19:11:35', 54, 'articulo/soy fredy yepes.txt', ''),
(7, 'juancamilo proyecto', 'este es de juancamilo', 'proyecto/juancamilo proyecto.txt', '2017-11-07 15:37:39', 53, 'articulo/juancamilo proyecto.docx', ''),
(8, 'Esta lista la Plataforma', 'vamos a presustentar mañana', 'proyecto/Esta lista la Plataforma.docx', '2017-11-15 04:36:05', 56, 'articulo/Esta lista la Plataforma.docx', '1'),
(9, 'no se que hacer de tesis', 'aun no tengo nada', 'proyecto/no se que hacer de tesis.doc', '2017-11-15 15:43:13', 57, 'articulo/no se que hacer de tesis.doc', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revision`
--

CREATE TABLE `revision` (
  `idrevision` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `correccion` varchar(45) NOT NULL,
  `archivo` varchar(45) NOT NULL,
  `estado` enum('Corrección','Rechazado','Aceptado') NOT NULL,
  `num_revisiones` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idanteproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revision`
--

INSERT INTO `revision` (`idrevision`, `descripcion`, `correccion`, `archivo`, `estado`, `num_revisiones`, `date_create`, `idanteproyecto`) VALUES
(1, 'bien', 'bien hecho', 'Revisiones/bien.docx', 'Aceptado', 1, '2017-09-27 14:09:24', 1),
(2, 'ahora si', 'esta perfecto', 'Revisiones/ahora si.docx', 'Aceptado', 2, '2017-10-06 00:23:15', 3),
(3, 'no pasaste las correcciones', 'busca otro por hacer', 'Revisiones/no pasaste las correcciones.docx', 'Rechazado', 3, '2017-10-09 14:13:11', 7),
(4, 'excelente', 'perfecto', 'Revisiones/excelente.txt', 'Aceptado', 1, '2017-10-25 13:10:44', 11),
(5, 'quedo listo', 'ahora si juan camilo', 'Revisiones/quedo listo.txt', 'Aceptado', 2, '2017-11-07 14:03:56', 14),
(6, 'excelente fredy', 'bien fredy', 'Revisiones/excelente fredy.docx', 'Aceptado', 2, '2017-11-07 19:05:44', 15),
(7, 'esta muy bien santiago', 'esta todo perfecto', 'Revisiones/esta muy bien santiago.docx', 'Aceptado', 1, '2017-11-15 04:11:19', 17),
(8, 'esta perfecto', 'nada que hacer, esta super bien', 'Revisiones/esta perfecto.doc', 'Aceptado', 1, '2017-11-15 15:11:27', 19),
(9, 'no pudiste', 'te falto mucho', 'Revisiones/no pudiste.docx', 'Rechazado', 3, '2017-11-15 16:22:26', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `revisonp`
--

CREATE TABLE `revisonp` (
  `idrevisonp` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `correccion` varchar(45) NOT NULL,
  `archivo` varchar(45) NOT NULL,
  `estado` enum('Corrección','Rechazado','Aprobado') NOT NULL,
  `num_revisiones` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revisonp`
--

INSERT INTO `revisonp` (`idrevisonp`, `descripcion`, `correccion`, `archivo`, `estado`, `num_revisiones`, `idproyecto`) VALUES
(1, 'bien', 'excelente', 'RevisionesP/bien.docx', 'Aprobado', 1, 1),
(2, 'bien denis', 'esta excelente', 'RevisionesP/bien denis.docx', 'Aprobado', 1, 2),
(3, 'excelente andres', 'no tienes nada que corregir', 'RevisionesP/excelente andres.txt', 'Aprobado', 1, 3),
(4, 'falta', 'no esta bien', 'RevisionesP/falta.docx', 'Corrección', 2, 7),
(5, 'gfhfgh', 'ghfgh', 'RevisionesP/gfhfgh.docx', 'Corrección', 1, 7),
(6, 'Perfecto Santiago', 'Está perfecta Santiago', 'RevisionesP/Perfecto Santiago.docx', 'Aprobado', 1, 8),
(7, 'esta bien', 'pasaste de una', 'RevisionesP/esta bien.docx', 'Aprobado', 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sustentacion_final`
--

CREATE TABLE `sustentacion_final` (
  `idsustentacion_final` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `lugar` varchar(200) NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sustentacion_final`
--

INSERT INTO `sustentacion_final` (`idsustentacion_final`, `fecha`, `lugar`, `idproyecto`) VALUES
(1, '2017-09-26 18:00:00', 'Salón 202', 1),
(2, '2017-09-29 18:00:00', 'Salon 302', 1),
(3, '2017-11-20 19:00:00', 'La Quimera', 2),
(4, '2017-11-15 10:00:00', 'Sala 502', 8),
(5, '2017-11-20 14:00:00', 'Auditrio la quimera', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8 NOT NULL,
  `codigo_estudiantil` varchar(100) CHARACTER SET utf8 NOT NULL,
  `facultad` enum('Ing. Sistemas informatico','Ing. Ambiental','Ing. Electronica','') CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `cont` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `apellido`, `codigo_estudiantil`, `facultad`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `cont`) VALUES
(10, 'hector', 'ricardo', '12833737', 'Ing. Sistemas informatico', 'ricardo', 'UOpWFVTf-jrrQ6tZAERM_puxZxWtVbcR', '$2y$13$2B7nOIiPsFrsW2rqdqQ57ef358ZIrsz/RhftxYj3KRR9WHeCvTLaW', NULL, 'rit@gmail.com', 'Activo', '2017-04-10', '2017-09-08', 1),
(27, 'Juan', 'cifuentes', '38748329748', 'Ing. Sistemas informatico', 'juan', 'yKi1G5DaZIwdEymiEW9TF_Kc139pP3le', '$2y$13$5Qt2DH8ydXWQqeQp.TCycODBQ09Bq07udClk1SlCeYeJF94KF5pTC', NULL, 'juan@uniautonoma.edu.co', 'Activo', '2017-09-27', '0000-00-00', 0),
(28, 'julian', 'bermudez', '938422834', 'Ing. Sistemas informatico', 'julian', 'GM8l-Vl7XY9vPd-8GtXlikoT3DqwmiiD', '$2y$13$dZRSUjXVCWmfeseeYQfkye1a6uK58HJYI8wEgaDd1xngCNnJ00fqG', NULL, 'julian@uniautonoma.edu.co', 'Activo', '2017-09-27', '0000-00-00', 1),
(29, 'gabriel', 'osorio', '38423489', 'Ing. Sistemas informatico', 'gabriel', 'i4dst9FWA_ryKsBWC17v_o6o4mq8izUT', '$2y$13$TxnnvhYH8wztCZQxxFKnHezEm8jlvZw440xUNlHVXDpIFYmd.bKUu', NULL, 'gabirel@uniautonoma.edu.co', 'Activo', '2017-09-27', '0000-00-00', 1),
(30, 'Rodrigo', 'Vivas', '18948349', 'Ing. Sistemas informatico', 'Rodrigo', 'Rv8FUUV-7gLxRi3O1l2yCJ_rYsH3oZP8', '$2y$13$jwOL5Amlpe3HRJVc1375S.CTu6q6dsOfqqdcE45S105oHFskpVcZi', NULL, 'rodrigo@uniautonoma.edu.co', 'Activo', '2017-09-27', '0000-00-00', 1),
(31, 'Denis', 'Orozco', '384923498', 'Ing. Sistemas informatico', 'denis', 'nwdBekIkBoaoBL7V1gdGZ0T_3FKJivVd', '$2y$13$DqGzcERv.w54rp1PAsVy6eFXyig1NhUMikp5bazLQAAnaqAN8BacW', NULL, 'denis@uniautonoma.edu.co', 'Activo', '2017-10-05', '0000-00-00', 1),
(32, 'henry', 'cordoba', '93840385', 'Ing. Sistemas informatico', 'henry', '-Pv6aC9SDe-SOHxZDe-asz01F_5zgMQ6', '$2y$13$JZRagQS8WuK8dY49AzFQY.PrU9kGhzlsQTqQw3XSEXXyBVPqS0Bpa', NULL, 'henry@uniautonoma.edu.co', 'Activo', '2017-10-05', '0000-00-00', 0),
(33, 'Daniel', 'Garcia', '93840923489', 'Ing. Sistemas informatico', 'daniel', 'eG2vQLauGeVK1t8wnAyzxuLgQ-w5PB1z', '$2y$13$5uGNR7pWVVANAHpX2ATfMOkarrRgZVDr9wy41UYJRVwJfu1hIESEK', NULL, 'daniel@uniautonoma.edu.co', 'Activo', '2017-10-07', '0000-00-00', 0),
(34, 'Melina', 'sam', '4566', 'Ing. Electronica', 'Melina', '949oWOS-dn8rJMH_hj08WaK8C5p-gTLz', '$2y$13$ScUVCvqyqNLwEnltdJqZme6rq/miCafR08hex5zPu0yk0ZQvmr/wi', NULL, 'sa@f.com', 'Activo', '2017-10-07', '2017-10-07', 0),
(35, 'Dahiana', 'Orozco', '874982349823', 'Ing. Ambiental', 'dahiana', '9xJ9JWecPYmYXIoPex0trxX-oxQFY85H', '$2y$13$CsQIgc2JxOXUIyY0.hNODuh0U9qMyskgTvY5lSyKtDDTH0CfYIrQK', NULL, 'dahiana@uniautonoma.edu.co', 'Activo', '2017-10-07', '2017-10-07', 0),
(36, 'Andres', 'Cifuentes', '1061772382', 'Ing. Sistemas informatico', 'andres', 'hX3qwBqRDz0uFa6tqvl7pffZXHa8AIAh', '$2y$13$fRd.q4lQbv3NfuMJ2lSLseONF5F5UlwLU6T8IO5vhOgcLaBkUagnG', NULL, 'octavio.c@uniautonoma.edu.co', 'Activo', '2017-10-09', '2017-10-24', 1),
(37, 'Daniela', 'Orozco', '58943755784', 'Ing. Electronica', 'daniela', '96LUHCmJ7XF7tdYAnG6pIQmbwr7OgX9W', '$2y$13$Iyk44iwnN5JUCVnZuQSGBe1AjhILl4xGOq8fUI4HmEzb343I0.85S', NULL, 'daniela@uniautonoma.edu.co', 'Activo', '2017-10-09', '2017-10-09', 0),
(38, 'James', 'Cifuentes', '48759437589', 'Ing. Electronica', 'james', 'feS9pyRk9cSZ-o9nGUV6GD--6AH_iGQ7', '$2y$13$AflwKb5yyfqeT1m8ju76wePJrRALE5DyQ.KPQc.H4GipMHQX7xlN2', NULL, 'james@uniautonoma.edu.co', 'Activo', '2017-10-09', '2017-10-09', 0),
(39, 'hector', 'campo', '3933', 'Ing. Electronica', 'hector', '41URydzJ8clTVmldAmtftjr810xhbYjn', '$2y$13$VcEYbjqqePtqp8T.IV.kyODbj11VNvDdYk1tHdD1dhzAVKkT.wZMe', 'utLyVdI7sxInxT351PLwVscIxPka8IWz_1507587639', 'riki0885@gmail.com', 'Activo', '2017-10-09', '2017-10-09', 0),
(40, 'Camilo', 'Ruiz Vidal', '3294828234', 'Ing. Sistemas informatico', 'camilo', 'nhmJ7LfJQbag1axcaDOJUyAPEiP6lLaT', '$2y$13$WBQE9WQYmfKm8Fn92B79dO6kLzIdrAevc5sIa0stSy/0tJ41GLuGO', NULL, 'camilo@uniautonoma.edu.co', 'Activo', '2017-10-09', '2017-10-09', 0),
(41, 'Julian Eduardo', 'Hoyos', '8576894', 'Ing. Sistemas informatico', 'julianh', 'OABCLt7jCmnVjwlN_uF-eAvs7tZ-NPT1', '$2y$13$1SZFIEU4JeYihijkGPbdTO0m1SLZXoXyw7QXyEgrb5Yg5M2rPAM2K', NULL, 'julianhoyos@uniautonoma.edu.co', 'Activo', '2017-10-11', '2017-10-11', 0),
(42, 'Julian', 'Hoyos ', '874974589', 'Ing. Sistemas informatico', 'julianhoyos', 'Ef-nazmh1x1YAhu2z_LT82u85MtXBH4x', '$2y$13$qOPnvZFy.3VO1NEOPAsWUeS9F20KYeu/UmVvgc2xJNExYwMzEb2SW', NULL, 'julianandreshoyos@uniautonoma.edu.co', 'Activo', '2017-10-19', '2017-10-19', 1),
(43, 'andres', 'vasquez', '1061688357', 'Ing. Sistemas informatico', 'afvasquez', 'jnHqXc2zjPIf1livpFKNvcFG_KIimv9g', '$2y$13$LUIcw/yB3azGo5.JsTJneeCa1uvOEzlJmkG163XNERVO9nBhXtO5y', NULL, 'andres.vasquez@uniautonoma.edu.co', 'Activo', '2017-10-20', '2017-10-20', 0),
(44, 'jimmy', 'hendrix', '1061345333', 'Ing. Electronica', 'jhx', 'WwPkJAx0iXkb7jhkKVJEpstX33Z28w8t', '$2y$13$Uy.uBzg7KgecmFdQc0B5yOGVQuRhXJD4YGPv5JkPHDgLDwSQcosHq', NULL, 'jimmy.hendrix@uniautonoma.edu.co', 'Activo', '2017-10-20', '2017-10-20', 0),
(45, 'luis', 'giron', '1431281', 'Ing. Sistemas informatico', 'lgirono', 'URdjJFTFuncI9wpY-rZPKYsmtbZ0kstC', '$2y$13$TEnS6qKWD5GelBYgvH08ruzUSCWz/kQvR7ppZ6WnIKEQcOcTCICXe', NULL, 'luis.giron@unicauca.edu.co', 'Activo', '2017-10-21', '2017-10-21', 0),
(46, 'Oscar Ivan', 'Diaz Salazar', '498354', 'Ing. Sistemas informatico', 'oscar', 'C5H23pQbVs8S2ElAP7YEJihSIoBBqtGZ', '$2y$13$HrOYnsYiS.k0sBCw6tM/T.UXlISL3rqnq7UmfHwuST0NVP0.3n50y', NULL, 'oscar@hotmail.com', 'Activo', '2017-10-21', '2017-10-21', 0),
(47, 'andres felipe', 'vasquez', '1061688357', 'Ing. Sistemas informatico', 'andres.vasquez', 'EwkjnuxpH-ENY5opImXo047ai-_bI28s', '$2y$13$hDS5NIKwGo9gTLTE1iYDkOfaBrYIxIUvB4tGzNrTJtkB5yFcaDSlO', NULL, 'afvasquez1986@gmail.com', 'Activo', '2017-10-21', '2017-11-15', 1),
(48, 'juan', 'vasquez', '1061788980', 'Ing. Sistemas informatico', 'jvasquez', 'zqkegAHteIgQRf9vzpGjpE7Rf70JP4uS', '$2y$13$QF.k4sBo382yUx9oI3fyqeXSBco3pMMUJDps7ze3ZknDqrua4kWni', NULL, 'jvasquez@gmail.com', 'Activo', '2017-10-21', '2017-10-21', 0),
(49, 'prueba', 'aapapap', '999', 'Ing. Sistemas informatico', 'prueba', 'zagt7rZeuKPfegGTtk6kMGHk2r2D8XXx', '$2y$13$mK5vZUpueEH73NfDF42WLOo0mNv69us6sdWksorMdeLqnT9Ks6Th.', NULL, 'pru@f.com', 'Activo', '2017-10-24', '2017-10-24', 0),
(50, 'Rodrigo', 'Garcia', '38274832748', 'Ing. Sistemas informatico', 'rodrigogarcia', 'eHZEq8FllUizvqwEUe48WUQY_D8yExK9', '$2y$13$W4SXQztDDIWx8Giju9v7b.B.ZaCvq4wfyhnTgQBcnXiil4b.qe8QK', NULL, 'rodrigo@hotmail.com', 'Activo', '2017-10-26', '2017-10-26', 1),
(51, 'juan camilo', 'suarez', '438284', 'Ing. Electronica', 'juanca', 'HBi8gMKlfUrYn5wASsQe4N6lorXZwQSU', '$2y$13$QiQ2Q/si.8CqtvcpdsyPne1LjTEuZnUk9VSUuY6auhk1tpEMOj0LW', NULL, 'juanca@hotmail.com', 'Activo', '2017-10-26', '2017-10-26', 1),
(52, 'fabian', 'ibarra', '23984358', 'Ing. Sistemas informatico', 'fabian', '0v17NY7xLZachPoujhKpeDVNBwY-l2Jp', '$2y$13$ynxuf72pK2gz29n/fV0kNe.g7Ed.wrMR69sJRK8ssnH6zpijlX7Ri', NULL, 'fabian@hotmail.com', 'Activo', '2017-10-26', '2017-10-26', 1),
(53, 'Juan Camilo', 'Garcia', '8334', 'Ing. Ambiental', 'juancamilo', 'kXh9_0R4sxH6hJW7nunE6vyyR13Igp48', '$2y$13$WAjc.ioZU.kf3hYU8YuRz.afupugqdEaq3G4TFZ3RYZUFBXL7IQM6', NULL, 'camilo@hotmail.com', 'Activo', '2017-11-07', '2017-11-07', 1),
(54, 'fredy', 'yepes', '4636434', 'Ing. Electronica', 'fredyyepes', 'jdAKunK4cLrWNPwr6GrTgKBDZrX-CIcW', '$2y$13$NRI1gM9VZJ261Lu3dyqV..f.OXo7W1KexOxHz6Bi5bCt8KhGnyhJC', NULL, 'fredy@hotmail.com', 'Activo', '2017-11-07', '2017-11-07', 1),
(55, 'camilo', 'ruiz', '1010101010', 'Ing. Sistemas informatico', 'milo9022', 'R9tlQXXfxf---YssaaobK3E4mJfL4Lg4', '$2y$13$Hkrr2qzvp2OeoKoCkouAkOH8P0rx1C93V.umgL2WyrhAxLIBevdE.', NULL, 'camiloruizvidal@gmail.com', 'Activo', '2017-11-14', '2017-11-14', 1),
(56, 'David Santiago', 'Cordoba Camacho', '182137912', 'Ing. Sistemas informatico', 'santiago', 'R6jsw70o503hlWHYa-M7xUlBQy_kZNih', '$2y$13$VnFPDzZKejscw7nuff07iubQ5egMbjIa2Gn825iCDs4x0H9cyXGqW', NULL, 'andrescifuentesdorado@gmail.com', 'Activo', '2017-11-14', '2017-11-14', 1),
(57, 'alejandro', 'restrepo', '34543770', 'Ing. Sistemas informatico', 'alejimio', 'fTVbG5Qf0TOttj3ST9yMElq-hEzqbqdg', '$2y$13$lsMd5tD.R/2UKsa.FDyuDeYnmTQgQduhd4OBBlwzrt0oXMQssRI4K', NULL, 'alejandro.restrepo.s@uniautonoma.edu.co', 'Activo', '2017-11-15', '2017-11-15', 1),
(58, 'julian', 'caicedo', '34543770', 'Ing. Electronica', 'juliancaicedo', 'SQai5VeIs8zyupiAM8fMcLq2pvMOBRNb', '$2y$13$IVvP8zwCAWA.2G0nJDArS.wcBgOZE1jbDFj1qErjlwMtqLLnfZ3m2', NULL, 'julian.caicedo@uniautonoma.edu.co', 'Activo', '2017-11-15', '2017-11-15', 1),
(59, 'Jimmy', 'Campo', '568975620', 'Ing. Sistemas informatico', 'jimmyc', 'uGxWY46Y19AYeE6GH-jC_XsEVa7rZMk6', '$2y$13$mL8wL8VPODmTZJsgIileI.R57X9Jxzs6gtv1IjtutSEcbpsRGGeHq', NULL, 'jimmy.campo@uniautonoma.edu.co', 'Activo', '2017-11-15', '2017-11-15', 1),
(60, 'andres', 'pelon', '456879', 'Ing. Sistemas informatico', 'andresito', 'j-gWRX_s8HuDEmZY5KFeyt160QzJMO9C', '$2y$13$tJ3kqG0qWjDyPQzxaqiDPefLUox8bIcOBddwZ/xyA62vIm0iMMaVi', NULL, 'andres.vasquez@uniautonama.edu.co', 'Activo', '2017-11-15', '2017-11-15', 1),
(61, 'felipe', 'ramiraz', '67676', 'Ing. Sistemas informatico', 'felipe', 'l9CRkKOvl4xCgBzsz4Id4IqOi7rWMhnR', '$2y$13$EoM3iFMU.LaXdmPLjRejRO94XjVsw3mCiL1s2a6t9wYK4NBi.ny4S', NULL, 'felipe@uniautonoma.edu.co', 'Activo', '2017-11-15', '2017-11-15', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD PRIMARY KEY (`idanteproyecto`),
  ADD KEY `fk_anteproyecto_modalidad1_idx` (`idmodalidad`),
  ADD KEY `fk_anteproyecto_user1_idx` (`id`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  ADD PRIMARY KEY (`idconocimiento`);

--
-- Indices de la tabla `director_proyecto`
--
ALTER TABLE `director_proyecto`
  ADD PRIMARY KEY (`iddirector_proyecto`);

--
-- Indices de la tabla `director_proyecto_por_proyecto`
--
ALTER TABLE `director_proyecto_por_proyecto`
  ADD PRIMARY KEY (`iddirector_proyecto`,`idproyecto`),
  ADD KEY `fk_director_proyecto_has_proyecto_proyecto1_idx` (`idproyecto`),
  ADD KEY `fk_director_proyecto_has_proyecto_director_proyecto1_idx` (`iddirector_proyecto`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`idevento`);

--
-- Indices de la tabla `jurado`
--
ALTER TABLE `jurado`
  ADD PRIMARY KEY (`idjurado`);

--
-- Indices de la tabla `jurado_has_proyecto`
--
ALTER TABLE `jurado_has_proyecto`
  ADD PRIMARY KEY (`idjurado`,`idproyecto`,`idjurado2`),
  ADD KEY `fk_jurado_has_proyecto_proyecto1_idx` (`idproyecto`),
  ADD KEY `fk_jurado_has_proyecto_jurado1_idx` (`idjurado`),
  ADD KEY `fk_jurado_has_proyecto_jurado2_idx` (`idjurado2`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`idmodalidad`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`idnovedades`),
  ADD KEY `fk_novedades_proyecto1_idx` (`idproyecto`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idproyecto`),
  ADD KEY `fk_proyecto_anteproyecto1_idx` (`idproyecto`),
  ADD KEY `fk_proyecto_user1_idx` (`id`);

--
-- Indices de la tabla `revision`
--
ALTER TABLE `revision`
  ADD PRIMARY KEY (`idrevision`),
  ADD KEY `fk_revision_anteproyecto1_idx` (`idanteproyecto`);

--
-- Indices de la tabla `revisonp`
--
ALTER TABLE `revisonp`
  ADD PRIMARY KEY (`idrevisonp`),
  ADD KEY `fk_revisonp_proyecto1_idx` (`idproyecto`);

--
-- Indices de la tabla `sustentacion_final`
--
ALTER TABLE `sustentacion_final`
  ADD PRIMARY KEY (`idsustentacion_final`),
  ADD KEY `fk_sustentacion_final_proyecto1_idx` (`idproyecto`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  MODIFY `idanteproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  MODIFY `idconocimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `director_proyecto`
--
ALTER TABLE `director_proyecto`
  MODIFY `iddirector_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `jurado`
--
ALTER TABLE `jurado`
  MODIFY `idjurado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `idmodalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `idnovedades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `revision`
--
ALTER TABLE `revision`
  MODIFY `idrevision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `revisonp`
--
ALTER TABLE `revisonp`
  MODIFY `idrevisonp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `sustentacion_final`
--
ALTER TABLE `sustentacion_final`
  MODIFY `idsustentacion_final` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD CONSTRAINT `fk_anteproyecto_modalidad1` FOREIGN KEY (`idmodalidad`) REFERENCES `modalidad` (`idmodalidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anteproyecto_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `director_proyecto_por_proyecto`
--
ALTER TABLE `director_proyecto_por_proyecto`
  ADD CONSTRAINT `fk_director_proyecto_has_proyecto_director_proyecto1` FOREIGN KEY (`iddirector_proyecto`) REFERENCES `director_proyecto` (`iddirector_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_director_proyecto_has_proyecto_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `jurado_has_proyecto`
--
ALTER TABLE `jurado_has_proyecto`
  ADD CONSTRAINT `fk_jurado_has_proyecto_jurado1` FOREIGN KEY (`idjurado`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurado_has_proyecto_jurado2` FOREIGN KEY (`idjurado2`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurado_has_proyecto_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD CONSTRAINT `fk_novedades_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_proyecto_user1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `revision`
--
ALTER TABLE `revision`
  ADD CONSTRAINT `fk_revision_anteproyecto1` FOREIGN KEY (`idanteproyecto`) REFERENCES `anteproyecto` (`idanteproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `revisonp`
--
ALTER TABLE `revisonp`
  ADD CONSTRAINT `fk_revisonp_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sustentacion_final`
--
ALTER TABLE `sustentacion_final`
  ADD CONSTRAINT `fk_sustentacion_final_proyecto1` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
