-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.19 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para symfonycopia
CREATE DATABASE IF NOT EXISTS `symfonycopia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `symfonycopia`;

-- Volcando estructura para tabla symfonycopia.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.cargo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `id_cargo`, `descripcion`) VALUES
	(1, 1, 'Usuario de Mesa de Ayuda'),
	(2, 2, 'Usuario de Grupo de Resolución');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.clasificacion_ticket
CREATE TABLE IF NOT EXISTS `clasificacion_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_cla_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CCB105B02A43A2E9` (`estado_cla_id`),
  KEY `IDX_CCB105B0A76ED395` (`user_id`),
  CONSTRAINT `FK_CCB105B02A43A2E9` FOREIGN KEY (`estado_cla_id`) REFERENCES `estado_clasificacion_ticket` (`id`),
  CONSTRAINT `FK_CCB105B0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.clasificacion_ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clasificacion_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `clasificacion_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.direccion
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direccion` int(11) NOT NULL,
  `calle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `oficina` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.direccion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` (`id`, `id_direccion`, `calle`, `piso`, `numero`, `oficina`) VALUES
	(1, 1, 'San Martin ', 5, 3049, 'secretaria de extensión'),
	(2, 2, 'Junin 218', 1, 344, 'administración de ingresos'),
	(3, 3, 'balcarse', 1, 1562, 'Otra oficina'),
	(4, 4, '4 Jefes', 1, 2345, 'La de Al lado de la otra'),
	(5, 5, 'Lavaisse', 0, 324, 'Asistencia Social'),
	(6, 6, '4 de Enero', 2, 334, 'DMZ');
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) DEFAULT NULL,
  `direccion_id` int(11) DEFAULT NULL,
  `legajo` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_interno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_directo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D9D9BF52D0A7BD7` (`direccion_id`),
  KEY `IDX_D9D9BF52813AC380` (`cargo_id`),
  CONSTRAINT `FK_D9D9BF52813AC380` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`),
  CONSTRAINT `FK_D9D9BF52D0A7BD7` FOREIGN KEY (`direccion_id`) REFERENCES `direccion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.empleado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`id`, `cargo_id`, `direccion_id`, `legajo`, `nombre`, `apellido`, `telefono_interno`, `telefono_directo`) VALUES
	(1, 1, 1, 1, 'Lisandro Adolfo', 'Rattero', '344', '3424999235'),
	(2, 1, 2, 2, 'Franco Damián', 'Beber', '223', '3455277345'),
	(3, 2, 3, 3, 'Franco Augusto', 'Pizzutti', '45435', '3424667899'),
	(4, 2, 4, 4, 'Hector Orlando', 'Crispens', '455', '3424872589'),
	(5, 1, 5, 5, 'Cristian ', 'Impini', '235', '4444444444');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.estado_clasificacion_ticket
CREATE TABLE IF NOT EXISTS `estado_clasificacion_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_cla` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.estado_clasificacion_ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_clasificacion_ticket` DISABLE KEYS */;
INSERT INTO `estado_clasificacion_ticket` (`id`, `id_estado_cla`, `descripcion`) VALUES
	(1, 1, 'Activa'),
	(2, 2, 'InActiva');
/*!40000 ALTER TABLE `estado_clasificacion_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.estado_grupo_resolucion
CREATE TABLE IF NOT EXISTS `estado_grupo_resolucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_grupo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.estado_grupo_resolucion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_grupo_resolucion` DISABLE KEYS */;
INSERT INTO `estado_grupo_resolucion` (`id`, `id_estado_grupo`, `descripcion`) VALUES
	(1, 1, 'Activo'),
	(2, 2, 'InActivo');
/*!40000 ALTER TABLE `estado_grupo_resolucion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.estado_intervencion
CREATE TABLE IF NOT EXISTS `estado_intervencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.estado_intervencion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_intervencion` DISABLE KEYS */;
INSERT INTO `estado_intervencion` (`id`, `id_estado`, `descripcion`) VALUES
	(1, 1, 'Asignada'),
	(2, 2, 'Rechazada'),
	(3, 3, 'Pausada'),
	(4, 4, 'Abordada'),
	(5, 5, 'Cerrada');
/*!40000 ALTER TABLE `estado_intervencion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.estado_ticket
CREATE TABLE IF NOT EXISTS `estado_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.estado_ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_ticket` DISABLE KEYS */;
INSERT INTO `estado_ticket` (`id`, `id_estado`, `descripcion`) VALUES
	(1, 1, 'Abierto Sin Derivar'),
	(2, 2, 'Abierto Derivado'),
	(3, 3, 'A la Espera OK'),
	(4, 4, 'Cerrado');
/*!40000 ALTER TABLE `estado_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.grupo_resolucion
CREATE TABLE IF NOT EXISTS `grupo_resolucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_30F626779F5A440B` (`estado_id`),
  CONSTRAINT `FK_30F626779F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_grupo_resolucion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.grupo_resolucion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo_resolucion` DISABLE KEYS */;
