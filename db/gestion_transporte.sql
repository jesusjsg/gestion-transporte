-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-08-2024 a las 17:45:33
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_transporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `id_conductor` int NOT NULL,
  `nombre_conductor` varchar(255) NOT NULL,
  `cedula_conductor` varchar(255) NOT NULL,
  `telefono_conductor` varchar(255) NOT NULL,
  `id_vehiculo` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `vencimiento_cedula` date NOT NULL,
  `vencimiento_licencia` date NOT NULL,
  `vencimiento_certificadoMedico` date NOT NULL,
  `vencimiento_mppps` date NOT NULL,
  `vencimiento_saberes` date NOT NULL,
  `vencimiento_manejoSeguro` date NOT NULL,
  `vencimiento_alimento` date NOT NULL,
  `tipo_nomina` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id_viaje` int NOT NULL,
  `id_movimiento` int NOT NULL,
  `id_ruta` varchar(255) NOT NULL,
  `movimiento_km` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general`
--

CREATE TABLE `general` (
  `id_registro` int NOT NULL,
  `id_entidad` int NOT NULL,
  `descripcion1` varchar(255) NOT NULL,
  `descripcion2` varchar(255) NOT NULL,
  `descripcion3` varchar(255) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` varchar(255) NOT NULL,
  `nombre_ruta` varchar(255) NOT NULL,
  `origen` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `kilometros` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `nombre_apellido` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `id_rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` varchar(8) NOT NULL,
  `tipo_vehiculo` varchar(255) NOT NULL,
  `propiedad` int NOT NULL,
  `unidad_negocio` int NOT NULL,
  `marca` int NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `year_vehiculo` varchar(255) NOT NULL,
  `serial_carroceria` varchar(255) NOT NULL,
  `serial_motor` varchar(255) NOT NULL,
  `numero_ejes` int NOT NULL,
  `capacidad_carga` int NOT NULL,
  `uso` int NOT NULL,
  `vencimiento_poliza` date NOT NULL,
  `vencimiento_racda` date NOT NULL,
  `vencimiento_sanitario` date NOT NULL,
  `vencimiento_rotc` date NOT NULL,
  `fecha_fumigacion` date NOT NULL,
  `fecha_impuesto` date NOT NULL,
  `bolipuertos` int NOT NULL,
  `gps` int NOT NULL,
  `link_gps` varchar(255) NOT NULL,
  `estatus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id_viaje` int NOT NULL,
  `id_conductor` int NOT NULL,
  `id_vehiculo` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_tipo_operacion` int NOT NULL,
  `aviso` varchar(255) NOT NULL,
  `id_cliente` int NOT NULL,
  `id_ruta` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `sabados` int NOT NULL,
  `domingos` int NOT NULL,
  `feriados` int NOT NULL,
  `tasa_cambio` decimal(10,0) NOT NULL,
  `monto_usd` decimal(10,0) NOT NULL,
  `monto_ves` decimal(10,0) NOT NULL,
  `origen` int NOT NULL,
  `destino` int NOT NULL,
  `id_nomina` int NOT NULL,
  `total_kilometros` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`id_conductor`),
  ADD UNIQUE KEY `cedula_conductor` (`cedula_conductor`),
  ADD UNIQUE KEY `telefono_conductor` (`telefono_conductor`),
  ADD KEY `id_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id_viaje`,`id_movimiento`),
  ADD KEY `id_ruta` (`id_ruta`);

--
-- Indices de la tabla `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id_registro`,`id_entidad`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`),
  ADD UNIQUE KEY `nombre_ruta` (`nombre_ruta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `usuario_ibfk_1` (`id_rol`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD UNIQUE KEY `aviso` (`aviso`),
  ADD KEY `id_ruta` (`id_ruta`),
  ADD KEY `id_conductor` (`id_conductor`),
  ADD KEY `id_vehiculo` (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id_viaje` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ibfk_2` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`id_conductor`) REFERENCES `conductor` (`id_conductor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viaje_ibfk_3` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
