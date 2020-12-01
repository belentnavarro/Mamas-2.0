-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-12-2020 a las 19:37:56
-- Versión del servidor: 8.0.22-0ubuntu0.20.04.3
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

--
-- Volcado de datos para la tabla `answers_numbers`
--

INSERT INTO `answers_numbers` (`id`, `questionId`, `correct`, `content`) VALUES
(11, 82, 1, 9),
(12, 83, 1, 3),
(13, 89, 1, 13),
(14, 90, 1, 13),
(15, 91, 1, 5);

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

--
-- Volcado de datos para la tabla `answers_texts`
--

INSERT INTO `answers_texts` (`id`, `questionId`, `correct`, `content`) VALUES
(18, 72, 1, 'robusto'),
(19, 72, 1, 'fuertes'),
(20, 72, 1, 'testarudos'),
(70, 85, 0, 'cuentos inconclusos'),
(71, 85, 0, 'el hobbit'),
(72, 85, 0, 'el camino perdido'),
(73, 85, 1, 'hoja de niggle'),
(74, 86, 0, 'dracarys'),
(75, 86, 1, 'smaug'),
(76, 86, 0, 'mickey'),
(77, 86, 0, 'maud'),
(78, 87, 1, 'galadriel'),
(79, 87, 1, 'luthiel'),
(80, 87, 1, 'tinuviel'),
(81, 87, 1, 'eowin'),
(82, 88, 1, 'sauron'),
(83, 88, 1, 'destino'),
(84, 88, 1, 'volcan'),
(85, 88, 1, 'ella'),
(90, 93, 1, 'gris'),
(91, 93, 1, 'maia '),
(92, 93, 1, 'valar'),
(93, 93, 1, 'sauron'),
(102, 81, 1, 'elfos'),
(103, 81, 0, 'cebras'),
(104, 81, 1, 'enanos'),
(105, 81, 0, 'zariguella'),
(106, 84, 0, 'honorables'),
(107, 84, 0, 'fuertes'),
(108, 84, 0, 'Ágiles'),
(109, 80, 0, 'el pardo'),
(110, 80, 1, 'el gris'),
(111, 80, 0, 'el azul'),
(112, 80, 0, 'el blanco'),
(113, 92, 0, 'magos'),
(114, 92, 0, 'maiar'),
(115, 92, 0, 'valar'),
(116, 92, 0, 'sauron');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

