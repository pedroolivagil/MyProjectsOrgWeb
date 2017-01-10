INSERT INTO parametros (id, etiqueta, texto, id_idioma) 
VALUES 
(NULL, 'USER_DROPDOWN_HEADER_PROFILE', 'Perfil', '73'),
(NULL, 'USER_DROPDOWN_HEADER_PROJECTS', 'Proyectos', '73'),
(NULL, 'USER_DROPDOWN_VIEW_PROJECTS', 'Tus proyectos', '73'),
(NULL, 'USER_DROPDOWN_NEW_PROJECT', 'Crear nuevo', '73'),
(NULL, 'USER_DROPDOWN_CONTROL_PANEL', 'Panel de usuario', '73'),
(NULL, 'USER_DROPDOWN_NEW_PASS', 'Cambiar contraseña', '73'),
(NULL, 'USER_DROPDOWN_LOGOUT', 'Cerrar sesión', '73'),
(NULL, 'PANEL_USER_HEADER_CONTROL_PANEL', 'Panel de usuario', '73'),
(NULL, 'PANEL_USER_HEADER_PROJECTS', 'Todos los proyectos', '73'),
(NULL, 'PANEL_USER_LABEL_PROYECTOS', 'Proyectos', '73'),
(NULL, 'PANEL_USER_LABEL_NEW_PROJECT', 'Crear nuevo', '73'),
(NULL, 'PANEL_USER_LABEL_FIND_PROJECT', 'Buscar proyecto', '73'),
(NULL, 'PANEL_USER_LABEL_EDIT_PROFILE', 'Editar perfil', '73')
-- ^^^ añadidos ^^^ -----------
INSERT INTO parametros (id, etiqueta, texto, id_idioma) 
VALUES
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73'),
(NULL, '', '', '73')

-- ALTER TABLES ---
ALTER TABLE `usuario` CHANGE `birth_date` `birth_date` DATE NULL DEFAULT NULL;
ALTER TABLE `usuario` ADD `fullname` VARCHAR(150) NOT NULL AFTER `birth_date`;