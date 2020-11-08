-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2020 a las 06:46:14
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_siec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `siec_permisos`
--

CREATE TABLE `siec_permisos` (
  `per_id_permiso` int(11) NOT NULL,
  `per_id_rol` int(11) NOT NULL,
  `per_id_pantalla` int(11) NOT NULL,
  `per_consulta` varchar(1) NOT NULL,
  `per_insercion` varchar(1) NOT NULL,
  `per_eliminacion` varchar(1) NOT NULL,
  `per_actualizacion` varchar(1) NOT NULL,
  `per_fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_usu_modi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `siec_permisos`
--

INSERT INTO `siec_permisos` (`per_id_permiso`, `per_id_rol`, `per_id_pantalla`, `per_consulta`, `per_insercion`, `per_eliminacion`, `per_actualizacion`, `per_fecha_creacion`, `per_fecha_modificacion`, `per_usu_modi`) VALUES
(1, 1, 6, '1', '1', '1', '1', '2018-10-10 13:22:36', '2018-10-10 13:22:36', 0),
(2, 1, 7, '1', '1', '1', '1', '2018-10-10 13:32:09', '2018-10-10 13:32:09', 1),
(3, 1, 8, '0', '0', '0', '0', '2018-10-10 13:32:28', '2018-10-10 13:32:28', 1),
(4, 2, 10, '0', '0', '0', '0', '2018-10-10 13:38:22', '2018-10-10 13:38:22', 1),
(5, 3, 12, '0', '1', '1', '1', '2018-10-11 11:29:39', '2018-10-11 11:29:39', 1),
(6, 1, 9, '1', '1', '0', '0', '2018-10-11 11:34:56', '2018-10-11 11:34:56', 1),
(7, 3, 6, '0', '1', '0', '1', '2018-10-11 14:12:05', '2018-10-11 14:12:05', 1),
(8, 1, 15, '1', '1', '0', '1', '2018-10-12 13:19:22', '2018-10-12 13:19:22', 3),
(14, 4, 24, '1', '1', '0', '0', '2018-10-16 10:25:56', '2018-10-16 10:25:56', 1),
(15, 1, 24, '1', '1', '1', '1', '2018-10-16 12:10:23', '2018-10-16 12:10:23', 3),
(16, 1, 11, '1', '0', '1', '0', '2018-10-17 14:17:07', '2018-10-17 14:17:07', 3),
(17, 2, 8, '1', '1', '1', '1', '2018-10-18 09:26:53', '2018-10-18 09:26:53', 1),
(18, 2, 20, '1', '1', '1', '1', '2018-10-18 09:27:07', '2018-10-18 09:27:07', 1),
(19, 2, 21, '1', '1', '0', '1', '2018-10-18 09:27:24', '2018-10-18 09:27:24', 1),
(20, 2, 6, '0', '1', '1', '1', '2018-10-19 11:13:32', '2018-10-19 11:13:32', 1),
(21, 4, 20, '1', '1', '1', '1', '2018-10-22 11:45:52', '2018-10-22 11:45:52', 1),
(22, 6, 24, '0', '1', '1', '1', '2018-10-25 22:22:38', '2018-10-25 22:22:38', 1),
(23, 4, 22, '0', '1', '1', '1', '2018-10-25 22:24:42', '2018-10-25 22:24:42', 1),
(24, 4, 21, '0', '1', '1', '1', '2018-10-25 22:25:09', '2018-10-25 22:25:09', 1),
(25, 4, 14, '0', '1', '1', '1', '2018-10-25 22:25:26', '2018-10-25 22:25:26', 1),
(26, 7, 11, '0', '1', '1', '1', '2018-11-23 20:21:49', '2018-11-23 20:21:49', 1),
(27, 7, 24, '0', '1', '1', '1', '2018-11-23 20:22:45', '2018-11-23 20:22:45', 1),
(28, 7, 14, '0', '1', '1', '1', '2018-11-23 20:23:13', '2018-11-23 20:23:13', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `siec_permisos`
--
ALTER TABLE `siec_permisos`
  ADD PRIMARY KEY (`per_id_permiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `siec_permisos`
--
ALTER TABLE `siec_permisos`
  MODIFY `per_id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
