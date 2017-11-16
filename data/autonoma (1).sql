-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-08-2017 a las 19:37:50
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autonoma`
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
(9, 'prueba de validacion', 'nn', 'anteproyecto/prueba de validacion.txt', 1, 1, '2017-05-26 15:06:28', 1, 9),
(10, 'salome', 'sal', 'anteproyecto/salome.txt', 1, 1, '2017-05-26 15:06:28', 1, 15),
(11, 'sistema online', 'nn', 'anteproyecto/sistema online.txt', 1, 1, '2017-05-31 15:27:27', 2, 16),
(12, 'nn', 'nn', 'anteproyecto/nn.txt', 1, 1, '2017-07-16 16:22:02', 1, 9),
(13, 'prueba3', 'prueba3', 'anteproyecto/prueba3.txt', 1, 1, '2017-07-16 15:31:49', 2, 9);

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
('Comite', 13, NULL),
('Docente', 11, NULL),
('Estudiante', 9, NULL),
('Estudiante', 15, NULL),
('Estudiante', 16, NULL),
('Jurado', 14, NULL),
('Secretario', 10, NULL),
('Secretario', 12, NULL);

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
(1, 'Alejandro'),
(2, 'Camilo'),
(3, 'Roberto');

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
(2, 3, '2017-07-18 00:00:00');

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
(1, 'hola', 'prueba', '2017-06-05'),
(2, 'otro evento', 'como sea', '2017-06-05'),
(3, 'evento 9', 'evnto1', '2017-06-06'),
(4, 'reunion de comite', 'segunda reunion del mes del año', '2017-06-09');

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
(1, 'andres pantoja'),
(2, 'Vazques'),
(3, 'cifuentes'),
(4, 'garry');

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
(1, 3, 3);

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
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idproyecto`, `nombre`, `descripcion`, `archivo_proyecto`, `date_create`, `id`) VALUES
(3, 'Plataforma Salesiano', 'Plataforma hecha en yii2', 'proyecto/Plataforma Salesiano.txt', '2017-05-30 23:05:49', 15);

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
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idanteproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revision`
--

INSERT INTO `revision` (`idrevision`, `descripcion`, `correccion`, `archivo`, `estado`, `date_create`, `idanteproyecto`) VALUES
(6, 'nn', 'nn', 'Revisiones/nn.txt', 'Aceptado', '2017-07-16 18:39:08', 10),
(7, 'prueba6', 'Revisiones/9.txt', 'Revisiones/prueba6.txt', 'Rechazado', '2017-05-26 15:23:28', 9),
(9, 'jfjfjfjfjfjhhffhfhhdhdhdhdhdhdhdhhdhhddhdhdh', 'Revisiones/9.txt', 'Revisiones/jfjfjfjfjfjhhffhfhhdhdhdhdhdhdhdhh', '', '2017-05-26 15:23:28', 9);

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
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `revisonp`
--

INSERT INTO `revisonp` (`idrevisonp`, `descripcion`, `correccion`, `archivo`, `estado`, `idproyecto`) VALUES
(1, 'Plataforma Salesiono', 'cc', 'RevisionesP/Plataforma Salesiono.txt', 'Corrección', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sustentacion_final`
--

CREATE TABLE `sustentacion_final` (
  `idsustentacion_final` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `apellido`, `codigo_estudiantil`, `facultad`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Andres', 'Cifuentes', '12282226', 'Ing. Sistemas informatico', 'andres', 'lKLrtfBPLvV3A0EbZFYNncZNEQkLptM8', '$2y$13$c.hcEkTwD77DtrN0vmHOFuQPLTPKA0E..uNA2XaRlRW0mp5x/orTS', NULL, 'andres@gmail.com', 'Activo', '2017-04-10', '0000-00-00'),
(10, 'hector', 'ricardo', '12833737', 'Ing. Sistemas informatico', 'ricardo', 'Ybk7Q31XWkvo0zq-xzTkrE31LERnyNYe', '$2y$13$cwcy0PQOP6r78W0SRS/P3uBqFhx/5eIk6ABk8HZfCDYlHSEjr0Jzu', NULL, 'rit@gmail.com', 'Activo', '2017-04-10', '0000-00-00'),
(11, 'nelson', 'menez', '', 'Ing. Sistemas informatico', 'nelson', 'pWd3Zuwgsl4GX8RneNzneGCJdinO7vCd', '$2y$13$I76GQfnEntqCV6OUyEKjN.BGp2iATGkzvNOFIliBpFjJz6gc.pxrC', NULL, 'nelson@gmail.com', 'Activo', '2017-04-21', '0000-00-00'),
(12, 'jimmy', 'campo', '', 'Ing. Sistemas informatico', 'jimmy', 'KvxQCMZMRgfuIrzx8ROa4W1Z7RWfLRzG', '$2y$13$da5rDv47QtB.OayxPdL8U.skT5loVCdleajMPlG.SC3SEu6GdjdNO', NULL, 'jimmy@gmail.com', 'Activo', '2017-04-21', '0000-00-00'),
(13, 'sandra', 'milena', '', 'Ing. Electronica', 'sandra', 'H49tyxQJVQL0hytrPov-kk-VcNSNdyvr', '$2y$13$aVtjr/Py/Fe8dA5rdEUdhO7pGXbVX7WeWkz2bnEWpfoDU04xrIX6G', NULL, 'sandra@gmail.com', 'Activo', '2017-04-21', '0000-00-00'),
(14, 'luis', 'luis', '', 'Ing. Ambiental', 'luis', 'FcF-_CD3IuaHam3bO3EmDOc_G-YIKIjP', '$2y$13$U9UUFLcxvubS4oziOspwCuVHQu.C.5n0FHXbmJsUQ.LXkLKISFaFi', NULL, 'luis@gmail.com', 'Activo', '2017-04-21', '0000-00-00'),
(15, 'salome', 'salmon', '19299383838', 'Ing. Sistemas informatico', 'salome', 'e1vFXzZPnvy-OZFJwTXL_ip5QWRZVxZx', '$2y$13$.iS4HtLrXZk7ypXGqEqlOeP7ufaakdqZ9MTJNaILNKacyrs3R6RYW', NULL, 'salome@gmail.com', 'Activo', '2017-04-26', '2017-06-04'),
(16, 'vazques', 'vasquez', '34555', 'Ing. Ambiental', 'vasquez', 'KJ4Og0pJ99Uy4BOxFtkTKN-qYFbbdV4d', '$2y$13$4cN1BYwSX.EXvURt10TS/.weBlhS0FoWgX9gDGXFjJX71DSthS1eW', NULL, 'vasquez@gmail.com', 'Activo', '2017-05-02', '0000-00-00');

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
  MODIFY `idanteproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  MODIFY `idconocimiento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `director_proyecto`
--
ALTER TABLE `director_proyecto`
  MODIFY `iddirector_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `jurado`
--
ALTER TABLE `jurado`
  MODIFY `idjurado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `idmodalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `idnovedades` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `revision`
--
ALTER TABLE `revision`
  MODIFY `idrevision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `revisonp`
--
ALTER TABLE `revisonp`
  MODIFY `idrevisonp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sustentacion_final`
--
ALTER TABLE `sustentacion_final`
  MODIFY `idsustentacion_final` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
