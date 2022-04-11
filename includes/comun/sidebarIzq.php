<nav id="sidebarIzq">
	<ul>
	<ul class="menu">
		<li><a href="index.php">Inicio</a></li>
		<li><a href="goles.php">Goleadores</a></li>
		<li><a href="asistencias.php">Asistentes</a></li>
		<li><a href="salvadas.php">Salvadores</a></li>
		<li><a href="showClasificacion.php">Clasificacion</a></li>
		<li><a href="infoEquipo.php">Equipos</a></li>
		<li><a href="infoJugador.php">Jugadores</a></li>
		
		<?php 
			if($_SESSION['esAdmin']){
				$contenido = <<<EOF
				<li><a href="">Operaciones</a>
				<ul>
				<ul class="submenu">
				<li><a href="newJugador.php">Añadir Jugador</a></li>
				<li><a href="newEquipo.php">Añadir Equipo</a></li>
				<li><a href="newClasificacion.php">Añadir Clasificacion</a></li>
				<li><a href="borraJugador.php">Borrar Jugador</a></li>
				<li><a href="borraEquipo.php">Borrar Equipo</a></li>
				</ul></li>
			EOF;

			echo $contenido;
			}

		?>
	</ul>
</nav>