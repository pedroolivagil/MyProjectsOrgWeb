-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2017 a las 00:56:13
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
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `accion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(350) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `error_log`
--

INSERT INTO `error_log` (`id_error_log`, `fecha_hora`, `id_usuario`, `accion`, `comentario`) VALUES
(50, '2016-12-28 03:38:46', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Se ha iniciado la creación del proyecto.'),
(52, '2016-12-28 03:38:46', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto; p_p: 0; p_p_r: 0; p_t: 6; p_t_r: 0; p_i: 3; p_i_r: 0', 'Se ha deshecho los cambios.'),
(53, '2016-12-28 03:41:31', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Se ha iniciado la creación del proyecto.'),
(55, '2016-12-28 03:41:31', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto; p_p: 0; p_p_r: 0; p_t: 6; p_t_r: 0; p_i: 3; p_i_r: 0', 'Se ha deshecho los cambios.'),
(56, '2016-12-28 03:44:02', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Se ha iniciado la creación del proyecto.'),
(58, '2016-12-28 03:44:02', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto; p_p: 0; p_p_r: 0; p_t: 6; p_t_r: 0; p_i: 3; p_i_r: 0', 'Se ha deshecho los cambios.'),
(59, '2016-12-28 03:53:58', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Se ha iniciado la creación del proyecto.'),
(60, '2016-12-28 03:53:58', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Proyecto creado con identificador: 474d779e666241218e40'),
(61, '2016-12-28 03:53:58', 'd6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'Crear Proyecto', 'Proyecto creado y asignado correctamente: 474d779e666241218e40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `url`, `descripcion`, `width`, `height`, `fecha_subida`, `flag_activo`) VALUES
('13a4c8d5267b419c84fb', 'home3ec4d730-fee5-4a89-b08b-1f55199eb26b.jpg', '', 640, 480, '2016-12-28 03:53:58', 1),
('837d408036a645ee81a6', 'home02ed3305-f048-4dff-822a-6fb8aff05780.jpg', '', 640, 480, '2016-12-28 03:53:58', 1),
('bd5b0558aae0449ba1cc', 'home5d23fbb2-4eb4-4650-8751-3c0c6a2b7d83.jpg', 'aedfrbsdfbdfbdfbdfbdfb', 640, 480, '2016-12-28 03:53:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `iso` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `nombre` varchar(80) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES
(1, 'AF', 'Afganistán'),
(2, 'AX', 'Islas Gland'),
(3, 'AL', 'Albania'),
(4, 'DE', 'Alemania'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antártida'),
(9, 'AG', 'Antigua y Barbuda'),
(10, 'AN', 'Antillas Holandesas'),
(11, 'SA', 'Arabia Saudí'),
(12, 'DZ', 'Argelia'),
(13, 'AR', 'Argentina'),
(14, 'AM', 'Armenia'),
(15, 'AW', 'Aruba'),
(16, 'AU', 'Australia'),
(17, 'AT', 'Austria'),
(18, 'AZ', 'Azerbaiyán'),
(19, 'BS', 'Bahamas'),
(20, 'BH', 'Bahréin'),
(21, 'BD', 'Bangladesh'),
(22, 'BB', 'Barbados'),
(23, 'BY', 'Bielorrusia'),
(24, 'BE', 'Bélgica'),
(25, 'BZ', 'Belice'),
(26, 'BJ', 'Benin'),
(27, 'BM', 'Bermudas'),
(28, 'BT', 'Bhután'),
(29, 'BO', 'Bolivia'),
(30, 'BA', 'Bosnia y Herzegovina'),
(31, 'BW', 'Botsuana'),
(32, 'BV', 'Isla Bouvet'),
(33, 'BR', 'Brasil'),
(34, 'BN', 'Brunéi'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'CV', 'Cabo Verde'),
(39, 'KY', 'Islas Caimán'),
(40, 'KH', 'Camboya'),
(41, 'CM', 'Camerún'),
(42, 'CA', 'Canadá'),
(43, 'CF', 'República Centroafricana'),
(44, 'TD', 'Chad'),
(45, 'CZ', 'República Checa'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CY', 'Chipre'),
(49, 'CX', 'Isla de Navidad'),
(50, 'VA', 'Ciudad del Vaticano'),
(51, 'CC', 'Islas Cocos'),
(52, 'CO', 'Colombia'),
(53, 'KM', 'Comoras'),
(54, 'CD', 'República Democrática del Congo'),
(55, 'CG', 'Congo'),
(56, 'CK', 'Islas Cook'),
(57, 'KP', 'Corea del Norte'),
(58, 'KR', 'Corea del Sur'),
(59, 'CI', 'Costa de Marfil'),
(60, 'CR', 'Costa Rica'),
(61, 'HR', 'Croacia'),
(62, 'CU', 'Cuba'),
(63, 'DK', 'Dinamarca'),
(64, 'DM', 'Dominica'),
(65, 'DO', 'República Dominicana'),
(66, 'EC', 'Ecuador'),
(67, 'EG', 'Egipto'),
(68, 'SV', 'El Salvador'),
(69, 'AE', 'Emiratos Árabes Unidos'),
(70, 'ER', 'Eritrea'),
(71, 'SK', 'Eslovaquia'),
(72, 'SI', 'Eslovenia'),
(73, 'ES', 'España'),
(74, 'UM', 'Islas ultramarinas de Estados Unidos'),
(75, 'US', 'Estados Unidos'),
(76, 'EE', 'Estonia'),
(77, 'ET', 'Etiopía'),
(78, 'FO', 'Islas Feroe'),
(79, 'PH', 'Filipinas'),
(80, 'FI', 'Finlandia'),
(81, 'FJ', 'Fiyi'),
(82, 'FR', 'Francia'),
(83, 'GA', 'Gabón'),
(84, 'GM', 'Gambia'),
(85, 'GE', 'Georgia'),
(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 'GH', 'Ghana'),
(88, 'GI', 'Gibraltar'),
(89, 'GD', 'Granada'),
(90, 'GR', 'Grecia'),
(91, 'GL', 'Groenlandia'),
(92, 'GP', 'Guadalupe'),
(93, 'GU', 'Guam'),
(94, 'GT', 'Guatemala'),
(95, 'GF', 'Guayana Francesa'),
(96, 'GN', 'Guinea'),
(97, 'GQ', 'Guinea Ecuatorial'),
(98, 'GW', 'Guinea-Bissau'),
(99, 'GY', 'Guyana'),
(100, 'HT', 'Haití'),
(101, 'HM', 'Islas Heard y McDonald'),
(102, 'HN', 'Honduras'),
(103, 'HK', 'Hong Kong'),
(104, 'HU', 'Hungría'),
(105, 'IN', 'India'),
(106, 'ID', 'Indonesia'),
(107, 'IR', 'Irán'),
(108, 'IQ', 'Iraq'),
(109, 'IE', 'Irlanda'),
(110, 'IS', 'Islandia'),
(111, 'IL', 'Israel'),
(112, 'IT', 'Italia'),
(113, 'JM', 'Jamaica'),
(114, 'JP', 'Japón'),
(115, 'JO', 'Jordania'),
(116, 'KZ', 'Kazajstán'),
(117, 'KE', 'Kenia'),
(118, 'KG', 'Kirguistán'),
(119, 'KI', 'Kiribati'),
(120, 'KW', 'Kuwait'),
(121, 'LA', 'Laos'),
(122, 'LS', 'Lesotho'),
(123, 'LV', 'Letonia'),
(124, 'LB', 'Líbano'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libia'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lituania'),
(129, 'LU', 'Luxemburgo'),
(130, 'MO', 'Macao'),
(131, 'MK', 'ARY Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MY', 'Malasia'),
(134, 'MW', 'Malawi'),
(135, 'MV', 'Maldivas'),
(136, 'ML', 'Malí'),
(137, 'MT', 'Malta'),
(138, 'FK', 'Islas Malvinas'),
(139, 'MP', 'Islas Marianas del Norte'),
(140, 'MA', 'Marruecos'),
(141, 'MH', 'Islas Marshall'),
(142, 'MQ', 'Martinica'),
(143, 'MU', 'Mauricio'),
(144, 'MR', 'Mauritania'),
(145, 'YT', 'Mayotte'),
(146, 'MX', 'México'),
(147, 'FM', 'Micronesia'),
(148, 'MD', 'Moldavia'),
(149, 'MC', 'Mónaco'),
(150, 'MN', 'Mongolia'),
(151, 'MS', 'Montserrat'),
(152, 'MZ', 'Mozambique'),
(153, 'MM', 'Myanmar'),
(154, 'NA', 'Namibia'),
(155, 'NR', 'Nauru'),
(156, 'NP', 'Nepal'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Níger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Isla Norfolk'),
(162, 'NO', 'Noruega'),
(163, 'NC', 'Nueva Caledonia'),
(164, 'NZ', 'Nueva Zelanda'),
(165, 'OM', 'Omán'),
(166, 'NL', 'Países Bajos'),
(167, 'PK', 'Pakistán'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestina'),
(170, 'PA', 'Panamá'),
(171, 'PG', 'Papúa Nueva Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Perú'),
(174, 'PN', 'Islas Pitcairn'),
(175, 'PF', 'Polinesia Francesa'),
(176, 'PL', 'Polonia'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'GB', 'Reino Unido'),
(181, 'RE', 'Reunión'),
(182, 'RW', 'Ruanda'),
(183, 'RO', 'Rumania'),
(184, 'RU', 'Rusia'),
(185, 'EH', 'Sahara Occidental'),
(186, 'SB', 'Islas Salomón'),
(187, 'WS', 'Samoa'),
(188, 'AS', 'Samoa Americana'),
(189, 'KN', 'San Cristóbal y Nevis'),
(190, 'SM', 'San Marino'),
(191, 'PM', 'San Pedro y Miquelón'),
(192, 'VC', 'San Vicente y las Granadinas'),
(193, 'SH', 'Santa Helena'),
(194, 'LC', 'Santa Lucía'),
(195, 'ST', 'Santo Tomé y Príncipe'),
(196, 'SN', 'Senegal'),
(197, 'CS', 'Serbia y Montenegro'),
(198, 'SC', 'Seychelles'),
(199, 'SL', 'Sierra Leona'),
(200, 'SG', 'Singapur'),
(201, 'SY', 'Siria'),
(202, 'SO', 'Somalia'),
(203, 'LK', 'Sri Lanka'),
(204, 'SZ', 'Suazilandia'),
(205, 'ZA', 'Sudáfrica'),
(206, 'SD', 'Sudán'),
(207, 'SE', 'Suecia'),
(208, 'CH', 'Suiza'),
(209, 'SR', 'Surinam'),
(210, 'SJ', 'Svalbard y Jan Mayen'),
(211, 'TH', 'Tailandia'),
(212, 'TW', 'Taiwán'),
(213, 'TZ', 'Tanzania'),
(214, 'TJ', 'Tayikistán'),
(215, 'IO', 'Territorio Británico del Océano Índico'),
(216, 'TF', 'Territorios Australes Franceses'),
(217, 'TL', 'Timor Oriental'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad y Tobago'),
(222, 'TN', 'Túnez'),
(223, 'TC', 'Islas Turcas y Caicos'),
(224, 'TM', 'Turkmenistán'),
(225, 'TR', 'Turquía'),
(226, 'TV', 'Tuvalu'),
(227, 'UA', 'Ucrania'),
(228, 'UG', 'Uganda'),
(229, 'UY', 'Uruguay'),
(230, 'UZ', 'Uzbekistán'),
(231, 'VU', 'Vanuatu'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Islas Vírgenes Británicas'),
(235, 'VI', 'Islas Vírgenes de los Estados Unidos'),
(236, 'WF', 'Wallis y Futuna'),
(237, 'YE', 'Yemen'),
(238, 'DJ', 'Yibuti'),
(239, 'ZM', 'Zambia'),
(240, 'ZW', 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(10) UNSIGNED NOT NULL,
  `etiqueta` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `id_idioma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `etiqueta`, `texto`, `id_idioma`) VALUES
