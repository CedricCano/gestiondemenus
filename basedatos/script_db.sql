-- phpMyAdmin SQL Dump
-- version 5.2.1
--
-- Servidor: 127.0.0.1
-- Fecha de generación: 24-06-2024 a las 10:03:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `menu_db`
--
create DATABASE menu_db2;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre_del_menu` varchar(255) NOT NULL,
  `descripcion_del_menu` text DEFAULT NULL,
  `id_menu_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `nombre_del_menu`, `descripcion_del_menu`, `id_menu_padre`) VALUES
(19, 'Catálogos', 'Catálogos del Sistema', NULL),
(27, 'bancos', 'catalogo de bancos', 19),
(29, 'proveedores ', 'opcion del catàlogo de proveedores internos', 19),
(30, 'usuarios', 'catalogo de usuarios', 19),
(31, 'reportes', 'reportes generales', NULL),
(32, 'edo de cuenta', 'estado de cuenta', 31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu_padre` (`id_menu_padre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`id_menu_padre`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
