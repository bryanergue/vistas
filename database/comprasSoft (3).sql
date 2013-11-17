-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2013 a las 01:57:10
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `comprasdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `numero_compra` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `nro_factura` varchar(45) DEFAULT NULL,
  `solicitud_compra_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_compra_solicitud_compra1` (`solicitud_compra_id`),
  KEY `fk_compra_cotizacion1` (`cotizacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `fecha`, `numero_compra`, `estado`, `nro_factura`, `solicitud_compra_id`, `cotizacion_id`) VALUES
(9, '2013-06-17 00:00:00', '1', 'pendiente', 'FAC001', 1, NULL),
(10, '2013-06-17 00:00:00', '2', 'pendiente', 'FAC002', 2, NULL),
(11, '2013-06-17 00:00:00', '2', 'pendiente', 'FAC002', 2, NULL),
(12, '2013-06-17 00:00:00', '4', 'pendiente', 'dasdas', 2, NULL),
(13, '2013-06-17 00:00:00', '5', 'pendiente', 'dasdasd', 3, NULL),
(14, '2013-06-17 00:00:00', '5', 'pendiente', 'dasdasd', 3, NULL),
(15, '2013-06-17 00:00:00', '5', 'pendiente', 'dasdasd', 3, NULL),
(16, '2013-06-17 00:00:00', '5', 'pendiente', 'dasdasd', 3, NULL),
(17, '2013-06-17 00:00:00', '5', 'pendiente', 'dasdasd', 3, NULL),
(18, '2013-06-20 00:00:00', '10', 'pendiente', '', 3, NULL),
(19, '2013-06-20 00:00:00', '11', 'pendiente', '', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_item`
--

DROP TABLE IF EXISTS `compra_item`;
CREATE TABLE IF NOT EXISTS `compra_item` (
  `producto_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio_compra` double NOT NULL,
  PRIMARY KEY (`producto_id`,`compra_id`),
  KEY `fk_producto_has_compra_compra1` (`compra_id`),
  KEY `fk_producto_has_compra_producto1` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_item`
--

INSERT INTO `compra_item` (`producto_id`, `compra_id`, `cantidad`, `precio_compra`) VALUES
(1, 9, 10, 100),
(1, 19, 10, 100),
(2, 9, 20, 100),
(2, 19, 20, 100),
(10, 13, 10, 100),
(10, 14, 10, 100),
(10, 15, 10, 100),
(10, 16, 10, 100),
(10, 17, 10, 100),
(10, 18, 10, 100),
(11, 13, 20, 100),
(11, 14, 20, 100),
(11, 15, 20, 100),
(11, 16, 20, 100),
(11, 17, 20, 100),
(11, 18, 20, 100),
(12, 13, 30, 100),
(12, 14, 30, 100),
(12, 15, 30, 100),
(12, 16, 30, 100),
(12, 17, 30, 100),
(12, 18, 30, 100),
(13, 10, 11, 100),
(13, 11, 11, 100),
(13, 12, 11, 100),
(14, 10, 12, 100),
(14, 11, 12, 100),
(14, 12, 12, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones_pago`
--

DROP TABLE IF EXISTS `condiciones_pago`;
CREATE TABLE IF NOT EXISTS `condiciones_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `condiciones_pago`
--

INSERT INTO `condiciones_pago` (`id`, `nombre`) VALUES
(1, 'Efectivo'),
(2, 'Debito'),
(3, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
CREATE TABLE IF NOT EXISTS `cotizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_alta` datetime NOT NULL,
  `solicitud_compra_id` int(11) NOT NULL,
  `nro_cotizacion` varchar(45) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cotizacion_solicitud_compra1` (`solicitud_compra_id`),
  KEY `fk_cotizacion_proveedor1` (`proveedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id`, `fecha_alta`, `solicitud_compra_id`, `nro_cotizacion`, `proveedor_id`, `estado`) VALUES
(22, '2013-06-19 00:00:00', 9, '1', 1, 'borrador'),
(23, '2013-06-19 00:00:00', 9, '2', 1, 'borrador'),
(25, '2013-06-19 00:00:00', 9, '3', 1, 'borrador'),
(26, '2013-06-19 00:00:00', 9, '4', 1, 'borrador'),
(27, '2013-06-19 00:00:00', 10, '1', 2, 'borrador'),
(28, '2013-06-20 00:00:00', 12, '1', 2, 'borrador'),
(29, '2013-06-20 00:00:00', 9, '5', 1, 'borrador'),
(30, '2013-06-20 00:00:00', 9, '5', 1, 'borrador'),
(31, '2013-06-20 00:00:00', 9, '7', 1, 'borrador'),
(32, '2013-06-20 00:00:00', 9, '8', 1, 'borrador'),
(33, '2013-06-20 00:00:00', 9, '8', 1, 'borrador'),
(34, '2013-06-20 00:00:00', 9, '10', 1, 'borrador'),
(35, '2013-06-20 00:00:00', 10, '2', 2, 'borrador'),
(36, '2013-06-20 00:00:00', 9, '11', 1, 'borrador'),
(37, '2013-07-20 00:00:00', 9, '12', 1, 'borrador'),
(38, '2013-10-31 00:00:00', 9, '13', 1, 'borrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_item`
--

DROP TABLE IF EXISTS `cotizacion_item`;
CREATE TABLE IF NOT EXISTS `cotizacion_item` (
  `cotizacion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio_compra` double NOT NULL,
  PRIMARY KEY (`cotizacion_id`,`producto_id`),
  KEY `fk_cotizacion_has_producto_producto1` (`producto_id`),
  KEY `fk_cotizacion_has_producto_cotizacion1` (`cotizacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizacion_item`
--

INSERT INTO `cotizacion_item` (`cotizacion_id`, `producto_id`, `cantidad`, `precio_compra`) VALUES
(22, 10, 10, 10),
(22, 11, 11, 10),
(22, 12, 12, 10),
(22, 13, 13, 10),
(22, 14, 14, 10),
(23, 10, 10, 1000),
(23, 11, 11, 1000),
(23, 12, 12, 1000),
(23, 13, 13, 1000),
(23, 14, 14, 1000),
(26, 10, 10, 5000),
(26, 11, 11, 5000),
(26, 12, 12, 5000),
(26, 13, 13, 5000),
(26, 14, 14, 5000),
(27, 2, 124, 10),
(27, 10, 55, 20),
(27, 12, 6, 40),
(29, 10, 10, 100),
(29, 11, 11, 200),
(29, 12, 12, 300),
(29, 13, 13, 389),
(29, 14, 14, 18),
(31, 10, 10, 10),
(31, 11, 11, 20),
(31, 12, 12, 30),
(31, 13, 13, 50),
(31, 14, 14, 60),
(32, 10, 10, 4000),
(32, 11, 11, 4000),
(32, 12, 12, 4000),
(32, 13, 13, 4000),
(32, 14, 14, 4000),
(34, 10, 10, 0),
(34, 11, 11, 0),
(34, 12, 12, 0),
(34, 13, 13, 0),
(34, 14, 14, 0),
(35, 2, 124, 3443),
(35, 10, 55, 0),
(35, 12, 6, 0),
(36, 10, 10, 1),
(36, 11, 11, 1),
(36, 12, 12, 2),
(36, 13, 13, 3),
(36, 14, 14, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authassignment`
--

DROP TABLE IF EXISTS `cruge_authassignment`;
CREATE TABLE IF NOT EXISTS `cruge_authassignment` (
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  `itemname` varchar(64) NOT NULL,
  PRIMARY KEY (`userid`,`itemname`),
  KEY `fk_cruge_authassignment_cruge_authitem1` (`itemname`),
  KEY `fk_cruge_authassignment_user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_authassignment`
--

INSERT INTO `cruge_authassignment` (`userid`, `bizrule`, `data`, `itemname`) VALUES
(9, NULL, 'N;', 'Compras'),
(11, NULL, 'N;', 'comite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authitem`
--

DROP TABLE IF EXISTS `cruge_authitem`;
CREATE TABLE IF NOT EXISTS `cruge_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_authitem`
--

INSERT INTO `cruge_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('action_compra_create', 0, '', NULL, 'N;'),
('action_compra_listado', 0, '', NULL, 'N;'),
('action_compra_nuevo', 0, '', NULL, 'N;'),
('action_compra_registrar', 0, '', NULL, 'N;'),
('action_compra_view', 0, '', NULL, 'N;'),
('action_cotizacion_add', 0, '', NULL, 'N;'),
('action_cotizacion_create', 0, '', NULL, 'N;'),
('action_cotizacion_getnumero', 0, '', NULL, 'N;'),
('action_cotizacion_nuevo', 0, '', NULL, 'N;'),
('action_cotizacion_registrar', 0, '', NULL, 'N;'),
('action_materiaPrima_create', 0, '', NULL, 'N;'),
('action_personal_personal', 0, '', NULL, 'N;'),
('action_producto_add', 0, '', NULL, 'N;'),
('action_producto_admin', 0, '', NULL, 'N;'),
('action_producto_buscarproduct', 0, '', NULL, 'N;'),
('action_producto_create', 0, '', NULL, 'N;'),
('action_producto_delete', 0, '', NULL, 'N;'),
('action_producto_index', 0, '', NULL, 'N;'),
('action_producto_listado', 0, '', NULL, 'N;'),
('action_producto_update', 0, '', NULL, 'N;'),
('action_producto_view', 0, '', NULL, 'N;'),
('action_proveedor_admin', 0, '', NULL, 'N;'),
('action_proveedor_autocompletado', 0, '', NULL, 'N;'),
('action_proveedor_buscar', 0, '', NULL, 'N;'),
('action_proveedor_create', 0, '', NULL, 'N;'),
('action_proveedor_delete', 0, '', NULL, 'N;'),
('action_proveedor_index', 0, '', NULL, 'N;'),
('action_proveedor_lista', 0, '', NULL, 'N;'),
('action_proveedor_listado', 0, '', NULL, 'N;'),
('action_proveedor_update', 0, '', NULL, 'N;'),
('action_proveedor_view', 0, '', NULL, 'N;'),
('action_site_contact', 0, '', NULL, 'N;'),
('action_site_error', 0, '', NULL, 'N;'),
('action_site_index', 0, '', NULL, 'N;'),
('action_site_indexcompras', 0, '', NULL, 'N;'),
('action_site_login', 0, '', NULL, 'N;'),
('action_site_loginsuccess', 0, '', NULL, 'N;'),
('action_site_logout', 0, '', NULL, 'N;'),
('action_site_oldindex', 0, '', NULL, 'N;'),
('action_solicitudcompra_addcomite', 0, '', NULL, 'N;'),
('action_solicitudcompra_addproveedor', 0, '', NULL, 'N;'),
('action_solicitudcompra_admin', 0, '', NULL, 'N;'),
('action_solicitudcompra_aprobadas', 0, '', NULL, 'N;'),
('action_solicitudcompra_aprobar', 0, '', NULL, 'N;'),
('action_solicitudcompra_asignarcomite', 0, '', NULL, 'N;'),
('action_solicitudcompra_confimarsolicitud', 0, '', NULL, 'N;'),
('action_solicitudcompra_confirmar', 0, '', NULL, 'N;'),
('action_solicitudcompra_create', 0, '', NULL, 'N;'),
('action_solicitudcompra_delete', 0, '', NULL, 'N;'),
('action_solicitudcompra_index', 0, '', NULL, 'N;'),
('action_solicitudcompra_listado', 0, '', NULL, 'N;'),
('action_solicitudcompra_listadoaprobacion', 0, '', NULL, 'N;'),
('action_solicitudcompra_nuevo', 0, '', NULL, 'N;'),
('action_solicitudcompra_rechazar', 0, '', NULL, 'N;'),
('action_solicitudcompra_update', 0, '', NULL, 'N;'),
('action_solicitudcompra_view', 0, '', NULL, 'N;'),
('action_solicitudcompra_viewaprobada', 0, '', NULL, 'N;'),
('action_solicitudcompra_viewcomite', 0, '', NULL, 'N;'),
('action_solicitudcompra_viewconfirmar', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_add', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_add2', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_contar', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_del', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_index', 0, '', NULL, 'N;'),
('action_solicitudingresoexistencia_listado', 0, '', NULL, 'N;'),
('action_ui_editprofile', 0, '', NULL, 'N;'),
('action_ui_fieldsadmincreate', 0, '', NULL, 'N;'),
('action_ui_fieldsadminlist', 0, '', NULL, 'N;'),
('action_ui_rbacajaxgetassignmentbizrule', 0, '', NULL, 'N;'),
('action_ui_rbacajaxsetchilditem', 0, '', NULL, 'N;'),
('action_ui_rbacauthitemchilditems', 0, '', NULL, 'N;'),
('action_ui_rbacauthitemcreate', 0, '', NULL, 'N;'),
('action_ui_rbacauthitemupdate', 0, '', NULL, 'N;'),
('action_ui_rbaclistops', 0, '', NULL, 'N;'),
('action_ui_rbaclistroles', 0, '', NULL, 'N;'),
('action_ui_rbaclisttasks', 0, '', NULL, 'N;'),
('action_ui_rbacusersassignments', 0, '', NULL, 'N;'),
('action_ui_sessionadmin', 0, '', NULL, 'N;'),
('action_ui_systemupdate', 0, '', NULL, 'N;'),
('action_ui_usermanagementadmin', 0, '', NULL, 'N;'),
('action_ui_usermanagementcreate', 0, '', NULL, 'N;'),
('action_ui_usermanagementdelete', 0, '', NULL, 'N;'),
('action_ui_usermanagementupdate', 0, '', NULL, 'N;'),
('admin', 0, '', NULL, 'N;'),
('Adquisiciones', 0, '', NULL, 'N;'),
('comite', 2, 'miembro de comite', 'miembro de comite', 'N;'),
('Compras', 2, 'Puede comprar', '', 'N;'),
('controller_compra', 0, '', NULL, 'N;'),
('controller_cotizacion', 0, '', NULL, 'N;'),
('controller_producto', 0, '', NULL, 'N;'),
('controller_proveedor', 0, '', NULL, 'N;'),
('controller_site', 0, '', NULL, 'N;'),
('controller_solicitudcompra', 0, '', NULL, 'N;'),
('controller_solicitudes', 0, '', NULL, 'N;'),
('controller_solicitudingresoexistencia', 0, '', NULL, 'N;'),
('Direccion', 2, '', '', 'N;'),
('edit-advanced-profile-features', 0, 'C:\\xampp\\htdocs\\vistas\\protected\\modules\\cruge\\views\\ui\\usermanagementupdate.php linea 114', NULL, 'N;'),
('gerente', 2, 'Gerente general', '', 'N;'),
('SuperUsuario', 0, '', NULL, 'N;'),
('Usuario', 0, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_authitemchild`
--

DROP TABLE IF EXISTS `cruge_authitemchild`;
CREATE TABLE IF NOT EXISTS `cruge_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cruge_authitemchild`
--

INSERT INTO `cruge_authitemchild` (`parent`, `child`) VALUES
('comite', 'controller_cotizacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_field`
--

DROP TABLE IF EXISTS `cruge_field`;
CREATE TABLE IF NOT EXISTS `cruge_field` (
  `idfield` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(20) NOT NULL,
  `longname` varchar(50) DEFAULT NULL,
  `position` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `fieldtype` int(11) DEFAULT '0',
  `fieldsize` int(11) DEFAULT '20',
  `maxlength` int(11) DEFAULT '45',
  `showinreports` int(11) DEFAULT '0',
  `useregexp` varchar(512) DEFAULT NULL,
  `useregexpmsg` varchar(512) DEFAULT NULL,
  `predetvalue` mediumblob,
  PRIMARY KEY (`idfield`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_fieldvalue`
--

DROP TABLE IF EXISTS `cruge_fieldvalue`;
CREATE TABLE IF NOT EXISTS `cruge_fieldvalue` (
  `idfieldvalue` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idfield` int(11) NOT NULL,
  `value` blob,
  PRIMARY KEY (`idfieldvalue`),
  KEY `fk_cruge_fieldvalue_cruge_user1` (`iduser`),
  KEY `fk_cruge_fieldvalue_cruge_field1` (`idfield`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_session`
--

DROP TABLE IF EXISTS `cruge_session`;
CREATE TABLE IF NOT EXISTS `cruge_session` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `created` bigint(30) DEFAULT NULL,
  `expire` bigint(30) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `ipaddress` varchar(45) DEFAULT NULL,
  `usagecount` int(11) DEFAULT '0',
  `lastusage` bigint(30) DEFAULT NULL,
  `logoutdate` bigint(30) DEFAULT NULL,
  `ipaddressout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsession`),
  KEY `crugesession_iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `cruge_session`
--

INSERT INTO `cruge_session` (`idsession`, `iduser`, `created`, `expire`, `status`, `ipaddress`, `usagecount`, `lastusage`, `logoutdate`, `ipaddressout`) VALUES
(1, 1, 1369796095, 1369797895, 0, '::1', 1, 1369796095, NULL, NULL),
(2, 1, 1370031424, 1370033224, 0, '::1', 1, 1370031424, NULL, NULL),
(3, 1, 1371336239, 1371338039, 0, '::1', 1, 1371336239, NULL, NULL),
(4, 9, 1371671766, 1371673566, 0, '::1', 1, 1371671766, 1371671888, '::1'),
(5, 9, 1371673959, 1371675759, 0, '::1', 1, 1371673959, 1371674057, '::1'),
(6, 11, 1371674316, 1371676116, 0, '::1', 1, 1371674316, 1371675185, '::1'),
(7, 1, 1371684697, 1371686497, 1, '::1', 1, 1371684697, NULL, NULL),
(8, 1, 1371764924, 1371766724, 0, '::1', 1, 1371764924, NULL, NULL),
(9, 1, 1374296419, 1374298219, 1, '::1', 1, 1374296419, NULL, NULL),
(10, 1, 1380603791, 1380605591, 0, '::1', 1, 1380603791, 1380603825, '::1'),
(11, 1, 1380605996, 1380607796, 1, '::1', 1, 1380605996, NULL, NULL),
(12, 1, 1381926203, 1381928003, 1, '::1', 1, 1381926203, NULL, NULL),
(13, 1, 1383974197, 1383975997, 0, '::1', 1, 1383974197, NULL, NULL),
(14, 1, 1384648521, 1384650321, 1, '::1', 1, 1384648521, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_system`
--

DROP TABLE IF EXISTS `cruge_system`;
CREATE TABLE IF NOT EXISTS `cruge_system` (
  `idsystem` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `largename` varchar(45) DEFAULT NULL,
  `sessionmaxdurationmins` int(11) DEFAULT '30',
  `sessionmaxsameipconnections` int(11) DEFAULT '10',
  `sessionreusesessions` int(11) DEFAULT '1' COMMENT '1yes 0no',
  `sessionmaxsessionsperday` int(11) DEFAULT '-1',
  `sessionmaxsessionsperuser` int(11) DEFAULT '-1',
  `systemnonewsessions` int(11) DEFAULT '0' COMMENT '1yes 0no',
  `systemdown` int(11) DEFAULT '0',
  `registerusingcaptcha` int(11) DEFAULT '0',
  `registerusingterms` int(11) DEFAULT '0',
  `terms` blob,
  `registerusingactivation` int(11) DEFAULT '1',
  `defaultroleforregistration` varchar(64) DEFAULT NULL,
  `registerusingtermslabel` varchar(100) DEFAULT NULL,
  `registrationonlogin` int(11) DEFAULT '1',
  PRIMARY KEY (`idsystem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cruge_system`
--

INSERT INTO `cruge_system` (`idsystem`, `name`, `largename`, `sessionmaxdurationmins`, `sessionmaxsameipconnections`, `sessionreusesessions`, `sessionmaxsessionsperday`, `sessionmaxsessionsperuser`, `systemnonewsessions`, `systemdown`, `registerusingcaptcha`, `registerusingterms`, `terms`, `registerusingactivation`, `defaultroleforregistration`, `registerusingtermslabel`, `registrationonlogin`) VALUES
(1, 'default', NULL, 30, 10, 1, -1, -1, 0, 0, 0, 0, '', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cruge_user`
--

DROP TABLE IF EXISTS `cruge_user`;
CREATE TABLE IF NOT EXISTS `cruge_user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` bigint(20) DEFAULT NULL,
  `actdate` bigint(20) DEFAULT NULL,
  `logondate` bigint(20) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `authkey` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `totalsessioncounter` int(11) DEFAULT '0',
  `currentsessioncounter` int(11) DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `cruge_user`
--

INSERT INTO `cruge_user` (`iduser`, `regdate`, `actdate`, `logondate`, `username`, `email`, `password`, `authkey`, `state`, `totalsessioncounter`, `currentsessioncounter`) VALUES
(1, NULL, NULL, 1384648521, 'admin', 'admin@tucorreo.com', 'admin', NULL, 1, 0, 0),
(2, NULL, NULL, NULL, 'invitado', 'invitado', 'nopassword', NULL, 1, 0, 0),
(3, NULL, NULL, NULL, 'Comite 1', NULL, 'comite1', NULL, 0, 0, 0),
(4, NULL, NULL, NULL, 'comite 2', NULL, 'comite2', NULL, 0, 0, 0),
(5, NULL, NULL, NULL, 'comite 3', NULL, 'comite3', NULL, 0, 0, 0),
(6, NULL, NULL, NULL, 'comite 4', NULL, 'comite4', NULL, 0, 0, 0),
(7, NULL, NULL, NULL, 'comite 5', NULL, 'comite5', NULL, 0, 0, 0),
(8, NULL, NULL, NULL, 'comite 6', NULL, 'comite6', NULL, 0, 0, 0),
(9, NULL, NULL, NULL, 'compras ', 'compras@localhost.net', 'compras', NULL, 1, 0, 0),
(10, NULL, NULL, NULL, 'gerentegeneral', 'gerentegeneral@localhost.net', 'gerente', NULL, 0, 0, 0),
(11, 1371674301, NULL, 1371674316, 'comite7', 'comite7@localhost.net', 'comite7', '7bccc1e533be651ecd8744dc6ca2d3c7', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_generacion` datetime NOT NULL,
  `estado` varchar(45) NOT NULL,
  `referencia` varchar(300) DEFAULT NULL,
  `comentario` varchar(300) DEFAULT NULL,
  `usuario_solicitante` int(11) NOT NULL,
  `usuario_controlador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventario_cruge_user1` (`usuario_solicitante`),
  KEY `fk_inventario_cruge_user2` (`usuario_controlador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_items`
--

DROP TABLE IF EXISTS `inventario_items`;
CREATE TABLE IF NOT EXISTS `inventario_items` (
  `producto_id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `cantidad` double DEFAULT NULL,
  `cantidad_real` double DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`inventario_id`),
  KEY `fk_producto_has_inventario_inventario1` (`inventario_id`),
  KEY `fk_producto_has_inventario_producto1` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `usuario_solicitante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_cruge_user1` (`usuario_solicitante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `descripcion`, `usuario_solicitante_id`) VALUES
(1, 'POO1', 'Tinta', 1),
(2, 'POO2', 'Repuestos', 1),
(3, 'PAP', 'Papel A4', 2),
(4, 'PAP', 'Papel A5', 1),
(10, 'PP01', 'Tinta color negro', 1),
(11, 'PP02', 'Tinta color rojo', 1),
(12, 'PP03', 'Tinta color verde', 2),
(13, 'PP04', 'Tinta color azul', 1),
(14, 'PP05', 'Tinta color amarillo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `codigo`, `nombre`, `descripcion`, `domicilio`, `telefono`) VALUES
(1, '0001', 'Carlos Santana', 'Proveedor de equipos', NULL, NULL),
(2, '0002', 'Juan Perez', 'Proveedor de repuestos', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_comite`
--

DROP TABLE IF EXISTS `solicitud_comite`;
CREATE TABLE IF NOT EXISTS `solicitud_comite` (
  `solicitud_id` int(11) NOT NULL,
  `comite_id` int(11) NOT NULL,
  KEY `solicitud_id` (`solicitud_id`),
  KEY `comite_id` (`comite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_comite`
--

INSERT INTO `solicitud_comite` (`solicitud_id`, `comite_id`) VALUES
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 9),
(9, 9),
(9, 3),
(9, 5),
(9, 6),
(9, 8),
(9, 9),
(9, 9),
(9, 4),
(9, 5),
(9, 7),
(9, 3),
(9, 9),
(9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compra`
--

DROP TABLE IF EXISTS `solicitud_compra`;
CREATE TABLE IF NOT EXISTS `solicitud_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_alta` datetime NOT NULL,
  `usuario_solicitante` int(11) NOT NULL,
  `codigo_solicitud` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `tipo_compra_id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_solicitud_compra_cruge_user1` (`usuario_solicitante`),
  KEY `tipo_compra_id` (`tipo_compra_id`),
  KEY `proveedor_id` (`proveedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `solicitud_compra`
--

INSERT INTO `solicitud_compra` (`id`, `fecha_alta`, `usuario_solicitante`, `codigo_solicitud`, `estado`, `tipo_compra_id`, `proveedor_id`) VALUES
(1, '2013-05-28 00:00:00', 1, 'SD00', 'aprobada', 1, 1),
(2, '2013-05-29 00:00:00', 1, 'SD01', 'rechazada', 1, 1),
(3, '2013-05-29 00:00:00', 1, 'SD02', 'cerrada', 1, 2),
(9, '2013-06-04 00:00:00', 1, 'SL01', 'a cotizar', 2, 1),
(10, '2013-06-06 00:00:00', 1, 'SL02', 'a cotizar', 2, 1),
(11, '2013-06-08 00:00:00', 1, 'SL03', 'aprobada', 2, 2),
(12, '2013-06-03 00:00:00', 1, 'SL04', 'borrador', 2, 1),
(13, '2013-06-08 00:00:00', 2, 'SD10', 'aprobada', 1, 1),
(14, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(15, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(16, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(17, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(18, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(19, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(20, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(21, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(22, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(23, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(24, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1),
(25, '2013-05-29 00:00:00', 1, '1', 'si', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compra_item`
--

DROP TABLE IF EXISTS `solicitud_compra_item`;
CREATE TABLE IF NOT EXISTS `solicitud_compra_item` (
  `solicitud_compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double DEFAULT NULL,
  PRIMARY KEY (`solicitud_compra_id`,`producto_id`),
  KEY `fk_producto_has_solicitud_compra_solicitud_compra1` (`solicitud_compra_id`),
  KEY `fk_producto_has_solicitud_compra_producto1` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud_compra_item`
--

INSERT INTO `solicitud_compra_item` (`solicitud_compra_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 10, 100),
(1, 2, 20, 100),
(2, 13, 11, 100),
(2, 14, 12, 100),
(3, 10, 10, 100),
(3, 11, 20, 100),
(3, 12, 30, 100),
(9, 10, 10, NULL),
(9, 11, 11, NULL),
(9, 12, 12, NULL),
(9, 13, 13, NULL),
(9, 14, 14, NULL),
(10, 2, 124, NULL),
(10, 10, 55, NULL),
(10, 12, 6, NULL),
(11, 3, 22, 100),
(11, 11, 34, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_compra`
--

DROP TABLE IF EXISTS `tipo_compra`;
CREATE TABLE IF NOT EXISTS `tipo_compra` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_compra`
--

INSERT INTO `tipo_compra` (`id`, `tipo`) VALUES
(1, 'directa'),
(2, 'licitacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_item`
--

DROP TABLE IF EXISTS `tipo_item`;
CREATE TABLE IF NOT EXISTS `tipo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_moneda`
--

DROP TABLE IF EXISTS `tipo_moneda`;
CREATE TABLE IF NOT EXISTS `tipo_moneda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

DROP TABLE IF EXISTS `unidad`;
CREATE TABLE IF NOT EXISTS `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_cotizacion1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_solicitud_compra1` FOREIGN KEY (`solicitud_compra_id`) REFERENCES `solicitud_compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra_item`
--
ALTER TABLE `compra_item`
  ADD CONSTRAINT `fk_producto_has_compra_compra1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_has_compra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `fk_cotizacion_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_solicitud_compra1` FOREIGN KEY (`solicitud_compra_id`) REFERENCES `solicitud_compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotizacion_item`
--
ALTER TABLE `cotizacion_item`
  ADD CONSTRAINT `fk_cotizacion_has_producto_cotizacion1` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_has_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cruge_authassignment`
--
ALTER TABLE `cruge_authassignment`
  ADD CONSTRAINT `fk_cruge_authassignment_cruge_authitem1` FOREIGN KEY (`itemname`) REFERENCES `cruge_authitem` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cruge_authassignment_user` FOREIGN KEY (`userid`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cruge_authitemchild`
--
ALTER TABLE `cruge_authitemchild`
  ADD CONSTRAINT `crugeauthitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crugeauthitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cruge_fieldvalue`
--
ALTER TABLE `cruge_fieldvalue`
  ADD CONSTRAINT `fk_cruge_fieldvalue_cruge_field1` FOREIGN KEY (`idfield`) REFERENCES `cruge_field` (`idfield`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cruge_fieldvalue_cruge_user1` FOREIGN KEY (`iduser`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_cruge_user1` FOREIGN KEY (`usuario_solicitante`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inventario_cruge_user2` FOREIGN KEY (`usuario_controlador`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario_items`
--
ALTER TABLE `inventario_items`
  ADD CONSTRAINT `fk_producto_has_inventario_inventario1` FOREIGN KEY (`inventario_id`) REFERENCES `inventario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_has_inventario_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_cruge_user1` FOREIGN KEY (`usuario_solicitante_id`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_comite`
--
ALTER TABLE `solicitud_comite`
  ADD CONSTRAINT `solicitud_comite_ibfk_1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud_compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_comite_ibfk_2` FOREIGN KEY (`comite_id`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  ADD CONSTRAINT `fk_solicitud_compra_cruge_user1` FOREIGN KEY (`usuario_solicitante`) REFERENCES `cruge_user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_compra_ibfk_1` FOREIGN KEY (`tipo_compra_id`) REFERENCES `tipo_compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_compra_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud_compra_item`
--
ALTER TABLE `solicitud_compra_item`
  ADD CONSTRAINT `fk_producto_has_solicitud_compra_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_has_solicitud_compra_solicitud_compra1` FOREIGN KEY (`solicitud_compra_id`) REFERENCES `solicitud_compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
