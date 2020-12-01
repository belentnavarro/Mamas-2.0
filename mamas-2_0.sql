-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-11-2020 a las 13:34:11
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
-- Base de datos: `mamas-2_0`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers_numbers`
--

CREATE TABLE `answers_numbers` (
  `id` bigint NOT NULL,
  `questionId` bigint NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `content` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabla de respuestas tipo texto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers_texts`
--

CREATE TABLE `answers_texts` (
  `id` bigint NOT NULL,
  `questionId` bigint NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `content` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='tabla de respuestas tipo texto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam`
--

CREATE TABLE `exam` (
  `id` bigint NOT NULL,
  `dniCreator` varchar(9) NOT NULL,
  `title` varchar(75) NOT NULL,
  `score` smallint NOT NULL DEFAULT '0',
  `startsAt` datetime DEFAULT NULL,
  `endsAt` datetime DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `dni` varchar(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profilePhoto` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`dni`, `name`, `surname`, `email`, `password`, `profilePhoto`, `active`, `rol`) VALUES
('02984589b', 'belen', 'trujillo', 'belentnavarro@gmail.com', '$2y$10$arl4ooAsQV57NtpiWPZfee/tbENqaJU1pBD/zaZ8oFzimP6.mxzgS', 'dAPG.png', 1, 2),
('02984589t', 'candela', 'gomez', 'belentrujillo1997@gmail.com', '$2y$10$lta/TtJoM/dab54JMJUM7.Ivgnw2eO12SJ5/d/prhhvrRn2x.IMN6', 'dAPG.png', 1, 2),
('05921415t', 'luis', 'quesada', 'kherop@gmail.com', '$2y$10$VP3Ideg9.HmLYeoEUcouVe0FAiF5mEyxOAkGaS7H/D1BpThkHlCuS', '08-35-38dAPJ.png', 1, 2),
('32157845u', 'jaime', 'bolt', 'jay@gmail.com', '$2y$10$9LOS9/9tPTWLcNOadQRnUOwXE6WAyM9fHtQ9h8891c8tFQGbu/iH2', 'dAPG.png', 0, 0),
('45214592l', 'lobo', 'lobito', 'lobezno@gmail.com', '$2y$10$shbKXaW8ywE5c7BZY8Ao3eUnLg3T0YPD./cFU5w613gIjQHPMddvC', 'dAPG.png', 0, 0),
('62485126n', 'super', 'man', 'superman@gmail.com', '$2y$10$fyyIx4KkYo4f2zvc2pqvoeW.C.o2KWggLzEYh/bX3wbIGFmhr6Av6', 'dAPG.png', 0, 0),
('95426519d', 'wonder', 'woman', 'wonder@gmail.com', '$2y$10$PEHCxrcs/GHFDNDc5O0sxOgBaj5Mu9XhcCGNKf0j97elRVcg5A0g6', 'dAPG.png', 0, 0);

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
(0, '01248512o'),
(0, '02984589b'),
(0, '02984589t'),
(0, '05921415t'),
(0, '32157845u'),
(0, '45214592l'),
(0, '62485126n'),
(0, '95426519d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question`
--

CREATE TABLE `question` (
  `id` bigint NOT NULL,
  `dniCreator` varchar(9) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `score` smallint NOT NULL DEFAULT '0',
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(0, 'usuario'),
(1, 'profesor'),
(2, 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `answers_numbers`
--
ALTER TABLE `answers_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionId` (`questionId`);

--
-- Indices de la tabla `answers_texts`
--
ALTER TABLE `answers_texts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionId` (`questionId`);

--
-- Indices de la tabla `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dniCreator` (`dniCreator`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `personRol`
--
ALTER TABLE `personRol`
  ADD PRIMARY KEY (`idRol`,`dniPerson`);

--
-- Indices de la tabla `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dniCreator` (`dniCreator`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `answers_numbers`
--
ALTER TABLE `answers_numbers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `answers_texts`
--
ALTER TABLE `answers_texts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `answers_numbers`
--
ALTER TABLE `answers_numbers`
  ADD CONSTRAINT `answers_numbers_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`id`);

--
-- Filtros para la tabla `answers_texts`
--
ALTER TABLE `answers_texts`
  ADD CONSTRAINT `answers_texts_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`id`);

--
-- Filtros para la tabla `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`dniCreator`) REFERENCES `people` (`dni`);

--
-- Filtros para la tabla `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`dniCreator`) REFERENCES `people` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
