<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Info Jugador';

if (!isset($_SESSION["login"])) {
	$contenidoPrincipal = <<<EOF
	<h1>Usuario no registrado!</h1>
	<p>Debes iniciar sesión para ver la informacion de los jugadores..</p>
EOF;
} 
else {

    $jugador = '';
    $equipo = '';
    $dorsal = '';
    $contenidoPrincipal = <<<EOF
   <h1 class = "move"> 
   <span>INFORMACIÓN JUGADORES</span>
   <div class="liquid"></div>
   </h1>
   <div class="content">
   <div class="grupo-control">
   <form action="busquedaJugador.php" method="post">
        <p><label>Nombre del jugador:</label> <input class="control" type="text" name="jugador" value="$jugador" /></p>
        <p><label>Equipo:</label> <input class="control" type="text" name="equipo" value="$equipo" /></p>
        <p><label>Dorsal:</label> <input class="control" type="text" name="dorsal" value="$dorsal" /></p>
        <div class="grupo-control"><button type="submit" name="registro">Buscar</button></div>
        </form>
    </div>
    </div>
EOF;

}

include __DIR__.'/includes/plantillas/plantilla.php';