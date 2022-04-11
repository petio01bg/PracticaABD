<?php

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Contenido';

if (!isset($_SESSION["login"])) {
	$contenidoPrincipal = <<<EOF
	<h1>Usuario no registrado!</h1>
	<p>Debes iniciar sesión para ver el contenido..</p>
EOF;
} 
else {
	$app = \es\fdi\ucm\aw\Aplicacion::getInstancia();
	$con = $app->conexionBd();
	$query = sprintf("SELECT idJugador FROM jugadores ORDER BY salvadasJugador DESC");
    $rs = $con->query($query);

	$jugadores=array();
	$cont = 0;
	while($fila = $rs->fetch_assoc()){
		$jugadores[$cont] = $fila["idJugador"];
		$cont++;
	}

    $contenidoPrincipal = <<<EOF
		<div>
   <h1 class = "move"> 
   <span>MAXIMOS GOLEADORES</span>
   <div class="liquid"></div>
   </h1>
    <table>
      <tr>
      <th>JUGADOR</th>
      <th>EQUIPO</th>
	  <th>DORSAL</th>
	  <th>SALVADAS</th>
      </tr>
EOF;

for($i = 0; $i < $cont; $i++){
	$jug = \es\fdi\ucm\aw\Jugador::buscaJugador($jugadores[$i]);
	$nombre = $jug->getNombreJugador();
	$equipo = $jug->getEquipo();
	$dorsal = $jug->getDorsal();
	$salvadas = $jug->getSalvadas();

	if($salvadas != 0){
		$contenidoPrincipal.=<<<EOF
			<tr>
				<td>{$nombre}</td>
				<td>{$equipo}</td>
				<td>{$dorsal}</td>
				<td>{$salvadas}</td>
			</tr>
EOF;
	}
}

$contenidoPrincipal.=<<<EOF
</table>		
EOF;
$rs->free();
}

include __DIR__.'/includes/plantillas/plantilla.php';