-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2017 a las 13:39:22
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
(0, NULL, NULL),
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
(1, 'GENERIC_TITLE', 'Organizador de proyectos', 73),
(2, 'GENERIC_CANCEL', 'Cancelar', 73),
(3, 'HOME_PAGE', 'Inicio', 73),
(4, 'ABOUT_PAGE', 'Nosotros', 73),
(5, 'CONTACT_PAGE', 'Contacto', 73),
(6, 'LOGIN_PAGE', 'Inicia sesión', 73),
(7, 'LOGIN_PAGE_TITLE', 'Inicia sesión', 73),
(8, 'LOGIN_PAGE_EMAIL', 'Email', 73),
(9, 'LOGIN_PAGE_PASSWORD', 'Contraseña', 73),
(10, 'LOGIN_PAGE_PLACEHOLDER_EMAIL', 'Introduce tu email', 73),
(11, 'LOGIN_PAGE_PLACEHOLDER_PASS', 'Introduce tu contraseña', 73),
(12, 'LOGIN_PAGE_AUTOLOGIN_TEXT', 'Mantén la sesión', 73),
(13, 'LOGIN_PAGE_SIGN_IN', 'Identificarse', 73),
(14, 'LOGIN_PAGE_SIGN_UP', 'Registrarse', 73),
(15, 'SIGN_UP_PAGE', 'Registro', 73),
(16, 'SIGN_UP_PAGE_TITLE', 'Registro de usuario', 73),
(17, 'SIGN_UP_PAGE_EMAIL', 'Email', 73),
(18, 'SIGN_UP_PAGE_PASSWORD', 'Contraseña', 73),
(19, 'SIGN_UP_PAGE_PASSWORD2', 'R.Contraseña', 73),
(20, 'SIGN_UP_PAGE_FULLNAME', 'Nombre', 73),
(21, 'SIGN_UP_PAGE_BIRTHDATE', 'F. Nacimiento', 73),
(22, 'SIGN_UP_PAGE_NIF', 'NIF', 73),
(23, 'SIGN_UP_PAGE_PHONE', 'Teléfono', 73),
(24, 'SIGN_UP_PAGE_COUNTRY', 'País', 73),
(25, 'SIGN_UP_PAGE_STATE', 'Provincia', 73),
(26, 'SIGN_UP_PAGE_PLACEHOLDER_EMAIL', 'Introduce tu email', 73),
(27, 'SIGN_UP_PAGE_PLACEHOLDER_PASSWORD', 'Introduce tu contraseña', 73),
(28, 'SIGN_UP_PAGE_PLACEHOLDER_PASSWORD2', 'Repite la contraseña', 73),
(29, 'SIGN_UP_PAGE_PLACEHOLDER_FULLNAME', 'Nombre y apellidos', 73),
(30, 'SIGN_UP_PAGE_PLACEHOLDER_BIRTHDATE', 'Fecha de nacimiento', 73),
(31, 'SIGN_UP_PAGE_PLACEHOLDER_NIF', 'NIF', 73),
(32, 'SIGN_UP_PAGE_PLACEHOLDER_PHONE', 'Teléfono', 73),
(33, 'SIGN_UP_PAGE_PLACEHOLDER_COUNTRY', 'País', 73),
(34, 'SIGN_UP_PAGE_PLACEHOLDER_STATE', 'Provincia', 73),
(35, 'SIGN_UP_PAGE_TERMS', 'Leer términos y condiciones', 73),
(36, 'SIGN_UP_PAGE_SIGNUP', 'Aceptar términos y registrarse', 73),
(37, 'LOGIN_PAGE_ERROR_LOGIN', 'Error de usuario o contraseña', 73),
(38, 'PANEL_USER', 'Panel de usuario', 73),
(39, 'LEGAL_PAGE', 'Aviso legal', 73),
(40, 'SIGN_UP_PAGE_FATAL_ERROR', 'Error al registrar el nuevo usuario', 73),
(41, 'SIGN_UP_PAGE_WARNING', 'Las contraseñas no coinciden', 73),
(42, 'SIGN_UP_PAGE_SELECT_ONE_MENU', '-- Selecciona un valor --', 73),
(43, 'USER_DROPDOWN_HEADER_PROFILE', 'Perfil', 73),
(44, 'USER_DROPDOWN_HEADER_PROJECTS', 'Proyectos', 73),
(45, 'USER_DROPDOWN_VIEW_PROJECTS', 'Tus proyectos', 73),
(46, 'USER_DROPDOWN_NEW_PROJECT', 'Crear nuevo', 73),
(47, 'USER_DROPDOWN_CONTROL_PANEL', 'Panel de usuario', 73),
(48, 'USER_DROPDOWN_NEW_PASS', 'Cambiar contraseña', 73),
(49, 'USER_DROPDOWN_LOGOUT', 'Cerrar sesión', 73),
(50, 'PANEL_USER_HEADER_CONTROL_PANEL', 'Panel de usuario', 73),
(51, 'PANEL_USER_HEADER_PROJECTS', 'Todos los proyectos', 73),
(52, 'PANEL_USER_LABEL_PROYECTOS', 'Proyectos', 73),
(53, 'PANEL_USER_LABEL_NEW_PROJECT', 'Crear nuevo', 73),
(54, 'PANEL_USER_LABEL_FIND_PROJECT', 'Buscar proyecto', 73),
(55, 'PANEL_USER_LABEL_EDIT_PROFILE', 'Editar perfil', 73),
(56, 'PANEL_USER_LABEL_NO_HAVE_PROJECTS', 'No tienes proyectos creados', 73),
(57, 'PANEL_USER_LABEL_RECOVERY_DELETED', 'Recuperar eliminados', 73),
(58, 'PANEL_USER_LABEL_VIEW_PROFILE', 'Ver perfil', 73),
(59, 'PROFILE_USER', 'Perfil de usuario', 73),
(60, 'PROFILE_USER_TITLE', 'Datos de perfil', 73),
(61, 'GENERIC_ACCEPT', 'Aceptar', 73),
(62, 'GENERIC_EDIT', 'Editar', 73),
(63, 'GENERIC_BACK', 'Volver', 73),
(64, 'GENERIC_SAVE', 'Guardar', 73),
(65, 'PROFILE_PREFERENCES', 'Configuración del perfil', 73),
(66, 'COMING_SOON', 'Próximamente', 73),
(67, 'GENERIC_ERROR_SAVE', 'Error al guardar los cambios', 73),
(68, 'GENERIC_SUCCESS_SAVE', 'Los cambios se han guardado correctamente', 73),
(73, 'GENERIC_ERROR_VALIDATION', 'Error de validación', 73),
(74, 'GENERIC_ERROR_PASSWORD_NO_MATCH', 'Las contraseñas no coinciden.', 73),
(75, 'GENERIC_ERROR_PASSWORD_REQUIRED', 'La contraseña es obligatoria', 73),
(76, 'GENERIC_ERROR_PASSWORD_INVALID', 'La contraseña no es correcta.', 73),
(77, 'PANEL_USER_LABEL_CHANGE_PASSWORD', 'Cambiar contraseña', 73),
(79, 'PANEL_USER_LABEL_DELETE_ACCOUNT', 'Cerrar tu cuenta', 73),
(80, 'PANEL_USER_LABEL_DELETE_PROJECTS', 'Borrar proyectos', 73),
(83, 'GENERIC_VIEW_PROJECT', 'Ver proyecto', 73),
(84, 'GENERIC_DELETE', 'Eliminar', 73),
(85, 'PROJECT_NOT_HAVE_IMAGES', 'No hay imágenes disponibles', 73),
(86, 'GENERIC_DESCRIPTION', 'Descripción del proyecto', 73),
(87, 'PROJECT_NOT_HAVE_TARGETS', 'No hay más información del proyecto', 73),
(88, 'GENERIC_TITLE_DELETE', 'Eliminar', 73),
(89, 'GENERIC_BODY_DELETE', '¿Seguro que desea eliminar el item ', 73),
(90, 'GENERIC_CLOSE', 'Cerrar', 73),
(91, 'GENERIC_NEXT', 'Siguiente', 73),
(92, 'GENERIC_PREV', 'Anterior', 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
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
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_imagen` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_tarjeta`
--

CREATE TABLE `rel_proyecto_tarjeta` (
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_tarjeta` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_proyecto_usuario`
--

CREATE TABLE `rel_proyecto_usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_proyecto` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id_tarjeta` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `valor` text COLLATE utf8_spanish_ci NOT NULL,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `user_pass` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_activo` tinyint(1) NOT NULL DEFAULT '1',
  `birth_date` date DEFAULT NULL,
  `fullname` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nif` varchar(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `poblacion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  MODIFY `id_error_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
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
