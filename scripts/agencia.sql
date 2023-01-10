-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-11-2022 a las 09:38:28
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agencia`
--
USE `agencia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

DROP TABLE IF EXISTS `aviso`;
CREATE TABLE IF NOT EXISTS `aviso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idEnvio` int NOT NULL,
  `fecha` date NOT NULL,
  `idRepartidor` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEnvio` (`idEnvio`),
  KEY `idRepartidor` (`idRepartidor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `DNI` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `mail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`DNI`, `nombre`, `apellidos`, `telefono`, `mail`, `password`, `activo`) VALUES
('98765432A', 'Sara', 'Sanz', '948550412', 'ssanzl@educacion.navarra.es', 'sara', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinatario`
--

DROP TABLE IF EXISTS `destinatario`;
CREATE TABLE IF NOT EXISTS `destinatario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `calle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `piso` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `idPoblacion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPoblacion` (`idPoblacion`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `destinatario`
--

INSERT INTO `destinatario` (`id`, `nombre`, `apellidos`, `correo`, `telefono`, `calle`, `piso`, `idPoblacion`) VALUES
(1, 'Pablo', 'García', 'pablog@gmail.com', '789456412', 'Paseo inmaculada 32', '5º C', 1),
(2, 'Miguel', 'Grandes', 'mgrandes@hotmail.com', '675489562', 'Mayor 25', '1º A', 1),
(3, 'Patricia', 'Luaño', 'patricial@gmail.com', '698475125', 'Mayor 2', '4º D', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

DROP TABLE IF EXISTS `envio`;
CREATE TABLE IF NOT EXISTS `envio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idDestinatario` int NOT NULL,
  `idRemitente` int NOT NULL,
  `DNICliente` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `peso` int NOT NULL,
  `ancho` int NOT NULL,
  `largo` int NOT NULL,
  `alto` int NOT NULL,
  `estado` int NOT NULL,
  `tarifa` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idDestinatario` (`idDestinatario`),
  KEY `idRemitente` (`idRemitente`),
  KEY `DNICliente` (`DNICliente`),
  KEY `estado` (`estado`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id`, `idDestinatario`, `idRemitente`, `DNICliente`, `fecha`, `peso`, `ancho`, `largo`, `alto`, `estado`, `tarifa`) VALUES
(1, 1, 1, '98765432A', '2022-10-31', 3, 25, 40, 20, 6, 'economica'),
(2, 1, 1, '98765432A', '2022-10-30', 3, 25, 40, 20, 6, 'economica'),
(3, 2, 2, '98765432A', '2022-10-29', 3, 40, 25, 30, 2, 'economica'),
(4, 3, 3, '98765432A', '2022-10-28', 3, 40, 25, 30, 2, 'economica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `tipo`) VALUES
(1, 'recogido'),
(2, 'entregado'),
(5, 'en reparto'),
(6, 'no recogido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacion`
--

DROP TABLE IF EXISTS `poblacion`;
CREATE TABLE IF NOT EXISTS `poblacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `cp` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `poblacion`
--

INSERT INTO `poblacion` (`id`, `nombre`, `cp`) VALUES
(1, 'estella', 31200),
(2, 'pamplona', 31012);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitente`
--

DROP TABLE IF EXISTS `remitente`;
CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `calle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `piso` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `idPoblacion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPoblacion` (`idPoblacion`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `remitente`
--

INSERT INTO `remitente` (`id`, `nombre`, `apellidos`, `correo`, `telefono`, `calle`, `piso`, `idPoblacion`) VALUES
(1, 'Maria', 'Fernandez', 'mariaf@gmail.com', '685745125', 'Plaza del Castillo 23', '3º C', 2),
(2, 'Marta', 'De Miguel', 'Martam@hotmail.com', '645987123', 'San Francisco Javier 10', '3º B', 1),
(3, 'Juana', 'De Miguel', 'juanaJ@hotmail.com', '615742158', 'Plaza aralar 4', '3º B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparpoblacion`
--

DROP TABLE IF EXISTS `reparpoblacion`;
CREATE TABLE IF NOT EXISTS `reparpoblacion` (
  `idRepartidor` int NOT NULL,
  `idPoblacion` int NOT NULL,
  PRIMARY KEY (`idRepartidor`,`idPoblacion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reparpoblacion`
--

INSERT INTO `reparpoblacion` (`idRepartidor`, `idPoblacion`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

DROP TABLE IF EXISTS `repartidor`;
CREATE TABLE IF NOT EXISTS `repartidor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `DNI` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellidos` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `DNI` (`DNI`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`id`, `DNI`, `Nombre`, `Apellidos`) VALUES
(1, '12345678A', 'Juan ', 'Perez'),
(2, '12345678B', 'Pedro', 'Martinez');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
