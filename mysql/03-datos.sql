TRUNCATE TABLE `Usuarios`;

/*
  user: userpass
  admin: adminpass
*/
INSERT INTO `Usuarios` (`id`, `nombreUsuario`, `nombre`, `password`, `correo`) VALUES
(1, 'admin', 'Administrador', '$2y$10$j3gDDnUmICg/rvP0lmz8Duv2FcE1Ufi0tDQpIqx5cKcbqtkBOxhfS','user@ucm.es'),
(2, 'user', 'Usuario', '$2y$10$ImLgzNnDkWlI7LBB5a1mk.vNu8Fb8z79syAsoOXqM7jy5hrTaZKnG','admin@ucm.es');

INSERT INTO `jugadores` (`idJugador`, `nombreJugador`, `equipo`, `dorsal`, `golesJugador`,`asistenciasJugador`,`salvadasJugador`) VALUES
(1, 'Karim Benzema', 'Real Madrid CF', 9, 30,15,0),
(2, 'Pierre-Emerik Aubameyang', 'FC Barcelona', 25, 11, 5, 0);