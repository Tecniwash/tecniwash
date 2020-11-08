-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2020 a las 06:20:53
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
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_nombre` varchar(255) NOT NULL,
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `estatus` enum('0','1') NOT NULL DEFAULT '1',
  `logo` varchar(200) NOT NULL,
  `pant_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_nombre`, `id_padre`, `link`, `estatus`, `logo`, `pant_nombre`) VALUES
(1, ' consulta medica</a><div>', 0, '#', '1', 'fa fa-briefcase-medical icon-large', ''),
(2, 'control de pacientes</a><div>', 0, '#', '1', 'fa fa-user-tie icon-large', ''),
(3, 'medicamentos</a><div>', 0, '#', '1', 'fa fa-pills icon-large', ''),
(4, 'Administracion</a><div>', 0, '#', '1', 'fa fa-procedures icon-large', ''),
(5, 'Seguridad</a><div>', 0, '#', '1', 'fa fa-cogs icon-list icon-large', ''),
(6, 'usuarios</a>', 5, 'usuarios.php', '1', '', 'Usuarios'),
(7, 'Permisos Pantalla</a>', 5, 'perfiles_pantalla.php', '1', '', 'Permisos Pantalla'),
(8, 'Roles</a>', 5, 'roles.php', '1', '', 'Roles'),
(9, 'Pantallas</a>', 5, 'pantallas.php', '1', '', 'Pantallas'),
(10, 'Configuracion</a>', 5, 'parametro.php', '1', '', 'Configuracion'),
(11, 'Empleados</a>', 4, 'empleados.php', '1', '', 'Empleados'),
(12, 'Clinicas</a>', 4, 'clinicas.php', '1', '', 'Clinicas'),
(13, 'Region</a>', 4, 'region.php', '0', '', 'Region'),
(14, 'Medicamentos a Entregar </a>', 3, 'medicamentos_entre.php', '1', '', 'Medicamento a Entregar'),
(15, 'Existencias </a>', 3, 'existencias.php', '1', '', 'Existencias'),
(16, 'Historial Operaciones</a>', 3, 'historial_operaciones.php', '1', '', 'Historial Operaciones'),
(17, 'Entrada de Medicamentos </a>', 3, 'entradas_exis.php', '1', '', 'Entrada de Medicamentos'),
(18, 'Catalogo Inventario </a>', 3, 'catalogo_inventario.php', '1', '', 'Catalogo Inventario'),
(19, 'unidad medida </a>', 3, 'unidad_medida.php', '1', '', 'Unidad de Medida'),
(20, 'Lista de Pacientes </a>', 2, 'pacientes_pendiente.php', '1', '', 'Lista de Pacientes'),
(21, 'Incapacidades</a>', 2, 'incapacidad_mes.php', '1', '', 'Incapacidades'),
(22, 'Historial Incapacidades </a>', 2, 'historial_incapacidades.php', '1', '', 'Historial Incapacidade'),
(23, 'Enfermedades</a>', 2, 'enfermedad.php', '1', '', 'Enfermedades'),
(24, 'Control Atencion Medica </a>', 1, 'pacientes_doctor.php', '1', '', 'Control Atenciones'),
(25, 'Historial Atenciones</a>', 1, 'historial_atenciones.php', '1', '', 'Historial Atenciones'),
(26, 'Historial Medico </a>', 1, 'mantenimiento_historial.php', '1', '', 'Historial medico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