CREATE TABLE `exams` (
  `id` bigint NOT NULL,
  `dniCreator` varchar(9) NOT NULL,
  `tittle` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `score` smallint NOT NULL DEFAULT '10',
  `startsAt` datetime DEFAULT NULL,
  `endsAt` datetime DEFAULT NULL,
  `description` text,
  `subject` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `exams`
--

INSERT INTO `exams` (`id`, `dniCreator`, `tittle`, `score`, `startsAt`, `endsAt`, `description`, `subject`) VALUES
(15, '05921415t', 'examen 4', 10, '2020-11-05 00:00:00', '2020-11-15 00:00:00', 'Descripcion examen 4', 'daw'),
(16, '05921415t', 'examen 5', 10, '2020-10-28 00:00:00', '2020-11-14 00:00:00', 'Descripcion examen 5', 'daw'),
(17, '05921415t', 'examen 2 -primera evaluación', 10, '2020-12-01 00:00:00', '2020-12-05 00:00:00', 'Descripción Examen 2 -Primera Evaluación', 'daw'),
(18, '05921415t', 'examen 5 -primera evaluación', 10, '2020-12-02 00:00:00', '2020-12-06 00:00:00', 'Descripción  - Examen 5 -Primera Evaluación', 'daw'),
(19, '05921415t', 'examen 6 -primera evaluación', 10, '2020-11-25 00:00:00', '2020-12-06 00:00:00', 'Descripción - Examen 6 -Primera Evaluación', 'daw');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_questions`
--

CREATE TABLE `exam_questions` (
  `idExam` bigint NOT NULL,
  `idQuestion` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `exam_questions`
--

INSERT INTO `exam_questions` (`idExam`, `idQuestion`) VALUES
(15, 80),
(16, 80),
(17, 80),
(18, 80),
(19, 80),
(15, 81),
(17, 81),
(18, 81),
(19, 81),
(15, 82),
(19, 82),
(15, 83),
(16, 83),
(17, 83),
(18, 83),
(19, 83),
(15, 84),
(16, 84),
(17, 84),
(18, 84),
(19, 84),
(15, 85),
(17, 85),
(18, 85),
(17, 86),
(19, 86),
(16, 87),
(15, 88),
(16, 88),
(18, 88),
(15, 89),
(16, 89),
(17, 89),
(18, 89),
(19, 89),
(15, 90),
(16, 90),
(18, 90),
(19, 90),
(16, 91),
(17, 91),
(18, 91),
(15, 92),
(16, 92),
(17, 92),
(18, 92),
(19, 92),
(16, 93),
(17, 93),
(19, 93);

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
('01248512o', 'belen', 'trujillo', 'belentnavarro@gmail.com', '$2y$10$NYEFqSFj.Wa3Rk14vQDm4eZtT40GU17Re8be.vFOoyAy.ncKxA7Qy', 'dAPG.png', 1, 2),
('05921415t', 'luis', 'quesada', 'kherop@gmail.com', '$2y$10$UoqGT6.zln0fGcko/zOYNOR5VArHgSlfQzxikuyn1arBVT.Tio/Ey', '12-59-07dAPJ.png', 1, 2),
('32015784p', 'sergi', 'walls', 'walls@gmail.com', '$2y$10$8/ZISrMZ0r53rWGEkdPb6OcnqD.L7z2AhSsn.Qtd3Q1T98mV.e7vG', 'dAPG.png', 0, 1),
('32157845u', 'jaime', 'bolts', 'jay@gmail.com', '$2y$10$9LOS9/9tPTWLcNOadQRnUOwXE6WAyM9fHtQ9h8891c8tFQGbu/iH2', 'dAPG.png', 0, 0),
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
(0, '32157845u'),
(0, '45214592l'),
(0, '62485126n'),
(0, '95426519d'),
(1, '32015784p'),
(2, '01248512o'),
(2, '05921415t');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` bigint NOT NULL,
  `dniCreator` varchar(9) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `score` smallint NOT NULL DEFAULT '0',
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `dniCreator`, `type`, `active`, `score`, `content`) VALUES
(72, '05921415t', 'writter', 1, 1, '¿describe la raza enana?'),
(80, '05921415t', 'option', 1, 1, '¿con que sobrenombre conoce al mago gandalf?'),
(81, '05921415t', 'option', 1, 1, 'razas de la tierra media'),
(82, '05921415t', 'number', 1, 1, '¿cuantos anillos entrego sauron a los reyes de los hombres?'),
(83, '05921415t', 'number', 1, 1, '¿cuantos hobbits acompañan a frodo en su viaje hasta el monte destino?'),
(84, '05921415t', 'writter', 1, 1, 'háblame de la raza elfa'),
(85, '05921415t', 'option', 1, 1, 'uno de estos libros no pertenece a la tierra media'),
(86, '05921415t', 'option', 1, 1, 'el nombre del dragón que guarda el tesoro en \'el hobbit\' es...'),
(87, '05921415t', 'option', 1, 1, '¿quién es la abuela materna de arwen?'),
(88, '05921415t', 'writter', 1, 1, '¿que sabes de mordor?'),
(89, '05921415t', 'number', 1, 1, '¿cuantos libros comprenden la historia de la tierra media?'),
(90, '05921415t', 'number', 1, 1, '¿cuantos miembros componen la compañia de thorin, escudo de roble?'),
(91, '05921415t', 'number', 1, 1, '¿cuantos istari conocemos?'),
(92, '05921415t', 'writter', 1, 1, '¿qué sabes de los istari?'),
(93, '05921415t', 'writter', 1, 1, '¿quien es gandalf?');

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
-- Indices de la tabla `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dniCreator` (`dniCreator`);

--
-- Indices de la tabla `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`idExam`,`idQuestion`),
  ADD KEY `idQuestion` (`idQuestion`);

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
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
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
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `answers_texts`
--
ALTER TABLE `answers_texts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `answers_numbers`
--
ALTER TABLE `answers_numbers`
  ADD CONSTRAINT `answers_numbers_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`id`);

--
-- Filtros para la tabla `answers_texts`
--
ALTER TABLE `answers_texts`
  ADD CONSTRAINT `answers_texts_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`id`);

--
-- Filtros para la tabla `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`dniCreator`) REFERENCES `people` (`dni`);

--
-- Filtros para la tabla `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`idExam`) REFERENCES `exams` (`id`),
  ADD CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`id`);

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`dniCreator`) REFERENCES `people` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
