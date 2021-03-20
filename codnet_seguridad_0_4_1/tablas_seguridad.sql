-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 04-07-2011 a las 17:08:14
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.2.10-2ubuntu6.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `mvc_filters`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `accionfuncion`
-- 

CREATE TABLE `accionfuncion` (
  `cd_accionfuncion` int(11) NOT NULL AUTO_INCREMENT,
  `cd_funcion` int(11) NOT NULL,
  `ds_accion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cd_accionfuncion`),
  UNIQUE KEY `ds_accion` (`ds_accion`),
  KEY `fk_funcion` (`cd_funcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

-- 
-- Volcar la base de datos para la tabla `accionfuncion`
-- 


INSERT INTO `accionfuncion` VALUES (1, 1, 'alta_usuario');
INSERT INTO `accionfuncion` VALUES (2, 1, 'alta_usuario_init');
INSERT INTO `accionfuncion` VALUES (3, 2, 'modificar_usuario');
INSERT INTO `accionfuncion` VALUES (4, 2, 'modificar_usuario_init');
INSERT INTO `accionfuncion` VALUES (5, 3, 'eliminar_usuario');
INSERT INTO `accionfuncion` VALUES (6, 4, 'ver_usuario');
INSERT INTO `accionfuncion` VALUES (7, 5, 'listar_usuarios');
INSERT INTO `accionfuncion` VALUES (8, 6, 'cambiar_clave_init');
INSERT INTO `accionfuncion` VALUES (9, 6, 'cambiar_clave');
INSERT INTO `accionfuncion` VALUES (10, 7, 'alta_perfil');
INSERT INTO `accionfuncion` VALUES (11, 7, 'alta_perfil_init');
INSERT INTO `accionfuncion` VALUES (12, 8, 'modificar_perfil_init');
INSERT INTO `accionfuncion` VALUES (13, 8, 'modificar_perfil');
INSERT INTO `accionfuncion` VALUES (15, 9, 'eliminar_perfil');
INSERT INTO `accionfuncion` VALUES (16, 10, 'ver_perfil');
INSERT INTO `accionfuncion` VALUES (17, 11, 'listar_perfiles');
INSERT INTO `accionfuncion` VALUES (18, 12, 'ver_panel');
INSERT INTO `accionfuncion` VALUES (19, 12, 'inicio');
INSERT INTO `accionfuncion` VALUES (20, 13, 'alta_accionfuncion');
INSERT INTO `accionfuncion` VALUES (21, 13, 'alta_accionfuncion_init');
INSERT INTO `accionfuncion` VALUES (22, 14, 'eliminar_accionfuncion');
INSERT INTO `accionfuncion` VALUES (23, 15, 'ver_accionfuncion');
INSERT INTO `accionfuncion` VALUES (24, 16, 'modificar_accionfuncion_init');
INSERT INTO `accionfuncion` VALUES (25, 16, 'modificar_accionfuncion');
INSERT INTO `accionfuncion` VALUES (26, 17, 'listar_accionfunciones');
INSERT INTO `accionfuncion` VALUES (27, 18, 'alta_funcion_init');
INSERT INTO `accionfuncion` VALUES (28, 18, 'alta_funcion');
INSERT INTO `accionfuncion` VALUES (29, 19, 'eliminar_funcion');
INSERT INTO `accionfuncion` VALUES (30, 20, 'ver_funcion');
INSERT INTO `accionfuncion` VALUES (31, 21, 'modificar_funcion_init');
INSERT INTO `accionfuncion` VALUES (32, 21, 'modificar_funcion');
INSERT INTO `accionfuncion` VALUES (33, 22, 'listar_funciones');
INSERT INTO `accionfuncion` VALUES (34, 23, 'alta_menugroup_init');
INSERT INTO `accionfuncion` VALUES (35, 23, 'alta_menugroup');
INSERT INTO `accionfuncion` VALUES (36, 24, 'eliminar_menugroup');
INSERT INTO `accionfuncion` VALUES (37, 25, 'ver_menugroup');
INSERT INTO `accionfuncion` VALUES (38, 26, 'modificar_menugroup_init');
INSERT INTO `accionfuncion` VALUES (39, 26, 'modificar_menugroup');
INSERT INTO `accionfuncion` VALUES (40, 27, 'listar_menugroups');
INSERT INTO `accionfuncion` VALUES (41, 28, 'alta_menuoption_init');
INSERT INTO `accionfuncion` VALUES (42, 28, 'alta_menuoption');
INSERT INTO `accionfuncion` VALUES (43, 29, 'eliminar_menuoption');
INSERT INTO `accionfuncion` VALUES (44, 30, 'ver_menuoption');
INSERT INTO `accionfuncion` VALUES (45, 31, 'modificar_menuoption_init');
INSERT INTO `accionfuncion` VALUES (46, 31, 'modificar_menuoption');
INSERT INTO `accionfuncion` VALUES (47, 32, 'listar_menuoptions');
INSERT INTO `accionfuncion` VALUES (49, 34, 'alta_perfilfuncion_init');
INSERT INTO `accionfuncion` VALUES (50, 34, 'alta_perfilfuncion');
INSERT INTO `accionfuncion` VALUES (51, 35, 'eliminar_perfilfuncion');
INSERT INTO `accionfuncion` VALUES (52, 36, 'ver_perfilfuncion');
INSERT INTO `accionfuncion` VALUES (53, 37, 'modificar_perfilfuncion_init');
INSERT INTO `accionfuncion` VALUES (54, 37, 'modificar_perfilfuncion');
INSERT INTO `accionfuncion` VALUES (55, 38, 'listar_perfilfunciones');
INSERT INTO `accionfuncion` VALUES (57, 5, 'pdf_usuarios');
INSERT INTO `accionfuncion` VALUES (58, 5, 'excel_usuarios');
INSERT INTO `accionfuncion` VALUES (59, 11, 'pdf_perfiles');
INSERT INTO `accionfuncion` VALUES (60, 11, 'excel_perfiles');
INSERT INTO `accionfuncion` VALUES (61, 17, 'pdf_accionfunciones');
INSERT INTO `accionfuncion` VALUES (62, 17, 'excel_accionfunciones');
INSERT INTO `accionfuncion` VALUES (63, 22, 'pdf_funciones');
INSERT INTO `accionfuncion` VALUES (64, 22, 'excel_funciones');
INSERT INTO `accionfuncion` VALUES (65, 27, 'pdf_menugroups');
INSERT INTO `accionfuncion` VALUES (66, 27, 'excel_menugroups');
INSERT INTO `accionfuncion` VALUES (67, 32, 'pdf_menuoptions');
INSERT INTO `accionfuncion` VALUES (68, 32, 'excel_menuoptions');
INSERT INTO `accionfuncion` VALUES (69, 38, 'pdf_perfilfunciones');
INSERT INTO `accionfuncion` VALUES (70, 38, 'excel_perfilfunciones');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `funcion`
-- 

CREATE TABLE `funcion` (
  `cd_funcion` int(11) NOT NULL AUTO_INCREMENT,
  `ds_funcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cd_funcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=184 ;

-- 
-- Volcar la base de datos para la tabla `funcion`
-- 

INSERT INTO `funcion` VALUES (1, 'Alta usuario');
INSERT INTO `funcion` VALUES (2, 'Modificar usuario');
INSERT INTO `funcion` VALUES (3, 'Baja usuario');
INSERT INTO `funcion` VALUES (4, 'Ver usuario');
INSERT INTO `funcion` VALUES (5, 'Listar usuario');
INSERT INTO `funcion` VALUES (6, 'Cambiar Clave');
INSERT INTO `funcion` VALUES (7, 'Alta perfil');
INSERT INTO `funcion` VALUES (8, 'Modificar perfil');
INSERT INTO `funcion` VALUES (9, 'Baja perfil');
INSERT INTO `funcion` VALUES (10, 'Ver perfil');
INSERT INTO `funcion` VALUES (11, 'Listar perfil');
INSERT INTO `funcion` VALUES (12, 'Ver Panel');
INSERT INTO `funcion` VALUES (13, 'Alta Accionfuncion');
INSERT INTO `funcion` VALUES (14, 'Eliminar Accionfuncion');
INSERT INTO `funcion` VALUES (15, 'Ver Accionfuncion');
INSERT INTO `funcion` VALUES (16, 'Modificar Accionfuncion');
INSERT INTO `funcion` VALUES (17, 'Listar Accionfuncion');
INSERT INTO `funcion` VALUES (18, 'Alta Funcion');
INSERT INTO `funcion` VALUES (19, 'Eliminar Funcion');
INSERT INTO `funcion` VALUES (20, 'Ver Funcion');
INSERT INTO `funcion` VALUES (21, 'Modificar Funcion');
INSERT INTO `funcion` VALUES (22, 'Listar Funcion');
INSERT INTO `funcion` VALUES (23, 'Alta Menugroup');
INSERT INTO `funcion` VALUES (24, 'Eliminar Menugroup');
INSERT INTO `funcion` VALUES (25, 'Ver Menugroup');
INSERT INTO `funcion` VALUES (26, 'Modificar Menugroup');
INSERT INTO `funcion` VALUES (27, 'Listar Menugroup');
INSERT INTO `funcion` VALUES (28, 'Alta Menuoption');
INSERT INTO `funcion` VALUES (29, 'Eliminar Menuoption');
INSERT INTO `funcion` VALUES (30, 'Ver Menuoption');
INSERT INTO `funcion` VALUES (31, 'Modificar Menuoption');
INSERT INTO `funcion` VALUES (32, 'Listar Menuoption');
INSERT INTO `funcion` VALUES (34, 'Alta Perfilfuncion');
INSERT INTO `funcion` VALUES (35, 'Eliminar Perfilfuncion');
INSERT INTO `funcion` VALUES (36, 'Ver Perfilfuncion');
INSERT INTO `funcion` VALUES (37, 'Modificar Perfilfuncion');
INSERT INTO `funcion` VALUES (38, 'Listar Perfilfuncion');
INSERT INTO `funcion` VALUES (39, 'Eliminar Usuario');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `menugroup`
-- 

CREATE TABLE `menugroup` (
  `cd_menugroup` int(11) NOT NULL AUTO_INCREMENT,
  `orden` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `action` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `cssclass` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cd_menugroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `menugroup`
-- 

INSERT INTO `menugroup` VALUES (1, 1, 65, 'Acceso', 'panel_control&menuGroupActivo=1', 'accesos');
INSERT INTO `menugroup` VALUES (4, 6, 60, 'Salir', 'salir', NULL);
INSERT INTO `menugroup` VALUES (6, 5, 60, 'Administración', 'panel_control&menuGroupActivo=6', 'configuracion');
INSERT INTO `menugroup` VALUES (10, 10, 65, 'Builder', 'panel_control&menuGroupActivo=10', 'accesos');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `menuoption`
-- 

CREATE TABLE `menuoption` (
  `cd_menuoption` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `href` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cd_funcion` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `cd_menugroup` int(11) DEFAULT NULL,
  `cssclass` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion_panel` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cd_menuoption`),
  KEY `cd_funcion` (`cd_funcion`),
  KEY `fk_menuoption_menugroup1` (`cd_menugroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

-- 
-- Volcar la base de datos para la tabla `menuoption`
-- 

INSERT INTO `menuoption` VALUES (1, 'Usuarios', 'doAction?action=listar_usuarios', 5, 1, 1, 'usuarios', NULL);
INSERT INTO `menuoption` VALUES (2, 'Perfiles', 'doAction?action=listar_perfiles', 11, 2, 1, 'perfiles', NULL);
INSERT INTO `menuoption` VALUES (3, 'Cambiar Clave', 'doAction?action=cambiar_clave_init', 6, 3, 1, 'password', NULL);
INSERT INTO `menuoption` VALUES (4, 'Cerrar Sesión', 'doAction?action=salir', NULL, 1, 4, 'salir', NULL);
INSERT INTO `menuoption` VALUES (38, 'AccionFunciones', 'doAction?action=listar_accionfunciones', 161, 5, 1, 'accionfunciones', 'Acción Funciones');
INSERT INTO `menuoption` VALUES (39, 'Funciones', 'doAction?action=listar_funciones', 166, 5, 1, 'funciones', NULL);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pais`
-- 

CREATE TABLE `pais` (
  `cd_pais` int(11) NOT NULL AUTO_INCREMENT,
  `ds_pais` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`cd_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `pais`
-- 

INSERT INTO `pais` VALUES (1, 'Argentina');
INSERT INTO `pais` VALUES (2, 'USA');
INSERT INTO `pais` VALUES (3, 'México');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `perfil`
-- 

CREATE TABLE `perfil` (
  `cd_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `ds_perfil` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cd_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `perfil`
-- 

INSERT INTO `perfil` VALUES (1, 'Administrator');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `perfilfuncion`
-- 

CREATE TABLE `perfilfuncion` (
  `cd_perfil` int(11) NOT NULL,
  `cd_funcion` int(11) NOT NULL,
  PRIMARY KEY (`cd_perfil`,`cd_funcion`),
  KEY `fk_perfil_has_funcion_perfil1` (`cd_perfil`),
  KEY `fk_perfil_has_funcion_funcion1` (`cd_funcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Volcar la base de datos para la tabla `perfilfuncion`
-- 
insert into perfilfuncion 
select 1, cd_funcion from funcion

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE `usuario` (
  `cd_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `ds_nomusuario` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_apynom` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_mail` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_password` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cd_perfil` int(11) DEFAULT NULL,
  `ds_telefono` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ds_domicilio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cd_pais` int(11) NOT NULL,
  PRIMARY KEY (`cd_usuario`),
  KEY `fk_usuario_perfil1` (`cd_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

-- 
-- Volcar la base de datos para la tabla `usuario`
-- 

INSERT INTO `usuario` VALUES (1, 'admin', 'Administrador Codnet', 'info@codnet.com.ar', '21232f297a57a5a743894a0e4a801fc3', 1, '', NULL, 0);

-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `accionfuncion`
-- 
ALTER TABLE `accionfuncion`
  ADD CONSTRAINT `fk_funcion` FOREIGN KEY (`cd_funcion`) REFERENCES `funcion` (`cd_funcion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `menuoption`
-- 
ALTER TABLE `menuoption`
  ADD CONSTRAINT `fk_menuoption_menugroup1` FOREIGN KEY (`cd_menugroup`) REFERENCES `menugroup` (`cd_menugroup`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `perfilfuncion`
-- 
ALTER TABLE `perfilfuncion`
  ADD CONSTRAINT `fk_perfil_has_funcion_funcion1` FOREIGN KEY (`cd_funcion`) REFERENCES `funcion` (`cd_funcion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfil_has_funcion_perfil1` FOREIGN KEY (`cd_perfil`) REFERENCES `perfil` (`cd_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

