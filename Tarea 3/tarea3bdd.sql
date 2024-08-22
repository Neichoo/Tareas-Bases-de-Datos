-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2024 a las 05:39:13
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
-- Base de datos: `tarea3bdd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `ID_ASIG` int(11) NOT NULL,
  `NOMBRE_A` varchar(45) NOT NULL,
  `CREDITOS_A` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`ID_ASIG`, `NOMBRE_A`, `CREDITOS_A`) VALUES
(1, 'Matematicas 1', 6),
(2, 'Matematicas 2', 6),
(3, 'Base de Datos', 5),
(4, 'Computacion Cientifica', 5),
(5, 'Programacion Basica', 5),
(6, 'Quimica Basica', 5),
(7, 'Arte', 2),
(8, 'Musica', 2),
(9, 'Etica', 2),
(10, 'Estructura de Datos', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura-extranjero`
--

CREATE TABLE `asignatura-extranjero` (
  `ASIGNATURA_ID_ASIG` int(11) NOT NULL,
  `EXTRANJERO_ID_EST` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chileno`
--

CREATE TABLE `chileno` (
  `ID_EST` int(11) NOT NULL,
  `PRIORIDAD` tinyint(2) NOT NULL,
  `PUNTAJE_PSU` smallint(3) NOT NULL,
  `PROM_NOTAS` decimal(2,1) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `DIRECCION` varchar(60) NOT NULL,
  `PERIODO` date NOT NULL,
  `FECHA_SOL` date NOT NULL,
  `PLAZO_IDEAL` int(11) NOT NULL,
  `LUGAR_RETIRO` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `chileno`
--

INSERT INTO `chileno` (`ID_EST`, `PRIORIDAD`, `PUNTAJE_PSU`, `PROM_NOTAS`, `NOMBRE`, `DIRECCION`, `PERIODO`, `FECHA_SOL`, `PLAZO_IDEAL`, `LUGAR_RETIRO`) VALUES
(1, 0, 750, 3.5, 'Juan Pérez', 'Calle Principal 123', '2024-01-01', '2024-05-10', 28, 'Sucursal Norte'),
(2, 1, 680, 3.2, 'María González', 'Av. Libertador 456', '2024-02-01', '2024-05-15', 30, 'Sucursal Sur'),
(3, 0, 720, 3.8, 'Carlos Ramírez', 'Pasaje Esperanza 789', '2024-03-01', '2024-05-20', 32, 'Oficina Central'),
(4, 1, 690, 3.6, 'Ana López', 'Ruta del Sol 234', '2024-04-01', '2024-05-25', 35, 'Sucursal Oeste'),
(5, 0, 760, 3.9, 'Pedro Silva', 'Calle Principal 567', '2024-05-01', '2024-06-01', 38, 'Sucursal Este'),
(6, 1, 700, 3.7, 'Sofía Martínez', 'Av. Libertad 890', '2024-06-01', '2024-06-05', 40, 'Oficina Principal'),
(7, 0, 730, 3.4, 'Jorge Fernández', 'Pasaje del Sol 123', '2024-07-01', '2024-06-10', 45, 'Sucursal Norte'),
(8, 1, 670, 3.1, 'Laura González', 'Calle del Río 456', '2024-08-01', '2024-06-15', 50, 'Sucursal Sur'),
(9, 0, 780, 3.8, 'Martín Pérez', 'Av. Independencia 789', '2024-09-01', '2024-06-20', 55, 'Oficina Central'),
(10, 1, 710, 3.6, 'Fernanda Ramírez', 'Ruta del Norte 234', '2024-10-01', '2024-06-25', 60, 'Sucursal Oeste'),
(11, 0, 740, 3.9, 'Diego López', 'Calle del Sol 567', '2024-11-01', '2024-07-01', 62, 'Sucursal Este'),
(12, 1, 680, 3.7, 'Valentina Silva', 'Av. Libertad 890', '2024-12-01', '2024-07-05', 65, 'Oficina Principal'),
(13, 0, 770, 3.5, 'Pablo Martínez', 'Pasaje del Río 123', '2025-01-01', '2024-07-10', 68, 'Sucursal Norte'),
(14, 1, 690, 3.3, 'Camila Fernández', 'Calle del Norte 456', '2025-02-01', '2024-07-15', 70, 'Sucursal Sur'),
(15, 0, 750, 3.8, 'Simón Pérez', 'Av. Principal 789', '2025-03-01', '2024-07-20', 75, 'Oficina Central');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extranjero`
--

CREATE TABLE `extranjero` (
  `ID_EST` int(11) NOT NULL,
  `PAIS` varchar(60) NOT NULL,
  `CARRERA` varchar(45) NOT NULL,
  `IDIOMA` varchar(25) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `DIRECCION` varchar(60) NOT NULL,
  `PERIODO` date NOT NULL,
  `CANT_CRED_TOTAL` tinyint(2) NOT NULL,
  `UNIVERSIDAD_ID_UNI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `extranjero`
--

INSERT INTO `extranjero` (`ID_EST`, `PAIS`, `CARRERA`, `IDIOMA`, `NOMBRE`, `DIRECCION`, `PERIODO`, `CANT_CRED_TOTAL`, `UNIVERSIDAD_ID_UNI`) VALUES
(1, 'Argentina', 'Ingeniería Civil', 'Español', 'Juan Pérez', 'Av. Libertador 123', '2024-01-01', 30, 1),
(2, 'Brasil', 'Medicina', 'Portugués', 'Maria Silva', 'Rua do Sol 456', '2024-02-01', 25, 2),
(3, 'Perú', 'Derecho', 'Español', 'Carlos Ramírez', 'Av. Principal 789', '2024-03-01', 20, 3),
(4, 'Colombia', 'Administración de Empresas', 'Español', 'Ana Gutiérrez', 'Calle Mayor 234', '2024-04-01', 35, 4),
(5, 'Ecuador', 'Arquitectura', 'Español', 'Diego Torres', 'Pasaje del Sol 567', '2024-05-01', 30, 5),
(6, 'Uruguay', 'Psicología', 'Español', 'Martina Fernández', 'Av. Libertad 890', '2024-06-01', 25, 6),
(7, 'Paraguay', 'Ingeniería Industrial', 'Español', 'Pedro González', 'Calle del Río 123', '2024-07-01', 20, 7),
(8, 'Bolivia', 'Medicina Veterinaria', 'Español', 'Laura Martínez', 'Pasaje del Mar 456', '2024-08-01', 15, 8),
(9, 'Venezuela', 'Economía', 'Español', 'Simón Ramírez', 'Av. Principal 789', '2024-09-01', 30, 9),
(10, 'Panamá', 'Ciencias de la Computación', 'Español', 'Valentina Pérez', 'Calle Mayor 234', '2024-10-01', 25, 10),
(11, 'Costa Rica', 'Biología', 'Español', 'Gabriel López', 'Pasaje del Sol 567', '2024-11-01', 20, 11),
(12, 'Honduras', 'Arquitectura', 'Español', 'Fernanda Martínez', 'Av. Libertad 890', '2024-12-01', 35, 6),
(13, 'El Salvador', 'Ingeniería Civil', 'Español', 'Pablo Gutiérrez', 'Calle del Río 123', '2025-01-01', 30, 13),
(14, 'Nicaragua', 'Derecho', 'Español', 'Valeria Ramírez', 'Pasaje del Mar 456', '2025-02-01', 25, 14),
(15, 'Paraguay', 'Ciencias Políticas', 'Español', 'Santiago Fernández', 'Av. Principal 789', '2025-03-01', 20, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE `universidad` (
  `ID_UNI` int(11) NOT NULL,
  `NOMBRE_U` varchar(60) NOT NULL,
  `CIUDAD_U` varchar(90) NOT NULL,
  `PAIS_U` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`ID_UNI`, `NOMBRE_U`, `CIUDAD_U`, `PAIS_U`) VALUES
(1, 'Universidad Tecnica Federico Santa Maria', 'Santiago', 'Chile'),
(2, 'Universidad de Chile', 'Santiago', 'Chile'),
(3, 'Universidad de Concepción', 'Concepción', 'Chile'),
(4, 'Pontificia Universidad Católica de Chile', 'Santiago', 'Chile'),
(5, 'Universidad de Santiago de Chile', 'Santiago', 'Chile'),
(6, 'Universidad Austral de Chile', 'Valdivia', 'Chile'),
(7, 'Universidad Católica del Norte', 'Antofagasta', 'Chile'),
(8, 'Universidad Diego Portales', 'Santiago', 'Chile'),
(9, 'Universidad de Valparaíso', 'Valparaíso', 'Chile'),
(10, 'Universidad Adolfo Ibáñez', 'Santiago', 'Chile'),
(11, 'Universidad Alberto Hurtado', 'Santiago', 'Chile'),
(12, 'Universidad de Talca', 'Talca', 'Chile'),
(13, 'Universidad de La Serena', 'La Serena', 'Chile'),
(14, 'Universidad de Los Lagos', 'Puerto Montt', 'Chile'),
(15, 'Universidad de Magallanes', 'Punta Arenas', 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad-chileno`
--

CREATE TABLE `universidad-chileno` (
  `CHILENO_ID_EST` int(11) NOT NULL,
  `UNIVERSIDAD_ID_UNI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`ID_ASIG`),
  ADD UNIQUE KEY `ID-ASIG_UNIQUE` (`ID_ASIG`);

--
-- Indices de la tabla `asignatura-extranjero`
--
ALTER TABLE `asignatura-extranjero`
  ADD PRIMARY KEY (`ASIGNATURA_ID_ASIG`,`EXTRANJERO_ID_EST`),
  ADD KEY `fk_ASIGNATURA-EXTRANJERO_EXTRANJERO1_idx` (`EXTRANJERO_ID_EST`);

--
-- Indices de la tabla `chileno`
--
ALTER TABLE `chileno`
  ADD PRIMARY KEY (`ID_EST`),
  ADD UNIQUE KEY `ID-EST_UNIQUE` (`ID_EST`);

--
-- Indices de la tabla `extranjero`
--
ALTER TABLE `extranjero`
  ADD PRIMARY KEY (`ID_EST`,`UNIVERSIDAD_ID_UNI`),
  ADD UNIQUE KEY `ID-EST_UNIQUE` (`ID_EST`),
  ADD KEY `fk_EXTRANJERO_UNIVERSIDAD1_idx` (`UNIVERSIDAD_ID_UNI`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`ID_UNI`),
  ADD UNIQUE KEY `ID-UNI_UNIQUE` (`ID_UNI`);

--
-- Indices de la tabla `universidad-chileno`
--
ALTER TABLE `universidad-chileno`
  ADD PRIMARY KEY (`CHILENO_ID_EST`,`UNIVERSIDAD_ID_UNI`),
  ADD KEY `fk_UNIVERSIDAD-CHILENO_UNIVERSIDAD1_idx` (`UNIVERSIDAD_ID_UNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura-extranjero`
--
ALTER TABLE `asignatura-extranjero`
  ADD CONSTRAINT `fk_ASIGNATURA-EXTRANJERO_ASIGNATURA` FOREIGN KEY (`ASIGNATURA_ID_ASIG`) REFERENCES `asignatura` (`ID_ASIG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ASIGNATURA-EXTRANJERO_EXTRANJERO1` FOREIGN KEY (`EXTRANJERO_ID_EST`) REFERENCES `extranjero` (`ID_EST`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `extranjero`
--
ALTER TABLE `extranjero`
  ADD CONSTRAINT `fk_EXTRANJERO_UNIVERSIDAD1` FOREIGN KEY (`UNIVERSIDAD_ID_UNI`) REFERENCES `universidad` (`ID_UNI`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `universidad-chileno`
--
ALTER TABLE `universidad-chileno`
  ADD CONSTRAINT `fk_UNIVERSIDAD-CHILENO_CHILENO1` FOREIGN KEY (`CHILENO_ID_EST`) REFERENCES `chileno` (`ID_EST`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UNIVERSIDAD-CHILENO_UNIVERSIDAD1` FOREIGN KEY (`UNIVERSIDAD_ID_UNI`) REFERENCES `universidad` (`ID_UNI`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