(3, 'GENERIC_TITLE', 'Organizador de proyectos', 73),
(40, 'GENERIC_CANCEL', 'Cancelar', 73),
(41, 'HOME_PAGE', 'Inicio', 73),
(42, 'ABOUT_PAGE', 'Nosotros', 73),
(43, 'CONTACT_PAGE', 'Contacto', 73),
(44, 'LOGIN_PAGE', 'Inicia sesión', 73),
(45, 'LOGIN_PAGE_TITLE', 'Inicia sesión', 73),
(46, 'LOGIN_PAGE_EMAIL', 'Email', 73),
(47, 'LOGIN_PAGE_PASSWORD', 'Contraseña', 73),
(48, 'LOGIN_PAGE_PLACEHOLDER_EMAIL', 'Introduce tu email', 73),
(49, 'LOGIN_PAGE_PLACEHOLDER_PASS', 'Introduce tu contraseña', 73),
(50, 'LOGIN_PAGE_AUTOLOGIN_TEXT', 'Mantén la sesión', 73),
(51, 'LOGIN_PAGE_SIGN_IN', 'Entrar', 73),
(52, 'LOGIN_PAGE_SIGN_UP', 'Registrar', 73),
(53, 'SIGN_UP_PAGE', 'Registro', 73),
(54, 'SIGN_UP_PAGE_TITLE', 'Registro de usuario', 73),
(55, 'SIGN_UP_PAGE_EMAIL', 'Email', 73),
(56, 'SIGN_UP_PAGE_PASSWORD', 'Contraseña', 73),
(57, 'SIGN_UP_PAGE_PASSWORD2', 'R.Contraseña', 73),
(58, 'SIGN_UP_PAGE_FULLNAME', 'Nombre', 73),
(59, 'SIGN_UP_PAGE_BIRTHDATE', 'F. Nacimiento', 73),
(60, 'SIGN_UP_PAGE_NIF', 'NIF', 73),
(61, 'SIGN_UP_PAGE_PHONE', 'Teléfono', 73),
(62, 'SIGN_UP_PAGE_COUNTRY', 'País', 73),
(63, 'SIGN_UP_PAGE_STATE', 'Provincia', 73),
(64, 'SIGN_UP_PAGE_PLACEHOLDER_EMAIL', 'Introduce tu email', 73),
(65, 'SIGN_UP_PAGE_PLACEHOLDER_PASSWORD', 'Introduce tu contraseña', 73),
(66, 'SIGN_UP_PAGE_PLACEHOLDER_PASSWORD2', 'Repite la contraseña', 73),
(67, 'SIGN_UP_PAGE_PLACEHOLDER_FULLNAME', 'Nombre y apellidos', 73),
(68, 'SIGN_UP_PAGE_PLACEHOLDER_BIRTHDATE', 'Fecha de nacimiento', 73),
(69, 'SIGN_UP_PAGE_PLACEHOLDER_NIF', 'NIF', 73),
(70, 'SIGN_UP_PAGE_PLACEHOLDER_PHONE', 'Teléfono', 73),
(71, 'SIGN_UP_PAGE_PLACEHOLDER_COUNTRY', 'País', 73),
(72, 'SIGN_UP_PAGE_PLACEHOLDER_STATE', 'Provincia', 73),
(73, 'SIGN_UP_PAGE_TERMS', 'Términos y condiciones', 73),
(74, 'SIGN_UP_PAGE_SIGNUP', 'Registrarse', 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(350) COLLATE utf8_spanish_ci NOT NULL,
  `flag_finish` tinyint(1) NOT NULL DEFAULT '0',
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `directorio_root` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `home_image` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `description`, `flag_finish`, `flag_activo`, `fecha_creacion`, `fecha_actualizacion`, `directorio_root`, `home_image`) VALUES
('474d779e666241218e40', 'Proyecto de prueba', 'adfbnszx fgdrdrnsgnsrtns zrtgmdrst ymtrymd rtymdtry mdtrym drtymdrtymrtdymtymytr mtrymdrty mtdrymrt ymtr ym trymtymdrt ymdtymdrty mdrtymdtry mdrt ym dtrym drt mr', 0, 1, '2016-12-28 03:53:58', '2016-12-28 03:53:58', 'a099ea0b6cf34ace995ea8e0dfa4ab68', 'home.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_imagen`
--

CREATE TABLE `rel_proyecto_imagen` (
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_imagen` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_proyecto_imagen`
--

INSERT INTO `rel_proyecto_imagen` (`id_proyecto`, `id_imagen`) VALUES
('474d779e666241218e40', '13a4c8d5267b419c84fb'),
('474d779e666241218e40', '837d408036a645ee81a6'),
('474d779e666241218e40', 'bd5b0558aae0449ba1cc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_tarjeta`
--

CREATE TABLE `rel_proyecto_tarjeta` (
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_tarjeta` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_proyecto_tarjeta`
--

INSERT INTO `rel_proyecto_tarjeta` (`id_proyecto`, `id_tarjeta`) VALUES
('474d779e666241218e40', '286f343313684107b7c2'),
('474d779e666241218e40', '6a7607bbd10940578bd7'),
('474d779e666241218e40', '70e61e6ec6a04bbdbe95'),
('474d779e666241218e40', '910f3494155d4085aa69'),
('474d779e666241218e40', 'af2a7e8981db4eeb8127'),
('474d779e666241218e40', 'd50f9c11612e45bf80c1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_usuario`
--

CREATE TABLE `rel_proyecto_usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rel_proyecto_usuario`
--

INSERT INTO `rel_proyecto_usuario` (`id_usuario`, `id_proyecto`) VALUES
('d6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', '474d779e666241218e40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id_tarjeta` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tarjeta`
--

INSERT INTO `tarjeta` (`id_tarjeta`, `label`, `valor`) VALUES
('286f343313684107b7c2', 'dfgnmxfghmxdfgm', 'xdfgmxfgmfxgmhjk,li.-ytrdtsxredytgkkmz<eat'),
('6a7607bbd10940578bd7', 'tdkmdt5rykjmdtfchhmkmktuk,', 'dftu,klrtctcykmmtydfhccmk,krtykmtydkmtdfkmtcdfy'),
('70e61e6ec6a04bbdbe95', 'sretjhrt6j5e6', 'e5tyjtyfkmuhy.guilyfrr'),
('910f3494155d4085aa69', 'dtyhmkdtykmdstrey6jk5', 'kdtykftyulk,ftyycuhh,.lfyu'),
('af2a7e8981db4eeb8127', 'detr5yykjseztkmh hgc', 'rzsxjmmngtfdrmmtyhk'),
('d50f9c11612e45bf80c1', 'xfmnxdfgmjhgykfyuks', 'ryzedtjmntfhgykj765i');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1',
  `nif` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `poblacion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `user_pass`, `fecha_alta`, `flag_activo`, `nif`, `telefono`, `id_pais`, `poblacion`) VALUES
('d6edfbf0a46a571cf0562daf23d90e81\nd6edfbf0a46a571cf', 'pedroolivagil@gmail.com', '1234', '2016-12-26 23:31:49', 1, '39929519R', '987654321', 73, 'Tarragona');

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
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso` (`iso`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etiqueta` (`etiqueta`),
  ADD KEY `id_idioma` (`id_idioma`);

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
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `dni` (`nif`),
  ADD KEY `id_pais` (`id_pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `error_log`
--
ALTER TABLE `error_log`
  MODIFY `id_error_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `error_log`
--
ALTER TABLE `error_log`
  ADD CONSTRAINT `error_log_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD CONSTRAINT `parametros_ibfk_1` FOREIGN KEY (`id_idioma`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_imagen`
--
ALTER TABLE `rel_proyecto_imagen`
  ADD CONSTRAINT `rel_proyecto_imagen_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_imagen_ibfk_2` FOREIGN KEY (`id_imagen`) REFERENCES `imagen` (`id_imagen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_tarjeta`
--
ALTER TABLE `rel_proyecto_tarjeta`
  ADD CONSTRAINT `rel_proyecto_tarjeta_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_tarjeta_ibfk_2` FOREIGN KEY (`id_tarjeta`) REFERENCES `tarjeta` (`id_tarjeta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rel_proyecto_usuario`
--
ALTER TABLE `rel_proyecto_usuario`
  ADD CONSTRAINT `rel_proyecto_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_proyecto_usuario_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
