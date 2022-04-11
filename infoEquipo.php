<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Info Equipo';

if (!isset($_SESSION["login"])) {
	$contenidoPrincipal = <<<EOF
	<h1>Usuario no registrado!</h1>
	<p>Debes iniciar sesión para ver la informacion de los equipos..</p>
EOF;
} 
else {

    $equipo = '';
    $contenidoPrincipal = <<<EOF
   <h1 class = "move"> 
   <span>INFORMACIÓN EQUIPOS</span>
   <div class="liquid"></div>
   </h1>
   <div class="content">
   <div class="grupo-control">
   <form action="busquedaEquipo.php" method="post">
        <p><label>Equipo:</label> <input class="control" type="text" name="equipo" value="$equipo" /></p>
        <div class="grupo-control"><button type="submit" name="registro">Buscar</button></div>
        </form>
    </div>
    </div>
EOF;

}

include __DIR__.'/includes/plantillas/plantilla.php';