-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2016 a las 03:47:40
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epic_telecom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attributes_service`
--

CREATE TABLE `attributes_service` (
  `code_service` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `attr1` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `attr2` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `attr3` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `attr4` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `attributes_service`
--

INSERT INTO `attributes_service` (`code_service`, `attr1`, `attr2`, `attr3`, `attr4`, `description`) VALUES
('BMM', 'CALLERID', 'Minutos a móviles', '[Nums]', NULL, 'Bonus de llamada a móviles'),
('CENTSOR', 'Canales de entrada', 'Canales de salida', NULL, NULL, 'Canales entrada y salida'),
('CHADD', 'CALLERID', NULL, NULL, NULL, 'Canales adicionales, sólo Linea Digital SIP Profesional'),
('EXTENSION', 'Descripcion', NULL, NULL, NULL, 'Extensión de centralita'),
('GNUM', 'CALLERID', NULL, NULL, NULL, 'Número geográfico adicional'),
('GNUMPORTAT', 'NUM geográfico', NULL, NULL, NULL, 'Número geográfico con portabilidad'),
('INST_EXTENSION', 'precio por extension', NULL, NULL, NULL, 'Precio de instalacion por extension'),
('INTERNET_SPEED', 'decarga', 'carga', NULL, NULL, 'Velocidad de internet para las tarifas aire y pro'),
('MAXCREDIT', 'Límite de crédito', NULL, NULL, NULL, 'Límite de crédito'),
('MF', 'CALLERID', 'Minutos a fijos', NULL, NULL, 'Minutos a fijos'),
('MM', 'CALLERID', 'Minutos a móviles', NULL, NULL, 'Minutos a móviles'),
('STATIC_IP', 'IP estatica', NULL, NULL, NULL, 'IP estática'),
('T_PLANA', 'Mins a Fijos', 'Mins a Móviles', '€/min Fijos', '€/min Móviles', 'Tarifa plana para internet pro y aire');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'ID de la categoría',
  `description` varchar(80) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion de la categoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `description`) VALUES
(1, 'Líneas de voz'),
(2, 'Centralitas virtuales'),
(3, 'Internet AIRE'),
(4, 'Internet Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `user_name` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `user_pass` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `user_mail` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `user_nif` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `user_datereg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_phone` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_fullname` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_birth` date DEFAULT NULL,
  `user_local` varchar(100) COLLATE utf8_spanish_ci DEFAULT 'España',
  `user_logo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass_mod` tinyint(1) NOT NULL DEFAULT '0',
  `mail_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `id_mail` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla de clientes';

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `user_name`, `user_pass`, `user_mail`, `user_nif`, `user_datereg`, `user_phone`, `user_fullname`, `user_birth`, `user_local`, `user_logo`, `pass_mod`, `mail_confirmed`, `id_mail`) VALUES
(00000000001, 'Empresa Prueba', '$2a$07$EpiCTelEcOm52570b6fcfuZWyBcJVu591L/01ZZTXlCH9qMaQG0w6', 'onion_oliva@hotmail.com', '39929519R', '2016-01-13 08:33:54', '977654321', 'Pedro Oliva Gil', '1991-08-20', 'España', NULL, 0, 0, '$2a$07$EpiCTelEcOm52570b6fcfusCqhJi2DKlXJfzF4zJpdtNGuWo1N2ya'),
(00000000006, 'Empresa lujo SL', '$2a$07$EpiCTelEcOm52570b6fcfuZWyBcJVu591L/01ZZTXlCH9qMaQG0w6', 'email@email.es', '48008515V', '2016-01-20 01:46:57', '', 'rtgrbhrtbht', '0000-00-00', 'España', NULL, 0, 0, '$2a$07$EpiCTelEcOm52570b6fcfuPgwcbePbJIICIFfQDXGsShYoO7cysCC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(9) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `service` varchar(30) CHARACTER SET utf8 NOT NULL,
  `coments` text CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contact_form`
--

INSERT INTO `contact_form` (`id`, `fullname`, `email`, `phone`, `address`, `service`, `coments`, `active`, `date`) VALUES
(0000000001, 'Pedro', 'pedroolivagil@gmail.com', '698745231', 'Postal', '3', 'Prueba de mail', 1, '2016-01-11 09:39:48'),
(0000000002, 'Pedro', 'pedroolivagil@gmail.com', '698745231', 'Postal', '3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse aliquam ex quis odio pretium dictum. Mauris quis ante volutpat, luctus mi sit amet, posuere risus. Nulla quis mi dictum, bibendum orci eget, faucibus lectus. Morbi semper, tellus in vestibulum blandit, massa magna fringilla quam, ac maximus sem nulla sed sem. Mauris feugiat, lectus eu convallis tristique, odio enim varius ex, a interdum purus lectus ac magna. Duis a augue a orci tempus aliquam facilisis id tellus. Suspendisse convallis auctor porta. Morbi molestie quam diam, sit amet placerat lacus porttitor at. Duis malesuada nisi mauris, nec maximus massa imperdiet sed. Sed non magna quis tellus cursus accumsan. Cras euismod tellus libero. ', 1, '2016-01-11 09:44:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(10) UNSIGNED NOT NULL,
  `id_client` int(11) UNSIGNED ZEROFILL NOT NULL,
  `id_service` int(11) NOT NULL,
  `status` int(11) UNSIGNED NOT NULL,
  `import` float NOT NULL,
  `date` date NOT NULL,
  `emission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_url` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `id_client`, `id_service`, `status`, `import`, `date`, `emission_date`, `invoice_url`) VALUES
(1, 00000000001, 2, 1, 200, '2015-10-01', '2016-01-20 00:23:11', 'pdf10.pdf'),
(2, 00000000001, 2, 1, 200, '2015-11-01', '2016-01-20 00:23:11', 'pdf11.pdf'),
(3, 00000000001, 2, 1, 200, '2015-12-01', '2016-01-20 00:23:11', 'pdf12.pdf'),
(4, 00000000001, 2, 2, 200, '2016-01-01', '2016-01-20 00:23:11', 'pdf01.pdf'),
(5, 00000000001, 2, 3, 200, '2016-02-01', '2016-01-20 00:46:21', 'pdf02.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_status`
--

CREATE TABLE `invoice_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `invoice_status`
--

INSERT INTO `invoice_status` (`id`, `description`) VALUES
(1, 'Pagado'),
(2, 'Pendiente'),
(3, 'No pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_type`
--

CREATE TABLE `log_type` (
  `id` int(11) NOT NULL,
  `description` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `log_type`
--

INSERT INTO `log_type` (`id`, `description`) VALUES
(9, 'Delete User'),
(8, 'Log Out'),
(7, 'Other'),
(3, 'Purchase'),
(1, 'Sign In'),
(2, 'Sign Up'),
(10, 'Update User'),
(6, 'Upload'),
(5, 'User logo'),
(4, 'User Pass');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(22) UNSIGNED ZEROFILL NOT NULL,
  `id_client` int(11) UNSIGNED ZEROFILL NOT NULL,
  `action` int(11) NOT NULL,
  `timedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) CHARACTER SET utf8 NOT NULL,
  `is_good` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `log_user`
--

INSERT INTO `log_user` (`id_log`, `id_client`, `action`, `timedate`, `message`, `is_good`) VALUES
(0000000000000000000001, 00000000001, 2, '2016-01-13 08:33:54', 'Usuario registrado con exito', 1),
(0000000000000000000002, 00000000001, 1, '2016-01-13 09:43:52', 'Usuario identificado con exito', 1),
(0000000000000000000003, 00000000001, 1, '2016-01-13 09:43:57', 'Usuario identificado con exito', 1),
(0000000000000000000004, 00000000001, 1, '2016-01-13 09:43:57', 'Usuario identificado con exito', 1),
(0000000000000000000005, 00000000001, 1, '2016-01-13 09:44:06', 'Usuario identificado con exito', 1),
(0000000000000000000006, 00000000001, 1, '2016-01-13 09:44:06', 'Usuario identificado con exito', 1),
(0000000000000000000007, 00000000001, 1, '2016-01-13 09:44:07', 'Usuario identificado con exito', 1),
(0000000000000000000008, 00000000001, 1, '2016-01-13 09:44:20', 'Usuario identificado con exito', 1),
(0000000000000000000009, 00000000001, 1, '2016-01-13 09:44:23', 'Usuario identificado con exito', 1),
(0000000000000000000010, 00000000001, 8, '2016-01-13 09:45:01', 'Usuario identificado con exito', 1),
(0000000000000000000011, 00000000001, 8, '2016-01-13 09:45:01', 'Usuario identificado con exito', 1),
(0000000000000000000012, 00000000001, 8, '2016-01-13 09:45:02', 'Usuario identificado con exito', 1),
(0000000000000000000013, 00000000001, 8, '2016-01-13 09:45:04', 'Usuario identificado con exito', 1),
(0000000000000000000014, 00000000001, 1, '2016-01-13 09:45:16', 'Usuario identificado con exito', 1),
(0000000000000000000015, 00000000001, 8, '2016-01-13 09:45:16', 'Usuario identificado con exito', 1),
(0000000000000000000016, 00000000001, 1, '2016-01-13 09:45:16', 'Usuario identificado con exito', 1),
(0000000000000000000017, 00000000001, 8, '2016-01-13 09:45:16', 'Usuario identificado con exito', 1),
(0000000000000000000018, 00000000001, 1, '2016-01-13 09:45:18', 'Usuario identificado con exito', 1),
(0000000000000000000019, 00000000001, 8, '2016-01-13 09:45:18', 'Usuario identificado con exito', 1),
(0000000000000000000020, 00000000001, 1, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000021, 00000000001, 8, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000022, 00000000001, 1, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000023, 00000000001, 8, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000024, 00000000001, 1, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000025, 00000000001, 8, '2016-01-13 09:45:21', 'Usuario identificado con exito', 1),
(0000000000000000000026, 00000000001, 1, '2016-01-13 09:50:02', 'Usuario identificado con exito', 1),
(0000000000000000000027, 00000000001, 8, '2016-01-13 09:50:02', 'Usuario identificado con exito', 1),
(0000000000000000000028, 00000000001, 1, '2016-01-13 09:50:13', 'Usuario identificado con exito', 1),
(0000000000000000000029, 00000000001, 8, '2016-01-13 09:50:14', 'Usuario identificado con exito', 1),
(0000000000000000000030, 00000000001, 1, '2016-01-13 09:50:21', 'Usuario identificado con exito', 1),
(0000000000000000000031, 00000000001, 8, '2016-01-13 09:50:21', 'Usuario identificado con exito', 1),
(0000000000000000000032, 00000000001, 1, '2016-01-13 09:50:28', 'Usuario identificado con exito', 1),
(0000000000000000000033, 00000000001, 8, '2016-01-13 09:50:28', 'Usuario identificado con exito', 1),
(0000000000000000000034, 00000000001, 1, '2016-01-13 09:50:29', 'Usuario identificado con exito', 1),
(0000000000000000000035, 00000000001, 8, '2016-01-13 09:50:29', 'Usuario identificado con exito', 1),
(0000000000000000000036, 00000000001, 1, '2016-01-13 09:52:39', 'Usuario identificado con exito', 1),
(0000000000000000000037, 00000000001, 8, '2016-01-13 09:52:39', 'Usuario identificado con exito', 1),
(0000000000000000000042, 00000000001, 1, '2016-01-19 19:30:47', 'Usuario identificado con exito', 1),
(0000000000000000000043, 00000000001, 1, '2016-01-19 19:43:30', 'Usuario identificado con exito', 1),
(0000000000000000000044, 00000000001, 1, '2016-01-19 20:14:05', 'Usuario identificado con exito', 1),
(0000000000000000000045, 00000000001, 8, '2016-01-19 20:14:08', 'Usuario identificado con exito', 1),
(0000000000000000000046, 00000000001, 1, '2016-01-19 20:15:10', 'Usuario identificado con exito', 1),
(0000000000000000000047, 00000000001, 8, '2016-01-19 20:15:48', 'Usuario identificado con exito', 1),
(0000000000000000000048, 00000000001, 1, '2016-01-19 20:26:47', 'Usuario identificado con exito', 1),
(0000000000000000000049, 00000000001, 8, '2016-01-19 21:16:09', 'Usuario identificado con exito', 1),
(0000000000000000000050, 00000000001, 1, '2016-01-19 21:17:19', 'Usuario identificado con exito', 1),
(0000000000000000000051, 00000000001, 8, '2016-01-19 21:19:01', 'Usuario identificado con exito', 1),
(0000000000000000000052, 00000000001, 1, '2016-01-19 21:19:09', 'Usuario identificado con exito', 1),
(0000000000000000000053, 00000000001, 8, '2016-01-19 22:45:10', 'Usuario identificado con exito', 1),
(0000000000000000000054, 00000000001, 1, '2016-01-19 22:47:41', 'Usuario identificado con exito', 1),
(0000000000000000000055, 00000000001, 8, '2016-01-19 23:16:54', 'Usuario identificado con exito', 1),
(0000000000000000000056, 00000000001, 1, '2016-01-19 23:20:45', 'Usuario identificado con exito', 1),
(0000000000000000000057, 00000000001, 8, '2016-01-20 01:46:09', 'Usuario identificado con exito', 1),
(0000000000000000000058, 00000000006, 2, '2016-01-20 01:46:57', 'Usuario registrado con exito', 1),
(0000000000000000000059, 00000000006, 1, '2016-01-20 01:47:55', 'Usuario identificado con exito', 1),
(0000000000000000000060, 00000000006, 8, '2016-01-20 01:51:47', 'Usuario identificado con exito', 1),
(0000000000000000000061, 00000000001, 1, '2016-01-20 01:51:52', 'Usuario identificado con exito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_client_service`
--

CREATE TABLE `rel_client_service` (
  `id_contratacion` int(11) NOT NULL COMMENT 'id del registro de contratacion',
  `id_client` int(11) UNSIGNED ZEROFILL NOT NULL,
  `id_serv` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `mensual_fee` float NOT NULL,
  `entry_fee` float NOT NULL,
  `install_fee` float NOT NULL,
  `date_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_activate` date DEFAULT NULL,
  `date_end_service` date DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_client_service`
--

INSERT INTO `rel_client_service` (`id_contratacion`, `id_client`, `id_serv`, `id_cat`, `mensual_fee`, `entry_fee`, `install_fee`, `date_request`, `date_activate`, `date_end_service`, `visible`, `active`) VALUES
(2, 00000000001, 2, 1, 200, 0, 0, '2016-01-20 00:55:52', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_client_subservice`
--

CREATE TABLE `rel_client_subservice` (
  `id_contratacion` int(11) NOT NULL,
  `id_extraserv` int(11) NOT NULL,
  `value_extraserv` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date_request` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_activate` date DEFAULT NULL,
  `date_end_service` date DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_service_category`
--

CREATE TABLE `rel_service_category` (
  `id_cat` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_service_category`
--

INSERT INTO `rel_service_category` (`id_cat`, `id_service`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(3, 8),
(3, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(2, 14),
(4, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_service_subservice`
--

CREATE TABLE `rel_service_subservice` (
  `id_service` int(11) NOT NULL,
  `id_subservice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_service_subservice`
--

INSERT INTO `rel_service_subservice` (`id_service`, `id_subservice`) VALUES
(1, 4),
(1, 10),
(1, 17),
(2, 4),
(2, 11),
(2, 18),
(3, 5),
(3, 12),
(3, 19),
(4, 6),
(4, 13),
(4, 20),
(5, 7),
(5, 14),
(5, 21),
(6, 8),
(6, 15),
(6, 22),
(7, 9),
(7, 16),
(7, 23),
(8, 43),
(9, 44),
(10, 38),
(11, 39),
(12, 40),
(13, 41),
(15, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL COMMENT 'ID del servicio',
  `description` varchar(125) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion',
  `service_fee` float NOT NULL COMMENT 'Cuota a pagar en euros',
  `period` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'mensual' COMMENT 'Periodo de pago, mensual, trimestral o anual',
  `permanecy` int(11) NOT NULL DEFAULT '0' COMMENT 'Meses de permanencia, 0 si no tiene',
  `entry_fee` float NOT NULL DEFAULT '0' COMMENT 'Cuota de alta',
  `penalty` float NOT NULL DEFAULT '0' COMMENT 'penalización en euros'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id_service`, `description`, `service_fee`, `period`, `permanecy`, `entry_fee`, `penalty`) VALUES
(1, 'línea digital SIP profesional', 9, 'mensual', 0, 0, 0),
(2, 'línea digital SIP +', 15, 'mensual', 0, 0, 0),
(3, 'línea digital SIP +4', 39, 'mensual', 0, 0, 0),
(4, 'línea digital SIP +8', 79, 'mensual', 0, 0, 0),
(5, 'línea digital SIP +16', 159, 'mensual', 0, 0, 0),
(6, 'línea digital SIP +24', 239, 'mensual', 0, 0, 0),
(7, 'línea digital SIP +32', 319, 'mensual', 0, 0, 0),
(8, 'Velocidad 10Mbps', 145, 'mensual', 0, 150, 0),
(9, 'Velocidad 25Mbps', 195, 'mensual', 0, 150, 0),
(10, 'Velocidad 20Mbps', 29, 'mensual', 12, 60, 0),
(11, 'Velocidad 30Mbps', 39, 'mensual', 12, 60, 0),
(12, 'Velocidad 40Mbps', 49, 'mensual', 12, 60, 0),
(13, 'Velocidad 50Mbps', 69, 'mensual', 12, 60, 0),
(14, 'Centralita', 29, 'mensual', 0, 0, 0),
(15, 'Velocidad 100Mbps', 89, 'mensual', 0, 60, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_address`
--

CREATE TABLE `service_address` (
  `id_address` int(11) NOT NULL COMMENT 'ID de la dirección',
  `id_service` int(11) NOT NULL,
  `billing_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `install_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `town` varchar(50) CHARACTER SET utf8 NOT NULL,
  `province` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'España',
  `cp_address` varchar(5) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_service`
--

CREATE TABLE `sub_service` (
  `id` int(11) NOT NULL COMMENT 'ID propiedad del servicio',
  `code_service` varchar(25) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Codigo de servicio, MF,MM,...',
  `fee` float NOT NULL DEFAULT '0' COMMENT 'Cuota mensual',
  `period` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'mensual' COMMENT 'Periodo de pago, mensual, trimestral o anual',
  `permanency` int(11) NOT NULL DEFAULT '0' COMMENT 'Meses de permanencia, 0 si no tiene',
  `entry_fee` int(11) NOT NULL DEFAULT '0' COMMENT 'Cuota de alta',
  `penalty` int(11) NOT NULL DEFAULT '0' COMMENT 'penalización en euros',
  `attr1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Aributo 1',
  `attr2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Aributo 2',
  `attr3` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Aributo 3',
  `attr4` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Aributo 4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sub_service`
--

INSERT INTO `sub_service` (`id`, `code_service`, `fee`, `period`, `permanency`, `entry_fee`, `penalty`, `attr1`, `attr2`, `attr3`, `attr4`) VALUES
(1, 'BMM', 59, 'mensual', 0, 0, 0, NULL, '1000', NULL, NULL),
(2, 'BMM', 220, 'mensual', 0, 0, 0, NULL, '5000', NULL, NULL),
(3, 'BMM', 15, 'mensual', 0, 0, 0, NULL, '1000', '10', NULL),
(4, 'CENTSOR', 0, 'mensual', 0, 0, 0, '1', '8', NULL, NULL),
(5, 'CENTSOR', 0, 'mensual', 0, 0, 0, '4', '8', NULL, NULL),
(6, 'CENTSOR', 0, 'mensual', 0, 0, 0, '8', '8', NULL, NULL),
(7, 'CENTSOR', 0, 'mensual', 0, 0, 0, '16', '16', NULL, NULL),
(8, 'CENTSOR', 0, 'mensual', 0, 0, 0, '24', '24', NULL, NULL),
(9, 'CENTSOR', 0, 'mensual', 0, 0, 0, '32', '32', NULL, NULL),
(10, 'MF', 0, 'mensual', 0, 0, 0, NULL, '0', NULL, NULL),
(11, 'MF', 0, 'mensual', 0, 0, 0, NULL, '1000', NULL, NULL),
(12, 'MF', 0, 'mensual', 0, 0, 0, NULL, '3000', NULL, NULL),
(13, 'MF', 0, 'mensual', 0, 0, 0, NULL, '7000', NULL, NULL),
(14, 'MF', 0, 'mensual', 0, 0, 0, NULL, '15000', NULL, NULL),
(15, 'MF', 0, 'mensual', 0, 0, 0, NULL, '23000', NULL, NULL),
(16, 'MF', 0, 'mensual', 0, 0, 0, NULL, '31000', NULL, NULL),
(17, 'MM', 0, 'mensual', 0, 0, 0, NULL, '0', NULL, NULL),
(18, 'MM', 0, 'mensual', 0, 0, 0, NULL, '100', NULL, NULL),
(19, 'MM', 0, 'mensual', 0, 0, 0, NULL, '300', NULL, NULL),
(20, 'MM', 0, 'mensual', 0, 0, 0, NULL, '700', NULL, NULL),
(21, 'MM', 0, 'mensual', 0, 0, 0, NULL, '1500', NULL, NULL),
(22, 'MM', 0, 'mensual', 0, 0, 0, NULL, '2300', NULL, NULL),
(23, 'MM', 0, 'mensual', 0, 0, 0, NULL, '3100', NULL, NULL),
(24, 'CHADD', 2, 'mensual', 0, 0, 0, NULL, NULL, NULL, NULL),
(25, 'GNUM', 2, 'mensual', 0, 0, 0, NULL, NULL, NULL, NULL),
(26, 'GNUMPORTAT', 0, 'mensual', 0, 15, 0, NULL, NULL, NULL, NULL),
(28, 'EXTENSION', 2.2, 'mensual', 24, 0, 0, 'GXP1625', NULL, NULL, NULL),
(29, 'EXTENSION', 3.67, 'mensual', 24, 0, 0, 'GXP2130', NULL, NULL, NULL),
(30, 'EXTENSION', 4.45, 'mensual', 24, 0, 0, 'GXP2140', NULL, NULL, NULL),
(31, 'EXTENSION', 5.45, 'mensual', 24, 0, 0, 'GXP2160', NULL, NULL, NULL),
(32, 'EXTENSION', 8.8, 'mensual', 24, 0, 0, 'GXP2140EXT', NULL, NULL, NULL),
(33, 'EXTENSION', 3.91, 'mensual', 24, 0, 0, 'GIGASET C530IP', NULL, NULL, NULL),
(34, 'EXTENSION', 1.9, 'mensual', 24, 0, 0, 'GIGASET C530IH', NULL, NULL, NULL),
(35, 'INST_EXTENSION', 0, 'mensual', 0, 30, 0, '3', NULL, NULL, NULL),
(36, 'T_PLANA', 15, 'mensual', 0, 0, 0, '1000', '100', '0.018', '0.08'),
(37, 'STATIC_IP', 0, 'mensual', 0, 0, 0, NULL, NULL, NULL, NULL),
(38, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '20', '2', NULL, NULL),
(39, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '30', '3', NULL, NULL),
(40, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '40', '4', NULL, NULL),
(41, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '50', '5', NULL, NULL),
(42, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '100', '10', NULL, NULL),
(43, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '10', '2', NULL, NULL),
(44, 'INTERNET_SPEED', 0, 'mensual', 0, 0, 0, '25', '5', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attributes_service`
--
ALTER TABLE `attributes_service`
  ADD PRIMARY KEY (`code_service`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`),
  ADD UNIQUE KEY `user_nif` (`user_nif`);

--
-- Indices de la tabla `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`service`,`date`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `status` (`status`),
  ADD KEY `id_service` (`id_service`);

--
-- Indices de la tabla `invoice_status`
--
ALTER TABLE `invoice_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log_type`
--
ALTER TABLE `log_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indices de la tabla `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `action` (`action`);

--
-- Indices de la tabla `rel_client_service`
--
ALTER TABLE `rel_client_service`
  ADD PRIMARY KEY (`id_contratacion`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_serv` (`id_serv`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `rel_client_subservice`
--
ALTER TABLE `rel_client_subservice`
  ADD KEY `id_contratacion` (`id_contratacion`),
  ADD KEY `id_extraserv` (`id_extraserv`);

--
-- Indices de la tabla `rel_service_category`
--
ALTER TABLE `rel_service_category`
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_service` (`id_service`);

--
-- Indices de la tabla `rel_service_subservice`
--
ALTER TABLE `rel_service_subservice`
  ADD KEY `id_serivce` (`id_service`),
  ADD KEY `id_extraserv` (`id_subservice`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indices de la tabla `service_address`
--
ALTER TABLE `service_address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `id_service` (`id_service`);

--
-- Indices de la tabla `sub_service`
--
ALTER TABLE `sub_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_service` (`code_service`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la categoría', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `invoice_status`
--
ALTER TABLE `invoice_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `log_type`
--
ALTER TABLE `log_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(22) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `rel_client_service`
--
ALTER TABLE `rel_client_service`
  MODIFY `id_contratacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del registro de contratacion', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del servicio', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `service_address`
--
ALTER TABLE `service_address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la dirección';
--
-- AUTO_INCREMENT de la tabla `sub_service`
--
ALTER TABLE `sub_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID propiedad del servicio', AUTO_INCREMENT=45;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`status`) REFERENCES `invoice_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`id_service`) REFERENCES `rel_client_service` (`id_serv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_user_ibfk_2` FOREIGN KEY (`action`) REFERENCES `log_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_client_service`
--
ALTER TABLE `rel_client_service`
  ADD CONSTRAINT `rel_client_service_ibfk_1` FOREIGN KEY (`id_serv`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_client_service_ibfk_3` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_client_service_ibfk_4` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_client_subservice`
--
ALTER TABLE `rel_client_subservice`
  ADD CONSTRAINT `rel_client_subservice_ibfk_1` FOREIGN KEY (`id_contratacion`) REFERENCES `rel_client_service` (`id_contratacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_client_subservice_ibfk_2` FOREIGN KEY (`id_extraserv`) REFERENCES `sub_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_service_category`
--
ALTER TABLE `rel_service_category`
  ADD CONSTRAINT `rel_service_category_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_service_category_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_service_subservice`
--
ALTER TABLE `rel_service_subservice`
  ADD CONSTRAINT `rel_service_subservice_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_service_subservice_ibfk_2` FOREIGN KEY (`id_subservice`) REFERENCES `sub_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `service_address`
--
ALTER TABLE `service_address`
  ADD CONSTRAINT `service_address_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `rel_client_service` (`id_contratacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sub_service`
--
ALTER TABLE `sub_service`
  ADD CONSTRAINT `sub_service_ibfk_1` FOREIGN KEY (`code_service`) REFERENCES `attributes_service` (`code_service`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
