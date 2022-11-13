-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-12-2021 a las 21:27:39
-- Versión del servidor: 8.0.27-0ubuntu0.21.10.1
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE `Alumnos` (
  `IdAlumnos` int NOT NULL,
  `NombreAl` varchar(150) NOT NULL,
  `FechaNac` varchar(30) NOT NULL,
  `Matricula` varchar(10) NOT NULL,
  `Ciudad` varchar(150) NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `Correo` varchar(300) NOT NULL,
  `Grado` int NOT NULL,
  `IdGrupo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`IdAlumnos`, `NombreAl`, `FechaNac`, `Matricula`, `Ciudad`, `Genero`, `Correo`, `Grado`, `IdGrupo`) VALUES
(7, 'GIOVANNI EUGENIO HERNANDEZ', '2000-06-26', '001', 'Ixtaczoquitlan', 'Hombre', 'giovannihernandez1012@gmail.com', 7, 1),
(8, 'ARTURO SANCHEZ LUNA', '1999-04-09', '002', 'Mendoza', 'Hombre', '186w0358@zongolica.tecnm.mx', 7, 1),
(23, 'ejemplo', '5055-05-05', '125', 'ejemplo', 'Mujer', 'ejemplo@ejemplo.com', 7, 3),
(24, 'jose juan lopez Hernandez', '2001-02-22', '005', 'nogales', 'Indefinido', 'joselopez@gmail.com', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calificaciones`
--

CREATE TABLE `Calificaciones` (
  `IdCalificacion` int NOT NULL,
  `Calificacion` int NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `IdAlumnos` int NOT NULL,
  `IdMateriasG` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupos`
--

CREATE TABLE `Grupos` (
  `IdGrupos` int NOT NULL,
  `NombreGru` varchar(50) NOT NULL,
  `PeriodoGrup` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Grupos`
--

INSERT INTO `Grupos` (`IdGrupos`, `NombreGru`, `PeriodoGrup`) VALUES
(1, 'ISC', '2018-2022'),
(3, 'IGE', '2019-2023'),
(4, 'IDC', '2021-2025'),
(5, 'IDC', '2018-2022'),
(6, 'ISC', '2021-2025'),
(7, 'ISC', '2019-2023'),
(8, 'IGE', '2018-2022'),
(9, 'ISC', '2020-2024'),
(10, 'IGE', '2020-2024');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Materias`
--

CREATE TABLE `Materias` (
  `IdMateria` int NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Clave` varchar(50) NOT NULL,
  `Grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Materias`
--

INSERT INTO `Materias` (`IdMateria`, `Nombre`, `Clave`, `Grado`) VALUES
(1, 'Programacion Web', 'Materia01501', '8'),
(3, 'Taller de Investigacion', 'Materia01502', '7'),
(12, 'Gestion de proyectos de Software', 'Materia01503', '4'),
(13, 'Tutoria', 'Materia01504', '5'),
(14, 'Lenguajes y Automatas', 'Materia01505', '7'),
(15, 'Lenguajes y Automatas II', 'Materia01506', '8'),
(16, 'Ingenieria de Software', 'Materia01507', '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MateriasGrupo`
--

CREATE TABLE `MateriasGrupo` (
  `IdMateriaG` int NOT NULL,
  `IdProfe` int NOT NULL,
  `IdMaterias` int NOT NULL,
  `IdGrupo` int NOT NULL,
  `MatriClas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `MateriasGrupo`
--

INSERT INTO `MateriasGrupo` (`IdMateriaG`, `IdProfe`, `IdMaterias`, `IdGrupo`, `MatriClas`) VALUES
(1, 1, 1, 1, 'clase001'),
(2, 2, 3, 1, 'clase002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profesor`
--

CREATE TABLE `Profesor` (
  `IdProfe` int NOT NULL,
  `NombreP` varchar(250) NOT NULL,
  `CorreoP` varchar(300) NOT NULL,
  `Genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Profesor`
--

INSERT INTO `Profesor` (`IdProfe`, `NombreP`, `CorreoP`, `Genero`) VALUES
(1, 'Martin Contreras de la Cruz', 'Martin.C.C@gmail.com', 'Hombre'),
(2, 'Maria Edith Quezada Fadanelli', 'Maria_Edith@hotmail.com', 'Mujer'),
(3, 'Norma Hernandez', 'NM123121@outlook.com', 'Mujer'),
(4, 'Humberto Marin Vega', 'Marin-vega-H@gmail.com', 'Hombre'),
(6, 'Guadalupe Nidia Cruz Hernandez', 'Lupe.Nidia@tecnm.mx', 'Mujer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD PRIMARY KEY (`IdAlumnos`),
  ADD UNIQUE KEY `Matricula` (`Matricula`),
  ADD UNIQUE KEY `Matricula_2` (`Matricula`),
  ADD UNIQUE KEY `Matricula_6` (`Matricula`),
  ADD KEY `IdGrupo` (`IdGrupo`),
  ADD KEY `Matricula_5` (`Matricula`);
ALTER TABLE `Alumnos` ADD FULLTEXT KEY `Matricula_3` (`Matricula`);
ALTER TABLE `Alumnos` ADD FULLTEXT KEY `Matricula_4` (`Matricula`);

--
-- Indices de la tabla `Calificaciones`
--
ALTER TABLE `Calificaciones`
  ADD PRIMARY KEY (`IdCalificacion`),
  ADD KEY `IdAlumnos` (`IdAlumnos`),
  ADD KEY `IdMateriasG` (`IdMateriasG`);

--
-- Indices de la tabla `Grupos`
--
ALTER TABLE `Grupos`
  ADD PRIMARY KEY (`IdGrupos`);

--
-- Indices de la tabla `Materias`
--
ALTER TABLE `Materias`
  ADD PRIMARY KEY (`IdMateria`),
  ADD UNIQUE KEY `Clave` (`Clave`);

--
-- Indices de la tabla `MateriasGrupo`
--
ALTER TABLE `MateriasGrupo`
  ADD PRIMARY KEY (`IdMateriaG`),
  ADD UNIQUE KEY `MatriClas` (`MatriClas`),
  ADD KEY `IdMaterias` (`IdMaterias`),
  ADD KEY `IdGrupo` (`IdGrupo`),
  ADD KEY `IdProfe` (`IdProfe`);

--
-- Indices de la tabla `Profesor`
--
ALTER TABLE `Profesor`
  ADD PRIMARY KEY (`IdProfe`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  MODIFY `IdAlumnos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `Calificaciones`
--
ALTER TABLE `Calificaciones`
  MODIFY `IdCalificacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Grupos`
--
ALTER TABLE `Grupos`
  MODIFY `IdGrupos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Materias`
--
ALTER TABLE `Materias`
  MODIFY `IdMateria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `MateriasGrupo`
--
ALTER TABLE `MateriasGrupo`
  MODIFY `IdMateriaG` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Profesor`
--
ALTER TABLE `Profesor`
  MODIFY `IdProfe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD CONSTRAINT `Alumnos_ibfk_1` FOREIGN KEY (`IdGrupo`) REFERENCES `Grupos` (`IdGrupos`);

--
-- Filtros para la tabla `Calificaciones`
--
ALTER TABLE `Calificaciones`
  ADD CONSTRAINT `Calificaciones_ibfk_1` FOREIGN KEY (`IdAlumnos`) REFERENCES `Alumnos` (`IdAlumnos`),
  ADD CONSTRAINT `Calificaciones_ibfk_2` FOREIGN KEY (`IdMateriasG`) REFERENCES `MateriasGrupo` (`IdMateriaG`);

--
-- Filtros para la tabla `MateriasGrupo`
--
ALTER TABLE `MateriasGrupo`
  ADD CONSTRAINT `MateriasGrupo_ibfk_1` FOREIGN KEY (`IdMaterias`) REFERENCES `Materias` (`IdMateria`),
  ADD CONSTRAINT `MateriasGrupo_ibfk_2` FOREIGN KEY (`IdGrupo`) REFERENCES `Grupos` (`IdGrupos`),
  ADD CONSTRAINT `MateriasGrupo_ibfk_3` FOREIGN KEY (`IdProfe`) REFERENCES `Profesor` (`IdProfe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
