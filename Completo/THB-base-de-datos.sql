-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.1.72-community - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para thb
CREATE DATABASE IF NOT EXISTS `thb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `thb`;

-- Volcando estructura para tabla thb.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla thb.roles: 0 rows
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'Admin'),
	(2, 'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla thb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `born_date` date NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_role` (`id_role`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla thb.users: 4 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `born_date`, `phone_number`, `id_role`) VALUES
	(14, '2do Sujeto.', 'segunda@prueba.com', '2024-01-22', '5574859612', 2),
	(16, '3er Prueba edicion', 'tercer@prueba', '2003-11-21', '5578964132', 2),
	(17, 'Prueba final', 'ultima@prueba.com', '2019-05-11', '55987562145', 2),
	(13, 'Sujeto prueba', 'prueba@esunaprueba.com', '2024-06-20', '5512345678', 2),
	(12, 'Abdiel Mejia', 'oscar_abdiel01@hotmail.com', '2024-06-20', '5513045263', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
