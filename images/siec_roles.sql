-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2020 a las 07:03:21
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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id_rol` int(11) NOT NULL,
  `rol_nombre` varchar(50) NOT NULL,
  `rol_descripcion` varchar(100) NOT NULL,
  `rol_fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rol_fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id_rol`, `rol_nombre`, `rol_descripcion`, `rol_fecha_modificacion`, `rol_fecha_creacion`) VALUES
(1, 'organizador', 'organiza', '2018-08-27 15:56:59', '2018-08-27 15:56:59'),
(2, 'asistente', 'teresita', '2018-08-27 15:57:25', '2018-08-27 15:57:25'),
(3, 'secretaria', 'persona encargada', '2018-10-09 14:11:52', '2018-10-09 14:11:52'),
(4, 'prueba', 'ansluisa', '2018-10-15 14:56:16', '2018-10-15 14:56:16'),
(5, 'visitante', 'visitasa', '2018-10-16 09:20:05', '2018-10-16 09:20:05'),
(6, 'doctor', 'atender pacientes', '2018-10-25 22:21:43', '2018-10-25 22:21:43'),
(7, 'cirugano', 'dentista', '2018-11-23 20:19:14', '2018-11-23 20:19:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