INSERT INTO `grupo_resolucion` (`id`, `estado_id`, `codigo`, `nombre`, `nivel`) VALUES
	(1, 1, 1, 'Mesa de ayuda', 0),
	(2, 1, 2, 'Unidades de soporte', 1),
	(3, 1, 3, 'Servicio tecnico', 1),
	(4, 1, 4, 'Administrador de base de datos', 2),
	(5, 1, 5, 'Administrador SUSE linux', 2),
	(6, 1, 6, 'Administrador proxy y correo electronico', 2),
	(7, 1, 7, 'Administrador Debian', 2),
	(8, 1, 8, 'Redes LAN', 1),
	(9, 1, 9, 'Comunicaciones', 2),
	(10, 1, 10, 'Desarrollo sistema comercial', 2),
	(11, 1, 11, 'Desarrollo sistema RRHH', 2),
	(12, 1, 12, 'Desarrollo sistema de reclamos', 2);
/*!40000 ALTER TABLE `grupo_resolucion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.intervencion
CREATE TABLE IF NOT EXISTS `intervencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_resolucion_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1CD67B8DA0FF6FD8` (`grupo_resolucion_id`),
  KEY `IDX_1CD67B8D700047D2` (`ticket_id`),
  CONSTRAINT `FK_1CD67B8D700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_1CD67B8DA0FF6FD8` FOREIGN KEY (`grupo_resolucion_id`) REFERENCES `grupo_resolucion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.intervencion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `intervencion` DISABLE KEYS */;
/*!40000 ALTER TABLE `intervencion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.item_historico_clasificacion
CREATE TABLE IF NOT EXISTS `item_historico_clasificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clasificacion_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `id_item` int(11) NOT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `hora_desde` time DEFAULT NULL,
  `hora_hasta` time DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDA484DA78ECAC4A` (`clasificacion_id`),
  KEY `IDX_EDA484DAA76ED395` (`user_id`),
  KEY `IDX_EDA484DA700047D2` (`ticket_id`),
  CONSTRAINT `FK_EDA484DA700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_EDA484DA78ECAC4A` FOREIGN KEY (`clasificacion_id`) REFERENCES `clasificacion_ticket` (`id`),
  CONSTRAINT `FK_EDA484DAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.item_historico_clasificacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `item_historico_clasificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_historico_clasificacion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.item_historico_estados
CREATE TABLE IF NOT EXISTS `item_historico_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `id_item` int(11) NOT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `hora_desde` time DEFAULT NULL,
  `hora_hasta` time DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_91D2DF8EAE4A2FA4` (`estado_ticket_id`),
  KEY `IDX_91D2DF8EA76ED395` (`user_id`),
  KEY `IDX_91D2DF8E700047D2` (`ticket_id`),
  CONSTRAINT `FK_91D2DF8E700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_91D2DF8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_91D2DF8EAE4A2FA4` FOREIGN KEY (`estado_ticket_id`) REFERENCES `estado_ticket` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.item_historico_estados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `item_historico_estados` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_historico_estados` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.item_historico_intervencion
CREATE TABLE IF NOT EXISTS `item_historico_intervencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_intervencion_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `hora_desde` time DEFAULT NULL,
  `hora_hasta` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0F5C50B2B50E810` (`estado_intervencion_id`),
  KEY `IDX_F0F5C50BA76ED395` (`user_id`),
  CONSTRAINT `FK_F0F5C50B2B50E810` FOREIGN KEY (`estado_intervencion_id`) REFERENCES `estado_intervencion` (`id`),
  CONSTRAINT `FK_F0F5C50BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.item_historico_intervencion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `item_historico_intervencion` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_historico_intervencion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.migration_versions
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla symfonycopia.migration_versions: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`) VALUES
	('20181030194429'),
	('20181102194137');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nro_ticket` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97A0ADA3952BE730` (`empleado_id`),
  KEY `IDX_97A0ADA3A76ED395` (`user_id`),
  CONSTRAINT `FK_97A0ADA3952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  CONSTRAINT `FK_97A0ADA3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.ticket: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_resolucion_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649952BE730` (`empleado_id`),
  KEY `IDX_8D93D649A0FF6FD8` (`grupo_resolucion_id`),
  CONSTRAINT `FK_8D93D649952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  CONSTRAINT `FK_8D93D649A0FF6FD8` FOREIGN KEY (`grupo_resolucion_id`) REFERENCES `grupo_resolucion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `grupo_resolucion_id`, `empleado_id`, `username`, `email`, `password`, `is_active`, `roles`, `nivel`) VALUES
	(1, 1, 1, 'lisandro', 'lisandrorattero@hotmail.com', '$2y$13$phuW/fIeFbfpS0uec1vgoe7RrQaLLvIeAs3sTlgphUyPq7/cPmGLC', 1, 'administrador de redes', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
