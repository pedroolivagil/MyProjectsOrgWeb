-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2016 a las 15:34:28
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bk_epic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_purchase`
--

CREATE TABLE IF NOT EXISTS `client_purchase` (
  `id_cart` int(10) unsigned NOT NULL COMMENT 'ID del carrito',
  `id_client` int(10) unsigned zerofill NOT NULL COMMENT 'Id del cliente',
  `import` float NOT NULL COMMENT 'importe de la compra',
  `services` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Array de los id sel servicio',
  `date_purchase` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de compra'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `client_purchase`
--

INSERT INTO `client_purchase` (`id_cart`, `id_client`, `import`, `services`, `date_purchase`) VALUES
(1, 0000000001, 200, '1', '2016-01-22 11:43:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client_purchase`
--
ALTER TABLE `client_purchase`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client_purchase`
--
ALTER TABLE `client_purchase`
  MODIFY `id_cart` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del carrito',AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
