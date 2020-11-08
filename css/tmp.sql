-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2020 a las 02:07:04
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_ber1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `id_producto`, `cantidad_tmp`, `precio_tmp`, `session_id`, `fecha`, `num`) VALUES
(29, 1, 11, 40.00, '2o77qvpq8mqgij4hii8me17fq2', '2017-10-06 01:30:07', 0),
(28, 1, 2, 20.00, '6s800j0abc0tch4dapbeagqr40', '2017-10-06 01:30:07', 0),
(18, 1, 3, 20.00, '9i6v4nmn7qssbnjjksh415gjk1', '2017-10-06 01:30:07', 0),
(198, 2, 1, 122.00, '', '2017-10-06 02:22:15', 0),
(197, 2, 1, 122.00, '', '2017-10-06 02:13:02', 0),
(196, 2, 1, 122.00, '', '2017-10-06 02:10:39', 0),
(195, 2, 1, 122.00, '', '2017-10-06 02:09:58', 0),
(194, 2, 1, 122.00, '', '2017-10-06 02:09:57', 0),
(193, 2, 1, 122.00, '', '2017-10-06 02:09:57', 0),
(192, 4, 1, 1.00, '', '2017-10-06 02:08:59', 0),
(199, 2, 1, 122.00, '', '2017-10-06 03:48:48', 0),
(200, 2, 1, 122.00, '', '2017-10-07 10:22:47', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
