-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 14:04:11
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `equipos` (
  `idEquipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `clasificacion` (
  `idEquipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `puntos` int(20) NOT NULL,
  `ganados` int(20) NOT NULL,
  `empatados` int(20) NOT NULL,
  `perdidos` int(20) NOT NULL,
  `golesmarcados` int(11) NOT NULL,
  `golesrecibidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ranking` (
  `IdJuego` int(11) DEFAULT NULL,
  `IdJugador` int(11) DEFAULT NULL,
  `goles` int(11) DEFAULT NULL,
  `asistencias` int(11) DEFAULT NULL,
  `salvadas` int(11) DEFAULT NULL
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

ALTER TABLE `ranking`
  ADD KEY `IdJuego` (`IdJuego`),
  ADD KEY `IdJugador` (`IdJugador`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`idJuego`);

ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`idEquipo`);

ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipo`);

ALTER TABLE `clasificacion`
  MODIFY `idEquipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `juegos`
  MODIFY `IdJuego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`Nombre`);

ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`IdJuego`) REFERENCES `juegos` (`IdJuego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ranking_ibfk_2` FOREIGN KEY (`IdJugador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `inscripcioneseventos`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEvento` (`idEvento`);

ALTER TABLE `inscripcioneseventos`
  ADD CONSTRAINT `inscripcioneseventos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripcioneseventos_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`);
COMMIT;