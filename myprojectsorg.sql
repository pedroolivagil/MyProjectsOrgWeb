-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2016 a las 00:54:00
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myprojectsorg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `error_log`
--

CREATE TABLE `error_log` (
  `id_error_log` int(10) UNSIGNED NOT NULL,
  `accion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comentario` varchar(350) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `error_log`
--

INSERT INTO `error_log` (`id_error_log`, `accion`, `id_usuario`, `fecha_hora`, `comentario`) VALUES
(1, 'Crear Proyecto', 'd6edfbf0a46a571cf0562daf23d90e81', '2016-12-26 23:44:18', 'Se ha iniciado la creación del proyecto.'),
(3, 'Crear Proyecto; p_p: 0; p_p_r: 0; p_t: 4; p_t_r: 1; p_i: 1; p_i_r: 1', 'd6edfbf0a46a571cf0562daf23d90e81', '2016-12-26 23:44:18', 'Se ha deshecho los cambios.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(20) UNSIGNED NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(350) COLLATE utf8_spanish_ci NOT NULL,
  `flag_finish` tinyint(1) NOT NULL DEFAULT '0',
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `directorio_root` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `home_image` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_imagen`
--

CREATE TABLE `rel_proyecto_imagen` (
  `id_proyecto` int(20) UNSIGNED NOT NULL,
  `id_imagen` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_tarjeta`
--

CREATE TABLE `rel_proyecto_tarjeta` (
  `id_proyecto` int(20) UNSIGNED NOT NULL,
  `id_tarjeta` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_usuario`
--

CREATE TABLE `rel_proyecto_usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_proyecto` int(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id_tarjeta` int(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `fecha_alta`, `flag_activo`) VALUES
('d6edfbf0a46a571cf0562daf23d90e81', 'pedroolivagil@gmail.com', '2016-12-26 23:31:49', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`id_error_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `rel_proyecto_imagen`
--
ALTER TABLE `rel_proyecto_imagen`
  ADD PRIMARY KEY (`id_proyecto`,`id_imagen`),
  ADD KEY `id_imagen` (`id_imagen`);

--
-- Indices de la tabla `rel_proyecto_tarjeta`
--
ALTER TABLE `rel_proyecto_tarjeta`
  ADD PRIMARY KEY (`id_proyecto`,`id_tarjeta`),
  ADD KEY `id_tarjeta` (`id_tarjeta`);

--
-- Indices de la tabla `rel_proyecto_usuario`
--
ALTER TABLE `rel_proyecto_usuario`
  ADD PRIMARY KEY (`id_proyecto`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`id_tarjeta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `error_log`
--
ALTER TABLE `error_log`
  MODIFY `id_error_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `error_log`
--
ALTER TABLE `error_log`
  ADD CONSTRAINT `error_log_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_imagen`
--
ALTER TABLE `rel_proyecto_imagen`
  ADD CONSTRAINT `rel_proyecto_imagen_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_imagen_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `rel_proyecto_tarjeta` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_tarjeta`
--
ALTER TABLE `rel_proyecto_tarjeta`
  ADD CONSTRAINT `rel_proyecto_tarjeta_ibfk_1` FOREIGN KEY (`id_tarjeta`) REFERENCES `tarjeta` (`id_tarjeta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_tarjeta_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `rel_proyecto_usuario` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_usuario`
--
ALTER TABLE `rel_proyecto_usuario`
  ADD CONSTRAINT `rel_proyecto_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_usuario_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
