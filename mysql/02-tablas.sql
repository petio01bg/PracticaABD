-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2021 a las 17:17:01
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoABD`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `equipos` (
  `idEquipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `clasificacion` (
  `idEquipo` int(11) NOT NULL,
  `puntos` int(20) NOT NULL,
  `ganados` int(20) NOT NULL,
  `empatados` int(20) NOT NULL,
  `perdidos` int(20) NOT NULL,
  `golesmarcados` int(11) NOT NULL,
  `golesrecibidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `jugadores` (
  `idJugador` int(11) NOT NULL,
  `nombreJugador` varchar(15) NOT NULL,
  `equipo` varchar(40) NOT NULL,
  `dorsal` int(6) NOT NULL,
  `golesJugador` int(50) NOT NULL,
  `asistenciasJugador` int(50) NOT NULL,
  `salvadasJugador` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJugador`);

ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`idEquipo`);

ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`);

ALTER TABLE `clasificacion`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `jugadores`
  MODIFY `idJugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
