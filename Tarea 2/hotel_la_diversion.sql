-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2024 a las 04:42:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_la_diversion`
--
CREATE DATABASE IF NOT EXISTS `hotel_la_diversion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hotel_la_diversion`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `ObtenerDetallesTour`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerDetallesTour` (IN `tour_id` INT)   BEGIN
    SELECT * FROM tours WHERE id_tour = tour_id;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `calcular_precio_total_tours`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_precio_total_tours` (`num_habitacion` INT) RETURNS INT(11)  BEGIN
    DECLARE total INT;
    
    SELECT COALESCE(SUM(t.precio_tour), 0) INTO total
    FROM reservas_tour rt
    INNER JOIN tours t ON rt.id_tour = t.id_tour
    WHERE rt.num_habitacion = num_habitacion;

    RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_habitaciones`
--

DROP TABLE IF EXISTS `calificacion_habitaciones`;
CREATE TABLE `calificacion_habitaciones` (
  `num_habitacion` int(4) NOT NULL,
  `calificacion` int(2) NOT NULL,
  `fecha_checkout` date NOT NULL,
  `dinero_de_tours` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificacion_habitaciones`
--

INSERT INTO `calificacion_habitaciones` (`num_habitacion`, `calificacion`, `fecha_checkout`, `dinero_de_tours`) VALUES
(2, 8, '2024-05-25', 170000),
(2, 9, '2024-06-10', 0),
(1, 10, '2024-05-31', 145000),
(6, 8, '2024-06-05', 57500),
(2, 5, '2024-06-28', 0),
(16, 10, '2024-05-30', 110000),
(17, 9, '2024-06-23', 82500),
(23, 4, '2024-05-28', 0),
(25, 7, '2024-06-07', 0),
(22, 6, '2024-05-28', 0),
(22, 8, '2024-05-28', 0),
(11, 10, '2024-05-31', 80000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_habitacion`
--

DROP TABLE IF EXISTS `reservas_habitacion`;
CREATE TABLE `reservas_habitacion` (
  `rut_huesped` int(8) NOT NULL,
  `num_habitacion` int(4) NOT NULL,
  `fecha_check_in` date NOT NULL,
  `fecha_check_out` date NOT NULL,
  `tipo_habitacion` varchar(6) NOT NULL,
  `total_tours` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_habitacion`
--

INSERT INTO `reservas_habitacion` (`rut_huesped`, `num_habitacion`, `fecha_check_in`, `fecha_check_out`, `tipo_habitacion`, `total_tours`) VALUES
(20227355, 20, '2024-05-20', '2024-06-01', 'Single', 3),
(18653453, 29, '2024-05-21', '2024-06-15', 'Double', 0),
(97854222, 35, '2024-05-30', '2024-06-03', 'Double', 2),
(10052525, 45, '2024-05-28', '2024-06-26', 'King', 0),
(19544554, 47, '2024-05-31', '2024-06-26', 'King', 0),
(17575542, 57, '2024-05-22', '2024-05-29', 'Double', 2),
(86868585, 63, '2024-05-27', '2024-06-07', 'Double', 0),
(96963453, 69, '2024-05-23', '2024-05-30', 'King', 2),
(72678534, 72, '2024-06-07', '2024-06-29', 'Double', 3),
(20254245, 77, '2024-06-02', '2024-06-07', 'Double', 0),
(81256754, 81, '2024-06-01', '2024-06-06', 'Single', 0),
(21445543, 85, '2024-05-19', '2024-06-09', 'Single', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_tour`
--

DROP TABLE IF EXISTS `reservas_tour`;
CREATE TABLE `reservas_tour` (
  `id_tour` int(1) NOT NULL,
  `num_habitacion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_tour`
--

INSERT INTO `reservas_tour` (`id_tour`, `num_habitacion`) VALUES
(5, 20),
(7, 20),
(3, 57),
(4, 57),
(2, 69),
(1, 69),
(5, 72),
(4, 72),
(6, 72),
(2, 35),
(3, 35),
(2, 20);

--
-- Disparadores `reservas_tour`
--
DROP TRIGGER IF EXISTS `actualizar_asistentes_despues_de_eliminar`;
DELIMITER $$
CREATE TRIGGER `actualizar_asistentes_despues_de_eliminar` AFTER DELETE ON `reservas_tour` FOR EACH ROW BEGIN
    UPDATE tours
    SET total_asistentes = total_asistentes - 1
    WHERE id_tour = OLD.id_tour;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `actualizar_total_asistentes`;
DELIMITER $$
CREATE TRIGGER `actualizar_total_asistentes` AFTER INSERT ON `reservas_tour` FOR EACH ROW BEGIN
    UPDATE tours
    SET total_asistentes = total_asistentes + 1
    WHERE id_tour = NEW.id_tour;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `actualizar_total_tours`;
DELIMITER $$
CREATE TRIGGER `actualizar_total_tours` AFTER INSERT ON `reservas_tour` FOR EACH ROW BEGIN
    DECLARE habitacion INT;
    SELECT num_habitacion INTO habitacion
    FROM reservas_habitacion
    WHERE num_habitacion = NEW.num_habitacion;
    UPDATE reservas_habitacion
    SET total_tours = total_tours + 1
    WHERE num_habitacion = habitacion;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `actualizar_total_tours_despues_de_eliminar`;
DELIMITER $$
CREATE TRIGGER `actualizar_total_tours_despues_de_eliminar` AFTER DELETE ON `reservas_tour` FOR EACH ROW BEGIN
    DECLARE habitacion INT;
    SELECT num_habitacion INTO habitacion
    FROM reservas_habitacion
    WHERE num_habitacion = OLD.num_habitacion;
    UPDATE reservas_habitacion
    SET total_tours = total_tours - 1
    WHERE num_habitacion = habitacion;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tours`
--

DROP TABLE IF EXISTS `tours`;
CREATE TABLE `tours` (
  `id_tour` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `medio_transporte` varchar(20) NOT NULL,
  `imagen_ref` varchar(50) NOT NULL,
  `total_asistentes` int(4) NOT NULL,
  `precio_tour` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tours`
--

INSERT INTO `tours` (`id_tour`, `fecha`, `lugar`, `medio_transporte`, `imagen_ref`, `total_asistentes`, `precio_tour`) VALUES
(1, '2024-06-05', 'Fiordo de Reloncaví', 'Embarcación', 'Ballena.jpg', 3, 85000),
(2, '2024-06-07', 'Lago Andino', 'Bus/Catamarán', 'PaseoEnLago.jpg', 9, 50000),
(3, '2024-06-09', 'Bosque Lagunas del Sur', 'Jeep 4x4', 'Safari.jpg', 6, 60000),
(4, '2024-06-11', 'Río Los Papus', 'Bus/Balsas Inflables', 'Rafting.jpg', 4, 75000),
(5, '2024-06-13', 'Pingu-Isla', 'Bus/Lancha', 'IslaPinguinos.jpg', 4, 30000),
(6, '2024-06-15', 'Sendero La Diversion', 'Senderismo', 'Senderismo.jpg', 4, 7500),
(7, '2024-06-17', 'Termas de Puyuhuapi', 'Bus/Lancha', 'TermasDePuyuhuapi.jpg', 3, 45000);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_calificaciones_promedio`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_calificaciones_promedio`;
CREATE TABLE `vista_calificaciones_promedio` (
`num_habitacion` int(4)
,`promedio_calificacion` decimal(3,1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_total_habitacion`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `vista_total_habitacion`;
CREATE TABLE `vista_total_habitacion` (
`num_habitacion` int(4)
,`fecha_check_in` date
,`fecha_check_out` date
,`tipo_habitacion` varchar(6)
,`id_tour` int(1)
,`precio_tour` int(6)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_calificaciones_promedio`
--
DROP TABLE IF EXISTS `vista_calificaciones_promedio`;

DROP VIEW IF EXISTS `vista_calificaciones_promedio`;
CREATE VIEW `vista_calificaciones_promedio`  AS SELECT `calificacion_habitaciones`.`num_habitacion` AS `num_habitacion`, cast(avg(`calificacion_habitaciones`.`calificacion`) as decimal(3,1)) AS `promedio_calificacion` FROM `calificacion_habitaciones` GROUP BY `calificacion_habitaciones`.`num_habitacion` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_total_habitacion`
--
DROP TABLE IF EXISTS `vista_total_habitacion`;

DROP VIEW IF EXISTS `vista_total_habitacion`;
CREATE VIEW `vista_total_habitacion`  AS SELECT `rh`.`num_habitacion` AS `num_habitacion`, `rh`.`fecha_check_in` AS `fecha_check_in`, `rh`.`fecha_check_out` AS `fecha_check_out`, `rh`.`tipo_habitacion` AS `tipo_habitacion`, `t`.`id_tour` AS `id_tour`, `t`.`precio_tour` AS `precio_tour` FROM ((`reservas_habitacion` `rh` left join `reservas_tour` `rt` on(`rh`.`num_habitacion` = `rt`.`num_habitacion`)) left join `tours` `t` on(`rt`.`id_tour` = `t`.`id_tour`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas_habitacion`
--
ALTER TABLE `reservas_habitacion`
  ADD PRIMARY KEY (`num_habitacion`);

--
-- Indices de la tabla `reservas_tour`
--
ALTER TABLE `reservas_tour`
  ADD KEY `reservas_tour_id_tour_tours` (`id_tour`),
  ADD KEY `reservas_tour_num_habitacion_reservas_habitacion` (`num_habitacion`);

--
-- Indices de la tabla `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id_tour`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas_tour`
--
ALTER TABLE `reservas_tour`
  ADD CONSTRAINT `reservas_tour_id_tour_tours` FOREIGN KEY (`id_tour`) REFERENCES `tours` (`id_tour`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `reservas_tour_num_habitacion_reservas_habitacion` FOREIGN KEY (`num_habitacion`) REFERENCES `reservas_habitacion` (`num_habitacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
