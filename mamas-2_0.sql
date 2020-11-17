-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-11-2020 a las 14:10:00
-- Versión del servidor: 8.0.22-0ubuntu0.20.04.2
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mamas-2.0`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `dni` varchar(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `profilePhoto` varchar(60) NOT NULL,
  `registerDate` date NOT NULL,
  `lastLogin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`dni`, `name`, `surname`, `email`, `passwd`, `profilePhoto`, `registerDate`, `lastLogin`) VALUES
('1A', 'Luis', 'Quesada Romero', 'info@luisquesadadesign.com', 'hola1A', '', '2020-11-17', '2020-11-17'),
('2B', 'Belén', 'Trujillo Navarro', 'belentnavarro@gmail.com', 'hola2B', '', '2020-11-17', '2020-11-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personRol`
--

CREATE TABLE `personRol` (
  `idRol` int NOT NULL,
  `dniPerson` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personRol`
--

INSERT INTO `personRol` (`idRol`, `dniPerson`) VALUES
(0, '1A'),
(1, '2B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE `rols` (
  `id` int NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id`, `description`) VALUES
(0, 'administrador'),
(1, 'profesor'),
(2, 'alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `personRol`
--
ALTER TABLE `personRol`
  ADD PRIMARY KEY (`idRol`,`dniPerson`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
