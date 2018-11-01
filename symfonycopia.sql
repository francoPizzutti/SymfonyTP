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

-- Volcando datos para la tabla symfonycopia.cargo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `id_cargo`, `descripcion`) VALUES
	(1, 1, 'Usuario de Mesa de Ayuda'),
	(2, 2, 'Usuario de Grupo de Resolución');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.direccion
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_direccion` int(11) NOT NULL,
  `calle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `oficina` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.direccion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` (`id`, `id_direccion`, `calle`, `piso`, `numero`, `oficina`) VALUES
	(1, 1, 'San Martin ', 5, 3049, 'secretaria de extensión'),
	(2, 2, 'Junin 218', 1, 344, 'administración de ingresos');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.empleado: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`id`, `cargo_id`, `direccion_id`, `legajo`, `nombre`, `apellido`, `telefono_interno`, `telefono_directo`) VALUES
	(1, 1, 1, 1, 'Lisandro Adolfo', 'Rattero', '344', '3424999235'),
	(2, 1, 2, 2, 'Franco Damián', 'Beber', '223', '3455277345');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.estado_grupo_resolucion
CREATE TABLE IF NOT EXISTS `estado_grupo_resolucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_grupo` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.estado_grupo_resolucion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `estado_grupo_resolucion` DISABLE KEYS */;
INSERT INTO `estado_grupo_resolucion` (`id`, `id_estado_grupo`, `descripcion`) VALUES
	(1, 1, 'Activo'),
	(2, 2, 'InActivo');
/*!40000 ALTER TABLE `estado_grupo_resolucion` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.grupo_resolucion: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo_resolucion` DISABLE KEYS */;
INSERT INTO `grupo_resolucion` (`id`, `estado_id`, `codigo`, `nombre`, `nivel`) VALUES
	(1, 1, 1, 'Mesa de ayuda', 0),
	(2, 1, 2, 'Unidades de soporte', 1);
/*!40000 ALTER TABLE `grupo_resolucion` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.migration_versions
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla symfonycopia.migration_versions: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`) VALUES
	('20181030194429');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Volcando estructura para tabla symfonycopia.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_resolucion_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649952BE730` (`empleado_id`),
  KEY `IDX_8D93D649A0FF6FD8` (`grupo_resolucion_id`),
  CONSTRAINT `FK_8D93D649952BE730` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`),
  CONSTRAINT `FK_8D93D649A0FF6FD8` FOREIGN KEY (`grupo_resolucion_id`) REFERENCES `grupo_resolucion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla symfonycopia.user: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `grupo_resolucion_id`, `empleado_id`, `username`, `email`, `password`, `is_active`, `roles`, `nivel`) VALUES
	(1, 1, 1, 'lisandro', 'lisandrorattero@hotmail.com', '$2y$13$phuW/fIeFbfpS0uec1vgoe7RrQaLLvIeAs3sTlgphUyPq7/cPmGLC', 1, 'administrador de redes', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
