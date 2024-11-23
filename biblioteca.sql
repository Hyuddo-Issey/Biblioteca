-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 01:10:14
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE `author` (
  `ID_AUTHOR` bigint(20) NOT NULL,
  `FULL_NAME` varchar(255) NOT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `DATE_OF_DEATH` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`ID_AUTHOR`, `FULL_NAME`, `DATE_OF_BIRTH`, `DATE_OF_DEATH`) VALUES
(1, 'Gabriel García Márquez', '1927-03-06', '2014-04-17'),
(2, 'Leo Tolstoy', '1828-09-09', '1910-11-20'),
(3, 'George Orwell', '1903-06-25', '1950-01-21'),
(4, 'Haruki Murakami', '1949-01-12', NULL),
(5, 'Isabel Allende', '1942-08-02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `ID_BOOK` bigint(20) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `YEAR_PUBLICATION` year(4) DEFAULT NULL,
  `ID_AUTHOR` bigint(20) DEFAULT NULL,
  `ID_GENRE` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`ID_BOOK`, `TITLE`, `DESCRIPTION`, `YEAR_PUBLICATION`, `ID_AUTHOR`, `ID_GENRE`) VALUES
(1, 'Cien años de soledad', 'Una novela sobre la familia Buendía en el ficticio pueblo de Macondo.', '1967', 1, 1),
(2, 'Guerra y Paz', 'Una novela épica sobre la invasión napoleónica a Rusia y la vida de la aristocracia rusa.', '0000', 2, 5),
(3, '1984', 'Una crítica a los regímenes totalitarios y la manipulación de la verdad.', '1949', 3, 3),
(4, 'Kafka en la orilla', 'Un joven en busca de su destino se enfrenta a lo inexplicable.', '2002', 4, 4),
(5, 'La casa de los espíritus', 'Una saga familiar que mezcla lo real y lo sobrenatural.', '1982', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genre`
--

CREATE TABLE `genre` (
  `ID_GENRE` bigint(20) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genre`
--

INSERT INTO `genre` (`ID_GENRE`, `NAME`) VALUES
(1, 'Ficción'),
(2, 'Ciencia Ficción'),
(3, 'Misterio'),
(4, 'Fantasía'),
(5, 'No Ficción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `ID_STOCK` bigint(20) NOT NULL,
  `ID_BOOK` bigint(20) DEFAULT NULL,
  `TOTAL_STOCK` int(11) NOT NULL,
  `NOTES` varchar(255) DEFAULT NULL,
  `LAST_INVENTORY_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`ID_STOCK`, `ID_BOOK`, `TOTAL_STOCK`, `NOTES`, `LAST_INVENTORY_DATE`) VALUES
(1, 1, 30, 'En buen estado', '2024-11-20'),
(2, 2, 50, 'Exitoso en ventas', '2024-11-20'),
(3, 3, 20, 'Requiere reposición', '2024-11-20'),
(4, 4, 15, 'Poco solicitado', '2024-11-20'),
(5, 5, 25, 'Reedición reciente', '2024-11-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ID_AUTHOR`);

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID_BOOK`),
  ADD KEY `ID_AUTHOR` (`ID_AUTHOR`),
  ADD KEY `ID_GENRE` (`ID_GENRE`);

--
-- Indices de la tabla `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_GENRE`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_STOCK`),
  ADD KEY `ID_BOOK` (`ID_BOOK`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `author`
--
ALTER TABLE `author`
  MODIFY `ID_AUTHOR` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `ID_BOOK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `genre`
--
ALTER TABLE `genre`
  MODIFY `ID_GENRE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_STOCK` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `author` (`ID_AUTHOR`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`ID_GENRE`) REFERENCES `genre` (`ID_GENRE`);

--
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`ID_BOOK`) REFERENCES `book` (`ID_BOOK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
